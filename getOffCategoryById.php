<?php
	session_start();
	require('includes/config.php');

	$cat_id = $_GET['id'];

	$query = " select * from offerings_category where active = 1 and id=".$cat_id;
	$exe = mysqli_query($con,$query);
	$data = array();
	if( $exe )	{			
		while( $rows = mysqli_fetch_assoc($exe) ){
			array_push( $data, [ 'id'=> $rows['id'], 'name' => $rows['category'], 'cmshare' => $rows['cms_share'], 'crshare' => $rows['church_share'] ]);
		}
		echo json_encode( ['code' => 200,'data' => $data ] );
	}else{
		echo json_encode( ['code' => 405 , 'data' => 'Error Occured' ] );
	}
?>