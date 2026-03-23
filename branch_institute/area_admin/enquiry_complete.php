<?php 
include 'session.php'; 

$type = mysqli_fetch_array(mysqli_query($con, "select type from user where id='$_SESSION[userid]'"))['type'];
if(sub_menu_check("A","C",$_SESSION['userid'], $type)==1){
    
}else{
    echo '<script>alert("You are not permitted to access this option.");window.location.assign("index");</script>'; 
}

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");
if($branch_access_details['enquiry_system']=="YES"){
    
}else{
    mysqli_close($con);
    echo '<script>window.location.assign("index");</script>';
}


if(isset($_GET['cancel_ids'])){
    $id=VerifyData($_GET['ids']);
    if(!$id==""){
        $check=mysqli_query($con,"select * from enquiry_details where id='$id'");
        if(mysqli_num_rows($check)){
          $enquiry_details=mysqli_fetch_array($check);
           $staff_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$enquiry_details[create_by]'"));
           $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$enquiry_details[course_id]'"));
           $batch_details=mysqli_fetch_array(mysqli_query($con,"select * from batch_details where id='$enquiry_details[batch_id]'"));
       
       $update=mysqli_query($con,"update enquiry_details set status='CLOSE', cancel_date='$t_date' where id='$id'");
         if($update){
          echo '<script>alert("Course Enroll proceess cancel.");window.location.assign("enquiry_running")</script>'; 
         }else{
         echo '<script>alert("Server Error 105.");window.location.assign("enquiry_running");</script>';     
         }
                       
          
       
        }else{
            echo '<script>alert("Server error 101.");window.location.assign("enquiry_running");</script>';
        }
        
    }else{
        echo '<script>alert("Not allowed.");window.location.assign("enquiry_running");</script>';
    }
}

$c_session = mysqli_fetch_array(mysqli_query($con, "select session_id from login_session where userid='$login_details[id]'"))['session_id'];


// if(isset($_GET['final_ids'])){
//     $id=VerifyData($_GET['ids']);
//     if(!$id==""){
//         $check=mysqli_query($con,"select * from enquiry_details where id='$id'");
//         if(mysqli_num_rows($check)){
//           $enquiry_details=mysqli_fetch_array($check);
//           $staff_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$enquiry_details[create_by]'"));
//           $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$enquiry_details[course_id]'"));
//           $batch_details=mysqli_fetch_array(mysqli_query($con,"select * from batch_details where id='$enquiry_details[batch_id]'"));
       
          
//           $courseid=$enquiry_details['course_id'];
//           $name=$enquiry_details['name'];
//       $email_id="";
//     $mobile=$enquiry_details['mobile1'];
    
//     if(!$courseid=="" and !$name=="" and !$mobile=="" ){
//         $check_course=mysqli_query($con,"select * from course_details where id='$courseid'");
//         if(mysqli_num_rows($check_course)==1){
//             $course_details=mysqli_fetch_array($check_course);
//             $check_mobile=mysqli_num_rows(mysqli_query($con,"select * from user where mobile='$mobile'"));
//             if(!$check_mobile>0){
//              $pass=rand(100000,999999);
//             $insert=mysqli_query($con,"insert into `user`(`name`, `mobile`, `pass`, `email`, `r_date`) values('$name', '$mobile', '$pass', '$email_id', '$t_date')");    
//             if($insert){
//                 $insert_id=mysqli_insert_id($con);
//                 if($insert_id>0){
//                   $insert_wallet=mysqli_query($con,"insert into `wallet`(`userid`) values('$insert_id')");
//                   if($insert_wallet){
//                      $create_course=mysqli_query($con,"insert into `course_book`(`userid`, `course_id`, `fee`, `book_date`) values('$insert_id', '$courseid', '$course_details[fee]', '$t_date')");
//                     $course_inert_id=mysqli_insert_id($con);
//                       if($create_course){
//                          $update=mysqli_query($con,"update enquiry_details set status='CLOSE', convert_date='$t_date' where id='$id'");
//                          if($update){
//                           echo '<script>alert("Course Enroll proceess please in new enrollment request.");window.location.assign("enquiry_running")</script>'; 
//                          }else{
//                          echo '<script>alert("Server Error 105.");window.location.assign("enquiry_running");</script>';     
//                          }
//                      }else{
//                         echo '<script>alert("Server Error 104.");window.location.assign("enquiry_running");</script>'; 
//                      }
                      
//                   }else{
//                      echo '<script>alert("Server Error 103.");window.location.assign("enquiry_running");</script>'; 
//                   }
                  
//                 }else{
//                     echo '<script>alert("Server Error 102.");window.location.assign("enquiry_running");</script>';  
//                 }
//             }else{
//               echo '<script>alert("Server Error 101.");window.location.assign("enquiry_running");</script>';  
//             }
//             }else{
//                 echo '<script>alert("Mobile number already registered.");window.location.assign("enquiry_running");</script>';
//             }
//         }else{
//             echo '<script>alert("Please select course.");window.location.assign("enquiry_running");</script>';
//         }
//     }else{
//         echo '<script>alert("Please fill all feild.");window.location.assign("enquiry_running");</script>';
//     }
           
          
       
