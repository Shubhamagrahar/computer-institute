<?php
include 'session.php'; 

if(isset($_POST['submit'])){
 
  $short_name=VerifyData($_POST['short_name']);
  $short_about=VerifyData($_POST['short_about']);
   $photo = $_FILES["upload_file1"]["name"];
     $photo2 = $_FILES["upload_file1"]["tmp_name"];
  
  if(!$photo==""){
   
       $extension12 = explode(".", $photo);

             $extension1 = end($extension12);
          if($extension1=="JPEG" or $extension1=="JPG" or $extension1=="PNG" or $extension1=="jpeg" or $extension1=="jpg" or $extension1=="png"){
            $nn_name = rand(1000,9999);
            $newfilename1 =$mobile.$nn_name.".".$extension1;
            $photo_dr="super_admin/img_logo/".$newfilename1 ;
            $upload_photo= move_uploaded_file($photo2,"img_logo/".$newfilename1) ;
            if($upload_photo){
          $insert=mysqli_query($con,"insert into `web_top_slider_area`(`con_hading`, `content`, `img`) values('$short_name', '$short_about', '$photo_dr')");
          if($insert){
              echo '<script>alert("Slider created successfully done.");window.location.assign("web_slider_area");</script>';
          }else{
           echo '<script>alert("Server error 103.");window.location.assign("web_slider_area");</script>';   
          }
        
            }else{
             echo '<script>alert("Server error 102.");window.location.assign("web_slider_area");</script>';     
            }
            
          }else{
             echo '<script>alert("Server error 101.");window.location.assign("web_slider_area");</script>';  
          }
    
       
  }else{
      echo '<script>alert("Please fill All data.");window.location.assign("web_slider_area");</script>'; 
  }
}

if(isset($_GET['delete_id'])){
    $id=VerifyData($_GET['delete_id']);
    if(!$id==""){
        $sql=mysqli_query($con,"select * from web_top_slider_area where id='$id'");
        if(mysqli_num_rows($sql)==1){
            $result=mysqli_fetch_array($sql);
            $photo=end(explode("/",$result['img']));
            $unlink=unlink("img_logo/".$photo);
            if($unlink){
                $delete=mysqli_query($con,"delete from web_top_slider_area where id='$id'");
                if($delete){
                    echo '<script>alert("The slider deleted successfully done.");window.location.assign("web_slider_area")</script>';
                }else{
                   echo '<script>alert("Server Error 103.");window.location.assign("web_slider_area")</script>'; 
                }
            }else{
             echo '<script>alert("Server Error 102.");window.location.assign("web_slider_area")</script>';    
            }
            
        }else{
          echo '<script>alert("Server Error 101.");window.location.assign("web_slider_area")</script>';  
        }
        
    }else{
        echo '<script>alert("Something went wrong.");window.location.assign("certificate_all")</script>';
    }
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Top Slider |  <?php echo $brand_name; ?></title>
    <!-- Favicons -->
  <link href="<?php echo $brand_logo; ?>" rel="icon">
  
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/theme_style.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  
  <style type="text/css">
      .website_drop{
	background: #157daf !important;
}

.web_short_about{
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
                <h3 class="card-title">Website Top Slider</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <!--<div class="form-group">-->
                  <!--  <label for="name">welcome content: </label>-->
                  <!--  <input type="text" class="form-control" id="name" name="name" value="<?php echo $web_details['name']; ?>" placeholder="Enter Institute full name.">-->
                    
                  <!--</div>-->
                  <div class="form-group">
                    <label for="short_name"> Heading:</label>
                    <input type="text" class="form-control" id="short_name" name="short_name" value="" placeholder="Enter content heading">
                  </div>
                  <div class="form-group">
                    <label for="short_about">Content:</label>
                    <textarea  class="form-control" rows="5" id="short_about" name="short_about" value=""  placeholder="Enter short content"></textarea>
                
                  </div>
                  
                  <div class="col-12" align="center">
                                           
                        <lable>Slider Image : </lable>
                        <input type="file" name="upload_file1" class="form-control" placeholder="Enter Name"
                            id="upload_file" onchange="getImagePreview(event)">
                            
                        <br>
                        <!--image preview div-->
                        <div id="preview">
                        
                        </div>
                        

                    </div>
                  <p style="font-size:13px; color:red;"><strong>*</strong>Upload high-resolution images.<br><strong>*</strong>Upload image size 1349px x 543 px for a better view.</p> 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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
                                    <h3 class="card-title">Website Top Slider Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                               <th>Photo</th>
                                                <th>Heading</th>
                                                <th>Content</th>
                                                <th>Delete</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                             $sql_data=mysqli_query($con,"select * from web_top_slider_area order by id desc");
                                            while($row=mysqli_fetch_array($sql_data)){
                                           
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><img width="50px" src="<?php echo $web_link.$row['img']; ?>"></td>
                                                <td><?php echo $row['con_hading']; ?></td>
                                                 <td><?php echo $row['content']; ?></td>
                                               
                                              
                                                <td><a href="web_slider_area?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are your sure for delete this slider?')" style="color:red;" ><i class="fa fa-trash" > </i> Delete</a></td>
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
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>

  <script>
        function getImagePreview(event) {
            var image = URL.createObjectURL(event.target.files[0]);
            var imagediv = document.getElementById('preview');
            var newimg = document.createElement('img');
            imagediv.innerHTML = '';
            newimg.src = image;
            newimg.width = "300";
            imagediv.appendChild(newimg);
        }
       
    </script>
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
