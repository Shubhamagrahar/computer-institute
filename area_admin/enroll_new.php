<?php 
include 'session.php'; 


$type = mysqli_fetch_array(mysqli_query($con, "select type from user where id='$_SESSION[userid]'"))['type'];
if(sub_menu_check("B","B",$_SESSION['userid'], $type)==1){
    
}else{
    echo '<script>alert("You are not permitted to access this option.");window.location.assign("index");</script>'; 
}


$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(isset($_GET['cancel'])){
    $id=VerifyData($_GET['cancel']);
    if(!$id==""){
      $check=mysqli_num_rows(mysqli_query($con,"select * from course_book where id='$id' and status='OPEN'"));
      if($check==1){
         $update=mysqli_query($con,"update course_book set status='CANCEL' where id='$id'");
         if($update){
             echo '<script>alert("Selected Eroll canceled done.");window.location.assign("enroll_new");</script>';
         }else{
          echo '<script>alert("Server error 101.");window.location.assign("enroll_new");</script>';   
         }
      }else{
        echo '<script>alert("Please choose valid enroll for cancel.");window.location.assign("enroll_new");</script>';  
      }
    }else{
        echo '<script>alert("Not a valid ID.");window.location.assign("enroll_new");</script>';
    }
}

$c_session = mysqli_fetch_array(mysqli_query($con, "select session_id from login_session where userid='$login_details[id]'"))['session_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Enrollment Request |
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
    
     <style type="text/css">
          .drop_enroll{
    	background: #157daf !important;
    }
    
    .enroll_new{
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
                            <h1>New Enrollment Request for approval</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>


           

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">New Enrollment Request</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Date</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Course Name</th>
                                                <th>Total Fee</th>
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                            $sql_d=mysqli_query($con,"select * from course_book where session_id='$c_session' and status='OPEN'");
                                            while($row=mysqli_fetch_array($sql_d)){
                                            $date=date_create($row['book_date']);
                                            $date=date_format($date,"d-m-Y");
                                            $user_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$row[userid]'"));
                                            $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$row[course_id]'"));
                                            if($user_details['branch_id']==$current_branch_id){
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $date ;?></td>
                                                <td><?php echo $user_details['name'];?></td>
                                                <td><?php echo $user_details['mobile'];?></td>
                                                <td><?php echo $course_details['name'];?></td>
                                                <td><?php echo $row['fee'];?></td>
                                              
                                                
                                                <td>
                                                      <a href="javascript:void(0);" class="process-btn" data-id="<?php echo $row['id']; ?>" title="Process" style="color:green;">
                                                        <i class="fa fa-edit"></i> Process
                                                      </a>&nbsp;&nbsp;&nbsp;&nbsp;
                                                      <a href="javascript:void(0);" class="cancel-btn" data-id="<?php echo $row['id']; ?>" title="Cancel" style="color:red;">
                                                        <i class="fa fa-trash"></i> Cancel
                                                      </a>
                                                    </td>

                                                
                                            </tr>
                                            
                                            <?php } }  ?>
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
    <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>

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
    
    <script>
document.addEventListener('DOMContentLoaded', function () {

  // Final Process
  document.querySelectorAll('.process-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var id = this.getAttribute('data-id');
      Swal.fire({
        title: 'Are you sure?',
        text: "You are about to start the final process.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, proceed!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = 'enroll_final?ids=' + id;
        }
      });
    });
  });

  // Cancel Enrollment
document.querySelectorAll('.cancel-btn').forEach(function (btn) {
  btn.addEventListener('click', function () {
    var id = this.getAttribute('data-id');

    Swal.fire({
      title: 'Are you sure?',
      text: "This will cancel the enrollment!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#dc3545',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Yes, cancel it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: 'get_data',
          type: 'GET',
          data: {
            cancle_enrollment: 1,
            id: id
          },
          success: function (response) {
              
            response = response.trim();
            if (response === "success") {
              Swal.fire({
                icon: 'success',
                title: 'Canceled!',
                text: 'The enrollment has been canceled.',
                timer: 2000,
                showConfirmButton: true
              }).then(() => {
                window.location.reload(); 
              });
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Failed!',
                text: response
              });
            }
          },
          error: function () {
            Swal.fire({
              icon: 'error',
              title: 'Error!',
              text: 'Something went wrong. Please try again.'
            });
          }
        });
      }
    });
  });
});


});
</script>

</body>

</html>