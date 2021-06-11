<?php
session_start();
	require('includes/config.php');
	
	date_default_timezone_set('Asia/Kolkata');
	$current_date_time = date("Y-m-d H:i:s");

	$name = mysqli_real_escape_string( $con,$_POST['name'] );
	$mobile = $_POST['mobile'];
	$gender = $_POST['gender'];
	$age = ( $_POST['age'] ) ? $_POST['age'] : 0 ;
	$off_date = $_POST['off_date'];
	/*$off_date = "";
	$off_date = isset( $_POST['off_date'] ) ? strtotime($_POST['off_date']) : strtotime(date("Y-m-d")) ;
	$off_date = $off_date + 86000;*/
// 	echo $off_date; 
// 	exit;
	$mode = isset( $_POST['mode'] ) ? $_POST['mode'] : 0;
	$email = $_POST['email'];
	$mtype= $_POST['mtype'];
	$amount = $_POST['amount'];
	$address = $_POST['address'];
	$category = $_POST['category'];
	$address = $_POST['address'];
	$cms_share = $_POST['cms_share'];
	$church_share = $_POST['church_share'];
	$cid = $_SESSION['cid'];
	$cheque = isset( $_POST['cheque'] ) ? $_POST['cheque'] : 0 ;
	
	$chk = ( isset( $_POST['oId'] ) ) ? 'Y' : 'N';
	$return = 0;
	
	if( $chk !== 'N' ){

		foreach ( $category as $ckey => $cat ) {
			foreach ( $amount as $akey => $amt ) {
				foreach ( $cms_share as $cmkey => $cmshare ) {
					foreach ( $church_share as $crkey => $crshare ) {
						foreach ( $mode as $mkey => $md ) {
							foreach ( $cheque as $chkey => $chq ) {
								if( ( $ckey == $akey ) && ( $akey == $cmkey ) && ( $crkey == $crkey ) && ( $crkey == $mkey )  && ( $mkey == $chkey) && ( $chkey == $ckey )){
									$chq = ($chq) ? $chq : 0;
									$query = "update offerings set offer_date = ".$off_date.",receipt_no = '".$_POST['receipt_no']."',name = '".$name."',mobile = ".$mobile.",gender ='".$gender."',age =".$age.",email ='".$email."',mtype =".$mtype.",amount = ".$amt.",cat_id ='".$cat."',address ='".$address."',cms_share = '".$cmshare."',chruch_share = '".$crshare."',updated_by = ".$_SESSION['userid'].",updated_at ='".$current_date_time."',mof = '".$md."',cheque_no = '".$chq."', cid = ".$cid." where id = " .$_POST['oId'];
									$exe = mysqli_query($con,$query);
									if( $exe ){
										$return = 1;
									}else{
										$return = 0;
									}
								}
							}
						}
					}
				}
			}
		}
	}
	if( $chk !== 'Y' ){

		$iquery = "select receipt_no from offerings where cid = ".$cid." AND active = '1' order by id DESC limit 1";
		$iexe = mysqli_query( $con, $iquery );
		$cnt = mysqli_num_rows($iexe);

		if( $cnt == 0 ){
			$receipt_no = 'RN404';
		}else{
			$row = mysqli_fetch_assoc($iexe);
			$str = $row['receipt_no'];
			$no = intVal( preg_replace('/[^0-9]/', '', $str) ) + 1;
			$receipt_no = 'RN'.$no;
		}

		foreach ( $category as $ckey => $cat ) {
			foreach ( $amount as $akey => $amt ) {
				foreach ( $cms_share as $cmkey => $cmshare ) {
					foreach ( $church_share as $crkey => $crshare ) {
						foreach ( $mode as $mkey => $md ) {
								foreach ( $cheque as $chkey => $chq ) {
									if( ( $ckey == $akey ) && ( $akey == $cmkey ) && ( $crkey == $crkey ) && ( $crkey == $mkey )  && ( $mkey == $chkey) && ( $chkey == $ckey )){
										$chq = ($chq) ? $chq : 0;
									$query = "insert into offerings( cid,receipt_no,offer_date,name,mobile,gender,age,email,mtype,amount,cat_id,address,cms_share,chruch_share,created_by,created_at,cheque_no,mof ) values( ".$cid.",'".$receipt_no."','".$off_date."','".$name."',".$mobile.",'".$gender."',".$age.",'".$email."',".$mtype.",".$amt.",'".$cat."','".$address."',".$cmshare.",".$crshare.",".$_SESSION['userid'].", '".$current_date_time."','".$chq."','".$md."')";
									$exe = mysqli_query($con,$query);
									if( $exe ){
										$return = 1;
									}else{
										$return = 0;
									}
								}
							}
						}
					}
				}
			}
		}
	}

	if( $return )	{		
		if( isset( $_POST['id'] ) ){	
			echo json_encode( ['code' => 200,'data' => 'Offered edited successfully', 'url' => 'offeringsList' ] );
		}else{
			echo json_encode( ['code' => 200,'data' => 'Offered successfully', 'url' => 'offeringsList' ] );
		}
	}else{
		echo json_encode( ['code' => 405 , 'data' => 'Error Occured' ] );				
	}
?>   