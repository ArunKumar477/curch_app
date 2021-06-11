<?php
	session_start();
	require('includes/config.php');
	$id = $_GET['id'];
	$query = "update offerings set active = 0,updated_by = ".$_SESSION['userid'].",updated_at =".strtotime(date("Y-m-d H:i:s")) ." where id=".$id;
	//echo $query;exit;
	$exe = mysqli_query( $con,$query );

	if( $exe )	{
		echo json_encode( ['code' => 200,'data' => 'Offering deleted successfully', 'url' => 'offeringsList' ] );
	}else{
		echo json_encode( ['code' => 405 , 'data' => 'Error Occured' ] );				
	}
?>