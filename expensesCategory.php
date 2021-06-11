<?php 
    require_once('includes/check-login.php');
    require_once('includes/header.php'); 
    require_once('includes/config.php');
    require_once("includes/pagination.php");

    $query = "SELECT * FROM expenses_category where cid=".$_SESSION['cid'];
    $result = mysqli_query($con,$query);
    $total_items = mysqli_num_rows($result);
                
    $limit = (isset($_GET["limit"])) ? $_GET["limit"] : 25;
    $page = (isset($_GET["page"]))? $_GET["page"] : 1;
        
    if((!$limit) || (is_numeric($limit) == false) || ($limit < 10) || ($limit > 50)) {  
        $limit = 100; //default     
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

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Expenses Category</h3>
                    </div>
                    <!-- /.col-lg-12 -->
                     <div class="col-lg-12">
                        <div class="message"></div>
                        <form class="form-horizontal" id="newCategoryForm" enctype="multipart/form-data" >
                        <div class="col-md-5">                           
                            <div class="form-group">
                                <label for="mod_name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="" required autofocus>
                                </div>
                            </div>  
                                         
                        </div>

                        <div class="col-md-5"> 

                            <div class="form-group">
                                <label for="active" class="col-md-4 control-label">Active</label>
                                <div class="col-md-6">
                                    <select id="active" name="active" class="form-control">
                                        <option value="-1">-- Select --</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-2">

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="button" id="newCategory" class="btn btn-success">
                                        save 
                                    </button>
                                </div>                        
                            </div>

                        </div>
                    </form>
                    </div>
                    <!-- /.col-lg-12 -->
                    <section id="content" style="border-bottom:none;">
                      <article id="cleft">
                    <div class="col-lg-12">

                        <table width="100%" cellpadding="0" cellspacing="0" border="0"> 
                            <?php 
                                $limit_data = "";
                                if( $limit !='all') { 
                                    $limit_data .= " LIMIT $set_limit, $limit";
                                }       
                                $fquery = "SELECT * FROM expenses_category where cid = ". $_SESSION['cid']." ORDER BY id DESC $limit_data";
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
                                <th> Active </th>
                                <th> Action </th>
                            </tr>
                        <?php while( $row = mysqli_fetch_assoc($fresult)){ 
                            $id = $row['id'];
                            $category = $row['name'];
                            $active   = $row['active'];
                        ?>
                                      
                            <tr>                                
                                <td>                
                                    <span><?php echo $row['name']; ?> </span>
                                </td>
                                <td>
                                    <span><?php if ( $row['active'] ) { echo 'Yes'; 
                                    }else{ echo 'No'; }?> </span>
                                </td>
                                <td>
                                    <span class="icons"><a href="javascript:void(0);" id="<?php echo $id;?>" data-id="<?php echo $id;?>" class="deleteExpCat"><i class="fa fa-trash"></i></a></span>
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
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<script src="js/expensesCategory/script.js"></script>
<?php require_once('includes/footer.php'); ?>
