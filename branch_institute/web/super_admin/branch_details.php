<?php
include 'session.php'; 
include('../phpmailer/init.php');
$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(isset($_GET['btn'])){
 if($_GET['btn']=="1" and !$_GET['id']==""){
  $branch_application=mysqli_fetch_array(mysqli_query($con,"select * from branch_application where id='$_GET[id]'"));
    $branch_name=$branch_application['branch_name'];
    $owner_name=$branch_application['admin_name'];
    $mob=$branch_application['mobile'];
   $email=$branch_application['email'];
    $state_id=$branch_application['state_id'];
    $district=$branch_application['district'];
    $pin=$branch_application['pin_code'];
    $full_add=$branch_application['full_add'];
    $admin_photo=$branch_application['admin_photo'];
    $branch_logo=$branch_application['branch_logo'];
    $branch_photo=$branch_application['branch_photo'];
    $lab_office_photo1=$branch_application['lab_office_photo1'];
    $lab_office_photo2=$branch_application['lab_office_photo2'];

 }
}


// if(isset($_POST['submit'])){
//     $franchise_name=VerifyData($_POST['franchise_name']);
//     $owner_name=VerifyData($_POST['owner_name']);
//     $mob=VerifyData($_POST['mob']);
//     $w_mob=VerifyData($_POST['w_mob']);
//     $email=VerifyData($_POST['email']);
//     $state_id=VerifyData($_POST['state_id']);
//     $pin=VerifyData($_POST['pin']);
//     $full_add=VerifyData($_POST['full_add']);
//     $pass=123456;
//     $photo = $_FILES["upload_file"]["name"];
//     $photo2 = $_FILES["upload_file"]["tmp_name"];
//     $text='<!DOCTYPE html>
// <html>
// <head>
// 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
// 	<style type="text/css">
// 		body {
// 			font-family: Arial, sans-serif;
// 			font-size: 16px;
// 			line-height: 1.5;
// 			color: #333;
// 			background-color: #f2f2f2;
// 			padding: 20px;
// 			margin: 0;
// 			background-image: url('.$brand_link.'phpmailer/image/background_image.webp);
// 			background-size: cover;
// 			background-position: center;
// 			background-repeat: no-repeat;
// 		}

// 		h1 {
// 			font-size: 24px;
// 			margin-bottom: 20px;
// 			text-align: center;
// 			color: #000000;
// 			text-shadow: 2px 2px 5px rgba(110, 109, 109, 0.5);
// 		}

// 		.container {
// 			background-color: rgba(255, 255, 255, 0.8);
// 			padding: 20px;
// 			border-radius: 5px;
// 			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
// 			max-width: 600px;
// 			margin: 0 auto;
// 		}

// 		.logo {
// 			display: block;
// 			margin: 0 auto;
// 			max-width: 200px;
// 			margin-bottom: 20px;
// 		}

// 		.btn {
// 			display: inline-block;
// 			background-color: #008CBA;
// 			color: #fff;
// 			padding: 10px 20px;
// 			border-radius: 5px;
// 			text-decoration: none;
// 			margin-right: 10px;
//             font-weight: 700;
// 		}

// 		.btn:last-child {
// 			margin-right: 0;
// 		}

// 		.footer {
// 			text-align: center;
// 			margin-top: 20px;
// 			color: #000000;
// 			text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
//             font-weight: 600;
// 		}

// 		@media screen and (max-width: 600px) {
// 			body {
// 				font-size: 14px;
// 			}

// 			.container {
// 				padding: 10px;
// 			}

// 			.logo {
// 				max-width: 150px;
// 				margin-bottom: 10px;
// 			}

// 			.btn {
// 				display: block;
// 				margin-bottom: 10px;
// 				margin-right: 0;
//                 font-weight: 700;
// 			}
// 		}
// 	</style>
// </head>
// <body>
	

// 	<div class="container">
// 		<img src="'.$brand_logo.'" alt="Logo" class="logo">
// 		<h1>'.$brand_name.' LOGIN DETAILS</h1>
// 		<p>Dear '.$franchise_name.',</p>

// 		<p style="text-align:justify;">Welcome to '.$brand_name.'. We are glad to have you as a Franchise of our institute. Below are your login details: </p>

// 		<p><strong>User ID:</strong> '.$mob.'</p>

// 		<p><strong>Password:</strong> '.$pass.'</p>

