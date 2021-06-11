<?php
session_start();
require('includes/config.php');
require('includes/sendsms.php');


$phone = mysqli_real_escape_string($con,$_POST['phone']);
$password = mysqli_real_escape_string($con,$_POST['password']);
$org_id = $_POST['org_id'];
//$password = md5($password);
$query = "select u.*,c.logo,c.name as cname,c.id as cid from users u join customers c on c.id = u.cid where u.phone ='".$phone."' and u.password='".$password."' and u.cid =".$org_id." and u.active = 1" ;
$exe = mysqli_query($con,$query);
$cnt = mysqli_num_rows($exe);
if( $cnt > 0 ){
	while($rows = mysqli_fetch_assoc($exe)){
		$_SESSION['userid'] = $rows['id'];
		$_SESSION['uname'] = $rows['name'];
		$_SESSION['id'] = session_id();
		$_SESSION['phone'] = $phone;
		$_SESSION['logo'] = $rows['logo'];
		$_SESSION['cname'] = $rows['cname'];
		$_SESSION['cid'] = $rows['cid'];
		$_SESSION['login_type'] = "user";
		$_SESSION['user_type'] = $rows['user_type'];

		$mac = getMAC();
		$otp = substr(number_format(time() * rand(),0,'',''),0,6);
		$sender = 'CHMGMT';
		$credit = '2';
		$message = 'Dear '.$_SESSION['uname'].', Verification code to authenticate your login is'.$otp.'.';
		//sendsms::sendmessage($credit,$sender,$message,$phone);

		$uSql = "update users set otp='".$otp."' where phone=".$phone;
		$uExe = mysqli_query( $con, $uSql );

		( $uExe ) ? $return = 1 : $return = 0;

		if( $uExe ){
			echo json_encode( ['code' => 200, 'is_verified' => 1, 'mac' => $mac, 'phone' => $phone, 'url' => 'otp' ] );	exit;
		}else{
			echo json_encode( ['code' => 401, 'is_verified' => 1, 'mac' => $mac ] );exit;
		}
	}
}else{
	echo json_encode(['code' => 405, 'data' => 'Login attempt with invalid credentials'] );	exit;

}

/**
 *Functions to get MAC address of a current system
 **/
function getMAC(){
    ob_start();
	system('getmac');
	$Content = ob_get_contents();
	ob_clean();
	return substr($Content, strpos($Content,'\\')-20, 17);
}

?>   