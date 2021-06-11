<?php require_once('includes/check-login.php'); ?>
<?php require_once('includes/header.php'); ?>

    <div id="wrapper">

        <?php require_once('includes/menu.php'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Expenses</h3>
                    </div>

                    <!-- /.col-lg-12 -->
                     <div class="col-lg-12">
                        <div class="message"></div>
                        <form class="form-horizontal" method="POST" id="newExpenseForm" enctype="multipart/form-data" >
                        <div class="col-md-10">                           
                            <div class="form-group">
                                <label for="amount" class="col-md-4 control-label">Amount</label>

                                <div class="col-md-6">
                                    <input id="amount" type="text" class="form-control" name="amount" value="" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="cat_id" class="col-md-4 control-label">Category</label>
                                <div class="col-md-6">
                                    <select id="cat_id" class="form-control" name="cat_id" required>
                                        <option value="">-- Select --</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="created_by" class="col-md-4 control-label">Created By</label>
                                <div class="col-md-6">
                                    <select id="created_by" name="created_by" class="form-control">
                                        <option value="-1">-- Select --</option>
                                    </select>
                                </div>
                            </div>  

                            <div class="form-group">
                                <label for="expense_date" class="col-md-4 control-label">Expense On</label>
                                <div class="col-md-6">
                                    <input type="date" id="expense_date" name="expense_date" class="form-control" />
                                </div>
                            </div>                       
                                         
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="button" id="newExpense" class="btn btn-success">
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
<script src="js/expenses/script.js"></script>
<?php require_once('includes/footer.php'); ?>
