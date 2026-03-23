<?php
include 'session.php'; 

$c_date=date("Y-m-d H:i:s");





$btn_name="Create";
$subject_name="";

if(isset($_POST['Create'])){
  $subject_name=VerifyData($_POST['subject_name']);
  
  if(!$subject_name==""){
     $check=mysqli_num_rows(mysqli_query($con,"select * from subject_details where subject_name='$subject_name'"));
     if(!$check>0){
         $insert=mysqli_query($con,"insert into `subject_details`(`subject_name`) values('$subject_name')"); 
        if($insert){
            echo '<script>alert("Subject Name Create Sucessfully Done .");window.location.assign("add_subjects");</script>'; 
        }else{
            echo '<script>alert("Server Error 101.");window.location.assign("add_subjects");</script>'; 
        }
     }else{
      echo '<script>alert("This subject name already created.");window.location.assign("add_subjects");</script>';    
     } 
    
  }else{
      echo '<script>alert("Please fill All data.");window.location.assign("add_subjects");</script>'; 
  }
}


if(isset($_GET['edit'])){
  $id=VerifyData($_GET['edit']);
  
  if(!$id==""){
     $check=mysqli_num_rows(mysqli_query($con,"select * from subject_details where id='$id'"));
     if($check>0){
        $subject_details=mysqli_fetch_array(mysqli_query($con,"select * from subject_details where id='$id'"));
        if($subject_details){
           $btn_name="Update";
           $subject_name=$subject_details['subject_name'];
        }else{
            echo '<script>alert("Server Error 101.");window.location.assign("add_subjects");</script>'; 
        }
     }else{
      echo '<script>alert("Batch Not available.");window.location.assign("add_subjects");</script>';    
     } 
    
  }else{
      echo '<script>alert("Please fill All data.");window.location.assign("add_subjects");</script>'; 
  }
}


if(isset($_POST['Update'])){
  $subject_name=VerifyData($_POST['subject_name']);
  
  if(!$subject_name==""){
    
         $update=mysqli_query($con,"update subject_details set subject_name='$subject_name' where id='$id'"); 
        if($update){
            echo '<script>alert("Subject Name Update Sucessfully Done .");window.location.assign("add_subjects");</script>'; 
        }else{
            echo '<script>alert("Server Error 101.");window.location.assign("add_subjects");</script>'; 
        }
    
    
  }else{
      echo '<script>alert("Please fill All data.");window.location.assign("add_subjects");</script>'; 
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Course Subject | <?php echo $brand_name; ?></title>
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
      .drop_course{
	background: #157daf !important;
}

.course_subjects{
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
           
                
            
            <div class="col-md-3">
                
            </div>
            <div class="col-md-6">
                <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"><?php echo $btn_name ;?> Subject </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body">
                 
                  <div class="form-group">
                    <label for="short_about">Subject</label>
                    <input  class="form-control"  id="subject_name" name="subject_name" value="<?php echo $subject_name ; ?>"  placeholder="Enter Subject Name.">
               
                  </div>
                  
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="<?php echo $btn_name ;?>" class="btn btn-primary"><?php echo $btn_name ;?></button>
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
                                    <h3 class="card-title">Subjects Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Subject</th>
                                                <th>Edit</th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                             $sql_course=mysqli_query($con,"select * from subject_details order by id desc");
                                            while($row=mysqli_fetch_array($sql_course)){
                                            
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                             
                                                <td><?php echo $row['subject_name']; ?></td>
                                               
                                               
                                                <td><a href="add_subjects?edit=<?php echo $row['id']; ?>" onclick="return confirm('Are your sure for edit this subject name?')"><button class="btn btn-success"> <i class="fa fa-edit"></i> Edit</button></a></td>
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
