<?php

// Tested on PHP 5.2, 5.3

// This code inspired by the Stripe SDK.
if (!function_exists('curl_init')) {
  throw new Exception('Sweet Tooth needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
  throw new Exception('Sweet Tooth needs the JSON PHP extension.');
}
if (!function_exists('mb_detect_encoding')) {
  throw new Exception('Sweet Tooth needs the Multibyte String PHP extension.');
}

// Sweet Tooth singleton
require(dirname(__FILE__) . '/SweetTooth/SweetTooth.php');

// Utilities
require(dirname(__FILE__) . '/SweetTooth/Util.php');
require(dirname(__FILE__) . '/SweetTooth/Util/Set.php');

// Errors
require(dirname(__FILE__) . '/SweetTooth/Error.php');
require(dirname(__FILE__) . '/SweetTooth/ApiError.php');
require(dirname(__FILE__) . '/SweetTooth/ApiConnectionError.php');
require(dirname(__FILE__) . '/SweetTooth/AuthenticationError.php');
require(dirname(__FILE__) . '/SweetTooth/InvalidRequestError.php');

// Plumbing
require(dirname(__FILE__) . '/SweetTooth/Object.php');
require(dirname(__FILE__) . '/SweetTooth/ApiRequestor.php');
require(dirname(__FILE__) . '/SweetTooth/ApiResource.php');
require(dirname(__FILE__) . '/SweetTooth/SingletonApiResource.php');
require(dirname(__FILE__) . '/SweetTooth/AttachedObject.php');
require(dirname(__FILE__) . '/SweetTooth/Collection.php');

// Sweet Tooth API Resources
require(dirname(__FILE__) . '/SweetTooth/Activity.php');
require(dirname(__FILE__) . '/SweetTooth/Customer.php');
require(dirname(__FILE__) . '/SweetTooth/Event.php');
require(dirname(__FILE__) . '/SweetTooth/RedemptionOption.php');
require(dirname(__FILE__) . '/SweetTooth/Redemption.php');
