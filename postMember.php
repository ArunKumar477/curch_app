<?php
session_start();
	require('includes/config.php');
	$name = $_POST['name'];
	$mobile = $_POST['mobile'];
	$gender = $_POST['gender'];
	$dob = isset($_POST['dob'])?  strtotime($_POST['dob']) : '0';
	$doa = isset( $_POST['doa'] ) ?  strtotime($_POST['doa']) : '0';
	$age = $_POST['age'];
	$active = $_POST['active'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$member_type = $_POST['mtype'];
	$is_child_sch = isset( $_POST['is_child_sch'] ) ? $_POST['is_child_sch'] : 0;
	$no_of_child_sch = ( $_POST['no_of_child_sch'] ) ?  $_POST['no_of_child_sch'] : 0;
	$user = $_SESSION['userid'];
	$cid = $_SESSION['cid'];

	$chk = ( isset( $_POST['mId'] ) ) ? 'Y' : 'N';	
	$return = 0;
	if( $chk !== 'N' ){
		$query = "update members set cid = ".$cid." ,name = '".$name."',mobile = ".$mobile.",age = ".$age.",email = '".$email."',address = '".$address."',gender = '".$gender."',dob = '". $dob ."',doa = '".$doa."',member_type = ".$member_type.",is_child_sch = ".$is_child_sch.",no_of_child_sch = ".$no_of_child_sch.",active = ".$active.",updated_by = ".$user.",updated_at = ".strtotime(date("Y-m-d H:i:s"))." where id =" .$_POST['mId'];
		$exe = mysqli_query($con,$query);
		( $exe )? $return = 1 : $return = 0;

		if(  $return == 1 ){	
			echo json_encode( ['code' => 200,'data' => 'Member edited successfully', 'url' => 'membersList' ] );
		}else{
			echo json_encode( ['code' => 405 , 'data' => 'Error Occured' ] );
		}
	}

	if( $chk !== 'Y' ){
		$chk_query = "select mobile from members where mobile=".$mobile;
		$cexe = mysqli_query($con,$chk_query);
		$count = mysqli_num_rows( $cexe );

		if( $count >= 1) {
			echo json_encode( ['code' => 401 , 'data' => 'Member details already exists' ] );
		}else{
			$query = "insert into members( cid,name,mobile,age,email,address,gender,dob,doa,member_type,is_child_sch,no_of_child_sch,active,created_by,created_at ) values( ".$cid.", '".$name."', ".$mobile.",".$age.",'".$email."','".$address."','".$gender."','". $dob ."','".$doa."',".$member_type.",".$is_child_sch.",".$no_of_child_sch.",".$active.",".$user.",".strtotime(date("Y-m-d H:i:s")).")" ;
			$exe = mysqli_query($con,$query);
			( $exe )? $return = 1 : $return = 0;
		}
		if( $return == 1 )	{
			echo json_encode( ['code' => 200,'data' => 'Member added successfully', 'url' => 'membersList' ] );
		}else{
			echo json_encode( ['code' => 405 , 'data' => 'Error Occured' ] );				
		}
	}
?>   