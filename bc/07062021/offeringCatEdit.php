<?php
require_once('includes/check-login.php'); 
require_once('includes/header.php'); ?>

    <div id="wrapper">

        <?php 
            require_once('includes/menu.php'); 
            require_once('includes/config.php'); 
            $id = $_GET['id'];
            $query = "select * from offerings_category where id=".$id;
            $exe = mysqli_query( $con, $query );
            $row =  mysqli_fetch_assoc($exe);

        ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Offering Category</h3>
                    </div>

                    <!-- /.col-lg-12 -->
                     <div class="col-lg-12">
                        <div class="message"></div>
                        <form class="form-horizontal" method="POST" id="offeringCatForm" enctype="multipart/form-data" >
                        <div class="col-md-10">                           
                            <div class="form-group">
                                <label for="amount" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="<?php echo $row['category'];?>">
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="created_by" class="col-md-4 control-label">CMS</label>
                                <div class="col-md-6">
                                     <input type="text" id="cms_share" name="cms_share" value="<?php echo $row['cms_share'];?>" class="form-control" />
                                </div>
                            </div>  

                            <div class="form-group">
                                <label for="expense_date" class="col-md-4 control-label">LCF</label>
                                <div class="col-md-6">
                                    <input type="text" id="church_share" name="church_share" value="<?php echo $row['church_share'];?>" class="form-control" />
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
                                         
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="button"  onclick="newOfferingCatEdit(<?php echo $id; ?>)" class="btn btn-success">
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
    <script>
function newOfferingCatEdit(id){
var formData  = $('#offeringCatForm').serialize();
    var message   = '';
    var flag     = 1 ;
    var serverUrl = "http://localhost/curch_app/";

     if ( flag == 1 ){
        $.ajax({
            url  : serverUrl+'offeringCatUpdate.php?id='+id,
            data : formData,
            method : 'GET',
            success: function( response ) {
                console.log(response);
                var objData = JSON.parse( response );
                if ( objData.code == 200  ){
                    message = objData.data;
                    var url = objData.url;
                    window.location.replace( url+'.php');
                }else if ( objData.code == 401 ){
                    message = objData.data;
                    $('.message').addClass('error').html(message);
                } else if ( objData.code == 405 ){
                    message = objData.data;
                    $('.message').addClass('error').html(message);
                }               
            },
            error: function () {
                $('.message').addClass('error').html('Request Failed. Cannot connect to server');
            } 
        });
    }
}
    </script>
<script src="js/common.js"></script> 
<script src="js/offeringCat/script.js"></script>
<?php require_once('includes/footer.php'); ?>
