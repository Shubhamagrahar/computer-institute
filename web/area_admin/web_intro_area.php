<?php 
include 'session.php'; 
echo '<script>window.location.assign("index");</script>';
exit();
$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(isset($_POST['update'])){
    
      
        $photo = $_FILES["upload_file1"]["name"];
        $photo2 = $_FILES["upload_file1"]["tmp_name"];
        
        $content=VerifyData($_POST['content']);
     
     
     
    if(!$content=="" and !$photo==""){
        $check_name=mysqli_num_rows(mysqli_query($con, "select * from website_data where id='1'"));
        if($check_name>0){
             $extension12 = explode(".", $photo);

             $extension1 = end($extension12);
          
            $nn_name = rand(1000,9999);
            $newfilename1 =$_SESSION['userid'].$nn_name.".".$extension1;
            $photo_dr="area_admin/user_img/".$newfilename1 ;
            $upload_photo= move_uploaded_file($photo2,"user_img/".$newfilename1);
            
            if($upload_photo){
                $update=mysqli_query($con,"update website_data set intro_img1='$photo_dr', intro_des='$content' where id='1'");
               if($update){
                   echo '<script>alert("Intro Area Update Success.");window.location.assign("web_intro_area")</script>'; 
               }else{
                 echo '<script>alert("Server error 101.");window.location.assign("web_intro_area")</script>';  
               } 
            }else{
              echo '<script>alert("Image uploading failed.");window.location.assign("web_intro_area")</script>';  
            }
        }else{
           echo '<script>alert("Server error 201.");window.location.assign("web_intro_area")</script>'; 
        }
        
        
    }else{
     echo '<script>alert("Please fill all the fields");window.location.assign("web_intro_area")</script>';   
    }
}

$web_details=mysqli_fetch_array(mysqli_query($con,"select * from website_data where id='1'"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About / Intro Area |
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
    <script src="ckeditor/ckeditor.js"></script>
    
     <style type="text/css">
          .website_drop{
    	background: #157daf !important;
    }
    
    .web_intro_area{
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
                            <h1>About / Intro Area</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>


            <!--Main Content section start-->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">About / Intro Area</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" name="form_2" enctype="multipart/form-data">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-12" align="center">
                                           
                                            <lable>First Image : </lable>
                                            <input type="file" name="upload_file1" class="form-control" placeholder="Enter Name"
                                                id="upload_file" onchange="getImagePreview(event)">
                                                
                                            <br>
                                            <!--image preview div-->
                                            <div id="preview">
                                             <img src="<?php echo $web_link.$web_details['intro_img1'] ?>" width="300">
                                            </div>
                                            
                    
                                        </div>
                                            <br>
                                       
                                        
                                        <div class="col-sm-12" style="margin-top:5px;">
                                            <label>About / Intro Area:</label> <br>
                                            <textarea name="content" rows="5" cols="80"><?php echo $web_details['intro_des'] ?></textarea>
                    
                                        </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                         <button style="margin-bottom:10px;" name="update" class="btn btn-success">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </section>
            <!--Main content section end-->

            <!-- Main content -->
        
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
    <script>
        CKEDITOR.replace('content');
    </script>
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