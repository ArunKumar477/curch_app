<?php 
    require_once('includes/check-login.php');
    require_once('includes/header.php'); 
    require_once('includes/config.php');
    require_once("includes/pagination.php");

    $data = '';
    $cond = '';
    $cond_exp = '';
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
        $cond .= " AND o.created_at BETWEEN $fdate";
    }

    if( $tdate != 0) {
        $cond .= " AND $tdate";
    }

    if( $fdate != "") {
        $cond_exp .= " AND e.expense_date BETWEEN $fdate";
    }

    if( $tdate != 0) {
        $cond_exp .= " AND $tdate";
    }

    $cid = $_SESSION['cid'];
    $query = "SELECT * FROM offerings o where o.cid = ".$cid." and o.active=1". $cond;
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
                <div class="col-lg-12">                   
                    <section id="content" style="border-bottom:none;">
                    <article id="cleft">
                    <div class="col-lg-12">
                        <div class="pull-right fcolor">Date:<?php echo date('d-m-Y'); ?></div>
                        <h3>Treasurer Report</h3>
                        <table width="100%" class="noprint" cellpadding="0" cellspacing="0" border="0"> 
                            <?php 
                                $amt = 0;
                                $limit_data = "";
                                if( $limit !='all') { 
                                    $limit_data .= " LIMIT $set_limit, $limit";
                                }       
                                $fquery = "SELECT sum(o.amount) amount,sum(o.cms_share) cms_share,sum(o.chruch_share) chruch_share from offerings o where o.cid = ".$cid." and o.active = 1 $cond $limit_data";
                                $fresult = mysqli_query($con,$fquery);
                                if( $total_items>0 ) { ?>
                                <tr height="25" valign="middle">
                                    <td>&nbsp;</td>
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
                                <th class="uppercase">Total Offerings</th>                               
                                <th class="uppercase">CMS</th>
                                <th class="uppercase">LCF</th>
                                <th class="uppercase">Expense</th>
                                <th class="uppercase">To be deposited in SBI</th>                               
                            </tr>
                            <tr>
                                <?php 
                                    $expenses = 0;
                                    $exp_query = "SELECT sum(amount) expense from expenses e where e.cid = ".$_SESSION['cid']." and  e.active = 1 $cond_exp";
                                    $equery = mysqli_query($con,$exp_query);
                                    $exp_row = mysqli_fetch_assoc($equery);
                                    $expenses = $exp_row['expense'];

                                    while( $rows = mysqli_fetch_assoc($fresult)) {
                                        $amount    = $rows['amount'];
                                        $cms_share = $rows['cms_share'];
                                        $chruch_share = $rows['chruch_share'];
                                        $exp       = $expenses;
                                    ?>
                                    <tr>
                                        <td><i class="fa fa-inr"> <?php echo $amount ?></i></td>
                                        <td> <i class="fa fa-inr"> <?php echo $cms_share ?></i></td>
                                        <td> <i class="fa fa-inr"> <?php echo $chruch_share ?></i></td>
                                        <td> <i class="fa fa-inr"> <?php echo $exp ?></i></td>   
                                        <td> <i class="fa fa-inr"> 
                                            <?php
                                                echo intVal($amount) - ( intVal($exp) + intVal($cms_share) + intVal($chruch_share ) );
                                            ?>                                            
                                        </i></td>    
                                    </tr> 
                                <?php } ?>                              
                        </table>       
                        <?php }else{
                            echo '<span class="success center col-md-12"> No Data found! </sapn>';
                        }   ?>          
        </div>
    </div>
</div>
<script src="js/offerings/print.js"></script>
<?php require_once('includes/footer.php'); ?>