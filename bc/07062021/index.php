<?php require_once('includes/header.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <center><h3 class="panel-title">Log In</h3></center>

                    </div>
                    <div class="panel-body">
                        <div class="message">
                        </div>
                        <form role="form" id="loginForm">
                            <fieldset>
                                <div class="form-group">
                                    <select name="org_id" id="org_id" class="form-control" autofocus>
                                        <option value="-1">--- Select ----</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input class="form-control" placeholder="Phone" name="phone" type="text" maxlength="10" minlength="10">
                                </div>
                               
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <input type="button" id="login" class="btn btn-success btn-block" value="Login" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="js/common.js"></script>    
<script src="js/login/script.js"></script>
<?php require_once('includes/footer.php'); ?>