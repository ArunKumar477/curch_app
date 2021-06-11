<?php
	session_start();
	require('includes/config.php');
	$id = $_GET['id'];
	$query = "update members set active = 0,updated_by = ".$_SESSION['userid'].",updated_at =".strtotime(date("Y-m-d H:i:s"))." where id=".$id;
	$exe = mysqli_query( $con,$query );

	if( $exe )	{
		echo json_encode( ['code' => 200,'data' => 'Member deleted successfully', 'url' => 'membersList' ] );
	}else{
		echo json_encode( ['code' => 405 , 'data' => 'Error Occured' ] );				
	}
?>