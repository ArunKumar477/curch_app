<?php 
    require_once('includes/check-login.php');
    require_once('includes/header.php'); 
    require_once('includes/config.php');
 	require_once("includes/pagination.php");
 	$opening_bal = 0;
 	$weeks = array();
 	$saturdays = array();
    $total_items = 0;
    $month = "";
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
	                    <!-- <img src="<?php echo 'admin/'.$_SESSION['logo']; ?>" alt="<?php echo $_SESSION['cname']; ?>"/> -->
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
                                <div class="uppercase success"> OYO : OLD YEAR OFFERING	</div>                              

                            </div>
                            <div class="col-xs-4">
                                <div class="uppercase success"> pfo : poor fund offering</div>
                                <div class="uppercase success"> bo : building project offering</div>
                                <div class="uppercase success"> ceo : church expense offering</div>
                                <div class="uppercase success"> dso : divine service offering</div>
                                <div class="uppercase success"> NYO : NEW YEAR OFFERING	</div>                              

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
                                <th class="uppercase">OYO</th>
                                <th class="uppercase">NYO</th>
			        		</tr>			        		

                            <?php 
                            	$grand_total = 0;
			        			$grand_exp   = 0;
			        			$grand_cms   = 0;
			        			$grand_lcf   = 0;
			        			$offer_dates = array();

								$start_val = $year."-".$month."-01";
								$dt = $start_val;
								$end_val = date("Y-m-t", strtotime($dt)); 
								$getMonthOff = "select offer_date from offerings where offer_date BETWEEN '".$start_val."' AND '".$end_val."'  group by offer_date";
								//echo $getMonthOff;
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
									sum(case when oc.category='OLD YEAR OFFERING' then o.amount else '-' end) as 'oyo',
									sum(case when oc.category='NEW YEAR OFFERING' then o.amount else '-' end) as 'nyo',
									sum(case when oc.category='Wedding Offering' then o.amount else '-' end) as 'wo' FROM `offerings` o 
									left outer join offerings_category oc on  o.cat_id=oc.id  
									where o.active = 1 AND o.cid=".$_SESSION['cid']." AND o.offer_date = '".$off_date."'";
									//echo $fquery;
									
									
	                                $fresult = mysqli_query($con,$fquery);

	                                /* getting expenses for each week*/
	                                $expenses = 0;
                                    $exp_query ="SELECT sum(amount) expense from expenses e where e.cid = ".$_SESSION['cid']." and e.expense_date ='".$off_date."' AND e.active = 1";
									//echo $exp_query;

                                    $equery = mysqli_query($con,$exp_query);                                    
                                    if( $equery ){
                                    	$exp_row = mysqli_fetch_assoc($equery);
	                                    $expenses =  ( $exp_row['expense'] != null ) ? $exp_row['expense'] : 0;
	                                    $grand_exp = $grand_exp + $expenses;
	                                }
                               ?>			        		
			        		<tr>	
			        			<?php 		
			        				if( $fresult ){
			        				while( $rows = mysqli_fetch_assoc($fresult)) {
											// echo $rows['amount'];
											// echo "<br>";
			        					$total = ( $rows['amount'] != null ) ? $rows['amount'] : 0;
			        					//$grand_total = $grand_total + intVal( $total );
										$grand_total = $grand_total + $total;
			        					$cms     =  ( $rows['cms_share'] != null ) ? $rows['cms_share'] : 0 ;
			        					$grand_cms = $grand_cms + $cms;
			        					$church  =  ( $rows['chruch_share'] != null ) ? $rows['chruch_share'] : 0;
			        					$grand_lcf = $grand_lcf + $church;

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
                                        $oyo       = ( $rows['oyo'] ) ? $rows['oyo'] : 0;
                                        $nyo       = ( $rows['nyo'] ) ? $rows['nyo'] : 0;

			                        ?>
			                        <tr>			                  		
			                        <td><?php 
			                            //echo date( 'd-m-Y', $off_date );
			                            echo $off_date;
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
                                    <td> <i class="fa fa-inr"> <?php echo $oyo; ?></i></td>
                                    <td> <i class="fa fa-inr"> <?php echo $nyo; ?></i></td>

			                    	</tr>
			                    <?php  } ?> 
			                <?php }  }?>

			                <tr>
                                <td class="success"> Total </td>
                                                                
                                <td class="success">
                                <span class="fa fa-inr">
                                    <?php
                                        $total_cms_val = "";
                                        $tot_cms_query = "SELECT sum(o.cms_share) cms from offerings o where o.active = 1 AND o.cid = ".$_SESSION['cid']."  AND o.active = 1 AND o.offer_date BETWEEN '".$start_val."' AND '".$end_val."' group by o.offer_date";

                                        $tot_cms_result = mysqli_query( $con, $tot_cms_query );
                                        $total_cms_val = 0;
										while( $tot_cms_rows = mysqli_fetch_assoc( $tot_cms_result )) {
										$total_cms_val_ttl = ( $tot_cms_rows['cms'] != null ) ? $tot_cms_rows['cms'] : 0;
										$total_cms_val = $total_cms_val + $total_cms_val_ttl;
										}
										echo $total_cms_val;
                                    ?>                                            
                                </span>
                                </td>

                                <td class="success">
                                <span class="fa fa-inr">
                                    <?php
                                        $tot_church_query = "SELECT sum(o.chruch_share) chruch_share from offerings o where o.active = 1 and o.cid = ".$_SESSION['cid']." AND o.active = 1  AND o.offer_date BETWEEN '".$start_val."' AND '".$end_val."' group by o.offer_date";
                                        $tot_church_result = mysqli_query( $con, $tot_church_query );
										$total_church_val = 0;
										while( $tot_church_rows = mysqli_fetch_assoc( $tot_church_result )) {
											$total_church_val_ttl = ( $tot_church_rows['chruch_share'] != null ) ? $tot_church_rows['chruch_share'] : 0;
											$total_church_val = $total_church_val + $total_church_val_ttl;
										}
										echo $total_church_val;

                                    ?>                                             
                                </span>
                                </td>

                                <td class="success">
                                <span class="fa fa-inr">
                                    <?php
                                        $tot_exp_query = "SELECT sum(e.amount) expene_amt from expenses e where e.active = 1 and e.cid = ".$_SESSION['cid']." AND e.active = 1  AND e.expense_date BETWEEN '".$start_val."' AND '".$end_val."' group by e.expense_date";
                                        $tot_exp_result = mysqli_query( $con, $tot_exp_query );
										$total_exp_ar = 0;
										while( $tot_exp_rows = mysqli_fetch_assoc( $tot_exp_result )) {
											$total_exp_ar_ttl = ( $tot_exp_rows['expene_amt'] != null ) ? $tot_exp_rows['expene_amt'] : 0;
											$total_exp_ar = $total_exp_ar + $total_exp_ar_ttl;
										}
										echo $total_exp_ar;
										?>                                            
                                </span>
                                </td>

                                <td class="success">
                                <span class="fa fa-inr">
                                    <?php
                                        $tot_off_query = "SELECT sum(o.amount) amt from offerings o where o.active = 1 and o.cid = ".$_SESSION['cid']." AND o.active = 1 AND o.offer_date BETWEEN '".$start_val."' AND '".$end_val."' group by o.offer_date";
                                        $tot_off_result = mysqli_query($con,$tot_off_query);
                                        
										$total_off_ar = 0;
										while( $tot_off_rows = mysqli_fetch_assoc($tot_off_result)) {
											$total_off_ar_ttl = ( $tot_off_rows['amt'] != null ) ? $tot_off_rows['amt']  : 0;
											$total_off_ar = $total_off_ar + $total_off_ar_ttl;
										}
										echo $total_off_ar;

                                    ?>                                            
                                </span>
                                </td>

                            <?php for( $i=1; $i<=14; $i++ ) { ?>
                                <td class="success">
                                <span class="fa fa-inr">
                                <?php
                                    $tot_off_t = "SELECT sum(o.amount) amt from offerings o where o.cat_id =". $i ." AND o.active = 1 and o.cid = ".$_SESSION['cid']." AND o.active = 1 AND o.offer_date BETWEEN '".$start_val."' AND '".$end_val."' group by o.offer_date";
                                    $tot_off_t_res = mysqli_query( $con, $tot_off_t );
									$total_val = 0;
									
									while( $rows = mysqli_fetch_assoc($tot_off_t_res)) {

										$total_val_arr = ( $rows['amt'] != null ) ? $rows['amt']  : 0;
										$total_val = $total_val + $total_val_arr;
									}
									echo $total_val;

                                    // echo ( $tot_off_t_rows['amt'] ) ? $tot_off_t_rows['amt'] : 0;
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
			                    	Expenses : <i class="fa fa-inr"><?php echo $total_exp_ar; ?></i>
			                    </td>               
			                </tr>
			        	</table>
			        	<table class="table table-striped table-bordered table-hover">

			        		<tr>
			        			<td class="success fcolor" align="center">Opening Balance</td>
			        			<td class="success fcolor" align="center">:</td>
			        			<?php 
/*			        				if ( isset( $_REQUEST['qmonth'] ) && ( $_REQUEST['qmonth'] == 1 ) ){
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
			        				}*/


			        				if($month == 1){
										$mon = 12;
			                    	 	    $yr = $year-1;
			                    	 	} else {
			                    	 	    $mon = $month - 1;
			                    	 	    $yr = $year;
			                    	 	}
			        				
			        				$cbal = "select * from accounts where month=".$mon." and year = ".$yr." and cid=".$_SESSION['cid'];
			        				
			        				$cexe = mysqli_query( $con, $cbal );
			                    	$cCnt = mysqli_num_rows( $cexe );
			                    	if( $cCnt == 1 ){
			                    		$cRows = mysqli_fetch_assoc( $cexe );

			                    		$opening_bal = $cRows['closing_balance'];
			                    		echo '<td class="success fcolor" align="center"><span class="fa fa-inr"> <b>'.$opening_bal.'</b></span></td>';
			                    	}else{
			                    		echo '<td class="success fcolor" align="center">0</td>';
			                    	}
			        			?>
			        		</tr>
			        		<tr>
			                	<td class="success fcolor" align="center">Total Offering</td>
			                	<td class="success fcolor" align="center"> : </td>
			                    <td class="success fcolor" align="left">
			                        <?php echo $grand_total; ?>
			                     </td>
			                </tr>
			                <tr>
			                	<td class="success fcolor" align="center">Expenses</td>
			                	<td class="success fcolor" align="center"> : </td>
			                    <td class="success fcolor" align="left">
			                        <?php echo $total_exp_ar; ?>
			                     </td>
			                </tr>
                             <tr>
			                	<td class="success fcolor" align="center">Amount to CMS</td>
			                	<td class="success fcolor" align="center"> : </td>
			                    <td class="success fcolor" align="left">
			                        <?php echo $total_cms_val; ?>
			                     </td>
			                </tr>
			        		<tr>
			                	<td class="success fcolor" align="center"> Closing Balance</td>
			                	<td class="success fcolor" align="center">:</td>
			                    <td class="success fcolor" align="left">
			                    	<?php
			                    		//$closing_balance = $opening_bal + $grand_total -  ($total_cms_val + $grand_exp);
			                    		//$closing_balance = $opening_bal + $grand_total - ( $grand_cms + $grand_lcf + $grand_exp );
			                    		$closing_balance = $opening_bal + $grand_total -  $total_cms_val - $grand_exp;
			                    	 	echo $closing_balance; 
			                    	 	
			                    	 	//echo  "<br>".$opening_bal." = =".$grand_total." = =". $grand_cms." = =".$grand_lcf ." = =".$grand_exp;
			                    	 	
			                    	 	$month_ = "";
			                    	 	$year_ = "";
			                    	 	
			                    	 	if($month == 1){
			                    	 	    $month_ = 12;
			                    	 	    $year_ = $year-1;
			                    	 	$getBal = "select * from accounts where month=".$month_." and year = ".$year_." and cid=".$_SESSION['cid'];
			                    	 	} else {
			                    	 	    $month_ = $month - 1;
			                    	 	    $year_ = $year;
			                    	 	$getBal = "select * from accounts where month=".$month_." and year = ".$year_." and cid=".$_SESSION['cid'];
			                    	 	}
			                    	 	
			                    	 	
			                    	 	//echo "hello -- ".$getBal."<br>";
			                    	 	$get_exe = mysqli_query( $con, $getBal );
			                    	 	$bCnt = mysqli_num_rows( $get_exe );
			                    	 	$closing_bal_Rows = mysqli_fetch_assoc( $get_exe );

                                        $closing_bal_ = $closing_bal_Rows['closing_balance'];
                                        
			                    	 	if( $bCnt != 1 ){
			                    	 	    //echo "arun";
			                    	 	    
    			                    	 	$checksql = "SELECT * FROM accounts WHERE month=".$month." AND year=".$year;
    			                    	 	$check_exe = mysqli_query( $con, $checksql );
    			                    	 	$check_cnt = mysqli_num_rows( $check_exe );
    			                    	 	//echo $check_cnt."test"; 
			                    	 	
                                            if($check_cnt == 0){
                                          		$bal_sql = "insert into accounts(cid,month,year,closing_balance,created_at,created_by) values( ".$_SESSION['cid'].", ".$month.", ".$year.", '".$closing_balance."', ".$_SESSION['userid'].", ".strtotime(date("Y-m-d H:i:s")).")";
    				                    	 	//echo $bal_sql."-------if insert 1";
    				                    	 	$bal_exe = mysqli_query( $con, $bal_sql );          
                                            }else{
    				                    		$u_bal = "update accounts set cid = ".$_SESSION['cid'].", closing_balance='".$closing_balance."',updated_at = ".strtotime(date("Y-m-d H:i:s")).", updated_by=".$_SESSION['userid']." where month=".$month." AND year = ".$year ;
                                               	//echo $u_bal ." if update----------1";
                                               	$u_exe = mysqli_query( $con, $u_bal );
                                            }
				                    	}else{
				                    		$checksql = "SELECT * FROM accounts WHERE month=".$month." AND year=".$year;
    			                    	 	$check_exe = mysqli_query( $con, $checksql );
    			                    	 	$check_cnt = mysqli_num_rows( $check_exe );
    			                    	 	//echo $checksql."test"; 
			                    	 	 
                                            if($check_cnt == 0){
                                          		$bal_sql = "insert into accounts(cid,month,year,closing_balance,created_at,created_by) values( ".$_SESSION['cid'].", ".$month.", ".$year.", '".$closing_balance."', ".$_SESSION['userid'].", ".strtotime(date("Y-m-d H:i:s")).")";
    				                    	 	//echo $bal_sql."-------------else insert2";
    				                    	 	$bal_exe = mysqli_query( $con, $bal_sql );          
                                            }else{
    				                    		$u_bal = "update accounts set cid = ".$_SESSION['cid'].", closing_balance='".$closing_balance."',updated_at = ".strtotime(date("Y-m-d H:i:s")).", updated_by=".$_SESSION['userid']." where month=".$month." AND year = ".$year ;
                                               	//echo $u_bal ." ----------2 else update 2";
                                               	$u_exe = mysqli_query( $con, $u_bal );
                                                
                                            }
				                    	}
			                    	?>
			                    	</td>
			                </tr>
			                <!--<tr>
			                	<td class="success fcolor" align="center">Calculation</td>
			                	<td class="success fcolor" align="center"> : </td>
			                    <td class="success fcolor" align="left">
			                        Opening Bal + Total - (CMS + Expenses)
			                     </td>
			                </tr>-->

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