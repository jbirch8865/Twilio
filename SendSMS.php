<?php
	require_once 'vendor/autoload.php';
	use Twilio\Rest\Client;

function SendSMS($TO, $BODY, $FROM = false)
{
	// Update the path below to your autoload.php,
	// see https://getcomposer.org/doc/01-basic-usage.md

	// Your Account Sid and Auth Token from twilio.com/console
	$ini = parse_ini_file('config.ini');
	$sid    = $ini['SID'];
	$token  = $ini['Token'];
	if(!$FROM)
	{
		$FROM = $ini['From'];
	}
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
