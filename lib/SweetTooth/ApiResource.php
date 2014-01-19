<?php

abstract class SweetTooth_ApiResource extends SweetTooth_Object
{
  protected static function _scopedRetrieve($class, $id, $apiKey=null)
  {
    $instance = new $class($id, $apiKey);
    $instance->refresh();
    return $instance;
  }

  public function refresh()
  {
    $requestor = new SweetTooth_ApiRequestor($this->_apiKey);
    $url = $this->instanceUrl();

    list($response, $apiKey) = $requestor->request('get', $url, $this->_retrieveOptions);
    $this->refreshFrom($response, $apiKey);
    return $this;
   }

  public static function className($class)
  {
    // Useful for namespaces: Foo\SweetTooth_Charge
    if ($postfix = strrchr($class, '\\'))
      $class = substr($postfix, 1);
    if (substr($class, 0, strlen('SweetTooth')) == 'SweetTooth')
      $class = substr($class, strlen('SweetTooth'));
    $class = str_replace('_', '', $class);
    $name = urlencode($class);
    $name = strtolower($name);
    return $name;
  }

  /**
   * Override this function for irregular plural
   * names. Eg. Activities
   * Default functionality is to append an 's'
   */
  public static function classNamePlural($class)
  {
    $base = self::_scopedLsb($class, 'className', $class);
    return "${base}s";
  }

  public static function classUrl($class)
  {
    $base = self::_scopedLsb($class, 'classNamePlural', $class);
    return "/v1/${base}";
  }

  public function instanceUrl()
  {
    $id = $this['id'];
    $class = get_class($this);
    if (!$id) {
      throw new SweetTooth_InvalidRequestError("Could not determine which URL to request: $class instance has invalid ID: $id", null);
    }
    $id = SweetTooth_ApiRequestor::utf8($id);
    $base = $this->_lsb('classUrl', $class);
    $extn = urlencode($id);
    return "$base/$extn";
  }

  private static function _validateCall($method, $params=null, $apiKey=null)
  {
    if ($params && !is_array($params))
      throw new SweetTooth_Error("You must pass an array as the first argument to SweetTooth API method calls.  (HINT: an example call to create a charge would be: \"SweetToothCharge::create(array('amount' => 100, 'currency' => 'usd', 'card' => array('number' => 4242424242424242, 'exp_month' => 5, 'exp_year' => 2015)))\")");
    if ($apiKey && !is_string($apiKey))
      throw new SweetTooth_Error('The second argument to SweetTooth API method calls is an optional per-request apiKey, which must be a string.  (HINT: you can set a global apiKey by "SweetTooth::setApiKey(<apiKey>)")');
  }

  protected static function _scopedAll($class, $params=null, $apiKey=null)
  {
    self::_validateCall('all', $params, $apiKey);
    $requestor = new SweetTooth_ApiRequestor($apiKey);
    $url = self::_scopedLsb($class, 'classUrl', $class);
    list($response, $apiKey) = $requestor->request('get', $url, $params);
    return SweetTooth_Util::convertToSweetToothObject($response, $apiKey);
  }

  protected static function _scopedCreate($class, $params=null, $apiKey=null)
  {
    self::_validateCall('create', $params, $apiKey);
    $requestor = new SweetTooth_ApiRequestor($apiKey);
    $url = self::_scopedLsb($class, 'classUrl', $class);
    list($response, $apiKey) = $requestor->request('post', $url, $params);
    return SweetTooth_Util::convertToSweetToothObject($response, $apiKey);
  }

  protected function _scopedSave($class)
  {
    self::_validateCall('save');
    $requestor = new SweetTooth_ApiRequestor($this->_apiKey);
    $params = $this->serializeParameters();

    if (count($params) > 0) {
      $url = $this->instanceUrl();
      list($response, $apiKey) = $requestor->request('patch', $url, $params);
      $this->refreshFrom($response, $apiKey);
    }
    return $this;
  }

  protected function _scopedDelete($class, $params=null)
  {
    self::_validateCall('delete');
    $requestor = new SweetTooth_ApiRequestor($this->_apiKey);
    $url = $this->instanceUrl();
    list($response, $apiKey) = $requestor->request('delete', $url, $params);
    $this->refreshFrom($response, $apiKey);
    return $this;
  }
}
