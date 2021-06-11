<?php
session_start();
	require('includes/config.php');
	date_default_timezone_set('Asia/Kolkata');
	$current_date_time = date("Y-m-d H:i:s");
	
	$name = mysqli_real_escape_string( $con,$_POST['name'] );
	$active = $_POST['active'];
	$cms_share = $_POST['cms_share'];
	$church_share = $_POST['church_share'];
	$cid = $_SESSION['cid'];

	$query = "insert into offerings_category( cid,category,active,cms_share,church_share,created_by,created_at ) values( ".$cid.",'".$name."',".$active.",'".$cms_share."','".$church_share."', ".$_SESSION['userid'].", '".$current_date_time."')" ;
	$exe = mysqli_query($con,$query);
	

	if( $exe )	{			
		echo json_encode( ['code' => 200,'data' => 'Category added successfully', 'url' => 'offeringCatList' ] );
	}else{
		echo json_encode( ['code' => 405 , 'data' => 'Error Occured' ] );				
	}
?>   