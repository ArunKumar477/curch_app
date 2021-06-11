<?php 
    require_once('includes/check-login.php');
    require_once('includes/header.php'); 
    require_once('includes/config.php');
    require_once("includes/pagination.php");

    $query = "SELECT * FROM customers";
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
                <div class="col-lg-12">
                    <br/>
                    <ul class="list-inline pull-right bbottom">
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#pSearch">Search</a>
                        </li>
                        <li>
                            <a href="newCustomer.php">New</a>
                        </li>            
                    </ul>            
                </div>
                <!-- Open Search Modal -->
                <div class="row collapse drkBdr col-md-12" id="pSearch">
                    <div class="col-xs-12 col-md-12 col-lg-12 no-padding">
                        <form class="form-horizontal" id="search_form" class="form-horizontal">
                            <div class="row mtb10">
                                <div class="col-md-3">
                                    <input type="text" class="form-control" id="qname" name="qname" placeholder="Name" value="" required autofocus>                   
                                </div>
                                <div class="col-md-3">
                                    <input class="btn btn-primary" id="filter" type="button" value="Search" />
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
                        <h3>Customers</h3>
                        <table width="100%" cellpadding="0" cellspacing="0" border="0"> 
                            <?php 
                                $limit_data = "";
                                if( $limit !='all') { 
                                    $limit_data .= " LIMIT $set_limit, $limit";
                                }       
                                $fquery = "SELECT c.*,s.name as sname FROM customers c join subscription s on c.subscription = s.id $limit_data";
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
                                <th> Customer </th>                                
                                <th> Contact </th> 
                                <th> Alternate Contact </th>                               
                                <th> Contact Email </th>
                                <th> Subscription </th>
                                <th> Expiry </th>
                                <th> Active </th>
                                <th> Action </th>
                            </tr>
                        <?php while( $row = mysqli_fetch_assoc($fresult)){ 
                            $id = $row['id'];
                            $name = $row['name'];
                            $email   = $row['email'];
                            $contact   = $row['phone'];
                            $expires   =  date( 'd-m-Y H:i:A' ,$row['expires_at']);
                            $acontact   = $row['alternate_no'];
                            $sname   = $row['sname'];
                            $active   = $row['active'];
                        ?>
                                      
                            <tr>                                
                                <td>                
                                    <span class="uppercase"><?php echo $name; ?> </span>
                                </td>
                                <td>
                                    <span><?php echo $contact;?> </span>
                                </td>
                                <td>
                                    <span><?php echo $acontact;?> </span>
                                </td>
                                 <td>
                                    <span><?php echo $email;?> </span>
                                </td>
                                <td>
                                    <span><?php echo $sname;?> </span>
                                </td>
                                <td>
                                    <span><?php echo $expires;?> </span>
                                </td>
                                <td>
                                    <span><?php 
                                        if( $active == 1){
                                            echo "Active";
                                        }else{
                                            echo "Inactive";
                                        }
                                    ?> </span>
                                </td>
                                <td>
                                    <span class="icons"><a href="javascript:void(0);" id="<?php echo $id;?>" data-id="<?php echo $id;?>" class="deleteOffCat"><i class="fa fa-trash"></i></a></span>
                                </td>
                            </tr>
                       
                        <?php } ?>
                        <?php } ?>
                        </table>
                        <table width="95%" border="0" cellspacing="0" cellpadding="0"  border="0">
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
<script src="js/offeringCat/script.js"></script>
<?php require_once('includes/footer.php'); ?>

