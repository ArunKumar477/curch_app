<?php 
    require_once('includes/check-login.php');
    require_once('includes/header.php'); 
    require_once('includes/config.php');
    require_once("includes/pagination.php");

    $data = '';
    $cond = '';
    $cond1 = '';
    $data1 = '';

    $total_items = 0;
    if(  isset( $_REQUEST['fdate'] ) ) {
        $fdate = strtotime($_REQUEST['fdate']);
        $data .= '&created_at='.$fdate;
    }

    if( isset( $_REQUEST['tdate'] ) ){
        $tdate = strtotime($_REQUEST['tdate']);
        $data .= '&created_at='.$tdate;
    }

    $fdate = isset( $fdate ) ? $fdate : "";
    $tdate = isset( $tdate ) ? $tdate : 0;    
    if( $fdate != "") {
        $cond .= " AND o.offer_date BETWEEN $fdate";
    }

    if( $tdate != 0) {
        $cond .= " AND $tdate";
    }

    if(  isset( $_REQUEST['fdate'] ) ) {
        $fdate = strtotime($_REQUEST['fdate']);
        $data1 .= '&expense_date='.$fdate;
    }

    if( isset( $_REQUEST['tdate'] ) ){
        $tdate = strtotime($_REQUEST['tdate']);
        $data1 .= '&expense_date='.$tdate;
    }

    $fdate = isset( $fdate ) ? $fdate : "";
    $tdate = isset( $tdate ) ? $tdate : 0;    
    if( $fdate != "") {
        $cond1 .= " AND e.expense_date BETWEEN $fdate";
    }

    if( $tdate != 0) {
        $cond1 .= " AND $tdate";
    }

    $cid = $_SESSION['cid'];

    $query = "SELECT 
    o.receipt_no,o.name,o.id,
    sum(o.amount) as amount,
    sum(case when oc.category='Tithes' then o.amount else '0' end) as t, 
    sum(case when oc.category='Thanks Offerings' then o.amount else '0' end) as 'to', 
    sum(case when oc.category='Birthday Offering' then o.amount else '0' end) as 'bdo',
    sum(case when oc.category='Dorcas Offering' then o.amount else '0' end) as 'do',
    sum(case when oc.category='Poor Fund Offering' then o.amount else '0' end) as 'pfo',
    sum(case when oc.category='Church Expenses Offering' then o.amount else '0' end) as 'ceo',
    sum(case when oc.category='Sabbath School Offering' then o.amount else '0' end) as 'sso',
    sum(case when oc.category='Investment Offering  ' then o.amount else '0' end) as 'io',
    sum(case when oc.category='Divine Service Offering  ' then o.amount else '0' end) as 'dso',
    sum(case when oc.category='Building Project' then o.amount else '0' end) as 'bpo',
    sum(case when oc.category='Sabbath School Lesson Cost Payment' then o.amount else '0' end) as 'sslcp',sum(case when oc.category='Wedding Offering' then o.amount else '0' end) as 'wo'
    FROM `offerings` o left outer join offerings_category oc on o.cat_id=oc.id where o.active = 1 
    $cond group by o.name,o.receipt_no";

    $result = mysqli_query($con,$query);
    $total_items = mysqli_num_rows($result);
                
    $limit = (isset($_GET["limit"])) ? $_GET["limit"] : 25;
    $page = (isset($_GET["page"]))? $_GET["page"] : 1;
        
    if((!$limit) || (is_numeric($limit) == false) || ($limit < 10) || ($limit > 50)) {  
        $limit = 15; //default     
    }
        
    if((!$page) || (is_numeric($page) == false) || ($page < 0) || ($page > $total_items)) {
        $page = 1; //default        
    }
        
    if( $limit == 'all' ) { 
        $total_category = ceil($total_items / $total_items);
    } 
    else {
        $total_category = ceil($total_items / $limit);
    }
        
    $set_limit = (($page*$limit)-$limit);
    $reload = $_SERVER['PHP_SELF'] . "?limit=" .$limit.$data;
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
                <div class="row collapse drkBdr col-md-12" id="pSearch">
                    <div class="col-xs-12 col-md-12 col-lg-12 no-padding">
                        <form class="form-horizontal" id="search_form" action="" class="form-horizontal" method="POST">
                            <div class="row mtb10">
                                <div class="col-md-3">
                                    From Date: <input type="date" class="form-control" id="fdate" name="fdate" autofocus>                   
                                </div>
                                <div class="col-md-3">
                                    To date : <input type="date" class="form-control" id="tdate" name="tdate">            
                                </div>
                                <div class="col-md-3">
                                    <br/>
                                    <input class="btn btn-primary" id="filter" type="submit" value="Search" />
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
                        <h3>Offerings Weekly Report</h3>
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
                        <table width="100%" cellpadding="0" class="noprint" cellspacing="0" border="0"> 
                            <?php 
                                $amt = 0;
                                $limit_data = "";
                                if( $limit !='all') { 
                                    $limit_data .= " LIMIT $set_limit, $limit";
                                }       
                                $fquery = "SELECT 
                                o.receipt_no,
                                o.name,o.id,o.mof,o.cheque_no,
                                sum(o.amount) as amount,
                                sum(case when oc.category='Tithes' then o.amount else '0' end) as t, 
                                sum(case when oc.category='Thanks Offerings' then o.amount else '0' end) as 'to', 
                                sum(case when oc.category='Birthday Offering' then o.amount else '0' end) as 'bdo',
                                sum(case when oc.category='Dorcas Offering' then o.amount else '0' end) as 'do',
                                sum(case when oc.category='Poor Fund Offering' then o.amount else '0' end) as 'pfo',
                                sum(case when oc.category='Church Expenses Offering' then o.amount else '0' end) as 'ceo',
                                sum(case when oc.category='Sabbath School Offering' then o.amount else '0' end) as 'sso',
                                sum(case when oc.category='Investment Offering  ' then o.amount else '0' end) as 'io',
                                sum(case when oc.category='Divine Service Offering  ' then o.amount else '0' end) as 'dso',
                                sum(case when oc.category='Building Project' then o.amount else '0' end) as 'bpo',
                                sum(case when oc.category='Sabbath School Lesson Cost Payment' then o.amount else '0' end) as 'sslcp',sum(case when oc.category='Wedding Offering' then o.amount else '0' end) as 'wo'
                                FROM `offerings` o left outer join offerings_category oc on  o.cat_id=oc.id where o.active = 1
                                $cond group by o.name,o.receipt_no order by o.id $limit_data";

                                $fresult = mysqli_query($con,$fquery);
                                if( $total_items>0 ) { ?>
                                <tr height="25" valign="middle">
                                    <td>Records : (<?php echo $total_items;?>)</td>
                                    <td colspan="4" align="right">
                                        <?php echo("Per Page:   
                                        
                                            <a href=$reload?limit=25&page=1>25</a> |
                                        
                                            <a href=$reload?limit=50&page=1>50</a> |
                                            
                                            <a href=$reload?limit=100&page=1>100</a> | 

                                            <a href=$reload?limit=all&page=1>All</a><br/>
                                                    
                                        "); 
                                        ?>
                                    </td>
                                </tr>
                        </table>
                        <table class="table table-striped table-bordered table-hover">
                            <tr>
                                <th class="uppercase">CR.No</th>
                                <th class="uppercase">Name</th>
                                <th class="uppercase">Amount</th>

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
                            <tr>
                                <?php 
                                    while( $rows = mysqli_fetch_assoc($fresult)) {
                                        $receipt  = $rows['receipt_no'];
                                        $mode     = $rows['mof'];
                                        $cheque   = $rows['cheque_no'];
                                        $id       = $rows['id'];
                                        $name     = $rows['name'];
                                        $amount   = $rows['amount'];
                                        $t        = $rows['t'];
                                        $to       = $rows['to'];
                                        $bdo      = $rows['bdo'];
                                        $do       = $rows['do'];

                                        $pfo      = $rows['pfo'];
                                        $ceo      = $rows['ceo'];                                                        
                                        $dso      = $rows['dso'];
                                        $sso      = $rows['sso'];

                                        $io       = $rows['io'];
                                        $bpo      = $rows['bpo'];
                                        $sslcp    = $rows['sslcp'];
                                        $wo       = $rows['wo'];
                                    ?>
                                    <tr>
                                    <td><?php echo $receipt; ?></td>
                                    <td><?php echo $name; ?></td>
                                    <td> <i class="fa fa-inr"> <?php echo $amount; ?><?php if( $mode == "cheque" ) { echo '<br/>( Cheque No :'.$cheque.' )'; } ?></i></td>

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

                                <?php  } ?>
                                <tr>
                                    <td colspan="2" class="success"> Total </td>
                                    <td class="success">
                                    <span class="fa fa-inr">
                                        <?php
                                            $tot_off_query = "SELECT sum(o.amount) amt from offerings o where o.active = 1 and o.cid = ".$_SESSION['cid']." AND o.active = 1 $cond $limit_data";
                                            $tot_off_result = mysqli_query($con,$tot_off_query);
                                            $tot_off_rows = mysqli_fetch_assoc($tot_off_result);
                                            echo $tot_off_rows['amt'];
                                        ?>                                            
                                        </span>
                                    </td>
                                   
                                    <?php for( $i=1; $i<=12; $i++ ) { ?>
                                    <td class="success">
                                    <span class="fa fa-inr">
                                        <?php
                                            $tot_off_t = "SELECT sum(o.amount) amt from offerings o where o.cat_id =". $i ." AND o.active = 1 and o.cid = ".$_SESSION['cid']." AND o.active = 1 $cond $limit_data";
                                            $tot_off_t_res = mysqli_query( $con, $tot_off_t );
                                            $tot_off_t_rows = mysqli_fetch_assoc($tot_off_t_res);
                                            echo ( $tot_off_t_rows['amt'] ) ? $tot_off_t_rows['amt'] : 0;
                                        ?>                                            
                                        </span>
                                    </td>
                                    <?php } ?>
                                </tr>
                        </table>
                        <?php } else{
                            echo '<span class="success center col-md-12" style="margin:20px 0 0 0;"> No Data found! </sapn>';
                        }
                        ?>
                        <?php 

                            if( $cond != '' ){
                                  $cond = "AND "."o.offer_date=".$fdate." AND o.offer_date=".$tdate;
                            }
                            if( $total_items>0 ) { 
                            $tquery = "SELECT sum(o.amount) amt, sum(o.cms_share) cshare, sum(o.chruch_share) sshare from offerings o where o.active = 1 and o.cid = ".$_SESSION['cid']." $cond $limit_data";
                            $tresult = mysqli_query($con,$tquery);
                            $rows = mysqli_fetch_assoc($tresult);
                        ?>    
                        <table class="table table-bordered table-striped table-hover">                
                            <tr>                                
                                <td class="success">Expense : <span class="fa fa-inr"> 
                                <?php 
                                    $exp_query = "SELECT sum(amount) expense from expenses e where e.cid = ".$_SESSION['cid']." $cond1 $limit_data";
                                    //echo $exp_query;
                                    $equery = mysqli_query($con,$exp_query); 
                                    $exp = 0;                                   
                                    if( $equery ){
                                        $exp_row = mysqli_fetch_assoc($equery);
                                        $expenses =  ( $exp_row['expense'] != null ) ? $exp_row['expense'] : 0;
                                        $exp = intVal( $expenses );
                                    }
                                    echo $exp;
                                ?></span></td>
                                <td class="success">
                                    Total Cash : <span class="fa fa-inr"> 
                                    <?php
                                        $cashQuery = "SELECT sum(o.amount) amt from offerings o where o.mof = 'cash' and  o.active = 1 and o.cid = ".$_SESSION['cid']." $cond $limit_data";
                                        $cequery = mysqli_query($con,$cashQuery);
                                        $cash_row = mysqli_fetch_assoc($cequery);
                                        $cashTot = ( $cash_row['amt'] ) ? $cash_row['amt'] : 0;
                                        echo  $cashTot;
                                    ?>
                                </span></td>
                                <td class="success">
                                    Total Cheque : <span class="fa fa-inr"> 
                                    <?php
                                        $cqQuery = "SELECT sum(o.amount) amt from offerings o where o.mof = 'cheque' and  o.active = 1 and o.cid = ".$_SESSION['cid']." $cond $limit_data";
                                        $cqquery = mysqli_query($con,$cqQuery);
                                        $cq_row = mysqli_fetch_assoc($cqquery);
                                        echo ( $cq_row['amt'] ) ? $cq_row['amt'] : 0 ;
                                    ?> 
                                </span></td>
                                <td class="success">
                                    Total Card : <span class="fa fa-inr"> 
                                    <?php
                                        $cdQuery = "SELECT sum(o.amount) amt from offerings o where o.mof = 'card' and  o.active = 1 and o.cid = ".$_SESSION['cid']." $cond $limit_data";
                                        $cdquery = mysqli_query($con,$cdQuery);
                                        $cd_row = mysqli_fetch_assoc($cdquery);
                                        echo ( $cd_row['amt'] ) ? $cd_row['amt'] : 0 ;
                                    ?>
                                </span></td>
                                <td colspan="5" class="success">To be deposited In Bank : <span class="fa fa-inr"> <?php echo ( intVal($cashTot) - intVal($exp) ); ?></span></td>
                            </tr>
                            </table>
                            <table class="table table-bordered table-striped table-hover">                           
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
                        <?php } ?>
                        </table>
        </div>
    </div>
</div>
<script src="js/offerings/print.js"></script>
<?php require_once('includes/footer.php'); ?>