<?php 
include 'session.php'; 
include '../smtp/init.php';
$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");
$type = mysqli_fetch_array(mysqli_query($con, "select type from user where id='$_SESSION[userid]'"))['type'];
 $session_id = mysqli_fetch_array(mysqli_query($con, "select id from session_details where status='RUN'"))['id'];
if(sub_menu_check("B","A",$_SESSION['userid'], $type)==1){
    
}else{
    echo '<script>alert("You are not permitted to access this option.");window.location.assign("index");</script>'; 
}

$start=0; 

if(isset($_POST['user_type'])){
    if($_POST['user_type'] == "existing"){
        $start=1; 
    }elseif($_POST['user_type'] == "new"){
        $start=2; 
        
       $reg_no = $brand_short_code . "/" . date("Y") . "/" . $count;
        $count++;
        $name=""; 
        $email_id=""; 
        $mobile=""; 
        $btn_name="new_enroll";
    }
}


if(isset($_POST['Next_process'])){
    $reg_no=VerifyData($_POST['reg_no']);
    if(!$reg_no==""){
        
        $check=mysqli_query($con,"select * from user where reg_no='$reg_no'");
        if(mysqli_num_rows($check)==1){
           $start=2; 
           $result=mysqli_fetch_array($check);
           if($result['branch_id']==$current_branch_id){
           $name=$result['name'];
           $email_id=$result['email'];
           $mobile=$result['mobile'];
           $btn_name="old_enroll";
           }else{
            echo '<script>alert("Entered registration number already list with other franchise.");window.location.assign("enroll_create")</script>';   
            die();
           }
           
           
        }else{
        //   $start=2; 
        //   $name="";
        //   $email_id="";
        //   $btn_name="new_enroll";
         echo '<script>alert("Registration number not found.");window.location.assign("enroll_create")</script>';
        }
        
    }else{
        echo '<script>alert("Please enter registration number.");window.location.assign("enroll_create")</script>';
    }
}



if(isset($_POST['old_enroll'])){
    
    $courseid=VerifyData($_POST['course_id']);
    $name=VerifyData($_POST['name']);
    $email_id=VerifyData($_POST['email']);
    $mobile=VerifyData($_POST['mobile']);
     $reg_no=VerifyData($_POST['reg_no']);
    if(!$courseid=="" and !$name=="" and !$email_id=="" and !$mobile=="" and !$reg_no=="" ){
        $check_course=mysqli_query($con,"select * from course_details where id='$courseid'");
        if(mysqli_num_rows($check_course)==1){
            $course_details=mysqli_fetch_array($check_course);
            $check_mobile=mysqli_num_rows(mysqli_query($con,"select * from user where reg_no='$reg_no'"));
            if($check_mobile==1){
              $user_details=mysqli_fetch_array(mysqli_query($con,"select * from user where reg_no='$reg_no'"));
              
            $update=mysqli_query($con,"update user set branch_id='$current_branch_id', name='$name', email='$email_id' where id='$user_details[id]'");    
           
           
            if($update){
                
                if($update){
                 
                  if($update){
                     $create_course=mysqli_query($con,"insert into `course_book`(`branch_id`, `userid`, `course_id`, `session_id`, `fee`, `book_date`) values('$current_branch_id', '$user_details[id]', '$courseid', '$session_id', '$course_details[fee]', '$t_date')");
                    $course_inert_id=mysqli_insert_id($con);
                      if($create_course){
                         $link="enroll_final?ids=".$course_inert_id;
                        echo '<script>alert("Enrollment added successfully. Please proceed to the next step");window.location.assign("'.$link.'")</script>'; 
                        $form_status=2;
                     }else{
                        echo '<script>alert("Failed to assign the course. Please try again.");</script>'; 
                     }
                      
                  }else{
                     echo '<script>alert("Unexpected error occurred while updating user. Please try again.");</script>'; 
                  }
                  
                }else{
                    echo '<script>alert("Could not update user information. Please check and try again.");</script>';  
                }
            }else{
              echo '<script>alert("Unable to update user details at the moment. Please try again.");</script>';  
            }
            }else{
                echo '<script>alert("Registration number not registered.");</script>';
            }
        }else{
            echo '<script>alert("Please select a valid course.");</script>';
        }
    }else{
        echo '<script>alert("Please fill all feild.");</script>';
    }
}