// 		<p>To access your account, please click the button below:</p>

// 		<p align="center" ><a href="'.$brand_link.'login" ><button style="cursor: pointer; display: inline-block;" class="btn btn-primary">Login</button></a></p>

// 		<p style="text-align: justify;">If you have any questions or concerns, please do not hesitate to contact us at '.$brand_email.'</p>

// 		<div class="footer">
// 			<p>Thank you for choosing '.$brand_name.'!</p>
// 		</div>
// 	</div>
// </body>
// </html>' ;
    
//   if(!$franchise_name=="" and !$owner_name=="" and !$mob=="" and !$email=="" and !$state_id=="" and !$pin=="" and !$full_add=="" and !$w_mob==""){
//       $check_mobile=mysqli_num_rows(mysqli_query($con,"select * from user where mobile='$mob'"));
//             if(!$check_mobile>0){
//               if(!$photo==""){
//                 $extension12 = explode(".", $photo);

//              $extension1 = end($extension12);
          
//             $nn_name = rand(1000,9999);
//             $newfilename1 =$_SESSION['userid'].$nn_name.".".$extension1;
//             $photo_dr="area_s/user_img/".$newfilename1 ;
//             $upload_photo= move_uploaded_file($photo2,"../area_s/user_img/".$newfilename1);
//              }else{
//                 $upload_photo=1; 
//                  $photo_dr ="area_s/user_img/user.jpg";
//              } 
                
//               if($upload_photo){
//                   $insert=mysqli_query($con,"insert into `user`(`name`, `mobile`, `pass`, `type`, `photo`, `father_name`, `email`, `w_mob`, `state_id`, `pin`, `full_add`, `r_date`) values('$franchise_name', '$mob', '$pass', '1', '$photo_dr', '$owner_name', '$email', '$w_mob', '$state_id', '$pin', '$full_add', '$t_date')"); 
//                     if($insert){
//                         echo '<script>alert("Franchise Create Successfully Done. Franchise login id and password have been sent to the registered mail id.");window.location.assign("branch_list")</script>';
//                         $send=  send_mail2($email,"LOGIN DETAILS ",$text);
                        
//                     }else{
//                      echo '<script>alert("Server Error 101.");window.location.assign("branch_new");</script>';  
//                 }
//               }else{
//               echo '<script>alert("Photo uploading failed.");window.location.assign("branch_new");</script>';  
//             } 
               
