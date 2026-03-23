<?php
include 'session.php'; 
include('../smtp/init.php');
$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if($branch_access_details['staff_system']=="YES"){
    
}else{
    mysqli_close($con);
    echo '<script>window.location.assign("index");</script>';
}


if(isset($_POST['submit'])){
    
        
        $photo = $_FILES["upload_file"]["name"];
        $photo2 = $_FILES["upload_file"]["tmp_name"];
        $name=VerifyData($_POST['name']);
        $mobile=VerifyData($_POST['mobile']);
        $father_name=VerifyData($_POST['father_name']);
        $email=VerifyData($_POST['email']);
        $dob=VerifyData($_POST['dob']);
        $gender=VerifyData($_POST['gender']);
        $w_mob=VerifyData($_POST['w_mob']);
        $state_id=VerifyData($_POST['state_id']);
        $pin=VerifyData($_POST['pin']);
        $full_add=VerifyData($_POST['full_add']);
        $qualification=VerifyData($_POST['qualification']);
        $designation=VerifyData($_POST['designation']);
        $doj=VerifyData($_POST['doj']);
        $monthly_salary=VerifyData($_POST['monthly_salary']);
        $pass=rand(100000,999999);
        
        $text='<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<style type="text/css">
		body {
			font-family: Arial, sans-serif;
			font-size: 16px;
			line-height: 1.5;
			color: #333;
			background-color: #f2f2f2;
			padding: 20px;
			margin: 0;
			background-image: url('.$brand_link.'phpmailer/image/background_image.webp);
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;
		}

		h1 {
			font-size: 24px;
			margin-bottom: 20px;
			text-align: center;
			color: #000000;
			text-shadow: 2px 2px 5px rgba(110, 109, 109, 0.5);
		}

		.container {
			background-color: rgba(255, 255, 255, 0.8);
			padding: 20px;
			border-radius: 5px;
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
			max-width: 600px;
			margin: 0 auto;
		}

		.logo {
			display: block;
			margin: 0 auto;
			max-width: 200px;
			margin-bottom: 20px;
		}

		.btn {
			display: inline-block;
			background-color: #008CBA;
			color: #fff;
			padding: 10px 20px;
			border-radius: 5px;
			text-decoration: none;
			margin-right: 10px;
            font-weight: 700;
		}

		.btn:last-child {
			margin-right: 0;
		}

		.footer {
			text-align: center;
			margin-top: 20px;
			color: #000000;
			text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
            font-weight: 600;
		}

		@media screen and (max-width: 600px) {
			body {
				font-size: 14px;
			}

			.container {
				padding: 10px;
			}

			.logo {
				max-width: 150px;
				margin-bottom: 10px;
			}

			.btn {
				display: block;
				margin-bottom: 10px;
				margin-right: 0;
                font-weight: 700;
			}
		}
	</style>
</head>
<body>
	

	<div class="container">
		<img src="'.$brand_logo.'" alt="Logo" class="logo">
		<h1>'.$brand_name.' LOGIN DETAILS</h1>
		<p>Dear '.$name.',</p>

		<p style="text-align:justify;">Welcome to '.$brand_name.'. We are glad to have you as a staff of our institute. Below are your login details: </p>

		<p><strong>User ID:</strong> '.$mobile.'</p>

		<p><strong>Password:</strong> '.$pass.'</p>

		<p>To access your account, please click the button below:</p>

		<p align="center" ><a href="'.$brand_link.'login" ><button style="cursor: pointer; display: inline-block;" class="btn btn-primary">Login</button></a></p>

		<p style="text-align: justify;">If you have any questions or concerns, please do not hesitate to contact us at '.$brand_email.'</p>

		<div class="footer">
			<p>Thank you for choosing '.$brand_name.'!</p>
		</div>
	</div>
</body>
</html>' ;
     
     
     
    if(!$photo=="" and !$name=="" and !$mobile=="" and !$father_name=="" and !$email=="" and !$dob=="" and !$gender=="" and !$w_mob=="" and !$state_id=="" and !$pin=="" and !$full_add=="" and !$qualification=="" and !$designation=="" and !$doj=="" and !$monthly_salary==""){
        $sql_check=mysqli_num_rows(mysqli_query($con,"select * from user where mobile='$mobile'"));
        if(!$sql_check>0){
           $extension12 = explode(".", $photo);

             $extension1 = end($extension12);
          
            $nn_name = rand(10000,99999);
            $newfilename1 =$_SESSION['userid'].$nn_name.".".$extension1;
            $photo_dr="area_s/user_img/".$newfilename1;
            $upload_photo= move_uploaded_file($photo2,"../area_s/user_img/".$newfilename1);
            $count_id=mysqli_fetch_array(mysqli_query($con,"select * from user where type='2' order by id desc LIMIT 1"));
            $count_id=$count_id['id'] + 1;
            if($upload_photo){
                if($login_details['type']==1){
                    $branch_id=$_SESSION['userid'];
                }else{
                    $branch_id=$login_details['branch_id'];
                }
                $insert=mysqli_query($con,"insert into `user`(`branch_id`, `name`, `mobile`, `pass`, `type`, `photo`, `father_name`, `email`, `dob`, `gender`, `w_mob`, `state_id`, `pin`, `full_add`, `r_date`) values('$branch_id', '$name', '$mobile', '$pass', '2', '$photo_dr', '$father_name', '$email', '$dob', '$gender', '$w_mob', '$state_id', '$pin', '$full_add', '$t_date')");
               if($insert){
                   $insert_id=$count_id;
                if($insert_id>0){
                    $insert_wallet=mysqli_query($con,"insert into `wallet`(`userid`) values('$insert_id')");
                     if($insert_wallet){
                         $create_staff_details=mysqli_query($con,"insert into `staff_details`(`userid`, `qualification`, `designation`, `doj`, `monthly_salary`) values('$insert_id', '$qualification', '$designation', '$doj', '$monthly_salary')");
                         if($create_staff_details){
                            echo '<script>alert("Staff added successfully done. The user ID and password have been sent to the registered email id.");window.location.assign("staff_add")</script>';  
                          $send=  send_mail($email,"LOGIN DETAILS ",$text);
                             
                         }
                     }else{
                     echo '<script>alert("Server Error 103.");window.location.assign("staff_add")</script>'; 
                  }
                 }else{
                    echo '<script>alert("Server Error 102.");window.location.assign("staff_add")</script>';  
                }
                   echo '<script>alert("Staff added successfully done.");window.location.assign("staff_add")</script>'; 
               }else{
                 echo '<script>alert("Server error 101.");window.location.assign("staff_add")</script>';  
               } 
            }else{
              echo '<script>alert("Image uploading failed.");window.location.assign("staff_add")</script>';  
            }
        }else{
           echo '<script>alert("These staff details have already been added.");window.location.assign("staff_add")</script>'; 
        }
        
        
    }else{
     echo '<script>alert("Please fill all the fields");window.location.assign("staff_add")</script>';   
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Staff |  <?php echo $brand_name; ?></title>
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
      .staff_drop{
	background: #157daf !important;
}

.staff_add1{
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
          <h4>Add New Staff</h4>
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
           
                
            
            

            
             <div class="col-md-12">
                <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Add New Staff</h3>
                <br>
               
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" name="form_2" enctype="multipart/form-data">
                <div class="card-body ">
                <div class="row">
                  <div class="col-md-6">
                       <label>Name: <span style="color:red;">*</span></label>
                      <input type="text" style="text-transform: capitalize;" name="name" id="name" value="" required class="form-control" placeholder="Enter staff name" style="text-transform: capitalize;">
                     
                  </div>
                   <div class="col-md-6">
                       <label>Mobile no.: <span style="color:red;">*</span></label>
                      <input type="number"  name="mobile" id="mobile" required value="" class="form-control" placeholder="Enter mobile number">
                     
                  </div>
                  <div class="col-md-6">
                    <label>Father Name: <span style="color:red;">*</span></label>
                      <input type="text" style="text-transform: capitalize;"  name="father_name" id="father_name" required  value="" class="form-control" placeholder="Enter father name">
                  </div>
                 
                  <div class="col-md-6">
                      <label>Email ID.: <span style="color:red;">*</span></label>
                      <input type="email"  name="email" id="email" required value="" class="form-control" pattern=".+@.+" placeholder="Enter email id">
                  </div>
                 
                   <div class="col-md-6">
                      <label>Date of Birth: <span style="color:red;">*</span></label>
                      <input type="date"  name="dob" id="dob" required value="" class="form-control" placeholder="Enter date of birth">
                  </div>
                   <div class="col-md-6">
                <label>Gender: <span style="color:red;">*</span></label>
                <select name="gender"  id="gender"  required  class="form-control">
                   <option value="">Select gender</option>
                    <option value="Male">Male </option>
                    <option value="Female">Female </option>
                    <option value="Other">Other </option>
                </select>
                
            </div>
                   <div class="col-md-6">
                      <label>WhaysApp No.: <span style="color:red;">*</span></label>
                      <input type="number"   name="w_mob" id="w_mob" required  value=""  class="form-control" placeholder="Enter whatsapp number">
                  </div>
                  
                  <div class="col-md-6">
                      <label>State: <span style="color:red;">*</span></label>
                     
                      <select name="state_id"  class="form-control" required  id="state_id"  >
                          <option value="">Select state</option>
                         
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
                    // $("#gender").val('<?php echo $login_details['gender'] ;?>');
                    // $("#state_id").val('<?php echo $login_details['state_id'] ;?>');
                </script>
                 
                  <div class="col-md-6">
                      <label>Pin Code / Zip Code: <span style="color:red;">*</span></label>
                      
                      <input type="number"   name="pin" id="pin" required  value="" class="form-control" placeholder="Enter pin/zip code">
                  </div>
                   
                  <div class="col-md-6 form-group">
                      <label>Full Address: <span style="color:red;">*</span></label>
                      <textarea class="form-control"  name="full_add" id="full_add" required  value="" placeholder="Enter full addres"></textarea>
                     
                  </div>
                  <div class="col-md-6">
                      <label>Qualification: <span style="color:red;">*</span></label>
                      <input type="text"   name="qualification" id="qualification"  required value=""  class="form-control" placeholder="Enter qualification">
                  </div>
                <div class="col-md-6">
                      <label>Designation: <span style="color:red;">*</span></label>
                      <input type="text"   name="designation" id="designation"  required value=""  class="form-control" placeholder="Enter designation">
                  </div>
                  <div class="col-md-6">
                      <label>Date Of Joining: <span style="color:red;">*</span></label>
                      <input type="date"   name="doj" id="doj"  required value=""  class="form-control" placeholder="Enter date of joining">
                  </div>
                  <div class="col-md-6">
                      <label>Monthly Salary: <span style="color:red;">*</span></label>
                      <input type="number"   name="monthly_salary" id="monthly_salary"  required value=""  class="form-control" placeholder="Enter monthly salary">
                  </div>
                    <div class="col-12" align="center">
                       <br> 
                        <label>Staff Image: <span style="color:red;">*</span></label>
                        <input type="file" name="upload_file" required class="form-control" placeholder=""
                            id="upload_file" onchange="getImagePreview(event)">
                            
                        <br>
                        <!--image preview div-->
                        <div id="preview">
                           
                        </div>

                    </div>

                  </div>
                  
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

<script>
        function getImagePreview(event) {
            var image = URL.createObjectURL(event.target.files[0]);
            var imagediv = document.getElementById('preview');
            var newimg = document.createElement('img');
            imagediv.innerHTML = '';
            newimg.src = image;
            newimg.width = "200";
            imagediv.appendChild(newimg);
        }
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
