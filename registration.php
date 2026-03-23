<?php
include 'con.php';
include'assets.php'; 
include('smtp/init.php');


$query = mysqli_query($con, "SELECT  bread_img FROM website_data LIMIT 1");
$website_data = mysqli_fetch_assoc($query);

$bread_img = $website_data['bread_img'] ?? 'img/background/Learning-bg.png'; // Default fallback

if(isset($_GET['ids'])){
   $course_id=$_GET['ids'];
}

$form_status=1;

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(isset($_POST['register_btn'])){
    $courseid=$_POST['course_id'];
    $name=$_POST['name'];
    $father_name=$_POST['father_name'];
    $mother_name=$_POST['mother_name'];
    $dob=$_POST['dob'];
    $gender=$_POST['gender'];
    $category=$_POST['category'];
    $qualification=$_POST['qualification'];
    $pin=$_POST['pin'];
    $state=$_POST['state'];
    $email=$_POST['email'];
    $mobile=$_POST['mobile'];
    $full_add=$_POST['full_add'];
    $branch_id=$_POST['branch_id'];
    $pass=rand(100000,999999);
    $discount_value = VerifyData($_POST['discount_value']);
    $coupen_code=VerifyData($_POST['coupon_code']);
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
    
     if(!$courseid=="" and !$name=="" and !$email=="" and !$mobile=="" and !$full_add=="" and !$branch_id=="" and !$father_name=="" and !$mother_name=="" and !$dob=="" and !$gender=="" and !$category=="" and !$qualification=="" and !$pin=="" and !$state==""){
        $check_course=mysqli_query($con,"select * from course_details where id='$courseid'");
        if(mysqli_num_rows($check_course)==1){
            // $course_details=mysqli_fetch_array($check_course);
            // $check_name=mysqli_num_rows(mysqli_query($con,"select * from enquiry_details where name='$name' and guardian_name='$father_name' and status='OPEN'"));
            // if(!$check_name>0){
             
            // $insert=mysqli_query($con,"insert into `enquiry_details`(`branch_id`, `create_by`, `name`, `guardian_name`, `mobile1`, `email`, `address1`, `course_id`, `enquiry_date`, `mother_name`, `dob`, `gender`, `category`, `qualification`, `pin`, `state`) 
            // values('$branch_id', '0', '$name', '$father_name', '$mobile', '$email', '$full_add', '$courseid', '$t_date', '$mother_name', '$dob', '$gender', '$category', '$qualification', '$pin', '$state')");    
            // if($insert){
            
            $course_details = mysqli_fetch_array($check_course);

            $check_name = mysqli_num_rows(mysqli_query($con, "SELECT * FROM enquiry_details WHERE name='$name' AND guardian_name='$father_name' AND status='OPEN'"));
            $c_session=mysqli_fetch_array(mysqli_query($con, "select id from session_details where status='RUN'"))['id'];

            if ($check_name == 0) {
                $insert = mysqli_query($con, "INSERT INTO `enquiry_details`(`session_id`,`branch_id`, `create_by`, `name`, `guardian_name`, `mobile1`, `email`, `address1`, `course_id`, `enquiry_date`, `mother_name`, `dob`, `gender`, `category`, `qualification`, `pin`, `state_id`, `coupen_discount`, `coupen_code`, `next_date`) 
                VALUES ('$c_session', '$branch_id', '0', '$name', '$father_name', '$mobile', '$email', '$full_add', '$courseid', '$t_date', '$mother_name', '$dob', '$gender', '$category', '$qualification', '$pin', '$state', '$discount_value', '$coupen_code', '$t_date')");
            
                if ($insert) {
 
                
                        // echo '<script>alert("Registration request submitted. Please wait we will contact you as soon as possible.");</script>'; 
                //         $send=  send_mail("$email","LOGIN DETAILS ","$text");
                        $form_status=2;
               
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


if (isset($_GET['id'])) {
    $course_id = intval($_GET['id']); 

    if ($course_id <= 0) {
        echo "<script>
            alert('Invalid Course ID! Redirecting back.');
            window.history.back();
        </script>";
        exit; 
    }
} else {
    // If no ID is provided, simply continue loading the page
    $course_id = null; 
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $brand_name ?> | Student Registration </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

   <?php include 'head.php'; ?>
   
   <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    
    
      <style>
        /** {*/
        /*    margin: 0;*/
        /*    padding: 0;*/
        /*    box-sizing: border-box;*/
        /*    font-family: 'Arial', sans-serif;*/
        /*}*/

        .container-xxxl {
            background: linear-gradient(135deg, #c3e0e5, #a1a4c9);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .registration_container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 80%;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #34495e;
        }

        

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            margin-top:10px;
        }

       

        .full-width {
            grid-column: span 2;
        }

        .checkbox {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .checkbox input{
            width: 25px;
        }

        .submit-btn {
            /*background: #3498db;*/
            /*color: white;*/
            padding: 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
            margin: 0 auto;
        }

        .submit-btn:hover {
            background: #2980b9;
        }
        
        
        
        @media (max-width: 768px) {
            form {
                grid-template-columns: 1fr;
            }
            .full-width {
                grid-column: span 1;
            }
            .registration_container{
                max-width: 100%;
            }
        }
    
       .text-primary{
            color: #04046e !important;
        }
        
        .popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}
.popup-content {
    background: white;
    padding: 20px;
    border-radius: 10px;
    max-width: 600px;
    width: 90%;
    position: relative;
    box-shadow: 0 0 10px rgba(0,0,0,0.3);
}
.close-btn {
    position: absolute;
    top: 5px;
    right: 15px;
    font-size: 22px;
    cursor: pointer;
}
.success{
    background-color: green;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px;
}
.animated-heading {
    font-size: 1.7rem;
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
                    <h1 class="display-3 text-white animated slideInDown">Student Registration</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class=""><a class="text-white" href="./"> Home / </a></li>
                            <li class=""><a class="text-white" href="#">  Student / </a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Student Registration</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>  
    <!-- Header End -->


    <!-- Team Start -->
    <div class="container-xxxl py-5">
        
        <?php
                   
    if($form_status==1){ ?>
        
        <div class="registration_container">
        <h2 class="animated-heading">STUDENT REGISTRATION FORM</h2>
        <form method="POST">
            <div class="row">
            <div class="col-md-6"> 
                <label for="course">Select Your Centre:</label>
                
               <select id="branch_id" name="branch_id" required class="form-control" >
                    <option value="">Please select</option>
                    <?php
                    $sql_branch=mysqli_query($con,"select * from user where type='1' and status='1'");
                    while($row=mysqli_fetch_array($sql_branch)){
                    ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                    <?php } ?>
                </select> 
                
            </div>
            <div class="col-md-6">
                <label for="course">Select Your Course:</label>
                <!--<select id="course" required>-->
                <!--    <option>-- Select Course --</option>-->
                <!--</select>-->
                
               <select id="course_id" name="course_id" onchange="get_fee(this.value)" class="form-control" required>
                <option value="">-- Select Course --</option>
        
                <?php
                $query = mysqli_query($con, "SELECT id, name, fee FROM course_details WHERE status = 'OPEN'");
                
                while ($row = mysqli_fetch_assoc($query)) {
                    $selected = (isset($course_id) && $course_id == $row['id']) ? 'selected' : '';
                    echo "<option value='{$row['id']}' $selected>{$row['name']} </option>";
                }
                ?>
              </select>
                
            </div>
            <div class="col-md-6">
                <label for="name">Your Full Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter your full name" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="father">Father's/Guardian Name:</label>
                <input type="text" id="father" name="father_name" class="form-control" placeholder="Enter father name">
            </div>
            <div class="col-md-6">
                <label for="mother">Mother Name:</label>
                <input type="text" id="mother" name="mother_name" class="form-control" placeholder="Enter mother name">
            </div>
            <div class="col-md-6">
                <label for="dob">Date of Birth:</label>
                <input type="date" name="dob" id="dob" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="gender">Select Your Gender:</label>
                <select id="gender" name="gender" class="form-control">
                    <option>Select Gender</option>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Other</option>
                </select>
            </div>
            
            <div class="col-md-6">
                <label for="category">Select Your Category:</label>
                <select id="category" name="category" class="form-control">
                    <option>Select Category</option>
                    <option>GEN</option>
                    <option>OBC</option>
                    <option>ST</option>
                    <option>SC</option>
                    <option>Other</option>
                </select>
            </div>
            
            <div class="col-md-6">
                <label for="contact">Contact Number:</label>
                <input type="tel" id="contact" name="mobile" class="form-control" placeholder="Enter mobile number" required>
            </div>
            <div class="col-md-6">
                <label for="email">Email Account:</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email ID" required>
            </div>
            <div class="col-md-6">
                <label for="qualification">Qualification:</label>
                <select id="qualification" name="qualification" class="form-control">
                    <option>Select</option>
                    <option>High School</option>
                    <option>Intermediate</option>
                    <option>Graduation</option>
                    <option>Post-Graduation</option>
                    <option>Other</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="state">State:</label>
                <select id="state" name="state" class="form-control" required>
                        <option value="">-- Select State --</option>
                        <?php
                        // Fetch states from the database
                        $query = mysqli_query($con, "SELECT id, name FROM states ORDER BY name ASC");
                
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo "<option value='{$row['id']}'>{$row['name']}</option>";
                        }
                        ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="pin">Pin Code:</label>
                <input type="text" id="pin" name="pin" class="form-control" placeholder="Enter pin code">
            </div>
            <div class="col-md-6">
                <label for="address">Full Address:</label>
                <textarea id="address" name="full_add" rows="3" class="form-control" placeholder="Enter your full address"></textarea>
            </div>
            </div>
            <div class="row">
                 <div class="col-md-4">
                                        <label for="course_fee" id="course_fee_label">Course Fee:</label>
                                        <input type="text" id="course_fee" readonly name="course_fee" class="form-control" placeholder="Course Fee">
                                    </div>
                               
                                      
                                    
                                         <div class="col-md-4">
                                            <label for="coupon_code">Coupon Code:</label>
                                            <input type="text" id="coupon_code" name="coupon_code" class="form-control" 
                                                   placeholder="Enter coupon code" onkeyup="checkCoupon()">
                                            <span id="coupon_message" style="display:block; margin-top:5px; font-size:14px;"></span>
                                        </div>
                                        
                                        <div class="col-md-4">
                                        <label for="final_course_fee" id="course_fee_label">Final Course Fee:</label>
                                        <input type="text" id="final_course_fee" readonly name="final_course_fee" class="form-control" placeholder="Final Course Fee">
                                    </div>
                                    <input type="hidden" id="discount_value" name="discount_value">
                                    
            </div>
            
            <div class="checkbox full-width">
                <input type="checkbox" id="agree" required>
                <label for="agree">I agree to the declaration below.</label>
            </div>
            <p class="full-width"><strong>DECLARATION BY STUDENT:</strong> I hereby declare that all the above statements are true and correct to the best of my knowledge and belief. I shall obey all the rules and regulations of the organization.</p>
            <button type="submit" name="register_btn" class=" btn btn-primary submit-btn full-width">Register Me</button>
        </form>
    </div>
    
    
    <?php }
                        if($form_status==2){ 
                            ?>
                            
                             <!--   <div class="col-md-12" align="center" style="margin-top:10px;">-->
                             <!--       <img src="images/check.jpg" width="140px">-->
                             <!--       <p style="font-size:17px;">Registration request submitted. Please wait we will contact you as soon as possible.</p>-->
                             <!--    <?php
                            //  <!--    $section=1;-->
                            //  <!--    if($section==2){-->
                               ?>-->
                             <!--       <h2>Registration Details</h2>-->
                             <!--       <p>Please note down the details for future use.</p>-->
                                   
                             <!--    Name : <?php echo $name; ?><br>-->
                             
                           
                             <!--    Course : <?php echo $course_details['name']; ?><br>-->
                            
                             <!--    Total Course Fee : Rs.<?php echo $course_details['fee']; ?><br>-->
                            
                             <!--    Mobile (User Id) : <?php echo $mobile; ?><br>-->
                          
                             <!--    Login Password : <?php echo $pass; ?>-->
                             
                             <!--<br>-->
                             <!--<div align="center"><span style="color: green;"> <a class="btn btn-success" style="color: blue; text-decoration: none;"-->
                             <!--   href="login"><strong> Click for login.</strong></a></span></div>-->
                             <!--   </div>-->
                             
                             
                             
                             <div id="popupBox" class="popup" style="display:none;">
  <div class="popup-content">
    <!--<span class="close-btn" onclick="closePopup()">&times;</span>-->
    <div class="col-md-12" align="center" style="margin-top:10px;">
        <img src="img/check.jpg" width="140px">
        <p style="font-size:17px;">Registration request submitted. Please wait we will contact you as soon as possible.</p>
        
        <button class="success"><a style="color:white; font-weigth: bold;" href="./">Home</a></button>
        <?php
        $section = 1;
        if ($section == 2) {
        ?>
        <h2>Registration Details</h2>
        <p>Please note down the details for future use.</p>
        Name : <?php echo $name; ?><br>
        Course : <?php echo $course_details['name']; ?><br>
        Total Course Fee : Rs.<?php echo $course_details['fee']; ?><br>
        Mobile (User Id) : <?php echo $mobile; ?><br>
        Login Password : <?php echo $pass; ?><br>
        <div align="center">
            <span style="color: green;">
                <a class="btn btn-success" style="color: blue; text-decoration: none;" href="login"><strong> Click for login.</strong></a>
            </span>
        </div>
        <?php } ?>
    </div>
  </div>
</div>

                            <?php } ?>
        
        
    </div>
    <!-- Team End -->
        

    <!-- Footer Start -->
    <?php include 'footer.php'; ?>
    <!-- Footer End -->



<script>
function closePopup() {
    document.getElementById("popupBox").style.display = "none";
}

// Show popup after form submit success
<?php if (isset($_POST['register_btn'])) { ?>
    window.onload = function() {
        document.getElementById("popupBox").style.display = "flex";
    };
<?php } ?>
</script>


    <!-- JavaScript Libraries -->
    <script src="code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="cdn.jsdelivr.net/npm/bootstrap%405.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="super_admin/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
        <script>
function checkCoupon(){
    let course_id = $("#course_id").val();
    let coupon = $("#coupon_code").val().trim();
    let messageSpan = $("#coupon_message");
    let course_fee = $("#course_fee").val();
    let branch_id = $("#branch_id").val();
    if(!branch_id){
        Swal.fire({
            icon: "warning",
            title: "Please select a Center before entering a coupon code."
        });
        $("#coupon_code").val("");
        messageSpan.html("");
        return;
    }
    if(!course_id){
        Swal.fire({
            icon: "warning",
            title: "Please select a course before entering a coupon code."
        });
        $("#coupon_code").val("");
        messageSpan.html("");
        return;
    }
    

    if(coupon === ""){
        messageSpan.html("");
        return;
    }

    $.ajax({
        url: "get_data",
        type: "GET",
        data: {
            check_coupon: 1,
            course_id: course_id,
            branch_id: branch_id,
            coupon_code: coupon
        },
        success: function(res){
            res = res.trim();
            if(res.startsWith("VALID:")){
                let discount = res.replace("VALID:", "");
                messageSpan.css("color", "green");
                messageSpan.html("Coupon applied successfully! Discount: " + discount + "%");
                 $("#discount_value").val(discount);
                 
                 let discount_amount = ((course_fee * discount)/100);
                 let final_amount = course_fee - discount_amount;
                 $("#final_course_fee").val(final_amount.toFixed(2));
            } else {
                messageSpan.css("color", "red");
                messageSpan.html(res);
                 $("#discount_value").val("");
                   $("#final_course_fee").val(course_fee);
            }
        }
        
    });
}
$("#course_id, #branch_id").on("change", function() {
    $("#coupon_code").val("");   
    $("#coupon_message").html("");
    $("#discount_value").val("");
    let course_fee = $("#course_fee").val();
    $("#final_course_fee").val(course_fee); 
});

</script>
    <script>
        function get_fee(course_id) {
    if (course_id === "") {
        $("#fee_row").hide();
        $("#course_fee").val("");
        return;
    }

    $.ajax({
        url: "get_data",
        type: "GET",
        data: {
            get_course_fee: 1,
            course_id: course_id
        },
        success: function(res) {
            res = res.trim();
            if (res !== "") {
                $("#course_fee").val(res);
                $("#final_course_fee").val(res);
                $("#fee_row").show();
            } else {
                $("#course_fee").val("");
                $("#fee_row").hide();
                
                
            }
        }
    });
}

    </script>
<script>
    $("#course_id").val(<?php echo $course_id; ?>);
</script>
</body>

</html>