<?php
session_start();
require('includes/config.php');

$query = " select * from subscription where active = 1" ;
$exe = mysqli_query($con,$query);
$data = array();
if( $exe )	{			
	while( $rows = mysqli_fetch_assoc($exe) ){
		array_push( $data, [ 'id'=> $rows['id'], 'name' => $rows['name'] , 'price' => $rows['price'] ]);
	}
	echo json_encode( ['code' => 200,'data' => $data ] );
}else{
	echo json_encode( ['code' => 405 , 'data' => 'Error Occured' ] );				
}
?>