<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");


$btnname="Create";
// $course_details=mysqli_fetch_array($course_details);
$course_details="";
$course_name="";
$course_img="";
$course_duration="";
$course_fee="";
$course_details_code="";
$course_max_fee="";
$course_short_name="";
$course_des="";

if(isset($_POST['Create'])){
    $course_type_name=$_POST['course_type_name'];
    $photo = $_FILES["upload_file"]["name"];
    $photo2 = $_FILES["upload_file"]["tmp_name"];
       
    if(!$course_type_name=="" and !$photo==""){
        $check_name=mysqli_num_rows(mysqli_query($con, "select * from course_type where name='$course_type_name'"));
        if(!$check_name>0){
           $extension12 = explode(".", $photo);

             $extension1 = end($extension12);
          
            $nn_name = rand(10000,99999);
            $newfilename1 =$_SESSION['userid'].$nn_name.".".$extension1;
            $photo_dr="course_image/".$newfilename1;
            $upload_photo= move_uploaded_file($photo2,"../course_image/".$newfilename1);
            if($upload_photo){
                $insert=mysqli_query($con,"insert into `course_type`(`name`, `img`) values('$course_type_name', '$photo_dr')");
               if($insert){
                   echo '<script>alert("Course type created successfuly done.");window.location.assign("add_course_type")</script>'; 
               }else{
                 echo '<script>alert("Server error 101.");window.location.assign("add_course_type")</script>';  
               } 
            }else{
              echo '<script>alert("Image uploading failed.");window.location.assign("add_course_type")</script>';  
            }
        }else{
           echo '<script>alert("This course type name already exist.");window.location.assign("add_course_type")</script>'; 
        }
        
        
    }else{
     echo '<script>alert("Please fill all the fields");window.location.assign("add_course_type")</script>';   
    }
}


if(isset($_GET['edit'])){
    $id=$_GET['edit'];
    if(!$id==""){
        $course_type_details=mysqli_query($con,"select * from course_type where id='$id'");
        if(mysqli_num_rows($course_type_details)>0){
            $course_type_details=mysqli_fetch_array($course_type_details);
            $course_name=$course_type_details['name'];
            $course_img=$course_type_details['img'];
            $btnname="Update";
        }else{
         echo '<script>alert("Course type not availabel.");window.location.assign("add_course_type");</script>';    
        }
    }else{
      echo '<script>alert("Somthing Went Wrong.");window.location.assign("add_course_type");</script>';   
    }
}

    if(isset($_POST['Update'])){
    
    $course_type_name=$_POST['course_type_name'];
    $photo = $_FILES["upload_file"]["name"];
    $photo2 = $_FILES["upload_file"]["tmp_name"];
     
     
    if(!$course_type_name==""){
      
            $unlink_status=1;
            if($photo==""){
            $photo_dr=$course_img;
            $upload_photo=1;
            $unlink_status=2;
            }else{
            $extension12 = explode(".", $photo);
            
            $extension1 = end($extension12);
            
            $nn_name = rand(10000,99999);
            $newfilename1 =$_SESSION['userid'].$nn_name.".".$extension1;
            $photo_dr="course_image/".$newfilename1;
            $upload_photo= move_uploaded_file($photo2,"../course_image/".$newfilename1);
            }
            if($upload_photo){
                $old_img=$course_type_details['img'];
                $update=mysqli_query($con,"update course_type set name='$course_type_name', img='$photo_dr' where id='$id'");
               if($update){
                   
                   if($unlink_status==1){
                   $unlink_old_image=unlink("../".$old_img);
                   if($unlink_old_image){
                   echo '<script>alert("Course type update successfuly done.");window.location.assign("add_course_type")</script>'; 
                   }else{
                     echo '<script>alert("Old image unlink failed.");window.location.assign("add_course_type")</script>';  
                   }
                   }else{
                       echo '<script>alert("Course type update successfuly done.");window.location.assign("add_course_type")</script>';
                   }
               }else{
                 echo '<script>alert("Server error 101.");window.location.assign("add_course_type")</script>';  
               } 
            }else{
              echo '<script>alert("Image uploading failed.");window.location.assign("add_course_type")</script>';  
            }
       
    }else{
     echo '<script>alert("Please fill all the fields");window.location.assign("add_course_type")</script>';   
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Course Type |
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
          .drop_course{
    	background: #157daf !important;
    }
    
    .add_course_type{
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
  font-size: 13px;
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
                            <h1><?php echo $btnname; ?> Courses Type</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>


            <!--Main Content section start-->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-3">
                         </div>   
                        <div class="col-6">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title"><?php echo $btnname; ?> Course Type</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" name="form_2"  enctype="multipart/form-data">
                                    <div class="card-body ">
                                        <div class="row">
                                             <div class="col-12">
                                            <?php
                                            if(!$course_img==""){
                                                $image_required="";
                                            }else{
                                                $image_required="required";
                                            }
                                            ?>
                                            <label>Course Type Image: <span style="color:red;">*</span></label>
                                            <input type="file" name="upload_file" <?php echo $image_required;?> class="form-control" placeholder=""
                                                id="upload_file" onchange="getImagePreview(event)">
                                                
                                            <br>
                                            <!--image preview div-->
                                            <div id="preview">
                                                <?php if(!$course_img=="") { ?>
                                              <img src="<?php echo $web_link.$course_img ;?>" width="300">
                                              <?php } ?>
                                            </div>
                    
                                        </div>
                                            <br>
                                            <div class="col-sm-12" >
                                            <label>Course Type Name: <span style="color:red;">*</span></label>
                                            <input type="text" class="form-control" required value="<?php echo $course_name ;?>" name="course_type_name" id="course_type_name" placeholder="Enter course type name.">
                                            </div>
                                         
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                         <button style="margin-bottom:10px;" name="<?php echo $btnname; ?>" class="btn btn-success"><?php echo $btnname; ?></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </section>
            <!--Main content section end-->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Course Type Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Edit</th>
                                                <th>Status</th>
                                                <!--<th>First Page Status</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                             $sql_course=mysqli_query($con,"select * from course_type order by id desc");
                                            while($row=mysqli_fetch_array($sql_course)){
                                           
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><img width="60px" src="<?php echo $web_link.$row['img']; ?>"></td>
                                                <td><?php echo $row['name']; ?></td>
                                                
                                                <td><a href="add_course_type?edit=<?php echo $row['id']; ?>" onclick="return confirm('Are your sure for edit this course type?')" style="color:blue;"><i class="fa fa-edit"></i> Edit</a></td>
                                                
                                                <td>
                                                  <label class="switch">
                                                      <input type="checkbox" onchange="toggle_permission(this, <?php echo $row['id']; ?>, 'status')" <?php echo ($row['status'] == 'SHOW') ? 'checked' : ''; ?>>
                                                      <span class="slider round"></span>
                                                    </label>

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
                    change_status_course_type: 1,
                    id: id,
                    field: field,
                    status: newStatus
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Status changed successfully.',
                        confirmButtonText: 'OK'
                    });
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