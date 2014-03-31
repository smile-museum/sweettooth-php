<?php
/**
 * Examples:
 *
 * SweetTooth_ChannelEnvironment::create(array(
 *   "url" => "http://example.com",
 *   "admin_url" => "http://example.com/admin",
 *   "connector_code" => "sweettooth-magento",
 *   "connector_version" => "1.0.0",
 *   "extra" => array(
 *     "php_version" => "5.3",
 *     "magento_version" => "1.11.1.0",
 *     "magento_product" => "enterprise",
 *   )
 * ))
 */
class SweetTooth_ChannelEnvironment extends SweetTooth_ApiResource
{
  public static function className($class)
  {
    return 'channel_environment';
  }

  public static function classNamePlural($class)
  {
    return "channel_environment";
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
}
