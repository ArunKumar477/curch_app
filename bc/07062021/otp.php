<?php 
    require_once('includes/check-login.php');
    require_once('includes/header.php'); 
    
    $mobile = isset( $_SESSION['phone'] ) ? $_SESSION['phone'] : '';
?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <center>
                        <h3 class="panel-title">OTP Verification</h3>
                        </center>
                    </div>
                    <div class="panel-body">
                        <div class="message error">
                        </div>
                        <form role="form" id="otpForm" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Phone" name="phone" type="text" value="<?php echo $mobile;?>" <?php if( $mobile != '' ) { ?> readonly <?php } ?> />
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="OTP" name="otp" type="otp" value="" autofocus="">
                                </div>
                                <input type="button" id="otp" class="btn btn-success btn-block" value="Verify" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="js/common.js"></script>    
<script src="js/otp/script.js"></script>
<?php require_once('includes/footer.php'); ?>