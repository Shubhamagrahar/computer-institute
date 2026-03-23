<?php
include 'session.php'; 
$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");


if(isset($_POST['create'])){
  $course_id=VerifyData($_POST['course_id']);
  $date_time=VerifyData($_POST['date_time']);
  $h_name=VerifyData($_POST['h_name']);
   $video_link=VerifyData($_POST['video_link']);
  
  if(!$h_name=="" and !$video_link=="" and !$course_id=="" and !$date_time==""){
   
         $insert=mysqli_query($con,"insert into `lms_live_class`(`course_id`, `heading`, `link`, `date_time`) values('$course_id', '$h_name', '$video_link', '$date_time')"); 
        if($insert){
            echo '<script>alert("LMS Live Class Create Sucessfully Done .");window.location.assign("lms_live_class");</script>'; 
        }else{
            echo '<script>alert("Server Error 101.");window.location.assign("lms_live_class");</script>'; 
        }
   }else{
      echo '<script>alert("Please fill all data.");window.location.assign("lms_live_class");</script>'; 
  }
}

if(isset($_GET['status'])){
    $status=VerifyData($_GET['status']);
    $id=VerifyData($_GET['id']);
    if(!$status=="" && !$id==""){
        $update =mysqli_query($con,"update lms_live_class set status='$status' where id='$id'");
        if($update){
            echo '<script>alert("Status update Sucessfully Done.");window.location.assign("lms_live_class");</script>';
        }else{
         echo '<script>alert("Server error 202.");window.location.assign("lms_live_class");</script>';   
        }
    }else{
      echo '<script>alert("Somthing Went Wrong.");window.location.assign("lms_live_class");</script>';   
    }
}
if(isset($_GET['delete'])){
    $status=VerifyData($_GET['delete']);
    $id=VerifyData($_GET['id']);
    if($status=="YES" && !$id==""){
        $delete =mysqli_query($con,"delete from lms_live_class where id='$id'");
        if($delete){
            echo '<script>alert("LMS Live Class Deleted Sucessfully Done.");window.location.assign("lms_live_class");</script>';
        }else{
         echo '<script>alert("Server error 203.");window.location.assign("lms_live_class");</script>';   
        }
    }else{
      echo '<script>alert("Somthing Went Wrong.");window.location.assign("lms_live_class");</script>';   
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LMS Live Class |  <?php echo $brand_name; ?></title>
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

.lms_live_class{
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
          
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
         
            <div class="col-md-12">
                <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Create Live Class</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
              <form method="post">
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-6" id="course_fee_label" >
                     <label>Course:</label>
                     <select name="course_id" id="course_id" required class="form-control" >
                       <option value="">Select</option> 
                       <?php
                       $sql_course=mysqli_query($con,"select * from course_details order by id desc ");
                       while($row=mysqli_fetch_array($sql_course)){
                           ?>
                           <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option> 
                           <?php
                       }
                       ?>
                       
                     </select>
                </div>
                    <div class="col-md-6">
                    <label for="short_about">Heading:</label>
                    <input type="text" class="form-control" required id="h_name" name="h_name" value="" placeholder="Enter heading.">
               
                  </div>
                 <div class="col-md-6">
                    <label for="short_about">Date & Time:</label>
                    <input type="datetime-local" class="form-control" required id="date_time" name="date_time" value="" placeholder="Enter date & time.">
               
                  </div>
                  <div class="col-md-6">
                    <label for="short_about">Zoom or Google Meet link:</label>
                    <input type="text" class="form-control" required id="video_link" name="video_link" value="" placeholder="Enter zoom or google meet link.">
               
                  </div>
                 
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="create" class="btn btn-primary">Create</button>
                </div>
              </form>
              
            </div>
            </div>
            
            
           
            
            
          </div>
        </div>
     </section>
     <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Video Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width="40px">Sr. No.</th>
                                                <th>Date & Time</th>
                                                <th>Course</th>
                                               <th>Heading</th>
                                                <th>Link</th>
                                                <th width="60px">Status</th>
                                                <th width="70px">Delete</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                             $sql_video=mysqli_query($con,"select * from lms_live_class order by id desc");
                                            while($row=mysqli_fetch_array($sql_video)){
                                           $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$row[course_id]'"));
                                            $date=date_create($row['date']);
                                            $date=date_format($date,"d-m-Y H:i:s");
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $date; ?></td>
                                                <td><?php echo $course_details['name']; ?></td>
                                                <td><?php echo $row['heading']; ?></td>
                                                <td><a target="_blank" href="<?php echo $row['link']; ?>"><?php echo $row['link']; ?></a></td>
                                                 <td><?php 
                                                if($row['status']=="SHOW"){
                                                    ?>
                                                <a href="lms_live_class?status=HIDE&id=<?php echo $row['id']; ?>" onclick="return confirm('Are your sure for hide this Video?')"><button class="btn btn-success"> Active</button></a>  
                                                  <?php
                                                }
                                                if($row['status']=="HIDE"){
                                                    ?>
                                                  <a href="lms_live_class?status=SHOW&id=<?php echo $row['id']; ?>" onclick="return confirm('Are your sure for show this Video?')"><button class="btn btn-danger"> Deactive</button></a>  
                                                   <?php
                                                }
                                                ?></td>
                                                <td>
                                                    
                                                    <a href="lms_live_class?delete=YES&id=<?php echo $row['id']; ?>" onclick="return confirm('Are your sure for delete this Video?')"><button class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</button></a>
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
