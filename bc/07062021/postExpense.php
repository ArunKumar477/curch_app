<?php
session_start();
require('includes/config.php');
$cat_id = $_POST['cat_id'];
$amount = $_POST['amount'];
$date = strtotime($_POST['expense_date']);
$user = $_POST['created_by'];
$cid = $_SESSION['cid'];
if( $user != ""){
	$user= $user;
}else{
	$user = $_SESSION['userid'];
}

$query = "insert into expenses( cat_id,amount,expense_date,created_by,created_at,cid ) values('".$cat_id."', ".$amount.",". $date ." ,".$user.", ". strtotime(date("Y-m-d H:i:s")) .", ".$cid.")" ;
$exe = mysqli_query($con,$query);

if( $exe )	{			
	echo json_encode( ['code' => 200,'data' => 'Expense added successfully', 'url' => 'expensesList' ] );
}else{
	echo json_encode( ['code' => 405 , 'data' => 'Error Occured' ] );				
}
?>   