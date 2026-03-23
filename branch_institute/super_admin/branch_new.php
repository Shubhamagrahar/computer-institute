<?php
include 'session.php'; 
include('../smtp/init.php');
$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");


$btn="Submit";
if(isset($_GET['btn'])){
    $btn=VerifyData($_GET['btn']);
    $id=VerifyData($_GET['id']);
 if($btn=="Update" and !$id==""){
     
     $refer_url=$_SERVER['HTTP_REFERER'];
     
     $sql___=mysqli_query($con,"select * from user where id='$id' and type='1'");
     if(mysqli_num_rows($sql___)==1){
    $update_user_details=mysqli_fetch_array($sql___);
    $franchise_name=$update_user_details['name'];
    $branch_code=$update_user_details['branch_code'];
    $owner_name=$update_user_details['father_name'];
    $mob=$update_user_details['mobile'];
    $w_mob=$update_user_details['w_mob'];
    $email=$update_user_details['email'];
    $state_id=$update_user_details['state_id'];
    $pin=$update_user_details['pin'];
    $full_add=$update_user_details['full_add'];
    $photo=$update_user_details['photo'];
    
    $branch_details=mysqli_fetch_array(mysqli_query($con,"select * from branch_details where userid='$id'"));
    
     }else{
         echo '<script>alert("Server error 101.");window.location.assign("'.$refer_url.'");</script>';
     }
	 
 }elseif($btn=="Process" and !$id==""){
   
    $refer_url=$_SERVER['HTTP_REFERER'];
     
     $sql___=mysqli_query($con,"select * from branch_application where id='$id'");
     if(mysqli_num_rows($sql___)==1){
    $update_user_details=mysqli_fetch_array($sql___);
    $franchise_name=$update_user_details['branch_name'];
    $branch_code="";
    $owner_name=$update_user_details['admin_name'];
    $mob=$update_user_details['mobile'];
    $w_mob=$update_user_details['mobile'];
    $email=$update_user_details['email'];
    $state_id=$update_user_details['state_id'];
    $pin=$update_user_details['pin_code'];
    $full_add=$update_user_details['full_add'];
    $photo=$update_user_details['branch_logo'];
     }else{
         echo '<script>alert("Server error 101.");window.location.assign("'.$refer_url.'");</script>';
     }
    
 
 
 }else{
    
    $franchise_name="";
    $owner_name="";
    $mob="";
    $w_mob="";
    $email="";
    $state_id="";
    $pin="";
    $full_add="";
    $photo="";
    $branch_code="";

    
	
	
 }
}else{
   
    $franchise_name="";
    $owner_name="";
    $mob="";
    $w_mob="";
    $email="";
    $state_id="";
    $pin="";
    $full_add="";
    $photo="";
    $branch_code="";
	
}




