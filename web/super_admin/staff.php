<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");


$staff_name="";
$staff_designation="";
$staff_img="";
$staff_role="";
$btnname="Add";

if(isset($_POST['Add'])){
     $photo = $_FILES["upload_file1"]["name"];
     $photo2 = $_FILES["upload_file1"]["tmp_name"];
     $name=VerifyData($_POST['name']);
     $designation=VerifyData($_POST['designation']);
     $role=VerifyData($_POST['role']);
     
     
     if(!$photo=="" && !$name=="" && !$designation=="" && !$role==""){
         
      
             $extension12 = explode(".", $photo);

             $extension1 = end($extension12);
          if($extension1=="JPEG" or $extension1=="JPG" or $extension1=="PNG" or $extension1=="jpeg" or $extension1=="jpg" or $extension1=="png"){
            $nn_name = rand(100000,999999);
            $newfilename1 =$mobile.$nn_name.".".$extension1;
            $photo_dr="super_admin/user_img/".$newfilename1 ;
            $upload_photo= move_uploaded_file($photo2,"user_img/".$newfilename1) ;
            if($upload_photo){
                $Insert_certificate=mysqli_query($con,"insert into  `web_teching_admin_staff`(`img`, `name`, `designation`, `role`) values('$photo_dr', '$name', '$designation', '$role')");
                if($Insert_certificate){
                    echo '<script>alert("Staff details created successfully done.");window.location.assign("staff")</script>';
                }else{
                echo '<script>alert("Server error 101.");window.location.assign("staff")</script>';
            }
            }else{
                echo '<script>alert("Staff details upload failed. ");window.location.assign("staff")</script>';
            }
            
          }else{
             echo '<script>alert("The image file format should be JPG or PNG or JPEG.");window.location.assign("staff")</script>'; 
          }    
          
     }else{
        echo '<script>alert("Please fill all fields.");window.location.assign("staff")</script>';
    }
}

if(isset($_GET['edit'])){
    $id=VerifyData($_GET['edit']);
    if(!$id==""){
        $staff_details=mysqli_query($con,"select * from web_teching_admin_staff where id='$id'");
        if(mysqli_num_rows($staff_details)>0){
            $teacher_staff_details=mysqli_fetch_array($staff_details);
            $staff_name=$teacher_staff_details['name'];
            $staff_designation=$teacher_staff_details['designation'];
            $staff_img=$teacher_staff_details['img'];
            $staff_role=$teacher_staff_details['role'];
            $btnname="Update";
        }else{
         echo '<script>alert("Staff details not availabel.");window.location.assign("staff");</script>';    
        }
    }else{
      echo '<script>alert("Somthing Went Wrong.");window.location.assign("staff");</script>';   
    }
}

if(isset($_POST['Update'])){
    
     $photo = $_FILES["upload_file1"]["name"];
     $photo2 = $_FILES["upload_file1"]["tmp_name"];
     $name=VerifyData($_POST['name']);
     $designation=VerifyData($_POST['designation']);
     $role=VerifyData($_POST['role']);
     
     
    if(!$name=="" and !$designation=="" and !$role==""){
      
        $unlink_status=1;
            if($photo==""){
             $photo_dr=$staff_img;
             $upload_photo=1;
             $unlink_status=2;
            }else{
           $extension12 = explode(".", $photo);

             $extension1 = end($extension12);
          
            $nn_name = rand(100000,999999);
            $newfilename1 =$_SESSION['userid'].$nn_name.".".$extension1;
            $photo_dr="super_admin/user_img/".$newfilename1;
            $upload_photo= move_uploaded_file($photo2,"user_img/".$newfilename1);
            }
            if($upload_photo){
                $old_img=$teacher_staff_details['img'];
                $update=mysqli_query($con,"update web_teching_admin_staff set img='$photo_dr', name='$name', designation='$designation', role='$role' where id='$id'");
               if($update){
                   
                   if($unlink_status==1){
                   $unlink_old_image=unlink("../".$old_img);
                   if($unlink_old_image){
                   echo '<script>alert("Staff details update successfuly done.");window.location.assign("staff")</script>'; 
                   }else{
                     echo '<script>alert("Old image unlink failed.");window.location.assign("staff")</script>';  
                   }
                   }else{
                       echo '<script>alert("Staff details update successfuly done.");window.location.assign("staff")</script>';
                   }
               }else{
                 echo '<script>alert("Server error 101.");window.location.assign("staff")</script>';  
               } 
            }else{
              echo '<script>alert("Image uploading failed.");window.location.assign("staff")</script>';  
            }
       
    }else{
     echo '<script>alert("Please fill all the fields");window.location.assign("staff")</script>';   
    }
}

