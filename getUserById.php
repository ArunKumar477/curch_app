<?php
	session_start();
	require('includes/config.php');
	$cid = $_SESSION['cid'];
	$mobile = $_REQUEST['mobile'];
	$query = " select * from members where mobile = ".$mobile." and cid=".$cid." and active = 1" ;
	$exe = mysqli_query($con,$query);
	$data = array();
	if( $exe )	{			
		while( $rows = mysqli_fetch_assoc($exe) ){
			array_push( $data, [ 'id'=> $rows['id'], 'name' => $rows['name'], 'mobile' => $rows['mobile'], 'dob' => $rows['doa'], 'doa' => $rows['doa'], 'email' => $rows['email'], 'age' => $rows['age'], 'gender' => $rows['gender'], 'address' => $rows['address'] ]);
		}
		echo json_encode( ['code' => 200,'data' => $data ] );
	}else{
		echo json_encode( ['code' => 405 , 'data' => 'Error Occured' ] );				
	}
?>