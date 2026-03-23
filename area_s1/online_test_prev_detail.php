<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(add_on_check("Online Test & Admit Card") == 1){
    
}else{
    echo '<script>alert("This is an add-on service. Please contact the administrator to activate or purchase access."); window.location.assign("./");</script>';

} 
//for exam over update 
 $sql_exam=mysqli_query($con,"select * from online_test_exam_details where status='OPEN' order by id desc");
 if(mysqli_num_rows($sql_exam)>0){
     $result=mysqli_fetch_array($sql_exam);
     $data_time=explode(":",$result['start_time']);
     $min=$data_time['1'];
     $next_minute=$min + $result['exam_time_min'];
     if($next_minute>59){
         $h=$data_time['0'] + 1;
         $m=$next_minute-60;
         $s="00";
         $test_dt= $result['exam_date']." ".$h.":".$m.":".$s;
     }else{
         $h=$data_time['0'] ;
         $m=$next_minute;
         $s="00";
         $test_dt= $result['exam_date']." ".$h.":".$m.":".$s;
     }
     if($c_date>$test_dt){
         $update=mysqli_query($con,"update online_test_exam_details set status='CLOSE' where id='$result[id]'");
     }
 }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Previous Online Exam Details |
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
          .drop_online_test{
    	background: #157daf !important;
    }
    
    .online_test_prev_detail{
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
                            <h1>Previous Online Exam Details</h1>
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
                                    <h3 class="card-title">Previous Online Exam Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Si. No.</th>
                                                <th>Exam Date</th>
                                                <th>Course</th>
                                                <!--<th>Test Level</th>-->
                                                <th>Exam Start Time</th>
                                                <th>Exam Time (Minutes)</th>
                                                <th>Total Question</th>
                                                <!--<th>Try Free</th>-->
                                                <th>Action</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                             <?php
                                             
                                             
                                            $i=0;
                                            $sql_course_book=mysqli_query($con,"select * from course_book where userid='$login_details[id]' and (status='RUN' or status='CLOSE') order by id desc");
                                            while($row=mysqli_fetch_array($sql_course_book)){
                                                $sql_exam=mysqli_query($con,"select * from online_test_exam_details where course_id='$row[course_id]' and status='CLOSE' order by id desc");
                                            if(mysqli_num_rows($sql_exam)>0){
                                            $exam_details=mysqli_fetch_array($sql_exam);
                                            $exam_date=date_create($exam_details['exam_date']);
                                            $exam_date=date_format($exam_date,"d-m-Y");
                                            $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$row[course_id]'"));
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $exam_date ;?></td>
                                                <td><?php echo $course_details['name'] ;?></td>
                                                <td><?php echo date_format(date_create($exam_details['start_time']), "h:i A"); ?></td>
                                                <td><?php echo $exam_details['exam_time_min']." Min."; ?></td>
                                                <td><?php echo $exam_details['total_question']; ?></td>
                                               <td>
                                              <a href="online_test_report?ids=<?php echo $exam_details['id'];?>" style="color:blue;cursor:pointer;"><i class="fa fa-eye"></i> View</a>
                                                    
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