//         }else{
//             echo '<script>alert("Server error 101.");window.location.assign("enquiry_running");</script>';
//         }
        
//     }else{
//         echo '<script>alert("Not allowed.");window.location.assign("enquiry_running");</script>';
//     }
// }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Running Enquiry|
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
          .drop_enquiry{
    	background: #157daf !important;
    }
    
    .enquiry_complete{
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
                            <h1>Complete Follow-up Enquiry Details</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>


  <section class="content" id="data_view">
     
     </section>

           

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                      
                        <div class="col-12">
                            <br>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Follow-up Enquiry Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
                                                <th>Enquiry Date</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Course</th>
                                                <th>Details</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php
                                        $i = 0;
                                        $sql_d = mysqli_query($con, "SELECT * FROM enquiry_details WHERE branch_id='$current_branch_id' AND status='CLOSE' AND session_id='$c_session' ORDER BY next_date DESC");
                                        
                                        while ($row = mysqli_fetch_array($sql_d)) {
                                            $i++;
                                            $enquiry_date = date("d-m-Y", strtotime($row['enquiry_date']));
                                            $next_followup = date("d-m-Y", strtotime($row['next_date']));
                                        
                                            $staff = mysqli_fetch_array(mysqli_query($con, "SELECT name FROM user WHERE id='$row[create_by]'"));
                                            $course = mysqli_fetch_array(mysqli_query($con, "SELECT name FROM course_details WHERE id='$row[course_id]'"));
                                            $batch = mysqli_fetch_array(mysqli_query($con, "SELECT batch_name FROM batch_details WHERE id='$row[batch_id]'"));
                                        ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $enquiry_date ?></td>
                                                <td><?= $row['name'] ?></td>
                                                <td><?= $row['mobile1'] ?></td>
                                                <td><?= $course['name'] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-smd btn-info" data-toggle="modal" data-target="#viewModal<?= $row['id'] ?>">
                                                        View
                                                    </button>
                                                </td>
                                                <td>
                                                    <a target="_blank" title="Add follow-up details" href="enquiry_details?ids=<?= $row['id'] ?>" class="btn btn-md btn-success">
                                                        Add
                                                    </a>
                                                </td>
                                            </tr>
                                        
                                            <div class="modal fade" id="viewModal<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-light">
                                                            <h5 class="modal-title">Enquiry Details</h5>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6 mb-2">
                                                                    <label><strong>Enquiry Date:</strong></label>
                                                                    <input type="text" class="form-control" value="<?= $enquiry_date ?>" readonly>
                                                                </div>
                                                                <div class="col-md-6 mb-2">
                                                                    <label><strong>Created By:</strong></label>
                                                                    <input type="text" class="form-control" value="<?= $staff['name'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-6 mb-2">
                                                                    <label><strong>Name:</strong></label>
                                                                    <input type="text" class="form-control" value="<?= $row['name'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-6 mb-2">
                                                                    <label><strong>Mobile 1:</strong></label>
                                                                    <input type="text" class="form-control" value="<?= $row['mobile1'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-6 mb-2">
                                                                    <label><strong>Mobile 2:</strong></label>
                                                                    <input type="text" class="form-control" value="<?= $row['mobile2'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-6 mb-2">
                                                                    <label><strong>Course:</strong></label>
                                                                    <input type="text" class="form-control" value="<?= $course['name'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-6 mb-2">
                                                                    <label><strong>Batch:</strong></label>
                                                                    <input type="text" class="form-control" value="<?= $batch['batch_name'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-6 mb-2">
                                                                    <label><strong>Next Follow-Up Date:</strong></label>
                                                                    <input type="text" class="form-control" value="<?= $next_followup ?>" readonly>
                                                                </div>
                                                                <div class="col-md-12 mb-2">
                                                                    <label><strong>Last Discussion:</strong></label>
                                                                    <input type="text" class="form-control" value="<?= $row['enquiry_note'] ?>" readonly>
                                                                </div>
                                                                  <?php
                                                        if($row['coupen_code'] !== ""){
                                                      ?>
                                                      <div class="col-md-6 mb-2">
                                                        <label><strong>Coupen Code (if any):</strong></label>
                                                        <input type="text" class="form-control" value="<?= $row['coupen_code'] ?>" readonly>
                                                      </div>
                                                      <div class="col-md-6 mb-2">
                                                        <label><strong>Discount % (if any):</strong></label>
                                                        <input type="text" class="form-control" value="<?= $row['coupen_discount'] ?>" readonly>
                                                      </div>
                                                      <?php } ?>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer bg-light">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
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
    function data_view_close(){
        $("#data_view").html("");
    }
    function get_data_view(val){
         $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'get_data_report_view='+val,
                success: function(data){
                   $("#data_view").html(data);
                }
              } );
    }
    
    
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