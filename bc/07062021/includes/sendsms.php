<?php
class sendsms
{
	public static function sendme($smsurl) {
		$curl = curl_init();
		curl_setopt($curl,CURLOPT_URL,$smsurl);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($curl,CURLOPT_HEADER,false);
		$result = curl_exec($curl);
		curl_close($curl);
		return $result;
	}

	public static function sendmessage($credit,$sender,$message,$number)	{
		$url = 'http://pay4sms.in/sendsms';
    	$token = '54c7063282fac4aed4a119558d245972';
		$credit = $credit;
		$message = urlencode($message);
		$numbe = $number;
		$sender = $sender;
 
		$smsurl = $url.'/?token='.$token.'&credit='.$credit.'&sender='.$sender.'&message='.$message.'&number='.$number;	
		$result = self::sendme($smsurl);
		return $result;
	}

	public static function checkdlr($message_id)	{
		$msgid = $message_id;
		$smsurl = $this->url.'Dlrcheck/'.$this->token.$this->msgid.$message_id;
		$result = $this->sendme($smsurl);
		return $result;
	}

	public static function availablecredit($credit) {
		$url = 'http://pay4sms.in/Credit-Balance';
    	$token = '54c7063282fac4aed4a119558d245972';
		$smsurl = $url.'/?token='.$token.'&credit='.$credit;
		$result = self::sendme($smsurl);
		return $result;
	}
}

?>