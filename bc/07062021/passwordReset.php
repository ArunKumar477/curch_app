<?php require_once('includes/check-login.php'); ?>
<?php require_once('includes/header.php'); ?>

    <div id="wrapper">

        <?php require_once('includes/menu.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <br/>
                    <div class="panel panel-default">                        
                        <div class="panel-heading">
                           Change Password
                        </div>
                        <div class="panel-body">
                            <div class="col-lg-12">
                                <div class="message"></div>
                                <form class="form-horizontal" method="POST" id="pwdChangeForm" enctype="multipart/form-data" >
                                <div class="col-md-5">                           
                                    <div class="form-group">
                                        <label for="old_password" class="col-md-4 control-label">Old Password</label>

                                        <div class="col-md-6">
                                            <input id="old_password" type="password" class="form-control" name="old_password" value="" required autofocus>
                                        </div>
                                    </div>  

                                    <div class="form-group">
                                        <label for="new_password" class="col-md-4 control-label">New Password</label>

                                        <div class="col-md-6">
                                            <input id="new_password" type="password" class="form-control" name="new_password" value="" required>
                                        </div>
                                    </div>  
                                                 
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="button" id="changePwd" class="btn btn-primary">
                                            update 
                                        </button>
                                    </div>                        
                                </div>
                        </form>
                    </div>
                            
                        </div>
                    </div>
                </div>
            </div>            
            
            
        </div>

    </div>
<script src="js/password/script.js"></script>
<?php require_once('includes/footer.php'); ?>

