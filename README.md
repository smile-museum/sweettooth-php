# Installation

Get the latest version of the Sweet Tooth PHP library with:

```
git clone https://github.com/sweettoothhq/sweettooth-php
```

To get started, add the following to your PHP script:

```php
require_once("/path/to/sweettooth-php/lib/SweetTooth.php");
```

Simple usage looks like:

```php
SweetTooth::setApiKey('sk_gUjtToMzKybHZ3yGg3C4Sv4L');
$newCustomerData = array(
	'first_name' => 'Wayne', 
	'last_name' => 'Rooney', 
	'email' => 'wrooney@example.com'
);
$customer = SweetTooth_Customer::create($newCustomerData);
echo $customer;
```

# Documentation

Please see https://www.sweettoothrewards.com/api for up-to-date documentation.
