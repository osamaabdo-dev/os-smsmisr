# PHP Class For SMS MISR Service

this is last version for [smsmisr](https://smsmisr.com/)  services 


## Usage
```php
/*
*   your_username => your username
*   your_password => your password
*   your_sender_id => your your_sender_id
*   environment => environment => 1 For Live - 2 For Test
*   language => 1 for English - 2 for Arabic
*/

$smsMisr = new OS_SmsMisr("your_username", "your_password", "your_sender_id",'environment', 'language');
$smsMisr->send_sms("0123456789", "Hello, This Is a Test SMS message.");
```
## Return
Return True If Success or error message if there any error so you should use if condition to check if send message is successfully

```php

if ($smsMisr->send_sms("0123456789", "Hello, This Is a Test SMS message.") === true) {
	// success send...
	
}else{
	// handle your error here...
	
}

