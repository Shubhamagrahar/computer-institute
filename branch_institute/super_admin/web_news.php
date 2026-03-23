<?php
include 'session.php'; 

$c_date=date("Y-m-d H:i:s");
if(isset($_POST['create'])){
  $des=VerifyData($_POST['des']);
  
  if(!$des==""){
   
         $insert=mysqli_query($con,"insert into `web_news`(`des`, `date`) values('$des', '$c_date')"); 
        if($insert){
            echo '<script>alert("Announcement Create Sucessfully Done .");window.location.assign("web_news");</script>'; 
        }else{
            echo '<script>alert("Server Error 101.");window.location.assign("web_news");</script>'; 
        }
          
    
  }else{
      echo '<script>alert("Please fill All data.");window.location.assign("web_news");</script>'; 
  }
}

if(isset($_GET['new'])){
    $new=VerifyData($_GET['new']);
    $id=VerifyData($_GET['id']);
    if(!$new=="" && !$id==""){
        $update =mysqli_query($con,"update web_news set new='$new' where id='$id'");
        if($update){
            echo '<script>alert("Status update Sucessfully Done.");window.location.assign("web_news");</script>';
        }else{
         echo '<script>alert("Server error 202.");window.location.assign("web_news");</script>';   
        }
    }else{
      echo '<script>alert("Somthing Went Wrong.");window.location.assign("web_news");</script>';   
    }
}

if(isset($_GET['status'])){
    $status=VerifyData($_GET['status']);
    $id=VerifyData($_GET['id']);
    if(!$status=="" && !$id==""){
        $update =mysqli_query($con,"update web_news set status='$status' where id='$id'");
        if($update){
            echo '<script>alert("Status update Sucessfully Done.");window.location.assign("web_news");</script>';
        }else{
         echo '<script>alert("Server error 202.");window.location.assign("web_news");</script>';   
        }
    }else{
      echo '<script>alert("Somthing Went Wrong.");window.location.assign("web_news");</script>';   
    }
}
if(isset($_GET['delete'])){
    $status=VerifyData($_GET['delete']);
    $id=VerifyData($_GET['id']);
    if($status=="YES" && !$id==""){
        $delete =mysqli_query($con,"delete from web_news where id='$id'");
        if($delete){
            echo '<script>alert("Deleted Sucessfully Done.");window.location.assign("web_news");</script>';
        }else{
         echo '<script>alert("Server error 203.");window.location.assign("web_news");</script>';   
        }
    }else{
      echo '<script>alert("Somthing Went Wrong.");window.location.assign("web_news");</script>';   
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LATEST ANNOUNCEMENT |  <?php echo $brand_name; ?></title>
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
      .website_drop{
	background: #157daf !important;
}

.web_news{
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
                <h3 class="card-title">LATEST ANNOUNCEMENT</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body">
                 
                  <div class="form-group">
                    <label for="short_about">ANNOUNCEMENT</label>
                    <textarea  class="form-control" rows="5" id="des" name="des" value=""  placeholder="Enter Announcemnet."></textarea>
               
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
                                    <h3 class="card-title">Announcement Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                               <th>Date</th>
                                                <th>Announcement</th>
                                                <th>New Icon</th>
                                                <th>Status</th>
                                                <th>Delete</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                             $sql_course=mysqli_query($con,"select * from web_news order by status desc");
                                            while($row=mysqli_fetch_array($sql_course)){
                                            $date=date_create($row['date']);
                                            $date=date_format($date,"d-m-Y H:i A");
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $date; ?></td>
                                                <td><?php echo $row['des']; ?></td>
                                                <td><?php 
                                                
                                                if($row['new']=="YES"){
                                                    ?>
                                                <a href="web_news?new=NO&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure to disable the new icon on this announcement?')"><button class="btn btn-danger"> Hide</button></a>  
                                                  <?php
                                                }
                                                if($row['new']=="NO"){
                                                    ?>
                                                  <a href="web_news?new=YES&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure to enable the new icon on this announcement?')"><button class="btn btn-success"> Show</button></a>  
                                                   <?php
                                                }
                                                
                                                
                                                ?></td>
                                               
                                                <td><?php 
                                                
                                                if($row['status']=="OPEN"){
                                                    ?>
                                                <a href="web_news?status=CLOSE&id=<?php echo $row['id']; ?>" onclick="return confirm('Are your sure for stop this announcement?')"><button class="btn btn-danger"> Stop</button></a>  
                                                  <?php
                                                }
                                                if($row['status']=="CLOSE"){
                                                    ?>
                                                  <a href="web_news?status=OPEN&id=<?php echo $row['id']; ?>" onclick="return confirm('Are your sure for start this announcement?')"><button class="btn btn-success"> Start</button></a>  
                                                   <?php
                                                }
                                                
                                                
                                                ?></td>
                                                <td>
                                                    
                                                    <a href="web_news?delete=YES&id=<?php echo $row['id']; ?>" onclick="return confirm('Are your sure for delete this announcement?')"><button class="btn btn-danger"> Delete</button></a>
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
