<?php
session_start();
    require('includes/config.php');
    $name = mysqli_real_escape_string( $con,$_REQUEST['name'] );
    $cms_share =  mysqli_real_escape_string( $con,$_REQUEST['cms_share']);
    $church_share =  mysqli_real_escape_string( $con,$_REQUEST['church_share']);
    $active =  mysqli_real_escape_string( $con,$_REQUEST['active']);

        $query = "update offerings_category set active = '".$active."',category = '".$name."',cms_share = '".$cms_share."',church_share = '".$church_share."',updated_at = ".strtotime(date("Y-m-d H:i:s"))." where id =" .$_GET['id'];
        $exe = mysqli_query($con,$query);
        ( $exe )? $return = 1 : $return = 0;

        if(  $return == 1 ){    
            echo json_encode( ['code' => 200,'data' => 'offeringCatList edited successfully', 'url' => 'offeringCatList' ] );
        }else{
            echo json_encode( ['code' => 405 , 'data' => 'Error Occured' ] );
        }
?>   