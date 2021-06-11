<?php
session_start();
	require('includes/config.php');
	$cname = $_POST['name'];
	$mobile = $_POST['phone'];
	$alternate_no = isset ( $_POST['alternate_no'] ) ? $_POST['alternate_no'] : 0;
	$active = $_POST['active'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$subs_type = $_POST['subscription'];

	$user = $_SESSION['userid'];

	$dir = "images/uploads/";
	$tmp_name = $_FILES["logo"]["tmp_name"];
    $name = $_FILES["logo"]["name"];
	$path = $dir.$name;
	if ( move_uploaded_file( $tmp_name,$dir.$name )) {
		$path = $path;
	}
	$chk = ( isset( $_POST['cId'] ) ) ? 'Y' : 'N';	
	$return = 0;
	if( $chk !== 'N' ){
		$query = "update customers set name = '".$cname."',phone = ".$mobile.",alternate_no = ".$alternate_no.",email = '".$email."',address = '".$address."',type = ".$subs_type.",logo = '".$path."',active = ".$active.",updated_by = ".$user.",updated_at = ".strtotime(date("Y-m-d H:i:s"))." where id =" .$_POST['cId'];
		$exe = mysqli_query($con,$query);
		( $exe )? $return = 1 : $return = 0;

		if(  $return == 1 ){	
			echo json_encode( ['code' => 200,'data' => 'Customer edited successfully', 'url' => 'customersList' ] );
		}else{
			echo json_encode( ['code' => 405 , 'data' => 'Error Occured' ] );
		}
	}

	if( $chk !== 'Y' ){
		$chk_query = "select phone from customers where phone=".$mobile;
		$cexe = mysqli_query($con,$chk_query);
		$count = mysqli_num_rows( $cexe );

		if( $count >= 1 ) {
			echo json_encode( ['code' => 401 , 'data' => 'Customer details already exists' ] );
		}else{			
			$expiry = getExpiryDate( $subs_type );
			$query = "insert into customers( name,phone,alternate_no,email,address,subscription,logo,active,created_by,created_at,expires_at ) values('".$cname."', ".$mobile.",".$alternate_no.",'".$email."','".$address."',".$subs_type.",'".$path."',".$active.",".$user.",".strtotime(date("Y-m-d H:i:s")).",".$expiry.")" ;
			$exe = mysqli_query($con,$query);
			( $exe )? $return = 1 : $return = 0;
		}
		if( $return == 1 )	{
			echo json_encode( ['code' => 200,'data' => 'Customer added successfully', 'url' => 'customersList' ] );
		}else{
			echo json_encode( ['code' => 405 , 'data' => 'Error Occured' ] );				
		}
	}

function getExpiryDate( $subs_type ){
	$ctime = time();
	$expiry = 0 ;
	switch ( $subs_type ) {
		case '1':
			$expiry = strtotime('+30 day', $ctime );
			break;
		case '2':
			$expiry = strtotime('+90 day', $ctime );
			break;
		case '3':
			$expiry = strtotime('+180 day', $ctime );
			break;
		case '4':
			$expiry = strtotime('+365 day', $ctime );
			break;
		case '5':
			$expiry = strtotime('+730 day', $ctime );
			break;
		case '6':
			$expiry = strtotime('+1095 day', $ctime );
			break;
		case '7':
			$expiry = strtotime('+1825 day', $ctime );
			break;
		case '8':
			$expiry = strtotime('+3650 day', $ctime );
			break;
	}
	return $expiry;
}
?>   