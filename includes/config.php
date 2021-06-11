<?php
	
	date_default_timezone_set('Asia/Kolkata');
	// $db_host = "localhost";
	// $db_user = "sda_church";
	// $db_pass = "Welcome123#";
	// $db_name = "sda_church";
	$db_host = "localhost";
	$db_user = "root";
	$db_pass = "";
	$db_name = "sda_church";
	$con =  mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if( mysqli_connect_error() ){
		echo 'connect to database failed';
	}
	else{
	    //echo "welcome";
	}
?>      