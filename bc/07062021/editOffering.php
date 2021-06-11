<?php 
    require_once('includes/check-login.php');
    require('includes/config.php');
    require_once('includes/header.php'); 
    $id = $_GET['id'];
?>

    <div id="wrapper">

        <?php 
            require_once('includes/menu.php'); 
            $query = "select * from offerings where id=".$id;
            $exe = mysqli_query( $con, $query );
            $row =  mysqli_fetch_assoc($exe);
        ?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h3><?php echo $row['name'] ?> Offerings</h3>
                    </div>
                    <!-- /.col-lg-12 -->
                     <div class="col-lg-12">
                        <div class="message"></div>
                        <form class="form-horizontal" method="POST" id="editOfferingForm" enctype="multipart/form-data" >
                        <input id="oId" type="hidden" class="form-control" name="oId" value="<?php echo $row['id'];?>" >
                        <input id="receipt_no" type="hidden" class="form-control" name="receipt_no" value="<?php echo $row['receipt_no'];?>" >
                        <div class="col-md-6">                           
                            <div class="form-group">
                                <label for="mod_name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="<?php echo $row['name'];?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="<?php echo $row['email'];?>" required>
                                </div>
                            </div>  

                            <div class="form-group">
                                <label for="mtype" class="col-md-4 control-label">Member Type</label>
                                <div class="col-md-6">
                                    <select id="mtype" name="mtype" class="form-control">
                                        <option value="-1">-- Select --</option>
                                        <?php if( $row['mtype'] == 1 ){ ?>
                                            <option value="1" selected="selected">Seventh Day Adventist Church</option>
                                            <option value="2">Visitor</option>
                                        <?php } else { ?>
                                            <option value="1">Seventh Day Adventist Church</option>
                                            <option value="2" selected="selected">Visitor</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="gender" class="col-md-4 control-label">Gender</label>
                                <div class="col-md-6">
                                    <select id="gender" name="gender" class="form-control">
                                        <option value="-1">-- Select --</option>
                                        <?php if( $row['gender'] == 'M' ){ ?>
                                            <option value="M" selected="selected">Male</option>
                                            <option value="F">Female</option>
                                        <?php } else { ?>
                                            <option value="M">Male</option>
                                            <option value="F" selected="selected">Female</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                                         
                        </div>

                        <div class="col-md-6"> 

                            <div class="form-group">
                                <label for="age" class="col-md-4 control-label">Age</label>

                                <div class="col-md-6">
                                    <input id="age" type="text" class="form-control" name="age" value="<?php echo $row['age'];?>" >
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="mobile" class="col-md-4 control-label">Mobile</label>

                                <div class="col-md-6">
                                    <input id="mobile" type="text" class="form-control" name="mobile" value="<?php echo $row['mobile'];?>" maxlength="10" minlength="10" required >
                                </div>
                            </div>  

                            <div class="form-group">
                                <label for="address" class="col-md-4 control-label">Address</label>
                                <div class="col-md-6">
                                    <textarea id="address" name="address" class="form-control"><?php echo $row['address'];?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 AddMoreAmtCl">
                            <fieldset>
                                <div class="col-lg-6">
                                      <div class="form-group">                                        
                                        <label for="amount" class="col-md-4 control-label">Amount</label>
                                        <div class="col-md-6 amt">
                                            <input id="amount_0" type="text" class="form-control amount" name="amount[]" value="<?php echo $row['amount'];?>" required>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="mode_0" class="col-md-4 control-label">Mode</label>
                                        <div class="col-md-6">
                                            <select id="mode_0" name="mode[]" class="form-control">
                                                <option value="-1">-- Select --</option>
                                                <?php if( $row['mof'] == 'cheque' ){ ?>
                                                    <option value="cash">Cash</option>
                                                    <option value="card">Card</option>
                                                    <option value="cheque" selected="selected">Cheque</option>
                                                <?php } else if( $row['mof'] == 'cash') { ?>
                                                    <option value="cash" selected="selected">Cash</option>
                                                    <option value="card">Card</option>
                                                    <option value="cheque">Cheque</option>
                                                <?php } else{ ?>
                                                    <option value="cash">Cash</option>
                                                    <option value="card" selected="selected">Card</option>
                                                    <option value="cheque">Cheque</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                       <label for="category" class="col-md-4 control-label">Category</label>
                                        <div class="col-md-6">
                                            <select id="category_0" type="text" class="form-control uppercase category" name="category[]">
                                            <option value = "-1">-- Select --</option>
                                            <?php
                                                $query = " select * from offerings_category where active = 1" ;
                                                $exe = mysqli_query( $con, $query );
                                                if( $exe )  {   
                                                    while ( $rows = mysqli_fetch_assoc($exe) ){
                                                        if( $row['cat_id'] == $rows['id']){
                                                            echo '<option value="'.$rows["id"].'" selected="selected">'.$rows["category"].'</option>';
                                                        }else{
                                                            echo '<option value="'.$rows["id"].'">'.$rows["category"].'</option>';
                                                        }
                                                    }
                                                }      
                                            ?>
                                            </select>
                                        </div>
                                    </div>                                                                  
                                </div>

                                <div class="col-lg-6">                                    
                                    <div class="form-group">
                                        <label for="cms_share" class="col-md-4 control-label">CMS Share</label>

                                        <div class="col-md-6">
                                            <input id="cms_share_0" type="text" class="form-control" name="cms_share[]" value="<?php echo $row['cms_share'];?>" readonly>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <label for="church_share" class="col-md-4 control-label">Church Share</label>

                                        <div class="col-md-6">
                                            <input id="church_share_0" type="text" class="form-control" name="church_share[]" value="<?php echo $row['chruch_share'];?>" readonly>
                                        </div>
                                    </div>
                                  
                                    <div class="form-group cheque_0 show">                                        
                                        <?php if( $row['mof'] == 'cheque' ){ ?>
                                            <label for="cheque_0" class="col-md-4 control-label">Cheque No</label>
                                            <div class="col-md-6 amt">
                                                <input id="cheque_0" type="text" class="form-control cheque" name="cheque[]" value="<?php echo $row['cheque_no']; ?>"/>
                                            </div>
                                        <?php } else{
                                            ?>
                                            <input id="cheque_0" type="hidden" class="form-control cheque" name="cheque[]" value=""/>
                                        <?php
                                        } ?>
                                    </div>                                

                                </div>
                                <a href="void:javascript(0);" class="addMoreBlk" id="addMoreBlk">Add More</a>
                            </fieldset>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="button" id="editOffering" class="btn btn-primary">
                                    Save
                                </button>
                                <button type="reset" class="btn btn-primary">
                                    Reset
                                </button>
                            </div>                        
                        </div>
                    </form>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<script src="js/common.js"></script>
<script src="js/offerings/script.js"></script>
<?php require_once('includes/footer.php'); ?>