if(isset($_POST['new_enroll'])){
    
    $courseid=VerifyData($_POST['course_id']);
    $name=VerifyData($_POST['name']);
    $email_id=VerifyData($_POST['email']);
    $mobile=VerifyData($_POST['mobile']);
    $reg_no=VerifyData($_POST['reg_no']);
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
    if(!$courseid=="" and !$name=="" and !$email_id=="" and !$mobile=="" and !$reg_no=="" ){
        $check_course=mysqli_query($con,"select * from course_details where id='$courseid'");
        if(mysqli_num_rows($check_course)==1){
            $course_details=mysqli_fetch_array($check_course);
            $check_mobile=mysqli_num_rows(mysqli_query($con,"select * from user where reg_no='$reg_no'"));
            if(!$check_mobile>0){
            //  $pass=rand(100000,999999);
            $insert=mysqli_query($con,"insert into `user`(`reg_no`,`branch_id`, `name`, `mobile`, `pass`, `email`, `r_date`) values('$reg_no','$current_branch_id', '$name', '$mobile', '$pass', '$email_id', '$t_date')");    
            if($insert){
                $insert_id=mysqli_insert_id($con);
                if($insert_id>0){
                   $update_count = mysqli_query($con,"UPDATE website_data SET adm_count = adm_count + 1 WHERE id = 1");
                   if($update_count){
                  $insert_wallet=mysqli_query($con,"insert into `wallet`(`userid`) values('$insert_id')");
                  if($insert_wallet){

                    $create_course=mysqli_query($con,"insert into `course_book`(`branch_id`, `userid`, `course_id`, `session_id`, `fee`, `book_date`) values('$current_branch_id', '$insert_id', '$courseid', '$session_id', '$course_details[fee]', '$t_date')");
                    $course_inert_id=mysqli_insert_id($con);
                      if($create_course){
                         $link="enroll_final?ids=".$course_inert_id;
                        // echo '<script>alert("Student registration successfully done. Please do next step.");window.location.assign("'.$link.'")</script>'; 
                        $form_status=2;
                         $send=  send_mail($email_id,"LOGIN DETAILS ",$text);
                              $mob=$mobile;
                       
                        if($send){
                           echo '<script>alert("Registration has been successfully completed. Please complete the course enrollment process. Panel login details have been sent to the registered email ID.");window.location.assign("'.$link.'");</script>';   
                        }else{
                            echo '<script>alert("Registration has been successfully completed but email not sends.");window.location.assign("'.$link.'");</script>';
                        } 
                     }else{
                        echo '<script>alert("Server Error 104.");</script>'; 
                     }
                      
                  }else{
                     echo '<script>alert("Server Error 103.");</script>'; 
                  }
                   }else{
                       echo '<script>alert("Error updating in Admission Count");</script>';
                   }
                }else{
                    echo '<script>alert("Server Error 102.");</script>';  
                }
            }else{
              echo '<script>alert("Server Error 101.");</script>';  
            }
            }else{
                echo '<script>alert("Registration Number already used.");</script>';
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Enroll | <?php echo $brand_name; ?></title>
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
    
    <style type="text/css">
          .drop_enroll{
    	background: #157daf !important;
    }
    
    .enroll_create{
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
                            <h1>Enroll Student</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>

<?php if($start==0){ ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Select User Type</h3>
                    </div>
                    <form method="post">
                        <div class="card-body" style="display:flex; flex-direction:column">
                            <button type="submit" name="user_type" value="new" class="btn btn-success m-2"><i class="fa fa-user-plus"></i> New User</button>
                            <button type="submit" name="user_type" value="existing" class="btn btn-secondary m-2"><i class="fa fa-user"></i> Existing User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>


            <!--Main Content section start-->
            <?php 
            if($start==1){
            ?>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-4">
                            
                        </div>
                        <div class="col-4">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Enroll Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" name="form_23">
                                    <div class="card-body ">
                                        <div class="row">
                                           
                                            <div class="col-md-12">
                                                <label>Registration No.</label>
                                                <input type="text" required name="reg_no" value="" class="form-control" placeholder="Enter student registration number.">
                                            </div>
                                          
                                           
                                           
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" name="Next_process" class="btn btn-primary">Next</button>
                                       
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </section>
            <?php }?>
            
            
            <?php 
            if($start==2){
            ?>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Enroll Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" name="form_2">
                                    <div class="card-body ">
                                        <div class="row">
                                              <div class="col-md-6">
                                                <label>Registration No. <span style="color:red;">*</span></label>
                                                <input type="text" readonly name="reg_no"
                                                    value="<?php echo $reg_no ;?>" class="form-control" placeholder="Enter registration number.">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Name: <span style="color:red;">*</span></label>
                                                <input type="text" required name="name"
                                                    value="<?php echo $name ;?>" class="form-control" placeholder="Enter student name.">
                                            </div>
                                          <div class="col-md-6">
                                                <label>Mobile No.</label>
                                                <input type="text" required name="mobile"
                                                    value="<?php echo $mobile ;?>" class="form-control" placeholder="Enter mobile number.">
                                            </div>
                                           <div class="col-md-6">
                                                <label>Email: </label>
                                                <input type="text" required name="email"
                                                    value="<?php echo $email_id ;?>" class="form-control" placeholder="Enter email Id.">
                                            </div>
                                            
                                            <div class="col-md-6">
                                                 <label for="course_id">Course Name: <span style="color:red;">*</span></label>
                                                    <select id="course_id" name="course_id" class="form-control" onchange="get_fee(this.value)">
                                                    <option value="">Please select</option>
                                                    <?php
                                                    $sql_course=mysqli_query($con,"select * from course_details where status='OPEN'");
                                                    while($row=mysqli_fetch_array($sql_course)){
                                                    ?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                                    <?php } ?>
                                                    </select>
                                            </div>
                                           <div class="col-md-6" id="course_fee_label" style="display:none;">
                                                 <label for="course_fee" >Course Fee: <span style="color:red;">*</span></label>
                                                 <input type="text" id="course_fee" readonly class="form-control" name="course_fee"  value="" required placeholder="Enter your name">
                                            </div>
                                           
                                            
                                            
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" name="<?php echo $btn_name ; ?>" id="update_bank"
                                             class="btn btn-primary">Next</button>
                                       
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </section>
            
            <?php } ?>
            <!--Main content section end-->

            
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