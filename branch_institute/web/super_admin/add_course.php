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
     
     
    if(!$course_code=="" and !$course_name=="" and !$course_short_name=="" and !$duration=="" and !$fee=="" and !$content=="" and !$photo=="" and !$max_fee==""){
        $check_name=mysqli_num_rows(mysqli_query($con, "select * from course_details where name='$course_name'"));
        if(!$check_name>0){
           $extension12 = explode(".", $photo);

             $extension1 = end($extension12);
          
            $nn_name = rand(1000,9999);
            $newfilename1 =$_SESSION['userid'].$nn_name.".".$extension1;
            $photo_dr="course_image/".$newfilename1;
            $upload_photo= move_uploaded_file($photo2,"../course_image/".$newfilename1);
            if($upload_photo){
                $insert=mysqli_query($con,"insert into `course_details`(`course_code`, `name`, `course_short_name`, `img`, `duration`, `max_fee`, `fee`, `des`) values('$course_code', '$course_name', '$course_short_name', '$photo_dr', '$duration', '$max_fee', '$fee', '$content')");
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
    
        $course_name=VerifyData($_POST['course_name']);
        $course_short_name=VerifyData($_POST['course_short_name']);
        $photo = $_FILES["upload_file"]["name"];
        $photo2 = $_FILES["upload_file"]["tmp_name"];
        $duration=VerifyData($_POST['duration']);
        $max_fee=VerifyData($_POST['max_fee']);
        $fee=VerifyData($_POST['fee']);
        $content=VerifyData($_POST['content']);
     $course_code=VerifyData($_POST['course_code']);
     
     
    if(!$course_name=="" and !$course_short_name=="" and !$duration=="" and !$fee=="" and !$content=="" and !$max_fee=="" and !$course_code==""){
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
                $update=mysqli_query($con,"update course_details set course_code='$course_code', name='$course_name', course_short_name='$course_short_name', img='$photo_dr', duration='$duration', max_fee='$max_fee', fee='$fee', des='$content' where id='$id'");
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
    <script src="ckeditor/ckeditor.js"></script>
    
     <style type="text/css">
          .drop_course{
    	background: #157daf !important;
    }
    
    .course_add{
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
                                             <div class="col-12" align="center">
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
                                            <div class="col-sm-4" >
                                            <label>Course Code: </label>
                                            <input type="text" class="form-control" required value="<?php echo $course_details_code ;?>" name="course_code" id="course_code" placeholder="Enter course code.">
                                            </div>
                                            <br>
                                        <div class="col-sm-4" >
                                            <label>Duration: </label>
                                            <input type="number" class="form-control" required value="<?php echo $course_duration ;?>" name="duration" id="duration" placeholder="Enter course duration.">
                                        </div>
                                        <br>
                                        <div class="col-sm-4" >
                                            <label>Maximum Fees: </label>
                                            <input type="number" class="form-control" required value="<?php echo $course_max_fee ;?>" name="max_fee" id="fee" placeholder="Enter course maximum fees.">
                                        </div>
                                        <br>
                                        <div class="col-sm-4" >
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
                                           
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><img width="60px" src="<?php echo $web_link.$row['img']; ?>"></td>
                                                <td><?php echo $row['course_code']; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['course_short_name']; ?></td>
                                                <td><?php echo $row['duration']; ?></td>
                                                <td><?php echo $row['max_fee']; ?></td>
                                                <td><?php echo $row['fee']; ?></td>
                                                <td><div class="col-md-12" id="des_div<?php echo $row['id'];?>" style="display:none; text-align: left;">
					     <!--<p><strong>Description: </strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet quod nisi quisquam modi dolore, dicta obcaecati architecto quidem ullam quia.</p>-->
					     <p ><?php echo $row['des']; ?></p>
					     <div align="center">
					     <button  type="submit" name="hide_des" onclick="hide_des_function('des_div<?php echo $row['id'];?>','des_btn<?php echo $row['id'];?>')" class="btn btn-danger"><i class="fa fa-eye-slash"></i></button> 
					     </div>
					     
					   </div>
					   <div class="col-md-12" align="center" id="des_btn<?php echo $row['id'];?>" >
					    <button type="submit" name="show_des" class="btn btn-success" onclick="show_des_function('des_div<?php echo $row['id'];?>','des_btn<?php echo $row['id'];?>')"><i class="fa fa-eye"></i></button> 
					 </div></td>
                                                <td><a href="add_course?edit=<?php echo $row['id']; ?>" onclick="return confirm('Are your sure for edit this course?')"><button class="btn btn-primary"><i class="fa fa-edit"></i> Edit</button></a></td>
                                                 <td><?php 
                                                
                                                if($row['status']=="OPEN"){
                                                    ?>
                                                <a href="add_course?status=CLOSE&id=<?php echo $row['id']; ?>" onclick="return confirm('Are your sure for stop this course?')"><button class="btn btn-danger"> Deactive</button></a>  
                                                  <?php
                                                }
                                                if($row['status']=="CLOSE"){
                                                    ?>
                                                  <a href="add_course?status=OPEN&id=<?php echo $row['id']; ?>" onclick="return confirm('Are your sure for start this course?')"><button class="btn btn-success"> Active</button></a>  
                                                   <?php
                                                }
                                                
                                                
                                                ?></td>
                                                <td><?php 
                                                
                                                if($row['first_page_status']=="OPEN"){
                                                    ?>
                                                <a href="add_course?status_first=CLOSE&id=<?php echo $row['id']; ?>" onclick="return confirm('Are your sure for hide this course from first page.?')"><button class="btn btn-danger"> Hide</button></a>  
                                                  <?php
                                                }
                                                if($row['first_page_status']=="CLOSE"){
                                                    ?>
                                                  <a href="add_course?status_first=OPEN&id=<?php echo $row['id']; ?>" onclick="return confirm('Are your sure for show this course on first page.?')"><button class="btn btn-success"> Show</button></a>  
                                                   <?php
                                                }
                                                
                                                
                                                ?></td>
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