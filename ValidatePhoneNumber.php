<?php
class InvalidPhoneNumber Extends \Exception{}


class PhoneNumber {
	private $phone_number;
	private $access_key;

	function __construct($phone_number)
	{
		$this->phone_number = $phone_number;
		$this->ValidatePhoneNumber();
	}

	public function ValidatePhoneNumber()
	{
		try {
			$this->Load_Validate_Keys();
			$submit_request = curl_init('http://apilayer.net/api/validate?access_key='.$this->access_key.'&number='.$this->phone_number.'');
			curl_setopt($submit_request, CURLOPT_RETURNTRANSFER, true);
			$json_results = curl_exec($submit_request);
			curl_close($submit_request);

			$validation_results = json_decode($json_results, true);
			if(!$validation_results['valid']) {
				throw new InvalidPhoneNumber("This phone number is invalid");
			}
		} catch (InvalidPhoneNumber $e) {
			throw new InvalidPhoneNumber("This phone number is not valid");
		} catch (\Exception $e)
		{
			throw new \Exception("Unknown Error validating this number");
		}
	}

	private function Load_Validate_Keys()
	{
                try
                {
                        $ini = parse_ini_file('SMS_config.ini');
                        $this->access_key = $ini['access_key'];
                } catch (Exception $e)
                {
                        throw new IniConfigError("Error loading ini configurations");
                }
	}

	public function Print_Number()
	{
		return $this->phone_number;
	}
}
?>