//             }else{
//                 echo '<script>alert("Already register a franchise with this mobile number.");window.location.assign("branch_new");</script>';
//             }
//   }else{
//         echo '<script>alert("Please fill all feild.");window.location.assign("branch_new");</script>';
//     }
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Branch Details |  <?php echo $brand_name; ?></title>
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
           
          <h4>Franchise Details</h4>
          	
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
             
                <div class="card-body ">
                <div class="row">
                     
                    
                  <div class="col-md-6">
                       <label>Franchise Institute Name:</label>
                      <input type="text" required readonly name="franchise_name" value="<?php echo $branch_name ;?>" class="form-control">
                     
                  </div>
                  <div class="col-md-6">
                    <label>Admin/Owner Name: </label>
                      <input type="text" required readonly name="owner_name" id="owner_name"   value="<?php echo $owner_name ;?>" class="form-control">
                  </div>
            <div class="col-md-6">
                      <label>Mobile No.: </label>
                      <input type="number"  required readonly name="mob" id="mob"   value="<?php echo $mob ;?>"  class="form-control">
                  </div>
                  <!--<div class="col-md-6">-->
                  <!--    <label>Whatsapp No.: </label>-->
                  <!--    <input type="number"   name="w_mob" id="w_mob"   value="<?php echo $w_mob ;?>"  class="form-control">-->
                  <!--</div>-->
                  <div class="col-md-6">
                      <label>Email ID.: </label>
                      <input type="email" required readonly name="email" id="email"  value="<?php echo $email ;?>" class="form-control" pattern=".+@.+">
                  </div>
       
           
                   <div class="col-md-6">
                      <label>State: </label>
                     
                      <select name="state_id" readonly required  class="form-control"  id="state_id"  >
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
                <div class="col-md-6">
                      <label>District: </label>
                      <input type="text" required readonly name="district" id="district"  value="<?php echo $email ;?>" class="form-control" pattern=".+@.+">
                  </div>
                  <div class="col-md-6">
                      <label>Pin Code / Zip Code: </label>
                      
                      <input type="number" readonly required   name="pin_code" id="pin_code"   value="<?php echo $pin ;?>" class="form-control">
                  </div>
                   
                  <div class="col-md-6 form-group">
                      <label>Franchise Full Address: </label>
                      <textarea readonly class="form-control"  name="full_add" id="full_add" required  value="" placeholder="Enter your full addres"><?php echo $full_add ;?></textarea>
                     
                  </div>
                  <br>
                  <div class="col-6" align="center">
                         <div id="preview">
                          
                          <img src="<?php echo $web_link.$admin_photo; ?>" width="250" height="200">
                         
                        </div>
                        <label>Admin photo: </label>
                       
                        <br>
                        <!--image preview div-->
                       

                    </div>
                    <div class="col-6" align="center">
                         <div id="preview">
                          
                          <img src="<?php echo $web_link.$branch_logo; ?>" width="250" height="200">
                         
                        </div>
                        <label>Franchise Logo: </label>
                       
                            
                        <br>
                        <!--image preview div-->
                       

                    </div>
                    <div class="col-6" align="center">
                         <div id="preview">
                          
                          <img src="<?php echo $web_link.$branch_photo; ?>" width="300" height="200">
                         
                        </div>
                        <label>Franchise Photo: </label>
                      
                            
                        <br>
                        <!--image preview div-->
                       

                    </div>
                    <div class="col-6" align="center">
                         <div id="preview">
                          
                          <img src="<?php echo $web_link.$lab_office_photo1; ?>" width="300" height="200">
                         
                        </div>
                        <label>Lab+Office Photo 1: </label>
                       
                            
                        <br>
                        <!--image preview div-->
                       

                    </div>
                    <div class="col-6" align="center">
                         <div id="preview">
                          
                          <img src="<?php echo $web_link.$lab_office_photo2; ?>" width="300" height="200">
                         
                        </div>
                        <label>Lab+Office Photo 2: </label>
                      
                        <br>
                        <!--image preview div-->
                       

                    </div>
                </div>
                  
                </div>
                <!-- /.card-body -->
                
                <!--<div class="card-footer">-->
                <!--  <a onclick="return confirm('Are you sure for final process ?')" href="branch_new?btn=Process&id=<?php echo $branch_application['id'] ?>"><button type="submit"  name="submitg" class="btn btn-success">Edit and Final Creation Process</button></a>-->
                  
                <!--  <a onclick="return confirm('Are you sure for cancel this franchise request?')" href="branch_details?cancel=<?php echo $branch_application['id'] ?>"><button class="btn btn-danger">Cancel</button></a>-->
                <!--</div>-->
                
                <div class="card-footer">
                      <button type="button" class="btn btn-success process-btn" data-id="<?php echo $branch_application['id'] ?>">
                        Edit and Final Creation Process
                      </button>
                    
                      <button type="button" class="btn btn-danger cancel-btn" data-id="<?php echo $branch_application['id'] ?>">
                        Cancel
                      </button>
                    </div>

              
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
<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>

<script>
document.querySelector('.process-btn').addEventListener('click', function () {
  const id = this.getAttribute('data-id');
  Swal.fire({
    title: 'Are you sure?',
    text: "You are about to start the final process.",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#28a745',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, proceed!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = 'branch_new?btn=Process&id=' + id;
    }
  });
});

document.querySelector('.cancel-btn').addEventListener('click', function () {
  const id = this.getAttribute('data-id');

  Swal.fire({
    title: 'Are you sure?',
    text: "You are about to cancel this franchise request.",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#6c757d',
    confirmButtonText: 'Yes, cancel it!'
  }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "GET",
          url: "get_data",
          data: { 
              cancle_request : 1,
              cancel: id 
              
          },
          success: function (response) {
              if (response === 'success') {
                Swal.fire('Canceled!', 'Request canceled successfully.', 'success').then(() => {
                  window.location.href = 'branch_apply_req_list';
                });
              } else if (response.startsWith('error:')) {
                let message = response.split('error:')[1];
                Swal.fire('Error!', message, 'error');
              } else {
                Swal.fire('Error!', 'Unexpected server response.', 'error');
              }
            },

          error: function () {
            Swal.fire('Error!', 'Network error or server problem.', 'error');
          }
        });
      }
    });
});
</script>


</body>
</html>
