<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(isset($_POST['update'])){
    
      
        $photo = $_FILES["upload_file1"]["name"];
        $photo2 = $_FILES["upload_file1"]["tmp_name"];
        
        $content=VerifyData($_POST['content']);
        $name=VerifyData($_POST['name']);
        $qualification=VerifyData($_POST['qualification']);
        $slogan=VerifyData($_POST['slogan']);
     
     
     
    if(!$content=="" and !$photo=="" and !$name=="" and !$qualification=="" and !$slogan==""){
        $check_name=mysqli_num_rows(mysqli_query($con, "select * from web_director_message where id='1'"));
        if($check_name>0){
             $extension12 = explode(".", $photo);

             $extension1 = end($extension12);
          
            $nn_name = rand(100000,999999);
            $newfilename1 =$_SESSION['userid'].$nn_name.".".$extension1;
            $photo_dr="super_admin/user_img/".$newfilename1 ;
            $upload_photo= move_uploaded_file($photo2,"user_img/".$newfilename1);
            
            if($upload_photo){
                $update=mysqli_query($con,"update web_director_message set photo='$photo_dr', name='$name',  qualification='$qualification', slogan='$slogan', message='$content' where id='1'");
               if($update){
                   echo '<script>alert("Details update successfully done.");window.location.assign("web_director_message")</script>'; 
               }else{
                 echo '<script>alert("Server error 101.");window.location.assign("web_director_message")</script>';  
               } 
            }else{
              echo '<script>alert("Image uploading failed.");window.location.assign("web_director_message")</script>';  
            }
        }else{
           echo '<script>alert("Server error 201.");window.location.assign("web_director_message")</script>'; 
        }
        
        
    }else{
     echo '<script>alert("Please fill all the fields");window.location.assign("web_director_message")</script>';   
    }
}


if(isset($_GET['status'])){
    $status=VerifyData($_GET['status']);
    $id=VerifyData($_GET['id']);
    if(!$status=="" && !$id==""){
        $update =mysqli_query($con,"update web_director_message set status='$status' where id='1'");
        if($update){
            echo '<script>alert("Status update Sucessfully Done.");window.location.assign("web_director_message");</script>';
        }else{
         echo '<script>alert("Server error 202.");window.location.assign("web_director_message");</script>';   
        }
    }else{
      echo '<script>alert("Somthing Went Wrong.");window.location.assign("web_director_message");</script>';   
    }
}

$web_director_message=mysqli_fetch_array(mysqli_query($con,"select * from web_director_message where id='1'"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Director Message |
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
    
    .web_director_message1{
    	background: #157daf !important;
    }
     .switch {
  position: relative;
  display: inline-block;
  width: 75px;
  height: 34px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ff0000;
  transition: 0.4s;
  border-radius: 34px;
  font-weight: bold;
  font-size: 13px;
  line-height: 34px;
  padding: 0 8px;
  color: white;
  text-align: right;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  transition: 0.4s;
  border-radius: 50%;
}

input:checked + .slider {
  background-color: #28a745;
  text-align: left;
  color: transparent;
}

input:checked + .slider:before {
  transform: translateX(41px); 
}

input:checked + .slider::after {
  content: "SHOW";
  position: absolute;
  top: 0;
  left: 10px;
  line-height: 34px;
  font-weight: bold;
  font-size: 12px;
  color: white;
}

input:not(:checked) + .slider::after {
  content: "HIDE";
  position: absolute;
  top: 0;
  right: 10px;
  line-height: 34px;
  font-weight: bold;
  font-size: 12px;
  color: white;
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
                            <h1>Director Message</h1>
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
                                    <h3 class="card-title">Director Message</h3>
                                    <div align="right">
                                        <label class="switch">
                                            <input type="checkbox" onchange="toggle_permission(this, <?php echo $web_director_message['id']; ?>, 'status')" <?php echo ($web_director_message['status'] == 'SHOW') ? 'checked' : ''; ?>>
                                         <span class="slider round"></span>
                                    </label>
              
</div>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" name="form_2" enctype="multipart/form-data">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-12" align="center">
                                           
                                            <label>Director Image : </label>
                                            <input type="file" name="upload_file1" class="form-control" required placeholder="Enter Name"
                                                id="upload_file" onchange="getImagePreview(event)">
                                                
                                            <br>
                                            <!--image preview div-->
                                            <div id="preview">
                                             <img src="<?php echo $web_link.$web_director_message['photo'] ?>" width="300">
                                            </div>
                                            
                    
                                        </div>
                                        <br>
                                        
                                         <div class="col-sm-6">
                                            <label>Name: </label>
                                            <input type="text" class="form-control" required value="<?php echo $web_director_message['name'] ;?>" name="name" id="name" placeholder="Enter director.">
                                            </div>
                                             <div class="col-sm-6">
                                            <label>Qualification: </label>
                                            <input type="text" class="form-control" required  value="<?php echo $web_director_message['qualification'] ;?>" name="qualification" id="qualification" placeholder="Enter president name.">
                                            </div>
                                              <div class="col-md-12 form-group">
                      <label>Slogan:</label>
                      <textarea class="form-control"  name="slogan" id="slogan" required   value="" placeholder="Enter slogan content."><?php echo $web_director_message['slogan'] ;?></textarea>
                     
                  </div>
                                        
                                            <br>
                                       
                                        <div class="col-sm-12" style="margin-top:5px;">
                                            <label>Message:</label> <br>
                                            <textarea name="content" rows="5" required cols="80"><?php echo $web_director_message['message'] ?></textarea>
                    
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
    function toggle_permission(element, id, field) {
    let newStatus = element.checked ? 'SHOW' : 'HIDE';

    element.checked = !element.checked;

    Swal.fire({
        title: 'Are you sure?',
        text: `Do you want to change status to ${newStatus}?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, change it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            element.checked = !element.checked; 
            $.ajax({
                url: 'get_data',
                type: 'GET',
                data: {
                    change_director_status: 1,
                    id: id,
                    field: field,
                    status: newStatus
                },
               success: function(response) {
    if (response.trim() === "success") {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Status changed successfully.',
            confirmButtonText: 'OK'
        });
    } else {
        Swal.fire({
            icon: 'warning',
            title: 'Notice',
            text: response,
            confirmButtonText: 'OK'
        });
    }
},

                error: function() {
                    element.checked = !element.checked; 
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred. Please try again.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });
}
</script>
</body>

</html>