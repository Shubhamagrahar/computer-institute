<?php
include 'session.php'; 

$c_date=date("Y-m-d H:i:s");
if(isset($_POST['create'])){
   $photo = $_FILES["upload_file1"]["name"];
   $photo2 = $_FILES["upload_file1"]["tmp_name"];
        
   
   $name=VerifyData($_POST['name']);
   if(!$photo=="" and !$name==""){
       
            $extension12 = explode(".", $photo);

             $extension1 = end($extension12);
          
            $nn_name = rand(10000,99999);
            $newfilename1 =$_SESSION['userid'].$nn_name.".".$extension1;
            $photo_dr="super_admin/registration_affiliation_img/".$newfilename1 ;
            $upload_photo= move_uploaded_file($photo2,"registration_affiliation_img/".$newfilename1);
            if($upload_photo){
                $insert=mysqli_query($con,"insert into `registration_affiliation`(`name`, `document`) values('$name', '$photo_dr')");
                if($insert){
                    echo '<script>alert("File uploaded successfully done.");window.location.assign("web_reg_aff");</script>';
                }else{
                  echo '<script>alert("Server Error 101.");window.location.assign("web_reg_aff");</script>';  
                }
            }else{
               echo '<script>alert("File uploading failed.");window.location.assign("web_reg_aff");</script>';  
            }
       
   }else{
      echo '<script>alert("Please fill all details.");window.location.assign("web_reg_aff");</script>';  
   }
   
}


if(isset($_GET['delete'])){
    $delete=VerifyData($_GET['delete']);
    $id=VerifyData($_GET['id']);
if(!$delete=="" and $delete=="YES" and !$id==""){
    $sql=mysqli_query($con,"select * from registration_affiliation where id='$id'");
    if(mysqli_num_rows($sql)>0){
        $result=mysqli_fetch_array($sql);
        $photo=end(explode("/",$result['document']));
        $unlinkphoto=unlink("registration_affiliation_img/".$photo);
        if($unlinkphoto){
            $delete=mysqli_query($con,"delete from registration_affiliation where id='$id'");
            if($delete){
                echo '<script>alert("File deleted successfully done.");window.location.assign("web_reg_aff");</script>';  
            }else{
              echo '<script>alert("Server Error 103.");window.location.assign("web_reg_aff");</script>';    
            }
        }else{
          echo '<script>alert("Server Error 102.");window.location.assign("web_reg_aff");</script>';  
        }
    }else{
      echo '<script>alert("Server Error 101.");window.location.assign("web_reg_aff");</script>';  
    }
    
}else{
   echo '<script>alert("Something went wrong, Please try again.");window.location.assign("web_reg_aff");</script>';   
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registrations & Affiliations |  <?php echo $brand_name; ?></title>
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

.web_reg_aff{
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
                <h3 class="card-title">Registrations & Affiliations</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="col-12" align="center">
                                           
                        <label>Image Document : </label>
                        <input type="file" name="upload_file1" class="form-control" placeholder=""
                            id="upload_file" onchange="getImagePreview(event)">
                            
                        <br>
                        <!--image preview div-->
                        <!--<div id="preview">-->
                         
                        <!--</div>-->
                        

                    </div>
                 
                 
                  <div class="form-group">
                    <label for="short_about">File Name</label>
                    <input  class="form-control" rows="5" id="name" name="name" value=""  placeholder="Enter file name."></input>
               
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
                                    <h3 class="card-title">Registrations & Affiliations Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                               <th >Documents</th>
                                               <th>File Name</th>
                                               <!--<th>Status</th>-->
                                                <th>Delete</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                             $sql_course=mysqli_query($con,"select * from registration_affiliation order by id desc");
                                            while($row=mysqli_fetch_array($sql_course)){
                                           
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td width="100px"><a target="_blank" href="<?php echo $web_link.$row['document']; ?>"><img  width="100px" src="<?php echo $web_link.$row['document']; ?>"></a></td>
                                                
                                                 <td><?php echo $row['name']; ?></td>
                                               
                                              
                                                <td><a href="web_reg_aff?delete=YES&id=<?php echo $row['id']; ?>" onclick="return confirm('Are your sure for delete this publication?')"><button class="btn btn-danger"> Delete</button></a></td>
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
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
