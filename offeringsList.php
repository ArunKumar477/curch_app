<?php 
    require_once('includes/check-login.php');
    require_once('includes/header.php'); 
    require_once('includes/config.php');
    require_once("includes/pagination.php");
    
    $data = '';
    $cond = '';
    $total_items = 0;
    if(  isset( $_REQUEST['name'] ) ) {
        $data .= '&name='.$_REQUEST['name'];
    }

    if( isset( $_REQUEST['cat_id'] ) ){
        $data .= '&cat_id='.$_REQUEST['cat_id'];
    }

    $name = isset( $_REQUEST['name'] ) ? $_REQUEST['name'] : "";
    $cat_id = isset( $_REQUEST['cat_id'] ) ? $_REQUEST['cat_id'] : 0;    
    if( $name != "") {
        $cond .= " AND o.name LIKE '%".trim($name)."%'";
    }

    if( $cat_id != 0) {
        $cond .= " AND o.cat_id = ".$cat_id;
    }

    if(  isset( $_REQUEST['fdate'] ) ) {
        $fdate = strtotime($_REQUEST['fdate']);
        $data .= '&offer_date='.$fdate;
    }

    if( isset( $_REQUEST['tdate'] ) ){
        $tdate = strtotime($_REQUEST['tdate']);
        $data .= '&offer_date='.$tdate;
    }

    $fdate = isset( $fdate ) ? $fdate : "";
    $tdate = isset( $tdate ) ? $tdate : 0;    
    if( $fdate != "") {
        $cond .= " AND o.offer_date BETWEEN $fdate";
    }

    if( $tdate != 0) {
        $cond .= " AND $tdate";
    }

    $query = "SELECT * FROM offerings o where o.cid=". $_SESSION['cid']." and o.active=1". $cond;
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
                <div class="col-lg-12">
                    <br/>
                    <ul class="list-inline pull-right bbottom noprint">
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#pSearch">Search</a>
                        </li>
                        <li>
                            <a href="newOffering.php">New</a>
                        </li> 
                        <li><a href="javascript:void(0);" class="print_link" data-pid="1">Print</a></li>           
                    </ul>            
                </div>
                <!-- Open Search Modal -->
                <div class="row collapse noprint drkBdr col-md-12" id="pSearch">
                    <div class="col-xs-12 col-md-12 col-lg-12 no-padding">
                        <form class="form-horizontal" id="search_form" action="" class="form-horizontal" method="POST">
                            <div class="row mtb10">
                                <div class="col-md-3">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="" autofocus>                   
                                </div>
                                <div class="col-md-3">
                                     <select id="cat_id" type="text" class="form-control uppercase category" name="cat_id">
                                            <option value="">-- Category --</option>
                                            <?php
                                                $query = " select * from offerings_category where active = 1" ;
                                                $exe = mysqli_query( $con, $query );
                                                if( $exe )  {   
                                                    while ( $row = mysqli_fetch_assoc($exe) ){
                                                        echo '<option value="'.$row["id"].'">'.$row["category"].'</option>';
                                                    }
                                                }      
                                            ?>
                                    </select>               
                                </div>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" id="fdate" name="fdate" autofocus>                   
                                </div>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" id="tdate" name="tdate">            
                                </div>
                            </div>
                            <br/>
                                <div class="col-md-3">
                                    <input class="btn btn-primary" id="filter" type="submit" value="Search" />
                                </div>
                        </form>
                    </div>
                </div>
                <!-- End Search Modal -->
                <div class="col-lg-12">                   
                    <section id="content" style="border-bottom:none;">
                    <article id="cleft">
                    <div class="col-lg-12">
                        <h3>Offerings</h3>
                        <table width="100%" cellpadding="0" class="noprint" cellspacing="0" border="0"> 
                            <?php 
                                $amt = 0;
                                $limit_data = "";
                                if( $limit !='all') { 
                                    $limit_data .= " LIMIT $set_limit, $limit";
                                }       
                                $fquery = "SELECT o.id,o.offer_date,o.receipt_no,o.name,o.amount,o.mof,o.cms_share,o.chruch_share,o.mobile,oc.category,o.mtype from offerings o, offerings_category oc where o.active = 1 and oc.id=o.cat_id and o.cid=".$_SESSION['cid']." $cond $limit_data";                                
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
                                <th> CRNo</th>
                                <th> Date</th>
                                <th> Name</th>
                                <th> Mode </th>
                                <th> Amount </th>                                
                                <th> CMS </th>
                                <th> LCF </th>
                                <th> Category </th>
                                <th> Member Type </th>
                                <th> Actions </th>
                            </tr>
                        <?php while( $row = mysqli_fetch_assoc($fresult)){ 
                            $receipt  = $row['receipt_no'];
                            $id       = $row['id'];
                            $name     = $row['name'];
                            $amount   = $row['amount']; 
                            $mode     = $row['mof'];                            
                            $cmshare  = $row['cms_share'];
                            $crshare  = $row['chruch_share'];                            
                            $cat      = $row['category'];
                            $mtype    = $row['mtype'];
                            $date     = $row['offer_date'];
                        ?>
                                      
                            <tr>  
                                <td>                
                                    <span><?php echo $receipt; ?> </span>
                                </td>

                                <td>                
                                    <span><?php echo date("d-m-Y",strtotime($date)); ?> </span>
                                </td>

                                <td>                
                                    <span><?php echo $name; ?> </span>
                                </td>
                                                              
                                <td>
                                    <span class="uppercase"><?php echo $mode;?> </span>
                                </td>
                                <td>
                                    <span class="fa fa-inr"><?php echo $amount;?> </span>
                                </td>
                                <td>
                                    <span class="fa fa-inr"><?php echo intVal($cmshare);?> </span>
                                </td>
                                <td>
                                    <span class="fa fa-inr"><?php echo intVal($crshare);?> </span>
                                </td>
                                <td>
                                    <span class="uppercase"><?php echo $cat; ?> </span>
                                </td>
                                <td>
                                    <span><?php if( $mtype == '1') { echo 'SDA English Church,Vepery,CH-7'; } else{ echo 'Visitor'; } ?> </span>
                                </td>
                                <td>
                                    <span class="icons"><a href="editOffering.php?id=<?php echo $id;?>" id="<?php echo $id;?>"><i class="fa fa-edit"></i></a></span>
                                    <span class="icons"><a href="javascript:void(0);"  id="<?php echo $id;?>" data-id="<?php echo $id;?>" class="deleteOffering"><i class="fa fa-trash"></i></a></span>

                                    <span class="icons"><a href="offerReceiptPreview.php?id=<?php echo $receipt;?>" id="<?php echo $receipt;?>"><i class="fa fa-print"></i></a></span>
                                </td>
                            </tr>
                       
                        <?php } ?>
                        <?php } else{
                            echo '<span class="success center col-md-12"> No Data found! </sapn>';
                        }
                        ?>
                        <?php 
                            if( $total_items>0 ) { 
                            $tquery = "SELECT sum(o.amount) amt, sum(o.cms_share) cshare, sum(o.chruch_share) sshare from offerings o where o.active = 1 $cond $limit_data";                         
                            $tresult = mysqli_query($con,$tquery);
                            $rows = mysqli_fetch_assoc($tresult);
                        ?>                    
                            <tr>
                                <td align="right" colspan="4"><span class="fcolor">Total</span></td>
                                <td><span class="fa fa-inr"> <?php echo $rows['amt'];?></span></td>
                                <td><span class="fa fa-inr"> <?php echo intVal($rows['cshare']);?></span></td>
                                <td colspan="5"><span class="fa fa-inr"> <?php echo intVal($rows['sshare']);?></span></td>
                            </tr>
                        <?php } ?>
                        </table>
                        <table width="95%" border="0" cellspacing="0" cellpadding="0" class="noprint"  border="0">
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
<script src="js/common.js"></script>
<script src="js/offerings/script.js"></script>
<script src="js/offerings/print.js"></script>
<?php require_once('includes/footer.php'); ?>

