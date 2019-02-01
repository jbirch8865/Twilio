<?php
	require_once '/var/www/vendor/autoload.php';
	use Twilio\Rest\Client;

function SendSMS($TO, $BODY, $FROM = '+19712735759')
{
	// Update the path below to your autoload.php,
	// see https://getcomposer.org/doc/01-basic-usage.md

	// Your Account Sid and Auth Token from twilio.com/console
	$sid    = "ACddb824e29bc5030f15a32fc8dac5cd10";
	$token  = "473dbc7ea53bc14a384a76c97fe73eb5";
	$twilio = new Client($sid, $token);


	$message = $twilio->messages
					  ->create($TO,
							   array(
								   "body" => $BODY,
								   "from" => $FROM
							   )
					  );

	return $message;

}

?>
