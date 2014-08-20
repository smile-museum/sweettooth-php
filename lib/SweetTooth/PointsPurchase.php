<?php

class SweetTooth_PointsPurchase extends SweetTooth_ApiResource
{
  public static function className($class)
  {
    return 'points_purchase';
  }

  public static function constructFrom($values, $apiKey=null)
  {
    $class = get_class();
    return self::scopedConstructFrom($class, $values, $apiKey);
  }

  public static function create($params=null, $apiKey=null)
  {
    $class = get_class();
    return self::_scopedCreate($class, $params, $apiKey);
  }

  public static function retrieve($id, $apiKey=null)
  {
    $class = get_class();
    return self::_scopedRetrieve($class, $id, $apiKey);
  }

  public function cancel($params=null, $apiKey=null)
  {
    $requestor    = new SweetTooth_ApiRequestor($apiKey);
    $url          = $this->instanceUrl() . '/cancel';
    list($response, $apiKey) = $requestor->request('post', $url, $params);
    $this->refreshFrom($response, $apiKey);

    return $this;
  }

  public static function all($params=null, $apiKey=null)
  {
    $class = get_class();
    return self::_scopedAll($class, $params, $apiKey);
  }
}
