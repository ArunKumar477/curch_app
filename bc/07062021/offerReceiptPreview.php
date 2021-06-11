<?php 
    require_once('includes/check-login.php');
    require_once('includes/header.php'); 
    require_once('includes/config.php');
    require_once("includes/sendsms.php");

    $name = '';
    $phone = '';
    $address = '';
    $receipt_no = '';
    $created = 0;
    $mof = '';
    $cheque = '';
    $total = 0;
    $email = '';
 ?>

<div class="row" style="background: #fff; height: 960px;">
  	<div class="col-xs-12 noprint">
      <ul class="list-inline pull-right">
    		<li><a href="javascript:void(0);" class="print_link">Print</a> | <a href='offeringsList.php'>Go Back</a></li>
      </ul>
  	</div>

    <div class="col-xs-12 lBottom2">
       	<div class="col-xs-4">
          <img src="<?php echo 'admin/'.$_SESSION['logo']; ?>" alt="<?php echo $_SESSION['cname']; ?>"/>
        </div>
        <div class="col-xs-8">
            <ul class="uppercase">
          	  <li> Seventh day adventist english church </li>
              <li> 52, ritherdon road, vepery , chennai - 600 007 ,India</li>
            </ul>
        	</div>    
      <span class="divider col-xs-12"></span>
    </div><!-- End of col-md-12 -->
        <?php 
            $query = "select * from offerings where receipt_no='".$_GET['id']."'";
            $exe = mysqli_query( $con, $query );
            while ( $row =  mysqli_fetch_assoc($exe) ){
            	$name = $row['name'];
            	$phone = $row['mobile'];
            	$address = $row['address'];
            	$receipt_no = $row['receipt_no'];
            	$created = $row['created_at'];
                $offer_date = $row['offer_date'];
                $mof = $row['mof'];
                $cheque = $row['cheque_no'];
                $email = $row['email'];
            }
        ?>
    <div class="col-xs-12 lBottom">
    	<div class="col-xs-6">
    		<table>
    		<tr>
		        <td class="theight"> Name </td>
		        <td class="theight">&nbsp;:&nbsp;</td>
		        <td><?php echo $name;?></td>
		    </tr><tr>
		        <td class="theight"> Mobile </td>	        
		        <td class="theight">&nbsp;:&nbsp;</td>
		        <td><?php echo $phone;?></td>
		    </tr>
		    <tr>
		        <td class="theight"> Address </td>
		        <td class="theight">&nbsp;:&nbsp;</td>
		        <td><?php echo $address;?></td>
		    </tr>
		    <tr>
		        <td class="theight"> Mode </td>
		        <td class="theight">&nbsp;:&nbsp;</td>
		        <td><?php echo $mof;?></td>
		    </tr>
	       	</table>
        </div> 
        <div class="col-xs-6">
        	<table>
    	    	<tr>
    		        <td class="theight"> Receipt No </td>
    		        <td class="theight">&nbsp;:&nbsp;</td>
    		        <td class="theight"><?php echo $receipt_no;?></td> 
    		    </tr>
    		    <tr>
    		        <td class="theight"> Date </td>
    		        <td class="theight">&nbsp;:&nbsp;</td>
    		        <td class="theight"><?php echo date('d-m-Y');?></td> 
    		    </tr>
    		    <tr>
    		        <td class="theight"> Offering Date </td>
    		        <td class="theight">&nbsp;:&nbsp;</td>
    		        <td class="theight"><?php echo date('d-m-Y', $offer_date);?></td> 
    		    </tr>

    		    <tr>
    		        <td class="theight"> Cheque No </td>
    		        <td class="theight">&nbsp;:&nbsp;</td>
    		        <td class="theight"><?php echo $cheque;?></td> 
    		    </tr>		    
    		  </table>
          <br/>
        </div>

        <div class="col-xs-12">
            <table class="table col-xs-12">
              <tr>
                <th class="uppercase" >S.No</th>
                <th class="uppercase">Particulars</th>
                <th class="uppercase">Amount</th>
              </tr>
              <?php                 
                $iquery = "select oc.category,o.amount from offerings o, offerings_category oc where o.cat_id = oc.id and receipt_no='".$_GET['id']."'";                
                $iexe = mysqli_query( $con, $iquery );
                $i = 1;
                $data = '';
                while ( $rows =  mysqli_fetch_assoc($iexe) ){ 
                $data .= '<tr>
                    <td>'. $i .'</td>
                    <td class="uppercase">'.$rows["category"].'</td>
                    <td><span class="fa fa-inr">'.$rows["amount"].'</span></td>
                    </tr>';
                    $total = $total + intval($rows["amount"]);
                  $i++;
                }
                echo $data;
              ?>
                <tr>
                    <td>&nbsp;</td>
                    <td>Total</td>
                    <td><span class="fa fa-inr">
                    <?php 
                        echo $total;
                        $data .='<tr><td>&nbsp;</td><td>Total</td><td><span class="fa fa-inr">'.$total.'</span><td></tr>';
                        if( $phone != '' ){
                            $sender = 'CHMGMT';
                            $credit = '2';
                            $message = 'Dear '.$name.', Thanks for your support. Total offering amout of Rs.'.$total.'/- received with gratitude.';
                            sendsms::sendmessage($credit,$sender,$message,$phone);
                        }
                        if( $email != '' ){
                            //sending Email
                            $headers_customers = '';
                            $headers_customers .= 'MIME-Version: 1.0' . "\r\n";
                            $headers_customers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                            $headers_customers  .= 'From: SeventhDay Adventist English Church <payart2018@gmail.com>' . "\r\n";
                            
                            $customerEmail    = "$email";      
                                
                            $subject  = "Regarding recent offerings made on SeventhDay Adventist Church";
                            
                            $msg="<html><head>";
                            $msg.="<style type='text/css'>body{font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 11px;color:#000000;}.style1 {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 11px;color:#000000;border-collapse:collapse;border-color:#00ccff;}.style2 {line-height:20px;}.style3 {color:#ffffff;}</style>";
                            $msg.="</head><body leftmargin=0 rightmargin=0 topmargin=0 bottommargin=0 >";
                            $msg.= "<table class='table'><tr><td>Dear ".$name.",</td></tr>";
                            $msg.= "<tr><td>Thanks for support. Find the below are the details which is realted to your recent offerings.</td></tr></table>";
                            $msg.="<table width=600px bordercolor=#cccccc bgcolor=#ffffff align=left border=1 cellpadding=4 cellspacing=0 class='style1'>"; 
                            $msg.="<tr><td colspan=2 bgcolor=#ebebeb><b>Offerings</b></td></tr>";
                            $msg .= $data;                         
                            $msg.="</table>";
                            $msg.="<table><tr><td>Thanks & Regards,</td></tr><tr><td>www.churchmgmt.in</td></tr><tr><td>System generated email confirmation for your offering recently made</td></tr></table>";
                            $msg.="</body></html>";


                            $sent  = mail( $customerEmail, $subject, $msg, $headers_customers );
                        }
                    ?>                        
                    </span></td>
                </tr>
            </table>
            <br/>
        </div>
        <span class="divider col-xs-12"></span>

        <div class="col-xs-12">
            <br/><br/>
            <div class="col-xs-4 center">
                Signature of Pastor
            </div>
            <div class="col-xs-4 center">
                Signature of Elder
            </div>
            <div class="col-xs-4 center">
                Signature of Treasurer
            </div>
        </div>
    </div>

    <div class="col-xs-12">
      <span class="divider col-xs-12"></span>
    </div>
    <div class="col-xs-12 lBottom2">
        <ul class="service">
            <li><span class="uppercase">"honor the lord with substance, and with the firstfruits of al thine increase." </span>Prov. 3:9</li>
        </ul>
    </div>
  </div><!-- End of row -->

<script src="js/common.js"></script>
<script src="js/offerings/print.js"></script>
<?php require_once('includes/footer.php'); ?>