if(isset($_GET['delete_id'])){
    $id=VerifyData($_GET['delete_id']);
    if(!$id==""){
        $sql=mysqli_query($con,"select * from web_teching_admin_staff where id='$id'");
        if(mysqli_num_rows($sql)==1){
            $result=mysqli_fetch_array($sql);
            $photo=end(explode("/",$result['img']));
            $unlink=unlink("user_img/".$photo);
            if($unlink){
                $delete=mysqli_query($con,"delete from web_teching_admin_staff where id='$id'");
                if($delete){
                    echo '<script>alert("Teacher details deleted successfully done.");window.location.assign("staff")</script>';
                }else{
                   echo '<script>alert("Server Error 103.");window.location.assign("staff")</script>'; 
                }
            }else{
             echo '<script>alert("Server Error 102.");window.location.assign("staff")</script>';    
            }
            
        }else{
          echo '<script>alert("Server Error 101.");window.location.assign("staff")</script>';  
        }
        
    }else{
        echo '<script>alert("Something went wrong.");window.location.assign("staff")</script>';
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff | <?php echo $brand_name; ?></title>
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
    <style type="text/css">
          .website_drop{
    	background: #157daf !important;
    }
    
    .staff{
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
                            <h1><?php echo $btnname;?> Staff</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>


            <!--Main Content section start-->
            
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                             <form method="post" name="form_5" enctype="multipart/form-data">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title"><?php echo $btnname;?> Staff Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                               
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Name:</label>
                                                <input type="text" required name="name" value="<?php echo $staff_name;?>" class="form-control" placeholder="Enter staff name.">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Designation/Qualification</label>
                                                <input type="text" required  name="designation" id="designation" value="<?php echo $staff_designation;?>" class="form-control" placeholder="Enter designation/qualification.">
                                            </div>
                                            <div class="col-md-4">
                                            <label>Role</label>
                                            <select name="role"  id="role"  required  class="form-control">
                                            <option value="">Select </option>
                                            <option value="teacher">Teacher Staff </option>
                                            <option value="administrative">Administrative Staff </option>
                                            
                                            </select>
                                            
                                            </div>
                                             <script>
                                                $("#role").val('<?php echo $staff_role ;?>');
                                            </script>
                                             <div class="col-12" align="center">
                                            <?php
                                            if(!$staff_img==""){
                                                $image_required="";
                                            }else{
                                                $image_required="required";
                                            }
                                            ?>
                                            <label>Upload Staff Image : </label>
                                            <input type="file" name="upload_file1" class="form-control" <?php echo $image_required;?> placeholder="Enter Name"
                                            id="upload_file" onchange="getImagePreview(event)">
                                            
                                            <br>
                                            <!--image preview div-->
                                            <div id="preview">
                                            <?php if(!$staff_img=="") { ?>
                                              <img src="<?php echo $web_link.$staff_img ;?>" width="300">
                                              <?php } ?>
                                            </div>
                                            </div> 
                                             <div class=""> 
                                        <button type="submit" name="<?php echo $btnname;?>" id="submit"
                                             class="btn btn-primary"><?php echo $btnname;?></button>
                                       </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    </div>
                            </form>
                            <!--<div class="card card-info">-->
                            <!--    <div class="card-header">-->
                            <!--        <h3 class="card-title">Upload Image</h3>-->
                            <!--    </div>-->
                                <!-- /.card-header -->
                                <!-- form start -->
                               
                            <!--        <div class="card-body ">-->
                            <!--            <div class="row">-->
                                              
                                           
                            <!--               </div>-->
                            <!--        </div>-->
                                    <!-- /.card-body -->

                            <!--        <div class="card-footer"> -->
                            <!--            <button type="submit" name="<?php echo $btnname;?>" id="submit"-->
                            <!--                 class="btn btn-primary"><?php echo $btnname;?></button>-->
                                       
                            <!--        </div>-->
                              
                            <!--</div>-->
                            <!--</form>-->
                        </div>
                        
                        
                    </div>
                </div>
            </section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                    <p style="font-size:14px;color:red;"><strong>*</strong>Image file format should be JPG or PNG or JPEG.</p>
                    </div>
                </div>
            </div>
          
            <!--Main content section end-->
            
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">All Staff Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Designation/Qualification</th>
                                                <th>Role</th>
                                                <th>Action</th>
                                                
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php
                                            $i=0;
                                            
                                            
                                            $sql_certificate=mysqli_query($con,"select * from web_teching_admin_staff  order by id desc");
                                            while($row=mysqli_fetch_array($sql_certificate)){
                                            
                                          
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><img width="50px" src="<?php echo $web_link.$row['img']; ?>"></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['designation']; ?></td>
                                                <td><?php 
                                                    if($row['role']=='teacher'){
                                                    echo "Teacher Staff";
                                                    }
                                                    if($row['role']=='administrative'){
                                                    echo "Administrative Staff";
                                                    }
                                                
                                                 ?>
                                                </td>
                                               
                                             <td><a href="staff?edit=<?php echo $row['id']; ?>" onclick="return confirm('Are your sure for edit this staff details?')" style="color:blue;"><i class="fa fa-edit"></i> Edit</a><br>
                                                 <a title="Delete Teacher Details" onclick="return confirm('Are you sure for delete this staff details?')" style="color:red;" href="staff?delete_id=<?php echo $row['id'] ;?>"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td>   
                                            </tr>
                                            
                                          <?php }  ?>  
                                        </tbody>

                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            
                            
                        </div>
                        
                        
                    </div>
                </div>
            </section> 
            

            
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
	
    		function get_fee(val){
    		  
    		    $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'fee_details='+val,
                success: function(data){
                    
                    if(data>0){
                        
                    document.getElementById("course_fee_label").style.display="block";
                   
                 $("#course_fee").val(data);
                    }
                }
              }
              );
    		}
    		
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