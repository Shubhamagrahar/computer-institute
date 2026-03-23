<?php
session_start();
include'con.php';
include'assets.php'; 
include('smtp/init.php');

$query = mysqli_query($con, "SELECT  bread_img FROM website_data LIMIT 1");
$website_data = mysqli_fetch_assoc($query);

$bread_img = $website_data['bread_img'] ?? 'img/background/Learning-bg.png'; // Default fallback



if(isset($_POST['login'])){
    $mobile=VerifyData($_POST['mobile']);
    $pass=VerifyData($_POST['pass']);
    if(!$mobile=="" and !$pass==""){
     $sql=mysqli_query($con,"select * from user where mobile='$mobile' and pass='$pass'");
     if(mysqli_num_rows($sql)==1){
         $result=mysqli_fetch_array($sql);
         
         if($result['mobile']=="$mobile" and $result['pass']=="$pass"){
             
             $date=date("Y-m-d");
             $sql_login=mysqli_query($con,"select * from login_count_data where userid='$result[id]' and date='$date'");
             if(mysqli_num_rows($sql_login)>0){
                $result_login=mysqli_fetch_array($sql_login) ;
             }else{
                 $insert_login_details=mysqli_query($con,"insert into `login_count_data`(`userid`, `date`) values('$result[id]', '$date')");
                 if($insert_login_details){
                     $inert_login_id=mysqli_insert_id($con);
                     $result_login=mysqli_fetch_array(mysqli_query($con,"select * from login_count_data where id='$inert_login_id'")) ;
                 }
             }
             
             if($result_login){
                 $new_count=$result_login['login_count']+1;
                 $update_login_count=mysqli_query($con,"update login_count_data set login_count='$new_count' where id='$result_login[id]'");
             }
             
             $_SESSION['id']=session_id();
             if($result['type']==1){
                 //Admin Login Part
                 $_SESSION['id']=session_id();
                 $_SESSION['userid']=$result['id'];
                 $_SESSION['login_type']='st_ijnbvcs3ergb8uhhb5tfc89hbuftccgfcveddgk';
                 echo '<script>window.location.assign("area_admin/");</script>';
             }elseif($result['type']==2){
                 //Staff Login Part
                  $_SESSION['id']=session_id();
                 $_SESSION['userid']=$result['id'];
                 $_SESSION['login_type']='st_ijnbvcs3ergb8uhhb5tfc89hbuftccgfcveddgk';
                 echo '<script>window.location.assign("area_admin/");</script>';
             }elseif($result['type']==3){
                 //Studente Login Part
                 $_SESSION['id']=session_id();
                 $_SESSION['userid']=$result['id'];
                 $_SESSION['login_type']='st_kjjvgfh5242kvjjhgfnsjhfuygjhdfrtdggsdk';
                 echo '<script>window.location.assign("area_s/");</script>';
             }else{
               echo '<script>alert("Your login panel under maintinance."); window.location.assign("login");</script>';   
                 
             }
             
         }else{
          echo '<script>alert("Mobile number or password is not correct."); window.location.assign("login");</script>';   
         }
         
     }else{
       echo '<script>alert("Please fill correct mobile number and password."); window.location.assign("login");</script>';  
     }
        
    }else{
        echo '<script>alert("Please fill mobile number and password."); window.location.assign("login");</script>';
    }
    
}


