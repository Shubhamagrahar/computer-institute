<?php
include 'session.php'; 


if(isset($_POST['update_photo'])){
    $photo = $_FILES["photo"]["name"];
     $photo2 = $_FILES["photo"]["tmp_name"];
      if(!$photo==""){ 
            $extension12 = explode(".", $photo);

             $extension1 = end($extension12);
          
            $nn_name = rand(1000,9999);
            $newfilename1 =$_SESSION['userid'].$nn_name.".".$extension1;
            $photo_dr="area_admin/user_img/".$newfilename1 ;
            $upload_photo= move_uploaded_file($photo2,"user_img/".$newfilename1) ;
        if($upload_photo){
            $update_dr=mysqli_query($con,"update user set photo='$photo_dr' where id='$_SESSION[userid]'");
            if($update_dr){
                
                $last_check=end(explode("/",$login_details['photo']));
                
                if($last_check=="user.jpg"){
                   $unlink_p="1" ;
                }else{
                     $unlink_p=unlink("user_img/".$last_check);
                 
                }
                
                
                if($unlink_p){
                echo '<script>alert("Photo Update Successfully Done.");window.location.assign("profile");</script>';
                }else{
                   echo '<script>alert("Photo Unlink Failed.");window.location.assign("profile");</script>';  
                }
            }else{
                echo '<script>alert("Photo Update user Failed.");window.location.assign("profile");</script>';     
            }
        }else{
          echo '<script>alert("Photo Upload Failed.");window.location.assign("profile");</script>';     
        }
     }else{
        echo '<script>alert("Please Select Photo.");window.location.assign("profile");</script>';
     }
}


if(isset($_POST['update'])){
    $father_name=VerifyData($_POST['father_name']);
    $email=VerifyData($_POST['email']);
    $dob=VerifyData($_POST['dob']);
    $gender=VerifyData($_POST['gender']);
    $w_mob=VerifyData($_POST['w_mob']);
    $qualification=VerifyData($_POST['qualification']);
    $state_id=VerifyData($_POST['state_id']);
    $pin=VerifyData($_POST['pin']);
    $full_add=VerifyData($_POST['full_add']);
   
   $update=mysqli_query($con,"update user set father_name='$father_name', email='$email', dob='$dob', gender='$gender', w_mob='$w_mob', qualification='$qualification', state_id='$state_id', pin='$pin', full_add='$full_add' where id='$_SESSION[userid]'");    
   if($update) {
      echo '<script>alert("Profile details update successfully Done.");window.location.assign("profile");</script>'; 
   }else{
      echo '<script>alert("Server Error 101.");window.location.assign("profile");</script>'; 
   }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profile Details |  <?php echo $brand_name; ?></title>
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
  <script src="https://tvssolution.com/panel/staff/admin_area/js/jquery-3.3.1.min.js" type="text/jscript"></script>
  <style type="text/css">
      .drop_a1{
	background: #157daf !important;
}

.profile{
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
          <h4>Admin Profile Details</h4>
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
           
                
            
            
            <div class="col-md-4">
                <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Institute Profile Photo</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form name="form_1" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
					    <div class="col-12">
        			     <div  style="text-align: center; margin-top:-15px;"><br>
                    	<img src="<?php echo $web_link.$login_details['photo'] ?>" class="img3" id="profile-img-tag" hight="240" width="300">
                          </div>
        			   </div>
					      <div class="col-12" align="center">
					          <br/>
						<div class="item form-group">
							<label for="last-name">Select Photo<span class="required">*</span>
							</label>
							<div class="col-12 ">
								<input type="file" name="photo" id="profile-img" value="" class="form-control">
							</div>
						</div>
					
						
						 </div>
						</div>
                  
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="update_photo" class="btn btn-success">Update</button>
                </div>
              </form>
            </div>
            </div>
            
             <div class="col-md-8">
                <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Institute Profile Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" name="form_2">
                <div class="card-body ">
                <div class="row">
                  <div class="col-md-6">
                       <lable>Institute Name</lable>
                      <input type="text" readonly name="student_name" value="<?php echo $login_details['name'] ;?>" class="form-control">
                     
                  </div>
                  <div class="col-md-6">
                    <lable>Owner/Admin Name </lable>
                      <input type="text"   name="father_name" id="father_name"   value="<?php echo $login_details['father_name'] ;?>" class="form-control">
                  </div>
                  <div class="col-md-6">
                      <lable>User Id (Read Only)</lable>
                      <input type="text" readonly name="mobile" value="<?php echo $login_details['mobile'] ;?>" class="form-control">
                  </div>
                  <div class="col-md-6">
                      <lable>Email ID. </lable>
                      <input type="email"  name="email" id="email"  value="<?php echo $login_details['email'] ;?>" class="form-control" pattern=".+@.+">
                  </div>
                 
                  <!-- <div class="col-md-6">-->
                  <!--    <lable>DOB </lable>-->
                  <!--    <input type="date"  name="dob" id="dob" required value="<?php echo $login_details['dob'] ;?>" class="form-control">-->
                  <!--</div>-->
            <!--       <div class="col-md-6">-->
            <!--    <lable>Gender</lable>-->
            <!--    <select name="gender"  id="gender"  required  class="form-control">-->
            <!--       <option value="">Select </option>-->
            <!--        <option value="Male">Male </option>-->
            <!--        <option value="Female">Female </option>-->
            <!--        <option value="Other">Other </option>-->
            <!--    </select>-->
                
            <!--</div>-->
                   <div class="col-md-6">
                      <lable>Contact No. </lable>
                      <input type="number"   name="w_mob" id="w_mob"   value="<?php echo $login_details['w_mob'] ;?>"  class="form-control">
                  </div>
                  
                  <!--<div class="col-md-6">-->
                  <!--    <lable>Qualification </lable>-->
                  <!--    <input type="text"   name="qualification" id="qualification"  required value="<?php echo $login_details['qualification'] ;?>"  class="form-control">-->
                  <!--</div>-->
                  
                
                   <div class="col-md-6">
                      <lable>State </lable>
                     
                      <select name="state_id"  class="form-control"  id="state_id"  >
                          <option value="">Select </option>
                         
                          <?php 
                          $st_sql=mysqli_query($con,"select * from states order by name");
                          while($row=mysqli_fetch_array($st_sql)){
                              ?>
                              
                              <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                              <?php 
                            
                          }
                          
                          ?>
                      </select>
                      
                      
                  </div>
                  <script>
                    $("#gender").val('<?php echo $login_details['gender'] ;?>');
                    $("#state_id").val('<?php echo $login_details['state_id'] ;?>');
                </script>
                 
                  <div class="col-md-6">
                      <lable>Pin Code / Zip Code </lable>
                      
                      <input type="number"   name="pin" id="pin"   value="<?php echo $login_details['pin'] ;?>" class="form-control">
                  </div>
                   
                  <div class="col-md-6 form-group">
                      <lable>Institute Full Address </lable>
                      <textarea class="form-control"  name="full_add" id="full_add"   value="<?php echo $login_details['full_add'] ;?>" placeholder="Enter your full addres"><?php echo $login_details['full_add'] ;?></textarea>
                     
                  </div>
                
    

                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="update" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
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

<script>
   function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#profile-img").change(function(){
        readURL(this);
    });
</script>


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
</body>
</html>
