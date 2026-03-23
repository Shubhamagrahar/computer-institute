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
    
        $course_name=VerifyData($_POST['course_name']);
         $course_short_name=VerifyData($_POST['course_short_name']);
        $photo = $_FILES["upload_file"]["name"];
        $photo2 = $_FILES["upload_file"]["tmp_name"];
        $duration=VerifyData($_POST['duration']);
        $max_fee=VerifyData($_POST['max_fee']);
        $fee=VerifyData($_POST['fee']);
        $content=VerifyData($_POST['content']);
         $course_code=VerifyData($_POST['course_code']);
         $course_type_id=VerifyData($_POST['course_type_id']);
     
     
  
    if($course_type_id!="" && $course_code!="" && $course_name!="" && $course_short_name!="" && $duration!="" && $fee!="" && $content!="" && $photo!="" && $max_fee!=""){

        $check_name=mysqli_num_rows(mysqli_query($con, "select * from course_details where name='$course_name'"));
        if(!$check_name>0){
          $extension12 = explode(".", $photo);

             $extension1 = end($extension12);
          
            $nn_name = rand(1000,9999);
            $newfilename1 =$_SESSION['userid'].$nn_name.".".$extension1;
            $photo_dr="course_image/".$newfilename1;
            $upload_photo= move_uploaded_file($photo2,"../course_image/".$newfilename1);
            if($upload_photo){
                $insert=mysqli_query($con,"insert into `course_details`(`course_code`, `course_type_id`, `name`, `course_short_name`, `img`, `duration`, `max_fee`, `fee`, `des`) values('$course_code', '$course_type_id', '$course_name', '$course_short_name', '$photo_dr', '$duration', '$max_fee', '$fee', '$content')");
              if($insert){
                  echo '<script>alert("Course created successfuly done.");window.location.assign("add_course")</script>'; 
              }else{
                 echo '<script>alert("Server error 101.");window.location.assign("add_course")</script>';  
              } 
            }else{
              echo '<script>alert("Image uploading failed.");window.location.assign("add_course")</script>';  
            }
        }else{
          echo '<script>alert("This course name already exist.");window.location.assign("add_course")</script>'; 
        }
        
        
    }else{
     echo '<script>alert("Please fill all the fields");window.location.assign("add_course")</script>';   
    }
}


if(isset($_GET['status'])){
    $status=VerifyData($_GET['status']);
    $id=VerifyData($_GET['id']);
    if(!$status=="" && !$id==""){
        $update =mysqli_query($con,"update course_details set status='$status' where id='$id'");
        if($update){
            echo '<script>alert("Status update Sucessfully Done.");window.location.assign("add_course");</script>';
        }else{
         echo '<script>alert("Server error 202.");window.location.assign("add_course");</script>';   
        }
    }else{
      echo '<script>alert("Somthing Went Wrong.");window.location.assign("add_course");</script>';   
    }
}

if(isset($_GET['status_first'])){
    $status=VerifyData($_GET['status_first']);
    $id=VerifyData($_GET['id']);
    if(!$status=="" && !$id==""){
        if($status=="CLOSE"){
            $go_next=1;
        }else{
            $count_first_page_open_course=mysqli_num_rows(mysqli_query($con,"select * from course_details where status='OPEN' and first_page_status='OPEN'"));
            if($count_first_page_open_course>2) {
                $go_next="You have already been shown 3 courses on the first page. Please hide a course and try again.";
            }else{
               $go_next=1; 
            }
        }
        if($go_next==1){
        $update =mysqli_query($con,"update course_details set first_page_status='$status' where id='$id'");
        if($update){
            echo '<script>alert("Status update Sucessfully Done.");window.location.assign("add_course");</script>';
        }else{
         echo '<script>alert("Server error 202.");window.location.assign("add_course");</script>';   
        }
    }else{
       echo '<script>alert("'.$go_next.'");window.location.assign("add_course");</script>'; 
    }
    }else{
      echo '<script>alert("Somthing Went Wrong.");window.location.assign("add_course");</script>';   
    }
}

if(isset($_GET['edit'])){
    $id=VerifyData($_GET['edit']);
    if(!$id==""){
        $course_details=mysqli_query($con,"select * from course_details where id='$id'");
        if(mysqli_num_rows($course_details)>0){
            $course_details=mysqli_fetch_array($course_details);
            $course_name=$course_details['name'];
            $course_short_name=$course_details['course_short_name'];
            $course_img=$course_details['img'];
            $course_duration=$course_details['duration'];
            $course_max_fee=$course_details['max_fee'];
            $course_fee=$course_details['fee'];
          
            $course_des=$course_details['des'];
            $course_details_code=$course_details['course_code'];
            $btnname="Update";
        }else{
         echo '<script>alert("Course not availabel.");window.location.assign("add_course");</script>';    
        }
    }else{
      echo '<script>alert("Somthing Went Wrong.");window.location.assign("add_course");</script>';   
    }
}

