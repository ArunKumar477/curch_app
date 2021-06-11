<?php require_once('includes/check-login.php'); ?>
<?php require_once('includes/header.php'); ?>

    <div id="wrapper">

        <?php require_once('includes/menu.php'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>New Customer</h3>
                    </div>

                    <!-- /.col-lg-12 -->
                     <div class="col-lg-12">
                        <div class="message"></div>
                        <form class="form-horizontal" method="POST" id="customerForm" enctype="multipart/form-data" >
                        <div class="col-md-6">                           
                            <div class="form-group">
                                <label for="amount" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="" required autofocus>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="address" class="col-md-4 control-label">Address</label>
                                <div class="col-md-6">
                                     <textarea id="address" name="address" class="form-control"></textarea>
                                </div>
                            </div>  

                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Email</label>
                                <div class="col-md-6">
                                    <input type="text" id="email" name="email" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="logo" class="col-md-4 control-label">Logo</label>
                                <div class="col-md-6">
                                    <input type="file" id="logo" name="logo" class="form-control" accept="image/*" />
                                </div>
                            </div>
                                         
                        </div>

                        <div class="col-md-6">                           
                            <div class="form-group">
                                <label for="phone" class="col-md-4 control-label">Phone</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control" name="phone" value="" required>
                                </div>
                            </div> 

                            <div class="form-group">
                                <label for="alternatae_no" class="col-md-4 control-label">Alternate No</label>
                                <div class="col-md-6">
                                    <input type="text" id="alternatae_no" name="alternatae_no" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="active" class="col-md-4 control-label">Active</label>
                                <div class="col-md-6">
                                    <select id="active" name="active" class="form-control">
                                        <option value="-1">-- Select --</option>
                                        <option value="1" selected="selected">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="subscription" class="col-md-4 control-label">Subscription</label>
                                <div class="col-md-6">
                                    <select id="subscription" name="subscription" class="form-control">
                                        <option value="-1">--- Select ---</option>                                      
                                    </select>
                                </div>
                            </div>                 
                                         
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="button" id="newCustomer" class="btn btn-primary">
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
<script src="js/customers/script.js"></script>
<?php require_once('includes/footer.php'); ?>
