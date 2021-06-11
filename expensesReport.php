<?php 
    require_once('includes/check-login.php');
    require_once('includes/header.php'); 
    require_once('includes/config.php');
    require_once("includes/pagination.php");

    $data = '';
    $cond = '';
    $total_items = 0;
    if(  isset( $_REQUEST['fdate'] ) ) {
        $fdate = $_REQUEST['fdate'];
        $data .= '&expense_date='.$fdate;
    }

    if( isset( $_REQUEST['tdate'] ) ){
        $tdate = $_REQUEST['tdate'];
        $data .= '&expense_date='.$tdate;
    }

    $fdate = isset( $fdate ) ? $fdate : "";
    $tdate = isset( $tdate ) ? $tdate : 0;    
    if( $fdate != "") {
        $cond .= " AND e.expense_date BETWEEN '$fdate'";
    }

    if( $tdate != 0) {
        $cond .= " AND '$tdate'";
    }
    $cid = $_SESSION['cid'];
    $query = "SELECT * FROM expenses e where e.cid = ".$cid." and e.active = 1". $cond;
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
    $reload = $_SERVER['PHP_SELF'] . "?limit=" . $limit;
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
                        <li>
                            <a href="expenses.php">New</a>
                        </li>  
                            <li><a href="javascript:void(0);" class="print_link" data-pid="1">Print</a></li>

                    </ul>            
                </div>
                <!-- Open Search Modal -->
                <div class="row collapse drkBdr col-md-12" id="pSearch">
                    <div class="col-xs-12 col-md-12 col-lg-12 no-padding">
                        <form class="form-horizontal" id="search_form" action=""  method="POST">
                            <div class="row mtb10">
                                <div class="col-md-3">
                                    <br/>
                                    <input type="text" class="form-control" id="qname" name="qname" placeholder="Name" value="" autofocus>                   
                                </div>
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
                      <!--<img src="<?php echo 'admin/'.$_SESSION['logo']; ?>" alt="<?php echo $_SESSION['cname']; ?>"/>-->
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
                        <br/>
                        <h3>Expenses</h3>
                        <table width="100%" cellpadding="0" class="noprint" cellspacing="0" border="0"> 
                            <?php 
                                $limit_data = "";
                                if( $limit !='all') { 
                                    $limit_data .= " LIMIT $set_limit, $limit";
                                }       
                                $fquery = "SELECT e.id,e.cat_id,e.expense_date,e.amount,ec.name as ec_name, u.name as uname FROM expenses e
                                join users u on e.created_by = u.id 
                                join expenses_category ec on e.cat_id = ec.id where e.cid = ".$cid." and e.active = 1 $cond $limit_data";
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
                                <th> Category</th>
                                <th> Amount </th>
                                <th> Expense Date </th>
                                <th> Created By </th>
                                <th class="noprint"> Action </th>
                            </tr>
                        <?php while( $row = mysqli_fetch_assoc($fresult)){ 
                            $id = $row['id'];
                            $category = $row['ec_name'];
                            $amount   = $row['amount'];
                            $date   = $row['expense_date'];
                            $name   = $row['uname'];
                        ?>
                                      
                            <tr>                                
                                <td>                
                                    <span><?php echo $category; ?> </span>
                                </td>
                                <td>
                                    <span><?php echo $amount;?> </span>
                                </td>
                                <td>
                                    <span><?php echo $date;?> </span>
                                </td>
                                <td>
                                    <span><?php echo $name;?> </span>
                                </td>
                                <td class="noprint">
                                    <span class="icons"><a href="javascript:void(0);" id="<?php echo $id;?>" data-id="<?php echo $id;?>" class="deleteExpense"><i class="fa fa-trash"></i></a></span>
                                </td>
                            </tr>
                       
                        <?php } ?>
                        <?php } ?>
                        </table>
                        <table width="95%" border="0" cellspacing="0" class="noprint" cellpadding="0"  border="0">
                            <tr>
                            <td height="25">
                                <?php
                                    
                                    // Results Per Page: Same as earlier one

                                    echo("<br/>Per Page:
                                    <a href=$reload?limit=25&page=1>25</a> |

                                    <a href=$reload?limit=50&page=1>50</a> |

                                    <a href=$reload?limit=100&page=1>100</a> | 

                                    <a href=$reload?limit=all&page=1>All</a><br/>

                                    ");

                                    //prev. page
                                ?>
                            </td>
                            <td align="right">
                                <?php echo paginate_one( $reload, $page, $total_category ); ?>      
                            </td>
                            </tr>
                        </table>
                    </div>

                    </article>
                </section>

                </div>
            </div>            
            
            </div>
        </div>
    </div>
</div>
<script src="js/expenses/script.js"></script>
<script src="js/offerings/print.js"></script>
<?php require_once('includes/footer.php'); ?>

