<?php
include 'session.php'; 
$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");


// if(isset($_POST['create'])){
//     $course_id=VerifyData($_POST['course_id']);
//     $h_name=VerifyData($_POST['h_name']);
//     $start_date=VerifyData($_POST['start_date']);
//     $end_date=VerifyData($_POST['end_date']);
//     $description=VerifyData($_POST['desc']);
  
//   if(!$h_name=="" and !$start_date=="" and !$course_id=="" and !$end_date=="" and !$description==""){
   
//          $insert=mysqli_query($con,"insert into `lms_project_create`(`course_id`, `heading`, `description`, `start_date`, `end_date`) values('$course_id', '$h_name', '$description', '$start_date', '$end_date')"); 
//         if($insert){
//             echo '<script>alert("Project Create Sucessfully Done .");window.location.assign("lms_project_create");</script>'; 
//         }else{
//             echo '<script>alert("Server Error 101.");window.location.assign("lms_project_create");</script>'; 
//         }
//   }else{
//       echo '<script>alert("Please fill all data.");window.location.assign("lms_project_create");</script>'; 
//   }
// }

// if(isset($_GET['status'])){
//     $status=VerifyData($_GET['status']);
//     $id=VerifyData($_GET['id']);
//     if(!$status=="" && !$id==""){
//         $update =mysqli_query($con,"update lms_project_create set status='$status' where id='$id'");
//         if($update){
//             echo '<script>alert("Status update Sucessfully Done.");window.location.assign("lms_project_create");</script>';
//         }else{
//          echo '<script>alert("Server error 202.");window.location.assign("lms_project_create");</script>';   
//         }
//     }else{
//       echo '<script>alert("Somthing Went Wrong.");window.location.assign("lms_project_create");</script>';   
//     }
// }
// if(isset($_GET['delete'])){
//     $status=VerifyData($_GET['delete']);
//     $id=VerifyData($_GET['id']);
//     if($status=="YES" && !$id==""){
//         $delete =mysqli_query($con,"delete from lms_project_create where id='$id'");
//         if($delete){
//             echo '<script>alert("Project Deleted Sucessfully Done.");window.location.assign("lms_project_create");</script>';
//         }else{
//          echo '<script>alert("Server error 203.");window.location.assign("lms_project_create");</script>';   
//         }
//     }else{
//       echo '<script>alert("Somthing Went Wrong.");window.location.assign("lms_project_create");</script>';   
//     }
// }

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
                                               <th>Description</th>
                                               <th width="60px">View Project</th>
                                              
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
                                                <td><div class="col-md-12" id="des_div<?php echo $row['id'];?>" style="display:none; text-align: left;">
                                                <p ><?php echo $row['description']; ?></p>
                                                <div align="center">
                                                <button  type="submit" name="hide_des" onclick="hide_des_function('des_div<?php echo $row['id'];?>','des_btn<?php echo $row['id'];?>')" class="btn btn-danger"><i class="fa fa-eye-slash"></i></button> 
                                                </div>
                                                
                                                </div>
                                                <div class="col-md-12" align="center" id="des_btn<?php echo $row['id'];?>" >
                                                <button type="submit" name="show_des" class="btn btn-success" onclick="show_des_function('des_div<?php echo $row['id'];?>','des_btn<?php echo $row['id'];?>')"><i class="fa fa-eye"></i></button> 
                                                </div></td>
                                               <td><a href="#"><button class="btn btn-primary"><i class="fa fa-eye"></i> View</button></a></td>
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
</body>
</html>
