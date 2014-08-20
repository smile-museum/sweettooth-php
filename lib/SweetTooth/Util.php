<?php

abstract class SweetTooth_Util
{
  public static function isCollection($array)
  {
    if (!is_array($array))
      return false;

    // TODO: this isn't actually correct in general, but it's correct given Sweet Tooth's responses
    foreach (array_keys($array) as $k) {
      if (!is_numeric($k))
        return false;
    }
    return true;
  }

  public static function convertSweetToothObjectToArray($values)
  {
    $results = array();
    foreach ($values as $k => $v) {
      // FIXME: this is an encapsulation violation
      if ($k[0] == '_') {
        continue;
      }
      if ($v instanceof SweetTooth_Object) {
        $results[$k] = $v->__toArray(true);
      }
      else if (is_array($v)) {
        $results[$k] = self::convertSweetToothObjectToArray($v);
      }
      else {
        $results[$k] = $v;
      }
    }
    return $results;
  }

  public static function convertToSweetToothObject($resp, $apiKey)
  {
    $types = array(
      'activity'            => 'SweetTooth_Activity',
      'channel_environment' => 'SweetTooth_ChannelEnvironment',
      'collection'          => 'SweetTooth_Collection',
      'customer'            => 'SweetTooth_Customer',
      'ping'                => 'SweetTooth_Ping',
      'points_product'      => 'SweetTooth_PointsProduct',
      'points_purchase'     => 'SweetTooth_PointsPurchase',
      'points_transaction'  => 'SweetTooth_PointsTransaction',

      // Deprecated
      'event'             => 'SweetTooth_Event',
      'redemption'        => 'SweetTooth_Redemption',
      'redemption_option' => 'SweetTooth_RedemptionOption',
      'spending'          => 'SweetTooth_Spending',
      'spending_option'   => 'SweetTooth_SpendingOption',
    );
    if (self::isCollection($resp)) {
      $mapped = array();
      foreach ($resp as $i)
        array_push($mapped, self::convertToSweetToothObject($i, $apiKey));
      return $mapped;
    } else if (is_array($resp)) {
      if (isset($resp['_object']) && is_string($resp['_object']) && isset($types[$resp['_object']])) {
        $class = $types[$resp['_object']];
      } else {
        $class = 'SweetTooth_Object';
      }
      return SweetTooth_Object::scopedConstructFrom($class, $resp, $apiKey);
    } else {
      return $resp;
    }
  }
}
