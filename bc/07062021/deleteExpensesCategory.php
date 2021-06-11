<?php
	session_start();
	require('includes/config.php');
	$id = $_GET['id'];
	$query = "update expenses_category set active = 0 where id=".$id;
	$exe = mysqli_query( $con,$query );

	if( $exe )	{
		echo json_encode( ['code' => 200,'data' => 'Expenses Category deleted successfully', 'url' => 'expensesCategory' ] );
	}else{
		echo json_encode( ['code' => 405 , 'data' => 'Error Occured' ] );				
	}
?>