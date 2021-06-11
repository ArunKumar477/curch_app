<?php 
    require_once('includes/check-login.php');
    require_once('includes/header.php'); 
    require_once('includes/config.php');
 	require_once("includes/pagination.php");

 	$opening_bal = 0;
 	$weeks = array();
 	$saturdays = array();
    $total_items = 0;
    isset( $_REQUEST['qmonth'] ) ? $month = $_REQUEST['qmonth'] : $month = date('m'); 
    isset( $_REQUEST['qyear'] ) ? $year = $_REQUEST['qyear'] : $year = date('Y');
    $year =  $year;
    $month = $month;

?> 

<div id="wrapper">

    <?php require_once('includes/menu.php'); ?>

    <div id="page-wrapper">
        <div class="row">            

        	 <div class="col-lg-12 noprint">
                    <br/>
                    <ul class="list-inline pull-right bbottom">
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#pSearch">Search</a>
                        </li>   
                       	<li><a href="javascript:void(0);" class="print_link" data-pid="1">Print</a></li>        
                    </ul>            
                </div>
                <!-- Open Search Modal -->


                <div class="row collapse drkBdr col-md-12 noprint" id="pSearch">
                    <div class="col-xs-12 col-md-12 col-lg-12 no-padding">
                        <form class="form-horizontal" id="search_form" action="" class="form-horizontal" method="POST">
                            <div class="row mtb10">
                                <div class="col-md-3">                                    
									<?php
										$monthArray = range(1, 12);
									?> 
									<select name="qmonth" id="qmonth" class="form-control">
									    <option value="">Select Month</option>
									    <?php
									    foreach ( $monthArray as $mnth ) {
									        $monthPadding = str_pad($mnth, 2, "0", STR_PAD_LEFT);
									        $fdate = date("F", strtotime("2015-$monthPadding-01"));
									        echo '<option value="'.$monthPadding.'">'.$fdate.'</option>';
									    }
									    ?>
									</select> 
								</div>
								<div class="col-md-3"> 
									<select name="qyear" id="qyear" class="form-control">
									    <option value="">Select Year</option>
									    <?php
										    for ( $i= 2017; $i<= 2050; $i++ ) {
										        echo '<option value="'.$i.'"">'.$i.'</option>';
										    }
									    ?>
									</select>                   
                                </div>

                                <div class="col-md-3">
                                	<input class="btn btn-primary" id="filter" type="submit" value="Search" />
                            	</div>

                            </div>
                            
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End Search Modal -->

                <div class="col-xs-12 lBottom show-div">
	                <div class="col-xs-4">
	                    <img src="<?php echo 'admin/'.$_SESSION['logo']; ?>" alt="<?php echo $_SESSION['cname']; ?>"/>
	                </div>
	                
	                <div class="col-xs-8">
	                    <ul class="uppercase">
	                        <li> Seventh day adventist english church </li>
	                        <li> 52, ritherdon road, vepery,</li>
	                        <li> chennai - 600 007, India</li>
	                    </ul>
	                </div>                                      
	            </div><!-- End of col-md-12 -->
            
                <div class="col-lg-12">                   
                    <section id="content" style="border-bottom:none;">
                    <article id="cleft">
                    <div class="col-lg-12">
                    	<div class="pull-right fcolor">Date:<?php echo date('d-m-Y'); ?></div>
                    	<?php $month_name = date('F', mktime(0, 0, 0, $month, 10)); ?>
                        <h3>Treasurer Monthly Report : <?php echo $month_name. "'" .$year; ?></h3>
                        <div class="col-xs-12">
                            <div class="col-xs-3">
                                <div class="uppercase success"> T : tithes </div>
                                <div class="uppercase success"> To : Thanks offering</div>
                                <div class="uppercase success"> bd'o : Birthday Offering</div>
                                <div class="uppercase success"> do : DORCAS offering</div>                              
                            </div>
                            <div class="col-xs-4">
                                <div class="uppercase success"> pfo : poor fund offering</div>
                                <div class="uppercase success"> bo : building project offering</div>
                                <div class="uppercase success"> ceo : church expense offering</div>
                                <div class="uppercase success"> dso : divine service offering</div>
                            </div>
                            <div class="col-xs-5">
                                <div class="uppercase success"> sso : sabaath school offering</div>
                                <div class="uppercase success"> io : investment offering</div>
                                <div class="uppercase success"> sslcp : sabbath school lesson cost offering</div>
                                <div class="uppercase success"> wo : wedding offering</div>
                            </div>
                        </div>

                        <table class="table table-striped table-bordered table-hover"> 
                        	<tr>
			        			<th class="uppercase">Day(s)</th>			        			
			        			<th class="uppercase">CMS</th>
			        			<th class="uppercase">LCF</th>
			        			<th class="uppercase">Expenses</th>
			        			<th class="uppercase">Total</th>
			        			<th class="uppercase">T</th>
                                <th class="uppercase">TO</th>
                                <th class="uppercase">B'DO</th>
                                <th class="uppercase">DO</th>
                                <th class="uppercase">PFO</th>
                                <th class="uppercase">CEO</th>
                                <th class="uppercase">DSO</th>
                                <th class="uppercase">SSO</th>
                                <th class="uppercase">IO</th>
                                <th class="uppercase">BPO</th>
                                <th class="uppercase">SSLCP</th>
                                <th class="uppercase">WO</th>
			        		</tr>			        		

                            <?php 
                            	$grand_total = 0;
			        			$grand_exp   = 0;
			        			$grand_cms   = 0;
			        			$grand_lcf   = 0;
			        			$offer_dates = array();
			        			$getMonthOff = "select offer_date from offerings where month(FROM_UNIXTIME(offer_date)) =".$month." AND year(FROM_UNIXTIME(offer_date)) =".$year." group by offer_date";
			        			$exeMonthOff = mysqli_query( $con, $getMonthOff );
			        			while( $monthOffRow = mysqli_fetch_assoc( $exeMonthOff ) ){
			        				array_push( $offer_dates, $monthOffRow['offer_date'] );
			        			}
                            	foreach ( $offer_dates as $wkey => $off_date ) {
                            		$amt = 0;  
	                                $fquery = "SELECT sum(o.amount) amount,sum(o.cms_share) cms_share,sum(o.chruch_share) chruch_share, sum(case when oc.category='tithes' then o.amount else '-' end) as t, 
									sum(case when oc.category='Thanks Offerings' then o.amount else '-' end) as 'to', 
									sum(case when oc.category='Birthday Offering' then o.amount else '-' end) as bdo,
									sum(case when oc.category='Dorcas Offering' then o.amount else '-' end) as do,
									sum(case when oc.category='Poor Fund Offering' then o.amount else '-' end) as 'pfo',
									sum(case when oc.category='Church Expenses Offering' then o.amount else '-' end) as 'ceo',
									sum(case when oc.category='Divine Service Offering' then o.amount else '-' end) as 'dso',
									sum(case when oc.category='Sabbath School Offering' then o.amount else '-' end) as 'sso',
									sum(case when oc.category='Investment Offering	' then o.amount else '-' end) as 'io',
									sum(case when oc.category='Building Project' then o.amount else '-' end) as 'bpo',
									sum(case when oc.category='Sabbath School Lesson Cost Payment' then o.amount else '-' end) as 'sslcp',
									sum(case when oc.category='Wedding Offering' then o.amount else '-' end) as 'wo' FROM `offerings` o left outer join offerings_category oc on  o.cat_id=oc.id  where o.active = 1 AND o.cid=".$_SESSION['cid']." AND o.offer_date = $off_date";
	                                $fresult = mysqli_query($con,$fquery);

	                                /* getting expenses for each week*/
	                                $expenses = 0;
                                    $exp_query ="SELECT sum(amount) expense from expenses e where e.cid = ".$_SESSION['cid']." and e.expense_date =".$off_date." AND e.active = 1";
                                    $equery = mysqli_query($con,$exp_query);                                    
                                    if( $equery ){
                                    	$exp_row = mysqli_fetch_assoc($equery);
	                                    $expenses =  ( $exp_row['expense'] != null ) ? $exp_row['expense'] : 0;
	                                    $grand_exp = $grand_exp + intVal( $expenses );
	                                }
                               ?>			        		
			        		<tr>	
			        			<?php 		
			        				if( $fresult ){
			        				while( $rows = mysqli_fetch_assoc($fresult)) {
			        					$total   =  ( $rows['amount'] != null ) ? $rows['amount'] : 0;
			        					$grand_total = $grand_total + intVal( $total );
			        					$cms     =  ( $rows['cms_share'] != null ) ? $rows['cms_share'] : 0 ;
			        					$grand_cms = $grand_cms + intVal( $cms );
			        					$church  =  ( $rows['chruch_share'] != null ) ? $rows['chruch_share'] : 0;
			        					$grand_lcf = $grand_lcf + intVal( $church );

			        					$t        = ( $rows['t'] ) ? $rows['t']     : 0;
                                        $to       = ( $rows['to'] ) ? $rows['to']   : 0;
                                        $bdo      = ( $rows['bdo'] ) ? $rows['bdo'] : 0;
                                        $do       = ( $rows['do'] ) ? $rows['do']   : 0;

                                        $pfo      = ( $rows['pfo'] ) ? $rows['pfo'] : 0;
                                        $ceo      = ( $rows['ceo'] ) ? $rows['ceo'] : 0;           
                                        $dso      = ( $rows['dso'] ) ? $rows['dso'] : 0;
                                        $sso      = ( $rows['sso'] ) ? $rows['sso'] : 0;

                                        $io       = ( $rows['io'] ) ? $rows['io'] : 0;
                                        $bpo      = ( $rows['bpo'] ) ? $rows['bpo'] : 0;
                                        $sslcp    = ( $rows['sslcp'] ) ? $rows['sslcp'] : 0;
                                        $wo       = ( $rows['wo'] ) ? $rows['wo'] : 0;

			                        ?>
			                        <tr>			                  		
			                        <td><?php 
			                          echo date( 'd-m-Y', $off_date );
			                        ?> </td>			                        
			                        <td><i class="fa fa-inr"><?php echo $cms; ?></i></td>
			                        <td><i class="fa fa-inr"><?php echo $church; ?></i></td>
			                        <td><i class="fa fa-inr"><?php echo $expenses; ?></i></td>
			                        <td><i class="fa fa-inr"> <?php echo $total; ?></i></td>

			                        <td> <i class="fa fa-inr"> <?php echo $t; ?></i></td>
                                    <td> <i class="fa fa-inr"> <?php echo $to; ?></i></td>
                                    <td> <i class="fa fa-inr"> <?php echo $bdo; ?></i></td>
                                    <td> <i class="fa fa-inr"> <?php echo $do; ?></i></td>

                                    <td> <i class="fa fa-inr"> <?php echo $pfo; ?></i></td>
                                    <td> <i class="fa fa-inr"> <?php echo $ceo; ?></i></td>
                                    <td> <i class="fa fa-inr"> <?php echo $dso; ?></i></td>
                                    <td> <i class="fa fa-inr"> <?php echo $sso; ?></i></td>

                                    <td> <i class="fa fa-inr"> <?php echo $io; ?></i></td>
                                    <td> <i class="fa fa-inr"> <?php echo $bpo; ?></i></td>
                                    <td> <i class="fa fa-inr"> <?php echo $sslcp; ?></i></td>
                                    <td> <i class="fa fa-inr"> <?php echo $wo; ?></i></td>

			                    	</tr>
			                    <?php  } ?> 
			                <?php }  }?>

			                <tr>
                                <td class="success"> Total </td>
                                                                
                                <td class="success">
                                <span class="fa fa-inr">
                                    <?php
                                        $tot_cms_query = "SELECT sum(o.cms_share) cms from offerings o where o.active = 1 and o.cid = ".$_SESSION['cid']." AND month(FROM_UNIXTIME(o.offer_date)) =".$month." AND year(FROM_UNIXTIME(o.offer_date)) =".$year." AND o.active = 1";
                                        $tot_cms_result = mysqli_query( $con, $tot_cms_query );
                                        $tot_cms_rows = mysqli_fetch_assoc( $tot_cms_result );
                                        echo ( $tot_cms_rows['cms'] ) ? $tot_cms_rows['cms'] : 0;
                                    ?>                                            
                                </span>
                                </td>

                                <td class="success">
                                <span class="fa fa-inr">
                                    <?php
                                        $tot_church_query = "SELECT sum(o.chruch_share) chruch_share from offerings o where o.active = 1 and o.cid = ".$_SESSION['cid']." AND month(FROM_UNIXTIME(o.offer_date)) =".$month." AND year(FROM_UNIXTIME(o.offer_date)) =".$year." AND o.active = 1";
                                        $tot_church_result = mysqli_query( $con, $tot_church_query );
                                        $tot_church_rows = mysqli_fetch_assoc( $tot_church_result );
                                        echo ( $tot_church_rows['chruch_share'] ) ? $tot_church_rows['chruch_share'] : 0;
                                    ?>                                             
                                </span>
                                </td>

                                <td class="success">
                                <span class="fa fa-inr">
                                    <?php
                                        $tot_exp_query = "SELECT sum(e.amount) expene_amt from expenses e where e.active = 1 and e.cid = ".$_SESSION['cid']." AND month(FROM_UNIXTIME(e.expense_date)) =".$month." AND year(FROM_UNIXTIME(e.expense_date)) =".$year." AND e.active = 1";
                                        $tot_exp_result = mysqli_query( $con, $tot_exp_query );
                                        $tot_exp_rows = mysqli_fetch_assoc( $tot_exp_result );
                                        echo ( $tot_exp_rows['expene_amt'] ) ? $tot_exp_rows['expene_amt'] : 0;
                                    ?>                                            
                                </span>
                                </td>

                                <td class="success">
                                <span class="fa fa-inr">
                                    <?php
                                        $tot_off_query = "SELECT sum(o.amount) amt from offerings o where o.active = 1 and o.cid = ".$_SESSION['cid']." AND month(FROM_UNIXTIME(offer_date)) =".$month." AND year(FROM_UNIXTIME(offer_date)) =".$year." AND o.active = 1";
                                        $tot_off_result = mysqli_query($con,$tot_off_query);
                                        $tot_off_rows = mysqli_fetch_assoc($tot_off_result);
                                        echo ( $tot_off_rows['amt'] ) ? $tot_off_rows['amt'] : 0;
                                    ?>                                            
                                </span>
                                </td>

                            <?php for( $i=1; $i<=12; $i++ ) { ?>
                                <td class="success">
                                <span class="fa fa-inr">
                                <?php
                                    $tot_off_t = "SELECT sum(o.amount) amt from offerings o where o.cat_id =". $i ." AND o.active = 1 and o.cid = ".$_SESSION['cid']." AND month(FROM_UNIXTIME(offer_date)) =".$month." AND year(FROM_UNIXTIME(offer_date)) =".$year." AND o.active = 1";
                                    $tot_off_t_res = mysqli_query( $con, $tot_off_t );
                                    $tot_off_t_rows = mysqli_fetch_assoc($tot_off_t_res);
                                    echo ( $tot_off_t_rows['amt'] ) ? $tot_off_t_rows['amt'] : 0;
                                ?>                                            
                               	</span>
                                </td>
                            <?php } ?>
                            </tr>

			        	</table>

			        	<table class="table table-striped table-bordered table-hover">
			        		 <tr>
			                	<td class="success fcolor"> 
			                		Total : <i class="fa fa-inr"> <?php echo $grand_total; ?></i>
			                	</td>
			                    <td class="success fcolor">
			                    	CMS :  <i class="fa fa-inr"><?php echo $grand_cms; ?></i>
			                    </td>
			                    <td class="success fcolor"> 
			                    	LCF : <i class="fa fa-inr"><?php echo $grand_lcf; ?></i>
			                    </td>
			                    <td class="success fcolor"> 
			                    	Espenses : <i class="fa fa-inr"><?php echo $grand_exp; ?></i>
			                    </td>               
			                </tr>
			        	</table>
			        	<table class="table table-striped table-bordered table-hover">

			        		<tr>
			        			<td class="success fcolor" align="center">Opening Balance</td>
			        			<td class="success fcolor" align="center">:</td>
			        			<?php 
			        				if ( isset( $_REQUEST['qmonth'] ) && ( $_REQUEST['qmonth'] == 1 ) ){
			        					$mon =  $_REQUEST['qmonth'];
			        				}else if ( isset( $_REQUEST['qmonth'] ) && ( $_REQUEST['qmonth'] != 1 ) ){
			        					$mon =  $_REQUEST['qmonth']-1;
			        				}else{
			        					$mon = date('m')-1;
			        				}

			        				if( isset($_REQUEST['qyear'] ) && ( $_REQUEST['qyear'] != date('Y') ) && ( $mon == 1 ) ){
			        					$yr = $year-1;
			        					$mon = 12;
			        				}else{
			        					$yr = $year;
			        				}
			        				
			        				$cbal = "select * from accounts where month=".$mon." and year = ".$yr." and cid=".$_SESSION['cid'];
			        				$cexe = mysqli_query( $con, $cbal );
			                    	$cCnt = mysqli_num_rows( $cexe );
			                    	if( $cCnt == 1 ){
			                    		$cRows = mysqli_fetch_assoc( $cexe );
			                    		$opening_bal = $cRows['closing_balance'];
			                    		echo '<td class="success fcolor" align="center"><span class="fa fa-inr">'.$opening_bal.'</span></td>';
			                    	}else{
			                    		echo '<td class="success fcolor" align="center">0</td>';
			                    	}
			        			?>
			        		</tr>

			        		<tr>
			                	<td class="success fcolor" align="center"> Closing Balance</td>
			                	<td class="success fcolor" align="center">:</td>
			                    <td class="success fcolor" align="left"><i class="fa fa-inr">
			                    	<?php
			                    		$closing_balance = $opening_bal + $grand_total - ( $grand_cms + $grand_lcf + $grand_exp );
			                    	 	echo $closing_balance; 
			                    	 	$getBal = "select * from accounts where month=".$month." and year = ".$year." and cid=".$_SESSION['cid'];
			                    	 	$get_exe = mysqli_query( $con, $getBal );
			                    	 	$bCnt = mysqli_num_rows( $get_exe );
			                    	 	if( $bCnt == 0 ){
				                    	 	$bal_sql = " insert into accounts(cid,month,year,closing_balance,created_at,created_by) values( ".$_SESSION['cid'].", ".$month.", ".$year.", '".$closing_balance."', ".$_SESSION['userid'].", ".strtotime(date("Y-m-d H:i:s")).")";
				                    	 	$bal_exe = mysqli_query( $con, $bal_sql );
				                    	}else{
				                    		$bRow = mysqli_fetch_assoc( $get_exe );
				                    		$u_bal = " update ccounts set cid = ".$_SESSION['cid'].", closing_balance='".$closing_balance."', month=".$month." ,year=".$year.",update_at = ".strtotime(date("Y-m-d H:i:s")).", updated_by=".$_SESSION['userid']." where id=".$bRow['id'];
				                    		$u_exe = mysqli_query( $con, $u_bal );
				                    	}
			                    	?>
			                    	
			                    </i></td>
			                </tr>
			                <tr>
			                	<td class="success fcolor" align="center">Amount to CMS </td>
			                	<td class="success fcolor" align="center">:</td>
			                	<td class="success fcolor" align="left"><i class="fa fa-inr"></i><?php echo $grand_cms; ?></i></td>
			                </tr>
			                <tr>
			                	<td class="success fcolor" align="center">Cheque No </td>
			                	<td class="success fcolor" align="center">:</td>
			                	<td class="success fcolor" align="left"></td>
			                </tr>
			                <tr>
			                	<td class="success fcolor" align="center">Date </td>
			                	<td class="success fcolor" align="center">:</td>
			                	<td class="success fcolor" align="left"></td>
			                </tr>
			                <tr class="noBorder">
			                	<td class="success fcolor" align="center">&nbsp;</td>
			                	<td class="success fcolor" align="cneter" colspan="3">&nbsp;</td>
			                </tr>
			                <tr class="noBorder">
			                	<td class="success fcolor" align="center">&nbsp;</td>
			                	<td class="success fcolor" align="cneter" colspan="3">&nbsp;</td>
			                </tr>
			                <tr class="noBorder">
			                	<td class="success fcolor" align="center">Pastor signature</td>
			                	<td class="success fcolor" align="center" colspan="3">Treasurer Signature</td>
			                </tr>
			        	</table>
        </div>
    </div>
</div>
<script src="js/offerings/print.js"></script>
<?php require_once('includes/footer.php'); ?>