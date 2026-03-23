<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

// if($_SESSION['userid']==2){
    
// }else{
//     echo '<script>alert("This page under maintenance. Please come back after some times.");window.location.assign("index");</script>';
//     exit();
// }

if(isset($_POST['update_bank'])){
    $bank_name=VerifyData($_POST['bank_name']);
    $ac_no=VerifyData($_POST['ac_no']);
    $ifsc_code=VerifyData($_POST['ifsc_code']);
    $branch_name=VerifyData($_POST['branch_name']);
    
    if(!$bank_name=="" and !$ac_no=="" and !$ifsc_code=="" and !$branch_name==""){
         $update=mysqli_query($con,"update user set bank_name='$bank_name', ac_no='$ac_no', ifsc_code='$ifsc_code', branch_name='$branch_name' where id='$_SESSION[userid]'");
         if($update){
             echo '<script>alert("Bank Details Updated Successfully Done.");window.location.assign("bank_details");</script>';
         }else{
             echo '<script>alert("Server Error 101.");window.location.assign("bank_details");</script>';
         }
    }else{
        echo '<script>alert("Please fill all the fields");window.location.assign("bank_details")</script>';
    }
    
}     

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bank Details | <?php echo $brand_name; ?></title>
    <!-- Favicons -->
    <link href="<?php echo $brand_logo; ?>" rel="icon">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    
    <style type="text/css">
          .bank_drop{
    	background: #157daf !important;
    }
    
    .bank_details_user{
    	background: #157daf !important;
    }
    
      </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader and Navbar -->
        <?php include 'top_navbar.php'; ?>

        <!-- /.navbar -->

        <!-- Main left Sidebar Container start-->

        <?php include 'left_side_navbar.php'; ?>

        <!-- Main left Sidebar Container end-->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Bank Details</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>


            <!--Main Content section start-->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Bank Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" name="form_2">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <lable>Name:</lable>
                                                <input type="text" readonly name="student_name"
                                                    value="<?php echo $login_details['name'] ;?>" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <lable>Mobile No.</lable>
                                                <input type="text" readonly name="mobile"
                                                    value="<?php echo $login_details['mobile'] ;?>" class="form-control">
                                            </div>
                                           <div class="col-md-6">
                                                <lable>Father Name:</lable>
                                                <input type="text" readonly name="father_name"
                                                    value="<?php echo $login_details['father_name'] ;?>" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <lable>Bank Name:</lable>
                                                <input type="text" name="bank_name" id="bank_name" required 
                                                    value="<?php echo $login_details['bank_name'] ;?>" class="form-control" placeholder="Enter Bank name.">
                                            </div>
                                            <div class="col-md-6">
                                                <lable>Bank A/C No.</lable>
                                                <input type="number"  name="ac_no" id="ac_no" required 
                                                    value="<?php echo $login_details['ac_no'] ;?>" class="form-control" placeholder="Enter Bank account number.">
                                            </div>
                                            <div class="col-md-6">
                                                <lable>IFSC Code.</lable>
                                                <input type="text" name="ifsc_code" id="ifsc_code" required
                                                    value="<?php echo $login_details['ifsc_code'] ;?>" class="form-control" placeholder="Enter Bank IFSC code.">
                                            </div>
                                            <div class="col-md-6">
                                                <lable>Branch Name.</lable>
                                                <input type="text" name="branch_name" id="branch_name" required
                                                    value="<?php echo $login_details['branch_name'] ;?>" class="form-control" placeholder="Enter branch name.">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" name="update_bank" id="update_bank"
                                             class="btn btn-primary">Update</button>
                                       
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </section>
            <!--Main content section end-->

            
        </div>
        <!-- /.content-wrapper -->
        <!--Footar start-->
        <?php include'footar.php'; ?>
        <!--Footar end-->
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
</body>

</html>