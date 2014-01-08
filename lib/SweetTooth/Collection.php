<?php

class SweetTooth_Collection extends SweetTooth_Object
{
  public static function constructFrom($values, $apiKey=null)
  {
    $class = get_class();
    return self::scopedConstructFrom($class, $values, $apiKey);
  }

  public function all($params=null)
  {
    $requestor = new SweetTooth_ApiRequestor($this->_apiKey);
    list($response, $apiKey) = $requestor->request('get', $this['url'], $params);
    return SweetTooth_Util::convertToSweetToothObject($response, $apiKey);
  }

  public function create($params=null)
  {
    $requestor = new SweetTooth_ApiRequestor($this->_apiKey);
    list($response, $apiKey) = $requestor->request('post', $this['url'], $params);
    return SweetTooth_Util::convertToSweetToothObject($response, $apiKey);
  }

  public function retrieve($id, $params=null)
  {
    $requestor = new SweetTooth_ApiRequestor($this->_apiKey);
    $base = $this['url'];
    $id = SweetTooth_ApiRequestor::utf8($id);
    $extn = urlencode($id);
    list($response, $apiKey) = $requestor->request('get', "$base/$extn", $params);
    return SweetTooth_Util::convertToSweetToothObject($response, $apiKey);
  }

}