if(isset($_POST['Update'])){
    $franchise_name=VerifyData($_POST['franchise_name']);
    $owner_name=VerifyData($_POST['owner_name']);
    $mob=VerifyData($_POST['mob']);
    $w_mob=VerifyData($_POST['w_mob']);
    $email=VerifyData($_POST['email']);
    $state_id=VerifyData($_POST['state_id']);
    $pin=VerifyData($_POST['pin']);
    $full_add=VerifyData($_POST['full_add']);
    $branch_code=VerifyData($_POST['branch_code']);
    $pass=123456;
   
    $student_course_fess=VerifyData($_POST['student_course_fess']);
    $pay_per_course=VerifyData($_POST['pay_per_course']);
    $student_certificate_fess=VerifyData($_POST['student_certificate_fess']);
    $pay_per_certificate=VerifyData($_POST['pay_per_certificate']);
   
   
   if(!$franchise_name=="" and !$owner_name=="" and !$mob=="" and !$email=="" and !$state_id=="" and !$pin=="" and !$full_add=="" and !$w_mob==""  and !$branch_code==""){
      
      if($student_course_fess=="Yes"){
          
      }else{
          $pay_per_course=1;
      }
      
      if($student_certificate_fess=="Yes"){
          
      }else{
         $pay_per_certificate=1; 
      }
      if(!$pay_per_certificate==""){
      if(!$pay_per_course==""){
       $check_mobile=mysqli_num_rows(mysqli_query($con,"select * from user where mobile='$mob'"));
            if(!$check_mobile>0 or $mob==$update_user_details['mobile']){
            
                $upload_photo=1; 
                 $photo_dr =$photo;
            
                
               if($upload_photo){
                   $update=mysqli_query($con,"update user set name='$franchise_name', mobile='$mob', father_name='$owner_name', email='$email', w_mob='$w_mob', state_id='$state_id', pin='$pin', full_add='$full_add', branch_code='$branch_code' where id='$update_user_details[id]'"); 
                    if($update){
                       
                       
                        $update_branch_details=mysqli_query($con,"update branch_details set student_course_fee='$student_course_fess', per_course_fee='$pay_per_course', student_certificate_fee='$student_certificate_fess', per_certificate_fee='$pay_per_certificate' where userid='$update_user_details[id]'");
                        if($update_branch_details){
                          if($update_user_details['own_branch']=="YES"){
                             echo '<script>alert("Franchise details update Successfully Done.");window.location.assign("branch_list_own")</script>'; 
                          }else{
                          echo '<script>alert("Franchise details update Successfully Done.");window.location.assign("branch_list")</script>';
                          }
                        }else{
                         echo '<script>alert("Server Error 101.")</script>';   
                        }    
                    }else{
                     echo '<script>alert("Server Error 102.")</script>';  
                }
               }else{
               echo '<script>alert("Photo uploading failed.")</script>';  
            } 
               
            }else{
                echo '<script>alert("Already register a franchise with this mobile number.")</script>';
            }
      }else{
        echo '<script>alert("Please fill franchise per course fee.")</script>';  
      }
      }else{
        echo '<script>alert("Please fill franchise per certificate fee.")</script>';   
      }     
   }else{
        echo '<script>alert("Please fill all feild.")</script>';
    }
   
    
}



