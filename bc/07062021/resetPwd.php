<?php
session_start();
require('includes/config.php');
$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];

$password = md5($new_password);

$query = "update users set password = '".$password."', updated_by = ".$_SESSION['userid'].",updated_at = ". strtotime(date("Y-m-d H:i:s")) ." where id=".$_SESSION['userid'] ;
$exe = mysqli_query($con,$query);

if( $exe )	{			
	echo json_encode( ['code' => 200,'data' => 'Password updated successfully' ] );
}else{
	echo json_encode( ['code' => 405 , 'data' => 'Error Occured' ] );				
}
?>   