<?php require_once('includes/check-login.php'); ?>
<?php require_once('includes/header.php'); ?>

    <div id="wrapper">

        <?php require_once('includes/menu.php'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Members</h3>
                    </div>
                    <!-- /.col-lg-12 -->
                     <div class="col-lg-12">
                        <div class="message"></div>
                        <form class="form-horizontal" method="POST" id="newMemberForm" enctype="multipart/form-data" >
                        <div class="col-md-6">                           
                            <div class="form-group">
                                <label for="mod_name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="" required autofocus>
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
                                        <option value="1" selected="selected">SDA English Church,Vepery,CH-7</option>
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

                            <div class="form-group">
                                <label for="address" class="col-md-4 control-label">Address</label>
                                <div class="col-md-6">
                                    <textarea id="address" name="address" class="form-control"></textarea>
                                </div>
                            </div>    

                            <div class="form-group">
                                <label for="doa" class="col-md-4 control-label">Anniversary</label>

                                <div class="col-md-6">
                                    <input id="doa" type="date" class="form-control" name="doa" >
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
                                <label for="mobile" class="col-md-4 control-label">Mobile</label>

                                <div class="col-md-6">
                                    <input id="mobile" type="text" class="form-control" name="mobile" value="" maxlength="10" minlength="10" required >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="dob" class="col-md-4 control-label">DOB</label>

                                <div class="col-md-6">
                                    <input id="dob" type="date" class="form-control" name="dob" >
                                </div>
                            </div> 


                            <input type="hidden" name="is_child_sch" id="is_child_sch" value="0">

                            <div class="form-group">
                                <label for="is_child_sch" class="col-md-4 control-label">Children in SDA School?</label>

                                <div class="col-md-6">
                                    <select id="is_child_sch" name="is_child_sch" class="form-control">
                                        <option value="-1">-- Select --</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group no_of_child_sch">
                                <label for="no_of_child_sch" class="col-md-4 control-label">No of Children in CMC</label>

                                <div class="col-md-6">
                                    <input id="no_of_child_sch" type="text" class="form-control" name="no_of_child_sch" >
                                </div>
                            </div>                           


                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="button" id="newMember" class="btn btn-success">
                                    Add
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
<script src="js/members/script.js"></script>
<?php require_once('includes/footer.php'); ?>