if(isset($_POST['Process'])){
    $franchise_name=VerifyData($_POST['franchise_name']);
    $branch_code=VerifyData($_POST['branch_code']);
    $owner_name=VerifyData($_POST['owner_name']);
    $mob=VerifyData($_POST['mob']);
    $w_mob=VerifyData($_POST['w_mob']);
    $email=VerifyData($_POST['email']);
    $state_id=VerifyData($_POST['state_id']);
    $pin=VerifyData($_POST['pin']);
    $full_add=VerifyData($_POST['full_add']);
    $pass=123456;
   
    $student_course_fess=VerifyData($_POST['student_course_fess']);
    $pay_per_course=VerifyData($_POST['pay_per_course']);
    $student_certificate_fess=VerifyData($_POST['student_certificate_fess']);
    $pay_per_certificate=VerifyData($_POST['pay_per_certificate']);
    
    
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
		<p>Dear '.$franchise_name.',</p>

		<p style="text-align:justify;">Welcome to '.$brand_name.'. We are glad to have you as a Franchise of our institute. Below are your login details: </p>

		<p><strong>User ID:</strong> '.$mob.'</p>

		<p><strong>Password:</strong> '.$pass.'</p>

		<p>To access your account, please click the button below:</p>

		<p align="center" ><a href="'.$brand_link.'login" ><button style="cursor: pointer; display: inline-block;" class="btn btn-primary">Login</button></a></p>

		<p style="text-align: justify;">If you have any questions or concerns, please do not hesitate to contact us at '.$brand_email.'</p>

		<div class="footer">
			<p>Thank you for choosing '.$brand_name.'!</p>
		</div>
	</div>
</body>
</html>';
    
   if(!$franchise_name=="" and !$owner_name=="" and !$mob=="" and !$email=="" and !$state_id=="" and !$pin=="" and !$full_add=="" and !$w_mob=="" and !$branch_code==""){
      
      if($student_course_fess=="Yes"){
          
      }else{
          $pay_per_course=1;
      }
      
      if($student_certificate_fess=="Yes"){
          
      }else{
         $pay_per_certificate=1; 
      }
      if(!$pay_per_certificate==""){
      if(!$pay_per_course==""){
       $check_mobile=mysqli_num_rows(mysqli_query($con,"select * from user where mobile='$mob'"));
            if(!$check_mobile>0){
            
                $upload_photo=1; 
                 $photo_dr =$photo;
            
                
               if($upload_photo){
                   $insert=mysqli_query($con,"insert into `user`(`name`,`branch_code` ,`mobile`, `pass`, `type`, `photo`, `father_name`, `email`, `w_mob`, `state_id`, `pin`, `full_add`, `r_date`) values('$franchise_name', '$branch_code' ,'$mob', '$pass', '1', '$photo_dr', '$owner_name', '$email', '$w_mob', '$state_id', '$pin', '$full_add', '$t_date')"); 
                    if($insert){
                        $insert_id=mysqli_insert_id($con);
                        $insert_wallet=mysqli_query($con,"insert into `wallet`(`userid`) values('$insert_id')");
                        $insert_branch_details=mysqli_query($con,"insert into `branch_details`(`userid`, `student_course_fee`, `per_course_fee`, `student_certificate_fee`, `per_certificate_fee`) values('$insert_id', '$student_course_fess', '$pay_per_course', '$student_certificate_fess', '$pay_per_certificate')");
                        if($insert_wallet and $insert_branch_details){
                          $update_=mysqli_query($con,"update branch_application set status='CLOSE' where id='$update_user_details[id]'");
                        if($update_){
                        echo '<script>alert("Franchise Create Successfully Done. Franchise login id and password have been sent to the registered mail id.");window.location.assign("branch_list")</script>';
                        $send=  send_mail($email,"LOGIN DETAILS ",$text);
                        }else{
                          echo '<script>alert("Server Error 103.")</script>';    
                        }
                            
                        }else{
                         echo '<script>alert("Server Error 101.")</script>';   
                        }    
                    }else{
                     echo '<script>alert("Server Error 102.")</script>';  
                }
               }else{
               echo '<script>alert("Photo uploading failed.")</script>';  
            } 
               
            }else{
                echo '<script>alert("Already register a franchise with this mobile number.")</script>';
            }
      }else{
        echo '<script>alert("Please fill franchise per course fee.")</script>';  
      }
      }else{
        echo '<script>alert("Please fill franchise per certificate fee.")</script>';   
      }     
   }else{
        echo '<script>alert("Please fill all feild.")</script>';
    }
}



