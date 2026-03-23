<?php
include 'con.php';
include'asset.php'; 
include('smtp/init.php');
if(isset($_GET['ids'])){
   $course_id=VerifyData($_GET['ids']);
}

$form_status=1;

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(isset($_POST['register_btn'])){
    $courseid=VerifyData($_POST['course_id']);
    $name=VerifyData($_POST['name']);
    $email=VerifyData($_POST['email']);
    $mobile=VerifyData($_POST['mobile']);
    $full_add=VerifyData($_POST['full_add']);
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

		<p style="text-align:justify;">Welcome to '.$brand_name.'. We are glad to have you as a student of our institute. Below are your login details: </p>

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
    
     if(!$courseid=="" and !$name=="" and !$email=="" and !$mobile=="" and !$full_add==""){
        $check_course=mysqli_query($con,"select * from course_details where id='$courseid'");
        if(mysqli_num_rows($check_course)==1){
            $course_details=mysqli_fetch_array($check_course);
            $check_mobile=mysqli_num_rows(mysqli_query($con,"select * from user where mobile='$mobile'"));
            if(!$check_mobile>0){
             
            $insert=mysqli_query($con,"insert into `user`(`name`, `mobile`, `pass`, `email`, `full_add`, `r_date`) values('$name', '$mobile', '$pass', '$email', '$full_add', '$t_date')");    
            if($insert){
                $insert_id=mysqli_insert_id($con);
                if($insert_id>0){
                  $insert_wallet=mysqli_query($con,"insert into `wallet`(`userid`) values('$insert_id')");
                  if($insert_wallet){
                     $create_course=mysqli_query($con,"insert into `course_book`(`userid`, `course_id`, `fee`, `book_date`) values('$insert_id', '$courseid', '$course_details[fee]', '$t_date')");
                     if($create_course){
                        echo '<script>alert("Course enroll successfully done. Your login id and password have been sent to your registered mail id.");</script>'; 
                        $send=  send_mail("$email","LOGIN DETAILS ","$text");
                        $form_status=2;
                     }else{
                        echo '<script>alert("Server Error 104.");</script>'; 
                     }
                      
                  }else{
                     echo '<script>alert("Server Error 103.");</script>'; 
                  }
                  
                }else{
                    echo '<script>alert("Server Error 102.");</script>';  
                }
            }else{
              echo '<script>alert("Server Error 101.");</script>';  
            }
            }else{
                echo '<script>alert("Mobile number already registered.");</script>';
            }
        }else{
            echo '<script>alert("Please select course.");</script>';
        }
    }else{
        echo '<script>alert("Please fill all feild.");</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Registration | <?php echo $brand_name; ?></title>
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
	body{
	      background: linear-gradient(106deg, #ceebf9, #e7bbdf);
	}
 label {
        display: block;
        margin-top: 10px;
      }
      input[type="text"], input[type="number"], input[type="email"], input[type="password"], input[type="tel"], select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-top: 5px;
      }
      input[type="radio"] {
        margin: 0 10px 0 0;
      }
 
	</style>
</head>

<body>


<!--loader and navbar start-->
<?php include 'header.php'; ?>
<!--loader and navbar end-->




    <!-- Login Start -->
    <div class="container-xxl py-5" >
        <br><br>
      <div class="container">
                <div class="section-wrapper row">
                    <div class="col-sm-12">
                        <?php
                   
                        if($form_status==1){ ?>
                        <div class="contact-part">
                            <div  style="margin-bottom: 30px;" align="center">
                                <!--<img width="300px" style="margin-top: 5px;" src="<?php echo $brand_logo ; ?>" alt="Logo">-->
                                <h3 style="margin-top: 5px; font-weight: 800;"><?php echo $brand_name ; ?></h3>
                                <h4 style="font-weight: 600;">Student Registration Form</h4>
                            </div>
                                <form method="post" name="registration_form">
                                 <label for="course_id">Course Name: <span style="color:red;">*</span></label>
                                <select id="course_id" name="course_id" required  onchange="get_fee(this.value)">
                                <option value="">Please select</option>
                                <?php
                                $sql_course=mysqli_query($con,"select * from course_details where status='OPEN'");
                                while($row=mysqli_fetch_array($sql_course)){
                                ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                <?php } ?>
                                </select>    
                                
                                <label for="course_fee" id="course_fee_label" style="display:none;">Course Fee:</label>
                                <input type="text" id="course_fee" readonly name="course_fee" style="display:none;" value="" required placeholder="Enter your name">
                                    
                                <label for="name">Name: <span style="color:red;">*</span></label>
                                <input type="text" id="name" name="name" value="" required placeholder="Enter your name">
                                
                               
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" value="" placeholder="Enter your email Id">
                                
                                <label for="mobile">Mobile Number: <span style="color:red;">*</span></label>
                                <input type="number" id="mobile" name="mobile" value="" required placeholder="Enter your mobile number">
                                
                                
                                <label for="address">Full Address: <span style="color:red;">*</span></label>
                                <textarea id="full_add" name="full_add" rows="4" cols="50" value="" class="form-control" required placeholder="Enter your full address"></textarea>
                                <br>
                               
                                <button class="btn btn-success" id="register_btn"  name="register_btn">Register</button>
                                </form>
                                <div align="center"><span style="color: green;">Have you already register? <a style="color: blue; text-decoration: none;"
                                href="login"><strong> Click for login.</strong></a></span></div>
                        </div>
                        
                        <?php }
                        if($form_status==2){ 
                            ?>
                            
                                <div class="col-md-12" align="center" style="margin-top:10px;">
                                    <h2>Registration Details</h2>
                                    <p>Please note down the details for future use.</p>
                                   
                                 Name : <?php echo $name; ?><br>
                             
                           
                                 Course : <?php echo $course_details['name']; ?><br>
                            
                                 Total Course Fee : Rs.<?php echo $course_details['fee']; ?><br>
                            
                                 Mobile (User Id) : <?php echo $mobile; ?><br>
                          
                                 Login Password : <?php echo $pass; ?>
                             
                             <br>
                             <div align="center"><span style="color: green;"> <a class="btn btn-success" style="color: blue; text-decoration: none;"
                                href="login"><strong> Click for login.</strong></a></span></div>
                                </div>
                             
                            <?php } ?>
                    </div>
                    
                </div>
            </div>
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