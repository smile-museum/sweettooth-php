<?php

/**
 * Notice: This resource is deprecated and will eventually be
 * replaced by SweetTooth_Activity. Please use the Activity
 * class, and port any use of this Event class over to Activity.
 * The Event object will be removed completely in version 1.0.0.
 *
 * The only difference between these two classes are the properties
 * in the payload.
 *   event_type -> verb
 *   data -> object
 *
 * Example:
 *
 * SweetTooth_Event::create(array(
 *   "customer_id" => "cus_cannPK3sVTJsF2",
 *   "event_type" => "order",
 *   "data" => array(
 *     "external_id" => "123",
 *     "total" => 200
 *   )
 * ));
 *
 * SweetTooth_Activity::create(array(
 *   "customer_id" => "cus_cannPK3sVTJsF2",
 *   "verb" => "order",
 *   "object" => array(
 *     "external_id" => "123",
 *     "total" => 200
 *   )
 * ));
 *
 */
class SweetTooth_Event extends SweetTooth_ApiResource
{
  public static function constructFrom($values, $apiKey=null)
  {
    $class = get_class();
    return self::scopedConstructFrom($class, $values, $apiKey);
  }

  public static function retrieve($id, $apiKey=null)
  {
    $class = get_class();
    return self::_scopedRetrieve($class, $id, $apiKey);
  }

  public static function create($params=null, $apiKey=null)
  {
    $class = get_class();
    return self::_scopedCreate($class, $params, $apiKey);
  }
}
