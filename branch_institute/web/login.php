<?php
session_start();
include'con.php';
include'asset.php'; 


include('smtp/init.php');
if(isset($_POST['login'])){
    $mobile=VerifyData($_POST['mobile']);
    $pass=VerifyData($_POST['pass']);
    if(!$mobile=="" and !$pass==""){
     $sql=mysqli_query($con,"select * from user where mobile='$mobile' and pass='$pass' and status='1'");
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
                 $_SESSION['login_type']='st_ijnbvcs3ergb8uhhb5tfc89hbuftcfw23fcgfcveddgk';
                 echo '<script>window.location.assign("area_admin/");</script>';
             }elseif($result['type']==2){
                 //Staff Login Part
                 
             }elseif($result['type']==3){
                 //Studente Login Part
                 $_SESSION['id']=session_id();
                 $_SESSION['userid']=$result['id'];
                 $_SESSION['login_type']='st_uhbcxs35468j56dtrfyghy67q2sfcgvhbhbu89o8ghy8jk';
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
                
                $send=  send_mail("$email","Forget Password Details ","$text");
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
    <title>Login | <?php echo $brand_name; ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="<?php echo $brand_fav_logo; ?>" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    
        <style>
        body {
            /*background-image: url(https://images2.alphacoders.com/747/747506.jpg);*/
            background-image: url(https://images.pond5.com/girl-high-school-computer-class-087202113_prevstill.jpeg);
            /*background-color: #f2f2f2;*/
            font-family: Arial, sans-serif;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 320px;
        }

        .login-form {
            background-color: #ffffffe8;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 90%;
        }

        .logo {
            /*width: 100px;*/
            /*height: 100px;*/
            max-width:150px;
            max-height:100px;
            margin-bottom: 20px;
        }

        .login-form h4 {
            font-size: 25px;
            font-family: ui-monospace;
            margin-top: -15px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            text-align: left;
        }

        input[type="text"],
        input[type="password"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: none;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #3e8e41;
        }

        @media screen and (max-width: 600px) {
            .login-form {
                max-width: 300px;
                margin-bottom: 125px;
            }
        }

        @media (max-width: 767px) {
            .login-container {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 550px;
            }
        }
         @media (max-width: 360px) {
    .logo{
        max-width:150px;
        max-height:100px;
    }
    }
    </style>
</head>

<body>


<!--loader and navbar start-->
<?php include 'header.php'; ?>
<!--loader and navbar end-->




    <!-- Login Start -->
    <div class="container-xxl py-5" id="login_area">
        <br><br>
        <div class="login-container">
                <form class="login-form" method="post">
                    <img class="logo" src="<?php echo $brand_logo; ?>" alt="Logo">
                    <h4> Login</h4>
                    <label for="username">User ID:</label>
                    <input type="text" id="username" name="mobile" required
                        placeholder="Enter UserId or Registered Mobile Number.">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="pass" required placeholder="Enter your password.">
                    <input type="submit" name="login" value="Login">
                    <div align="center" style="margin-top: 13px;">
                        <p><span style="float:left;font-size: 15px;"><a
                                    style="text-decoration: none; color:blue;" href="registration"> <strong>Register
                                        Account</strong></a></span>
                            <span onclick="get_forget_form()" style="float:right;cursor:pointer; color: blue;"><b>Forget
                                    Password</b></span>
                        </p>
                    </div>
                </form>

            </div>
    </div>
    
    <div class="container-xxl py-5" id="forget_area" style="display:none;">
        <br><br>
        <section id="mu-error">
            <div class="login-container">
                <form class="login-form" method="post">
                    <img class="logo" src="<?php echo $brand_logo; ?>" alt="Logo">
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
   <?php include 'footer.php'; ?>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    
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
</body>

</html>