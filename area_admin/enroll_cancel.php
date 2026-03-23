<?php 
include 'session.php'; 

$type = mysqli_fetch_array(mysqli_query($con, "select type from user where id='$_SESSION[userid]'"))['type'];
if(sub_menu_check("B","E",$_SESSION['userid'], $type)==1){
    
}else{
    echo '<script>alert("You are not permitted to access this option.");window.location.assign("index");</script>'; 
}

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(isset($_GET['batch_id'])){
    $get_batch_id=$_GET['batch_id'];
}else{
    $get_batch_id="";
}
if(isset($_GET['course_id'])){
    $get_course_id=$_GET['course_id'];
}else{
    $get_course_id="";
}

$c_session = mysqli_fetch_array(mysqli_query($con, "select session_id from login_session where userid='$login_details[id]'"))['session_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cancel Enrollments |
        <?php echo $brand_name; ?>
    </title>
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
    <script src="https://tvssolution.com/panel/staff/admin_area/js/jquery-3.3.1.min.js" type="text/jscript"></script>
    
     <style type="text/css">
          .drop_enroll{
    	background: #157daf !important;
    }
    
    .enroll_cancel{
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
                            <h1>Cancel Enrollments </h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>


           

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                         <div class="col-md-6">
                            <label>Search By course</label>
                            <select class="form-control" id="course_search" name="course_search" onchange="by_course(this.value)">
                                <option value="">Select</option>
                                <?php 
                                $sql_course=mysqli_query($con,"select * from course_details");
                                while($row=mysqli_fetch_array($sql_course)){
                                    ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php 
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Search By Batch</label>
                            <select class="form-control" id="batch_search" name="batch_search" onchange="by_batch(this.value)">
                                <option value="">Select</option>
                                <?php 
                                $sql_course=mysqli_query($con,"select * from batch_details");
                                while($row=mysqli_fetch_array($sql_course)){
                                    ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['batch_name']; ?></option>
                                    <?php 
                                }
                                ?>
                            </select>
                        </div>
                        <script>
                            <?php 
                            if($get_batch_id>0){
                                ?>
                                $("#course_search").val("");
                                $("#batch_search").val('<?php echo $get_batch_id ; ?>');
                                <?php
                            }
                            ?>
                            <?php 
                            if($get_course_id>0){
                                
                                ?>
                                
                                $("#course_search").val(<?php echo $get_course_id ; ?>);
                                $("#batch_search").val("");
                                
                                <?php
                            }
                            ?>
                            
                            function by_course(val){
                                var url="enroll_cancel?course_id="+val;
                                window.location.assign(url);
                            }
                            
                            function by_batch(val){
                                var url="enroll_cancel?batch_id="+val;
                                window.location.assign(url);
                            }
                         
                        </script>
                        <div class="col-12">
                            <br>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Cancel Enrollment </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Date</th>
                                                <th>Reg No.</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Course Name</th>
                                               
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                            if($get_batch_id>0 or $get_course_id>0){
                                            if($get_batch_id>0){
                                               $sql_d=mysqli_query($con,"select * from course_book where status='CANCEL' and batch_id='$_GET[batch_id]' and session_id='$c_session'");
                                            }
                                            
                                            if($get_course_id>0){
                                              $sql_d=mysqli_query($con,"select * from course_book where course_id='$_GET[course_id]' and  status='CANCEL' and session_id='$c_session'");  
                                            }
                                            }else{
                                              $sql_d=mysqli_query($con,"select * from course_book where status='CANCEL' and session_id='$c_session'");   
                                            }
                                            while($row=mysqli_fetch_array($sql_d)){
                                            $date=date_create($row['book_date']);
                                            $date=date_format($date,"d-m-Y");
                                           
                                            $user_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$row[userid]'"));
                                            $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$row[course_id]'"));
                                            $user_wallet=mysqli_fetch_array(mysqli_query($con,"select * from wallet where id='$row[userid]'"));
                                            if($user_details['branch_id']==$current_branch_id){
                                            
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $date ;?></td>
                                                <td><?php echo $user_details['reg_no'];?></td>
                                                <td><?php echo $user_details['name'];?></td>
                                                <td><?php echo $user_details['mobile'];?></td>
                                                <td><?php echo $course_details['name'];?></td>
                                              
                                              
                                              
                                            </tr>
                                            
                                            <?php } } ?>
                                        </tbody>

                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
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