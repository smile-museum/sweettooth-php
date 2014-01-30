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
      'customer' => 'SweetTooth_Customer',
      'activity' => 'SweetTooth_Activity',
      'spending_option' => 'SweetTooth_SpendingOption',
      'spending' => 'SweetTooth_Spending',
      'collection' => 'SweetTooth_Collection',

      // Deprecated
      'event' => 'SweetTooth_Event',
      'redemption_option' => 'SweetTooth_RedemptionOption',
      'redemption' => 'SweetTooth_Redemption',
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
