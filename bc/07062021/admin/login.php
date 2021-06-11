<?php
session_start();
require('includes/config.php');
$phone = mysqli_real_escape_string($con,$_POST['phone']);
$password = mysqli_real_escape_string($con,$_POST['password']);
$password = md5($password);

$query = "select u.*,c.logo,c.name as cname from users u join customers c on c.id = u.cid where u.phone ='".$phone."' and u.password='".$password."' and u.active = 1" ;
$exe = mysqli_query($con,$query);
$cnt = mysqli_num_rows($exe);
if( $cnt > 0 ){
	while($rows = mysqli_fetch_assoc($exe)){
		$_SESSION['userid'] = $rows['id'];
		$_SESSION['id'] = session_id();
		$_SESSION['logo'] = $rows['logo'];
		$_SESSION['cname'] = $rows['cname'];
		$_SESSION['login_type'] = "user";
		$_SESSION['user_type'] = $rows['user_type'];
		echo json_encode( ['code' => 200, 'is_verified' => 1, 'url' => 'home' ] );
	}
}else{
	echo json_encode(['code' => 405, 'data' => 'Login attempt with invalid credentials'] );

}
?>   