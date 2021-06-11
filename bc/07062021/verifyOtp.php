<?php
session_start();
require('includes/config.php');
$phone = mysqli_real_escape_string($con,$_POST['phone']);
$otp = mysqli_real_escape_string($con,$_POST['otp']);

$query = "select * from users where phone ='".$phone."' and active = 1";
$exe = mysqli_query($con,$query);
$cnt = mysqli_num_rows($exe);
if( $cnt > 0 ){
	$url = '';
	while( $rows = mysqli_fetch_assoc($exe) ){				
		if( $rows['otp'] == $otp ) {
			$url = 'offeringsList';
		}else{
			echo json_encode(['code' => 405, 'otp_verified' => '0',  'data' => 'Invalid OTP entered'] );exit;
		}
		echo json_encode( ['code' => 200, 'otp_verified' => '1',  'url' => $url ] );exit;
	}
}else{
	echo json_encode(['code' => 405, 'data' => 'User not found.'] );exit;
}
?>   