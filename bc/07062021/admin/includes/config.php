<?php
	
	date_default_timezone_set('Asia/Kolkata');
	$db_host = "localhost";
	$db_user = "pos_church";
	$db_pass = "poschurch";
	$db_name = "pos_church";
		
	$con =  mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if( mysqli_connect_error() ){
		echo 'connect to database failed';
	}
?>      