if(isset($_POST['Submit'])){
    $franchise_name=VerifyData($_POST['franchise_name']);
    $branch_code=VerifyData($_POST['branch_code']);
    $owner_name=VerifyData($_POST['owner_name']);
    $mob=VerifyData($_POST['mob']);
    $w_mob=VerifyData($_POST['w_mob']);
    $email=VerifyData($_POST['email']);
    $state_id=VerifyData($_POST['state_id']);
    $pin=VerifyData($_POST['pin']);
    $full_add=VerifyData($_POST['full_add']);
    $pass=123456;
    $photo = $_FILES["upload_file"]["name"];
    $photo2 = $_FILES["upload_file"]["tmp_name"];
    
    $student_course_fess=VerifyData($_POST['student_course_fess']);
    $pay_per_course=VerifyData($_POST['pay_per_course']);
    $student_certificate_fess=VerifyData($_POST['student_certificate_fess']);
    $pay_per_certificate=VerifyData($_POST['pay_per_certificate']);
    
    
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
		<p>Dear '.$franchise_name.',</p>

		<p style="text-align:justify;">Welcome to '.$brand_name.'. We are glad to have you as a Franchise of our institute. Below are your login details: </p>

		<p><strong>User ID:</strong> '.$mob.'</p>

		<p><strong>Password:</strong> '.$pass.'</p>

		<p>To access your account, please click the button below:</p>

		<p align="center" ><a href="'.$brand_link.'login" ><button style="cursor: pointer; display: inline-block;" class="btn btn-primary">Login</button></a></p>

		<p style="text-align: justify;">If you have any questions or concerns, please do not hesitate to contact us at '.$brand_email.'</p>

		<div class="footer">
			<p>Thank you for choosing '.$brand_name.'!</p>
		</div>
	</div>
</body>
</html>';
    
   if(!$franchise_name=="" and !$owner_name=="" and !$mob=="" and !$email=="" and !$state_id=="" and !$pin=="" and !$full_add=="" and !$w_mob=="" and !$branch_code==""){
      
      if($student_course_fess=="Yes"){
          
      }else{
          $pay_per_course=1;
      }
      
      if($student_certificate_fess=="Yes"){
          
      }else{
         $pay_per_certificate=1; 
      }
      if(!$pay_per_certificate==""){
      if(!$pay_per_course==""){
       $check_mobile=mysqli_num_rows(mysqli_query($con,"select * from user where mobile='$mob'"));
            if(!$check_mobile>0){
              if(!$photo==""){
                $extension12 = explode(".", $photo);

             $extension1 = end($extension12);
          
            $nn_name = rand(1000,9999);
            $newfilename1 =$_SESSION['userid'].$nn_name.".".$extension1;
            $photo_dr="area_s/user_img/".$newfilename1 ;
            $upload_photo= move_uploaded_file($photo2,"../area_s/user_img/".$newfilename1);
             }else{
                $upload_photo=1; 
                 $photo_dr ="area_s/user_img/user.jpg";
             } 
                
               if($upload_photo){
                   $insert=mysqli_query($con,"insert into `user`(`name`, `branch_code`, `mobile`, `pass`, `type`, `photo`, `father_name`, `email`, `w_mob`, `state_id`, `pin`, `full_add`, `r_date`) values('$franchise_name', '$branch_code', '$mob', '$pass', '1', '$photo_dr', '$owner_name', '$email', '$w_mob', '$state_id', '$pin', '$full_add', '$t_date')"); 
                    if($insert){
                        $insert_id=mysqli_insert_id($con);
                         $insert_wallet=mysqli_query($con,"insert into `wallet`(`userid`) values('$insert_id')");
                        $insert_branch_details=mysqli_query($con,"insert into `branch_details`(`userid`, `student_course_fee`, `per_course_fee`, `student_certificate_fee`, `per_certificate_fee`) values('$insert_id', '$student_course_fess', '$pay_per_course', '$student_certificate_fess', '$pay_per_certificate')");
                       
                        if($insert_wallet and $insert_branch_details){
                        echo '<script>alert("Franchise Create Successfully Done. Franchise login id and password have been sent to the registered mail id.");window.location.assign("branch_list")</script>';
                        $send=  send_mail($email,"LOGIN DETAILS ",$text);
                        }else{
                         echo '<script>alert("Server Error 101.");window.location.assign("branch_new");</script>';   
                        }    
                    }else{
                     echo '<script>alert("Server Error 101.");window.location.assign("branch_new");</script>';  
                }
               }else{
               echo '<script>alert("Photo uploading failed.");window.location.assign("branch_new");</script>';  
            } 
               
            }else{
                echo '<script>alert("Already register a franchise with this mobile number.");window.location.assign("branch_new");</script>';
            }
      }else{
        echo '<script>alert("Please fill franchise per course fee.");window.location.assign("branch_new");</script>';  
      }
      }else{
        echo '<script>alert("Please fill franchise per certificate fee.");window.location.assign("branch_new");</script>';   
      }     
   }else{
        echo '<script>alert("Please fill all feild.");window.location.assign("branch_new");</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> <?php 
			if($btn=="Submit"){
			?>
         Add New Franchise
          <?php }?>
					<?php 
					if($btn=="Update"){
					?>
				Update Franchise Details	
				<?php }?>
				
				<?php 
					if($btn=="Process"){
					?>
				Create Franchise Details	
				<?php }?>|  <?php echo $brand_name; ?></title>
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
      .branch_drop{
	background: #157daf !important;
}

.branch_new1{
	background: #157daf !important;
}
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 24px;
  margin-left: 10px;
}

/* Hide default checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0; left: 0; right: 0; bottom: 0;
  background-color: #ccc;
  transition: 0.4s;
  border-radius: 24px;
}

/* The circle */
.slider:before {
  position: absolute;
  content: "";
  height: 18px;
  width: 18px;
  left: 3px;
  bottom: 3px;
  background-color: white;
  transition: 0.4s;
  border-radius: 50%;
}

/* Checked styles */
input:checked + .slider {
  background-color: #28a745;
}

input:checked + .slider:before {
  transform: translateX(26px);
}

/* Label text */
.switch-label {
  font-weight: bold;
  font-size: 15px;
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
            <?php 
			if($btn==1){
			?>
          <h4>Add New Franchise</h4>
          <?php }?>
					<?php 
					if($btn==2){
					?>
				<h4>Update Franchise Details</h4>	
				<?php }?>	
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
                <h3 class="card-title">Franchise Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" name="form_2" enctype="multipart/form-data">
                <div class="card-body ">
                <div class="row">
                    
                    <?php 
                    if($btn=="Submit"){
                    ?>
                     <div class="col-12" align="center">
                         <div id="preview">
                          
                          <img src="<?php echo $web_link.$photo; ?>" width="250">
                         
                        </div>
                        <label>Select photo: </label>
                        <input type="file" name="upload_file" class="form-control" placeholder="Enter Name"
                            id="upload_file" onchange="getImagePreview(event)">
                            
                        <br>
                        <!--image preview div-->
                       

                    </div>
                    <?php }else{
                    ?>
                    <div class="col-12" align="center">
                        <img src="<?php echo $web_link.$photo; ?>" width="250">
                        <p style="color:red;">This image update option enable in franchise profile section.</p>
                    </div>
                     
                    <?php 
                    
                    } ?>
                  <div class="col-md-4 mt-2">
                       <label>Franchise Name:</label>
                      <input type="text" required name="franchise_name" value="<?php echo $franchise_name ;?>" class="form-control">
                     
                  </div>
                  <div class="col-md-4 mt-2">
                       <label>Franchise Code:</label>
                      <input type="text" required name="branch_code" value="<?php echo $branch_code ;?>" class="form-control">
                     
                  </div>
                  <div class="col-md-4 mt-2">
                    <label>Owner Name: </label>
                      <input type="text" required  name="owner_name" id="owner_name"   value="<?php echo $owner_name ;?>" class="form-control">
                  </div>
            <div class="col-md-4 mt-2">
                      <label>Mobile No.: </label>
                      <input type="number"  required  name="mob" id="mob"   value="<?php echo $mob ;?>"  class="form-control">
                  </div>
                  <div class="col-md-4 mt-2">
                      <label>Whatsapp No.: </label>
                      <input type="number"   name="w_mob" id="w_mob"   value="<?php echo $w_mob ;?>"  class="form-control">
                  </div>
                  <div class="col-md-4 mt-2">
                      <label>Email ID.: </label>
                      <input type="email" required name="email" id="email"  value="<?php echo $email ;?>" class="form-control" pattern=".+@.+">
                  </div>
       
           
                   <div class="col-md-4 mt-2">
                      <label>State: </label>
                     
                      <select name="state_id" required  class="form-control"  id="state_id"  >
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
                   
                    $("#state_id").val('<?php echo $state_id ;?>');
                </script>
                  <div class="col-md-4 mt-2">
                      <label>Pin Code / Zip Code: </label>
                      
                      <input type="number" required   name="pin" id="pin"   value="<?php echo $pin ;?>" class="form-control">
                  </div>
                   
                  <div class="col-md-12 mt-2 form-group">
                      <label>Franchise Full Address: </label>
                      <textarea class="form-control"  name="full_add" id="full_add" required  value="" placeholder="Enter your full addres"><?php echo $full_add ;?></textarea>
                     
                  </div>
                  <!--<div class="col-md-6 mt-2">-->
                  <!--    <p style="font-size: 15px;"><strong>Will the franchise pay the amount for each course of the student?</strong>-->
                  <!--    <input type="radio" onclick="get_data_check1(this.value)" required name="student_course_fess" id="student_course_fess" value="Yes">Yes <input type="radio" onclick="get_data_check1(this.value)" required name="student_course_fess" id="student_course_fess" value="No">No</p>-->
                  <!--    <div id="data_check1" style="display:none;">-->
                  <!--    <input type="number" class="form-control" name="pay_per_course" id="pay_per_course" value="" placeholder="Enter amount per course.">-->
                  <!--    </div>-->
                  <!--</div>-->
                  
                  <!-- <div class="col-md-6 mt-2">-->
                  <!--    <p style="font-size: 15px;"><strong>Will the franchisee pay the amount for each certificate of the student?</strong>-->
                  <!--    <input type="radio" onclick="get_data_check2(this.value)" required name="student_certificate_fess" id="student_certificate_fess" value="Yes">Yes <input type="radio" onclick="get_data_check2(this.value)" required name="student_certificate_fess" id="student_certificate_fess" value="No">No</p>-->
                  <!--    <div id="data_check2" style="display:none;">-->
                  <!--    <input type="number" class="form-control" name="pay_per_certificate" id="pay_per_certificate" value="" placeholder="Enter amount per certificate.">-->
                  <!--    </div>-->
                  <!--</div>-->
                  <div class="col-md-6 mt-2">
                          <label class="switch-label">
                            Will the franchise pay the amount for each course of the student?
                          </label>
                          <label class="switch">
                            <input type="checkbox" id="student_course_fess" name="student_course_fess" onchange="get_data_check1(this.checked)">
                            <span class="slider"></span>
                          </label>
                          <div id="data_check1" style="display:none; margin-top:10px;">
                            <input type="number" class="form-control" name="pay_per_course" id="pay_per_course" placeholder="Enter amount per course">
                          </div>
                        </div>
                        
                        <div class="col-md-6 mt-2">
                          <label class="switch-label">
                            Will the franchise pay the amount for each certificate of the student?
                          </label>
                          <label class="switch">
                            <input type="checkbox" id="student_certificate_fess" onchange="get_data_check2(this.checked)">
                            <span class="slider"></span>
                          </label>
                          <div id="data_check2" style="display:none; margin-top:10px;">
                            <input type="number" class="form-control" name="pay_per_certificate" id="pay_per_certificate" placeholder="Enter amount per certificate">
                          </div>
                        </div>

                </div>
                  
                  <script>
                  <?php 
                   if($btn=="Update"){
                       if($branch_details['student_course_fee']=="Yes"){
                         ?>
                        
                        
                         get_data_check1("Yes");
                         $("#pay_per_course").val(<?php echo $branch_details['per_course_fee'] ;?>);
                         <?php
                       }
                       if($branch_details['student_certificate_fee']=="Yes"){
                         ?>
                         
                       
                         get_data_check2("Yes");
                         $("#pay_per_certificate").val(<?php echo $branch_details['per_certificate_fee'] ;?>);
                         <?php
                       }
                   }
                  
                  ?>
                  
                  
                      function get_data_check1(val){
                          if(val=== true){
                              document.getElementById("data_check1").style.display="block";
                          }else{
                              document.getElementById("data_check1").style.display="none";
                          }
                      }
                      
                      function get_data_check2(val){
                          if(val=== true){
                              document.getElementById("data_check2").style.display="block";
                          }else{
                              document.getElementById("data_check2").style.display="none";
                          }
                      }
                      
                  </script>
                  
                </div>
                <!-- /.card-body -->
                
				
					 <div class="card-footer">
                  <button type="submit" name="<?php echo $btn; ?>" class="btn btn-primary"><?php echo $btn; ?></button>
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
