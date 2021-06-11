<?php 
    require_once('includes/check-login.php');
    require('includes/config.php');
    require_once('includes/header.php'); ?>

    <div id="wrapper">

        <?php require_once('includes/menu.php'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Offerings</h3>
                    </div>
                    <!-- /.col-lg-12 -->
                     <div class="col-lg-12">
                        <div class="message"></div>
                        <form class="form-horizontal" method="POST" id="newOfferingForm" enctype="multipart/form-data" >
                        <div class="col-md-6">                           
                            <div class="form-group">
                                <label for="mod_name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="" required autofocus>
                                    <div id="suggesstion-box"></div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="" required>
                                </div>
                            </div>  

                            <div class="form-group">
                                <label for="mtype" class="col-md-4 control-label">Member Type</label>
                                <div class="col-md-6">
                                    <select id="mtype" name="mtype" class="form-control">
                                        <option value="-1">-- Select --</option>
                                        <option value="1">SDA English Church,Vepery,CH-7</option>
                                        <option value="2">Visitor</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="gender" class="col-md-4 control-label">Gender</label>
                                <div class="col-md-6">
                                    <select id="gender" name="gender" class="form-control">
                                        <option value="-1">-- Select --</option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                </div>
                            </div>
                                         
                        </div>

                        <div class="col-md-6"> 

                            <div class="form-group">
                                <label for="age" class="col-md-4 control-label">Age</label>

                                <div class="col-md-6">
                                    <input id="age" type="text" class="form-control" name="age" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="mobile" class="col-md-4 control-label">Mobile</label>

                                <div class="col-md-6">
                                    <input id="mobile" type="text" class="form-control" name="mobile" value="" maxlength="10" minlength="10" required >
                                </div>
                            </div>  

                            <div class="form-group">
                                <label for="address" class="col-md-4 control-label">Address</label>
                                <div class="col-md-6">
                                    <textarea id="address" name="address" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="date" class="col-md-4 control-label">Date</label>

                                <div class="col-md-6">
                                    <input id="off_date" type="date" class="form-control" name="off_date" >
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 AddMoreAmtCl">
                            <fieldset>
                                <div class="col-lg-6">
                                    <div class="form-group">                                        
                                        <label for="amount" class="col-md-4 control-label">Amount</label>
                                        <div class="col-md-6 amt">
                                            <input id="amount_0" type="text" class="form-control amount" name="amount[]" value="" required>
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
                                                    while ( $row = mysqli_fetch_assoc($exe) ){
                                                        echo '<option value="'.$row["id"].'">'.$row["category"].'</option>';
                                                    }
                                                }      
                                            ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="mode" class="col-md-4 control-label">Mode</label>
                                        <div class="col-md-6">
                                            <select id="mode_0" name="mode[]" class="form-control mode">
                                                <option value="-1">-- Mode of Fund --</option>
                                                <option value="cash">Cash</option>
                                                <option value="card">Card</option>
                                                <option value="cheque">Cheque</option>
                                            </select>
                                        </div>
                                    </div>                                    

                                </div>

                                <div class="col-lg-6">                                    

                                    <div class="form-group">
                                        <label for="cms_share" class="col-md-4 control-label">CMS</label>

                                        <div class="col-md-6">
                                            <input id="cms_share_0" type="text" class="form-control" name="cms_share[]" value="" readonly>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <label for="church_share" class="col-md-4 control-label">LCF</label>

                                        <div class="col-md-6">
                                            <input id="church_share_0" type="text" class="form-control" name="church_share[]" value="" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        &nbsp;                                        
                                        <label for="cheque" class="col-md-4 control-label cheque_0">Cheque No</label>
                                        <div class="col-md-6 amt cheque_0">
                                            <input id="cheque_0" type="text" class="form-control cheque" name="cheque[]" value="" required>
                                        </div>
                                    </div>                                  

                                </div>
                                <a href="void:javascript(0);" class="addMoreBlk" id="addMoreBlk">Add More</a>
                            </fieldset>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="button" id="newOffering" class="btn btn-success">
                                    Save
                                </button>
                                <button type="reset" class="btn btn-danger">
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
</script>
<?php require_once('includes/footer.php'); ?>
