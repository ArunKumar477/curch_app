<?php require_once('includes/check-login.php'); ?>
<?php require_once('includes/header.php'); ?>

    <div id="wrapper">

        <?php require_once('includes/menu.php'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-includes/header">Offerings</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                     <div class="col-lg-12">
                        <form class="form-horizontal" method="POST" id="newOfferingForm" enctype="multipart/form-data" >
                        <div class="col-md-6">                           
                            <div class="form-group">
                                <label for="mod_name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="" required autofocus>
                                </div>
                            </div>  

                            <div class="form-group">
                                <label for="mod_id" class="col-md-4 control-label">Modality</label>
                                <div class="col-md-6">
                                    <select id="mod_id" class="form-control" name="mod_id" required>
                                        <option value="">-- Select --</option>
                                    </select>
                                </div>
                            </div>
                                         
                        </div>

                        <div class="col-md-6"> 

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

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="button" id="newOffering" class="btn btn-primary">
                                    Give
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
<script src="js/offerings/script.js"></script>
<?php require_once('includes/footer.php'); ?>
