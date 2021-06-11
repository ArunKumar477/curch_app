<?php
session_start();
require('includes/config.php');

date_default_timezone_set('Asia/Kolkata');
$current_date_time = date("Y-m-d H:i:s");


$query = "insert into expenses_category( name,created_by,created_at,cid ) values('".$_REQUEST['name']."', ".$_SESSION['userid'].", '".$current_date_time."',".$_SESSION['cid'].")" ;
$exe = mysqli_query($con,$query);

if( $exe )	{			
	echo json_encode( ['code' => 200,'data' => 'Category added successfully', 'url' => 'expensesCategory' ] );
}else{
	echo json_encode( ['code' => 405 , 'data' => 'Error Occured' ] );				
}
?>   