<?php
include 'session.php'; 
$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(add_on_check("Learning Management System") == 1){
    
}else{
    echo '<script>alert("This is an add-on service. Please contact the administrator to activate or purchase access."); window.location.assign("./");</script>';

} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Project Details |  <?php echo $brand_name; ?></title>
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
    <script src="ckeditor/ckeditor.js"></script>
    
  <style type="text/css">
      .drop_lms{
	background: #157daf !important;
}

.lms_project_details{
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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
         <div class="col-sm-6">
        <h1>Project Details</h1>
    </div> 
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    
    <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        
                        <div class="col-md-6">
                           <label>Search By Course</label>
                            <select class="form-control" id="course_id" name="course_id" onchange="by_course(this.value)">
                                <option value="">Select</option>
                                <?php 
                                $sql_course=mysqli_query($con,"select * from course_details where status='OPEN'");
                                while($row=mysqli_fetch_array($sql_course)){
                                    ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php 
                                }
                                ?>
                            </select>
                        </div>
                       
                        <script>
                            <?php 
                            if(isset($_GET['course_id'])){
                            if($_GET['course_id']>0){
                                ?>
                               
                                $("#course_id").val('<?php echo $_GET['course_id'] ; ?>');
                                <?php
                            } }
                            ?>
                            
                            
                            function by_course(val){
                                var url="lms_project_details?course_id="+val;
                                window.location.assign(url);
                            }
                            
                           
                         
                        </script>
                         <?php 
                         if(isset($_GET['course_id'])){
                         if(!$_GET['course_id']==""){
                        ?>
                        
                        <div class="col-12">
                  <br>
                            <div class="card">
                                <div class="card-header">
                                    <?php
                                    $course_name=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$_GET[course_id]'"));
                                    ?>
                                    <h3 class="card-title" style="font-weight:700;">Course Name: <?php echo $course_name['name'];?></h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                   <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width="40px">Sr. No.</th>
                                               <th>Heading</th>
                                               <th>Start Date</th>
                                               <th>End Date</th>
                                               <th>Description</th>
                                              
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                             $sql_project=mysqli_query($con,"select * from lms_project_create where course_id='$_GET[course_id]' and status='SHOW' order by id desc");
                                            while($row=mysqli_fetch_array($sql_project)){
                                           $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$row[course_id]'"));
                                            $start_date=date_create($row['start_date']);
                                            $start_date=date_format($start_date,"d-m-Y");
                                            $end_date=date_create($row['end_date']);
                                            $end_date=date_format($end_date,"d-m-Y");
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $row['heading']; ?></td>
                                                <td><?php echo date('d-M Y', strtotime($row['start_date'])); ?></td>
                                                <td><?php echo date('d-M Y', strtotime($row['end_date'])); ?></td>
                                                <td>
                                              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#descModal<?php echo $row['id']; ?>">
                                                <i class="fa fa-eye"></i> View
                                              </button>
                                            
                                              <!-- Modal -->
                                              <div class="modal fade" id="descModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="descModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                                  <div class="modal-content">
                                            
                                                    <div class="modal-header">
                                                      <h5 class="modal-title" id="descModalLabel<?php echo $row['id']; ?>">Project Details</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                      </button>
                                                    </div>
                                            
                                                    <div class="modal-body" style="text-align: left;">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label>Course Name :</label>
                                                                <input type="text" class="form-control" value="<?php echo $course_details['name']; ?>" readonly >
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label>Heading :</label>
                                                                <input type="text" class="form-control" value="<?php echo $row['heading']; ?>" readonly >
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label>Start Date :</label>
                                                                <input type="text" class="form-control" value="<?php echo date('d-M Y', strtotime($row['start_date'])); ?>" readonly >
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label>Heading :</label>
                                                                <input type="text" class="form-control" value="<?php echo date('d-M Y', strtotime($row['end_date'])); ?>" readonly >
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="col-md-12">
                                                            <label>Description: </label><br>
                                                      <?php echo nl2br($row['description']); ?>
                                                        </div>
                                                    </div>
                                            
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                            
                                                  </div>
                                                </div>
                                              </div>
                                            </td>
                                              
                                            </tr>
                                            
                                            <?php }  ?>
                                        </tbody>

                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        
                        <?php } } ?>
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
    <script>
        function show_des_function(val,val1){
            document.getElementById(val).style.display="block";
            document.getElementById(val1).style.display="none";
        }
        function hide_des_function(val,val1){
            document.getElementById(val).style.display="none";
            document.getElementById(val1).style.display="block";
        }
    </script>
    <script>
        $("#course_id").val('<?php echo $_GET['course_id'] ; ?>');
    </script>
</body>
</html>
