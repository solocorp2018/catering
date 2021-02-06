<?php

namespace App\Services;

class TextLocalSmsGateway
{

    public static function sendSms($mobileNumbers,$message="Message Content") {

    	$apiUrl = env('TEXT_LOCAL_API_URL');
		$apiKey = env('TEXT_LOCAL_API_KEY');
		$sender = env('TXTLCL');

    	$mobileNumbers = is_array($mobileNumbers)?$mobileNumbers:array_wrap($mobileNumbers);

    	// Account details
		$apiKey = urlencode($apiKey);

		// Message details
		$sender = urlencode($sender);
		$message = rawurlencode($message);

		$mobileNumbers = implode(",", $mobileNumbers);

		// Prepare data for POST request
		$data = [
					"apikey" => $apiKey,
					"numbers" => $mobileNumbers,
					"sender" => $sender,
					"message" => $message
				];

		// Send the POST request with cURL
		$ch = curl_init($apiUrl);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);

		// Process your response here
		 echo $response;
    }

    public static function generateOtp() {
    	$otpLength = 6;
    	$generator = "1357902468";
    	$result = "";
    	for ($i = 1; $i <= $otpLength; $i++) {
        	$result .= substr($generator, (rand()%(strlen($generator))), 1);
    	}
    	return $result;
    }
}