if(isset($_POST['forget_password'])){
    $user=VerifyData($_POST['data_forget']);
    if(!$user==""){
        $sql_chk=mysqli_query($con,"select * from user where (mobile='$user' or email='$user')");
        if(mysqli_num_rows($sql_chk)>0){
            $result=mysqli_fetch_array($sql_chk);
            if($result['mobile']==$user or $result['email']==$user){
                
                $email=$result['email'];
                
                $rand_pass=rand(10000,99999);
                $update=mysqli_query($con,"update user set pass='$rand_pass' where id='$result[id]'");
                
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
			background-image: url('.$brand_link.'smtp/image/background_image.webp);
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;
		}

		h1 {
			font-size: 24px;
			margin-bottom: 20px;
			text-align: center;
			color: #000000;
			text-shadow: 2px 2px 5px rgba(116, 115, 115, 0.5);
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
		}

		.btn:last-child {
			margin-right: 0;
		}

		.reset-password {
			text-align: center;
			margin-top: 40px;
		}

		.reset-password p {
			margin-bottom: 20px;
		}

		.reset-password .btn {
			display: block;
			margin: 0 auto;
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
		}
	</style>
</head>
<body>
	
	<div class="container">
		<img src="'.$brand_logo.'" alt="Logo" class="logo">
		<h1 align="center">'.$brand_name.'</h1>
		<p>Dear '.$result['name'].',</p>
		<p style="text-align: justify;">We received a request to reset your password for your '.$brand_name.'.</p>
		<p><strong>Your User ID:</strong> '.$result['mobile'].'</p>
        <p><strong>Your Reset Password:</strong> '.$rand_pass.'</p>

		<p>To access your account, please click the button below:</p>
        
		<p align="center" ><a href="'.$brand_link.'login" ><button style="cursor: pointer; display: inline-block;" class="btn btn-primary">Login</button></a></p>
		
		<p style="text-align: justify; font-size:13px; color:red;">If you did not request a password reset, please ignore this email or contact our support team at '.$brand_email.'</p>
	</div>
</body>
</html>' ;
                
                $send=  send_mail ($email,"Forget Password Details ",$text);
                if($send){
                     echo '<script>alert("Your password has been sent to your registered email id."); window.location.assign("login");</script>';
                   
                }else{
                    echo '<script>alert("Server error, Try Again."); window.location.assign("login");</script>';
                  
                }
                
            }else{
                echo '<script>alert("Somthing is wrong."); window.location.assign("login");</script>';
             
            }
            
        }else{
             echo '<script>alert("Mobile or email is not registered."); window.location.assign("login");</script>';
            
        }
        
    }else{
        echo '<script>alert("Please enter email or mobile no."); window.location.assign("login");</script>';
       
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $brand_name ?> Login</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

   <?php include 'head.php'; ?>
   
    <style>
    

    body {
      /*height: 100vh;*/
      /*background: #f5f5f5;*/
      /*background-image: url('https://images.pond5.com/girl-high-school-computer-class-087202113_prevstill.jpeg') ; */
      /*display: flex;*/
      /*justify-content: center;*/
      /*align-items: center;*/
    }

    .login-container {
      background: #ffffffe8;
      width: 50%;
      max-width: 400px;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
      text-align: center;
      margin: auto;
      margin-top: 50px;
    }

    .login-container img {
      width: 200px;
      height: 140px;
      /*margin-bottom: 20px;*/
    }

    .login-container h2 {
      margin-bottom: 20px;
      color: #333;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
      width: 100%;
      padding: 12px 15px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .login-container button {
      width: 100%;
      padding: 12px;
      /*background-color: #4CAF50;*/
      /*border: none;*/
      color: white;
      font-size: 16px;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 15px;
    }

    .login-links {
      margin-top: 20px;
      display: flex;
      justify-content: space-between;
      font-size: 14px;
    }

    .login-links a {
      text-decoration: none;
      color: #0025f9;
    font-weight: bold;
    }

    .login-links a:hover {
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      .login-container {
        width: 70%;
      }
    }

    @media (max-width: 480px) {
      .login-container {
        width: 90%;
        padding: 20px;
      }

      .login-links {
        flex-direction: column;
        gap: 10px;
      }
    }
    
    .main-container {
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }

        .login-container {
            background: #ffffffe8;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .logo {
            max-width: 100px;
            margin-bottom: 1.5rem;
            border-radius:50%;
        }

        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #333;
        }

        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn:hover {
            background: #45a049;
        }

        .links {
            text-align: center;
            margin-top: 1rem;
        }

        .links a {
            text-decoration: none;
            color: #4caf50;
        }

        .links a:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .container {
                padding: 1.5rem;
            }

            .logo {
                max-width: 80px;
            }
        }
  </style>
  
  
</head>

<body>
   


    <!-- Navbar Start -->
    <?php include 'header.php'; ?>
    <!-- Navbar End -->


    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header"
         style="background: linear-gradient(rgba(24, 29, 56, 0.7), rgba(24, 29, 56, 0.7)), url('<?php echo $bread_img; ?>');
                background-position: center center;
                background-repeat: no-repeat;
                background-size: cover;">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Login</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class=""><a class="text-white" href="./"> Home / </a></li>
                            <!--<li class=""><a class="text-white" href="#">  About / </a></li>-->
                            <li class="breadcrumb-item text-white active" aria-current="page">Login</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>  
    <!-- Header End -->


    <!-- Login Start -->
    
      <div class="login-container" id="login_area">
    <img src="<?php echo $brand_logo?>" alt="Logo">
    
    <h2>Login</h2>
    
    <form  method="POST">
      <input type="text" for="username" id="username" name="mobile" placeholder="User ID" required>
      <input type="password" for="password" id="password" name="pass" placeholder="Password" required>
      <button class="btn btn-primary py-4 px-lg-5 d-lg-block" type="submit" name="login" value="login">Login</button>
    </form>
    
    <div class="login-links">
      <a href="registration">Register</a>
      <!--<a href="#" onclick="get_forget_form()">Forgot Password?</a>-->
      <span onclick="get_forget_form()" style="float:right;cursor:pointer; color: blue;"><b>Forget Password?</b></span>
    </div>
  </div>
  
  
  <div class="container-xxl py-5" id="forget_area" style="display:none;">
        <br><br>
        <section id="mu-error">
            <div class="login-container">
                <form class="login-form" method="post">
                    <img style="border-radius:8px;" class="logo" src="<?php echo $brand_logo; ?>" alt="Logo">
                    <h4> Forget Password</h4>
                    <label for="username">Registered email/mobile number: </label>
                    <input type="text" id="username" name="data_forget" required
                        placeholder="Enter email/mobile number.">

                    <input type="submit" name="forget_password" value="Forget">
                    <div align="center" style="margin-top: 13px;">
                        <p><span style="float:left;font-size: 15px;">New User?<a
                                    style="text-decoration: none; color:blue;" href="registration"> <strong>Register
                                        Account</strong></a></span>
                            <span onclick="get_login_form()"
                                style="float:right;cursor:pointer; color: blue;"><b>Login</b></span>
                        </p>
                    </div>
                </form>

            </div>
        </section>
    </div>
    
    <!-- Login End -->


    <!-- Footer Start -->
    <?php  include 'footer.php'; ?>
    
    
    <script>
        function get_forget_form() {
            document.getElementById("forget_area").style.display = "block";
            document.getElementById("login_area").style.display = "none";
        }

        function get_login_form() {
            document.getElementById("forget_area").style.display = "none";
            document.getElementById("login_area").style.display = "block";
        }
    </script>




    <!-- JavaScript Libraries -->
    <script src="code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="cdn.jsdelivr.net/npm/bootstrap%405.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>