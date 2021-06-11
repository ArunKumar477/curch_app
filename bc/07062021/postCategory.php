<?php
session_start();
require('includes/config.php');
$name = mysqli_real_escape_string( $con,$_POST['name'] );
$active = $_POST['active'];

$query = "insert into expenses_category( name,active,created_by,created_at,cid ) values('".$name."', ".$active.", ".$_SESSION['userid'].", ". strtotime(date("Y-m-d H:i:s")) .",".$_SESSION['cid'].")" ;
$exe = mysqli_query($con,$query);

if( $exe )	{			
	echo json_encode( ['code' => 200,'data' => 'Category added successfully', 'url' => 'expensesCategory' ] );
}else{
	echo json_encode( ['code' => 405 , 'data' => 'Error Occured' ] );				
}
?>   