if(isset($_POST['Update'])){
    
        $id = VerifyData($_POST['course_id']);
        $course_name=VerifyData($_POST['course_name']);
        $course_short_name=VerifyData($_POST['course_short_name']);
        $photo = $_FILES["upload_file"]["name"];
        $photo2 = $_FILES["upload_file"]["tmp_name"];
        $duration=VerifyData($_POST['duration']);
        $max_fee=VerifyData($_POST['max_fee']);
        $fee=VerifyData($_POST['fee']);
        $content=VerifyData($_POST['content']);
     $course_code=VerifyData($_POST['course_code']);
      $course_type_id=VerifyData($_POST['course_type_id']);
     
     
    if(!$course_type_id=="" and !$course_name=="" and !$course_short_name=="" and !$duration=="" and !$fee=="" and !$content=="" and !$max_fee=="" and !$course_code==""){
        // $check_name=mysqli_num_rows(mysqli_query($con, "select * from course_details where name='$course_name'"));
        // if(!$check_name>0){
        $unlink_status=1;
            if($photo==""){
             $photo_dr=$course_img;
             $upload_photo=1;
             $unlink_status=2;
            }else{
          $extension12 = explode(".", $photo);

             $extension1 = end($extension12);
          
            $nn_name = rand(1000,9999);
            $newfilename1 =$_SESSION['userid'].$nn_name.".".$extension1;
            $photo_dr="course_image/".$newfilename1;
            $upload_photo= move_uploaded_file($photo2,"../course_image/".$newfilename1);
            }
            if($upload_photo){
                $old_img=$course_details['img'];
                $update=mysqli_query($con,"update course_details set course_code='$course_code', course_type_id='$course_type_id', name='$course_name', course_short_name='$course_short_name', img='$photo_dr', duration='$duration', max_fee='$max_fee', fee='$fee', des='$content' where id='$id'");
              if($update){
                  
                  if($unlink_status==1){
                  $unlink_old_image=unlink("../".$old_img);
                 
                  if($unlink_old_image){
                  echo '<script>alert("Course update successfuly done.");window.location.assign("add_course")</script>'; 
                  }else{
                     echo '<script>alert("Old image unlink failed.");window.location.assign("add_course")</script>';  
                  }
                  }else{
                      echo '<script>alert("Course update successfuly done.");window.location.assign("add_course")</script>';
                  }
              }else{
                 echo '<script>alert("Server error 101.");window.location.assign("add_course")</script>';  
              } 
            }else{
              echo '<script>alert("Image uploading failed.");window.location.assign("add_course")</script>';  
            }
        // }else{
        //   echo '<script>alert("This course name already exist.");window.location.assign("add_course")</script>'; 
        // }
        
        
    }else{
     echo '<script>alert("Please fill all the fields");window.location.assign("add_course")</script>';   
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Course |
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
    <script src="https://tvssolution.com/panel/staff/admin_area/js/jquery-3.3.1.min.js" type="text/jscript"></script>
    <script src="ckeditor/ckeditor.js"></script>
    
     <style type="text/css">
          .drop_course{
    	background: #157daf !important;
    }
    
    .course_add{
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
  content: "OPEN";
  position: absolute;
  top: 0;
  left: 10px;
  line-height: 34px;
  font-weight: bold;
  font-size: 12px;
  color: white;
}

input:not(:checked) + .slider::after {
  content: "CLOSE";
  position: absolute;
  top: 0;
  right: 10px;
  line-height: 34px;
  font-weight: bold;
  font-size: 12px;
  color: white;
}
label{
    margin-top:10px;
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
                            <h1>Add Courses</h1>
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
                                    <h3 class="card-title">Add Course</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" name="form_2" enctype="multipart/form-data">
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
                                            <label>Course Image: </label>
                                            <input type="file" name="upload_file" <?php echo $image_required;?> class="form-control" placeholder="Enter Name"
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
                                        <?php if(isset($id) && !empty($id)) { ?>
                                              <input type="hidden" name="course_id" value="<?php echo $id; ?>">
                                            <?php } ?>

                                            <div class="col-md-4" id="course_fee_label" >
                                                 <label>Course Type:</label>
                                                 <select name="course_type_id" id="course_type_id" required class="form-control" >
                                                   <option value="">Select</option> 
                                                   <?php
                                                   $sql_course_type=mysqli_query($con,"select * from course_type where status='SHOW' order by id desc ");
                                                   while($row=mysqli_fetch_array($sql_course_type)){
                                                       ?>
                                                       <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option> 
                                                       <?php
                                                   }
                                                   ?>
                                                   
                                                 </select>
                                            </div>
                                            <script>
                                            <?php 
                                            if(isset($course_details['course_type_id'])){
                                             if($course_details['course_type_id']>0){
                                            ?>
                                            $("#course_type_id").val('<?php echo $course_details['course_type_id'];?>');
                                            <?php } } ?>
                                            </script>
                                            <br>
                                            <div class="col-sm-4" >
                                            <label>Course Name: </label>
                                            <input type="text" class="form-control" required value="<?php echo $course_name ;?>" name="course_name" id="course_name" placeholder="Enter course name.">
                                            </div>
                                            <br>
                                            <div class="col-sm-4" >
                                            <label>Course Short Name: </label>
                                            <input type="text" class="form-control" required value="<?php echo $course_short_name ;?>" name="course_short_name" id="course_short_name" placeholder="Enter course short name.">
                                            </div>
                                            <br>
                                            <div class="col-sm-3" >
                                            <label>Course Code: </label>
                                            <input type="text" class="form-control" required value="<?php echo $course_details_code ;?>" name="course_code" id="course_code" placeholder="Enter course code.">
                                            </div>
                                            <br>
                                        <div class="col-sm-3" >
                                            <label>Duration: </label>
                                            <input type="number" class="form-control" required value="<?php echo $course_duration ;?>" name="duration" id="duration" placeholder="Enter course duration.">
                                        </div>
                                        <br>
                                        <div class="col-sm-3" >
                                            <label>Maximum Fees: </label>
                                            <input type="number" class="form-control" required value="<?php echo $course_max_fee ;?>" name="max_fee" id="fee" placeholder="Enter course maximum fees.">
                                        </div>
                                        <br>
                                        <div class="col-sm-3" >
                                            <label>Total Fees: </label>
                                            <input type="number" class="form-control" required value="<?php echo $course_fee ;?>" name="fee" id="fee" placeholder="Enter course fees.">
                                        </div>
                                        <br>
                                        <div class="col-sm-12" style="margin-top:5px;">
                                            <label>Description:</label> <br>
                                            <textarea name="content" rows="5" cols="80" ><?php echo $course_des ;?></textarea>
                    
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
                                    <h3 class="card-title">Course Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Image</th>
                                                <th>Course Type</th>
                                                <th>Course Code</th>
                                               <th>Name</th>
                                               <th>Short Name</th>
                                                <th>Duration</th>
                                                <th>Max. Fee</th>
                                                <th>Fee</th>
                                                <th>Description</th>
                                                <th>Edit</th>
                                                <th>Status</th>
                                                <th>First Page Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                             $sql_course=mysqli_query($con,"select * from course_details where status='OPEN' or status='CLOSE' order by status desc");
                                            while($row=mysqli_fetch_array($sql_course)){
                                                if($row['course_type_id']>0){
                                             $course_type_details=mysqli_fetch_array(mysqli_query($con,"select * from course_type where id='$row[course_type_id]'"));
                                                $course_type_name=$course_type_details['name'];
                                                }else{
                                                  $course_type_name="";  
                                                }
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><img width="60px" src="<?php echo $web_link.$row['img']; ?>"></td>
                                                <td><?php echo $course_type_name; ?></td>
                                                <td><?php echo $row['course_code']; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['course_short_name']; ?></td>
                                                <td><?php echo $row['duration']; ?></td>
                                                <td><?php echo $row['max_fee']; ?></td>
                                                <td><?php echo $row['fee']; ?></td>
                                            <td>
                                              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#descModal" onclick="showDescription(`<?php echo htmlspecialchars($row['des'], ENT_QUOTES); ?>`)">
                                                View
                                              </button>
                                            </td>

                                                <td><a href="add_course?edit=<?php echo $row['id']; ?>" onclick="return confirm('Are your sure for edit this course?')" style="color:blue;"><i class="fa fa-edit"></i> Edit</a></td>
                                                
                                                <td>
                                                  <label class="switch">
                                                      <input type="checkbox" onchange="toggle_permission(this, <?php echo $row['id']; ?>, 'status')" <?php echo ($row['status'] == 'OPEN') ? 'checked' : ''; ?>>
                                                      <span class="slider round"></span>
                                                    </label>

                                                </td>
                                                
                                                
                                                <td>
                                                  <label class="switch">
                                                      <input type="checkbox" onchange="toggle_permission(this, <?php echo $row['id']; ?>, 'first_page_status')" <?php echo ($row['first_page_status'] == 'OPEN') ? 'checked' : ''; ?>>
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
            
            <!-- Description Modal -->
<div class="modal fade" id="descModal" tabindex="-1" role="dialog" aria-labelledby="descModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="descModalLabel">Course Description</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="descModalBody">
        <!-- Description content will be injected here -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

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
        document.addEventListener("contextmenu", (event) => {
    event.stopPropagation(); 
 }, true);
    </script>
<script>
    function toggle_permission(element, id, field) {
    let newStatus = element.checked ? 'OPEN' : 'CLOSE';

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
                    change_status_course: 1,
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
<script>
  function showDescription(description) {
    document.getElementById('descModalBody').innerHTML = description;
  }
</script>

</body>

</html>