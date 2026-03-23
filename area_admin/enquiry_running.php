<?php 
include 'session.php'; 
include '../smtp/init.php';
$type = mysqli_fetch_array(mysqli_query($con, "select type from user where id='$_SESSION[userid]'"))['type'];
if(sub_menu_check("A","B",$_SESSION['userid'], $type)==1){
    
}else{
    echo '<script>alert("You are not permitted to access this option.");window.location.assign("index");</script>'; 
}

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");
if($branch_access_details['enquiry_system']=="YES"){
    
}else{
    mysqli_close($con);
    echo '<script>window.location.assign("index");</script>';
}


if(isset($_POST['cancel_ids'])){
    $id=VerifyData($_POST['data_id']);
    $des=VerifyData($_POST['des']);
    
    if(!$id=="" and !$des==""){
        $check=mysqli_query($con,"select * from enquiry_details where id='$id'");
        if(mysqli_num_rows($check)){
          $enquiry_details=mysqli_fetch_array($check);
           $staff_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$enquiry_details[create_by]'"));
           $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$enquiry_details[course_id]'"));
           $batch_details=mysqli_fetch_array(mysqli_query($con,"select * from batch_details where id='$enquiry_details[batch_id]'"));
       
       $update=mysqli_query($con,"update enquiry_details set status='CANCEL', cancel_date='$t_date' where id='$id'");
         if($update){
             $insert_history=mysqli_query($con,"insert into `enquiry_follow_history`(`enquiry_id`, `follow_by`, `des`, `next_date`, `date`) values('$id', '$_SESSION[userid]', '$des', '$t_date', '$c_date')");
           if($insert_history){
          echo '<script>alert("Course Enroll proceess cancel.");window.location.assign("enquiry_running")</script>'; 
           }else{
            echo '<script>alert("Server Error 106.");window.location.assign("enquiry_running");</script>';    
           }
               
           }else{
         echo '<script>alert("Server Error 105.");window.location.assign("enquiry_running");</script>';     
         }
                       
          
       
        }else{
            echo '<script>alert("Server error 101.");window.location.assign("enquiry_running");</script>';
        }
        
    }else{
        echo '<script>alert("Not allowed.");window.location.assign("enquiry_running");</script>';
    }
}

if(isset($_GET['final_ids'])){
    $id=VerifyData($_GET['final_ids']);
    if(!$id==""){
        $check=mysqli_query($con,"select * from enquiry_details where id='$id'");
        if(mysqli_num_rows($check)){
          $enquiry_details=mysqli_fetch_array($check);
          $staff_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$enquiry_details[create_by]'"));
          $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$enquiry_details[course_id]'"));
          $batch_details=mysqli_fetch_array(mysqli_query($con,"select * from batch_details where id='$enquiry_details[batch_id]'"));
       
          
          $courseid=$enquiry_details['course_id'];
          $name=$enquiry_details['name'];
      $email_id=$enquiry_details['email'];
      $state_id = $enquiry_details['state_id'];
        $reg_no = $brand_short_code . "/" . date("Y") . "/" . $count; 
      $pin = $enquiry_details['pin'];
    $mobile=$enquiry_details['mobile1'];
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
    if(!$courseid=="" and !$name=="" and !$mobile=="" and !$reg_no=="" ){
        $check_course=mysqli_query($con,"select * from course_details where id='$courseid'");
        if(mysqli_num_rows($check_course)==1){
            $course_details=mysqli_fetch_array($check_course);
            $check_mobile=mysqli_num_rows(mysqli_query($con,"select * from user where reg_no='$reg_no'"));
            $session_id = mysqli_fetch_array(mysqli_query($con, "select id from session_details where status='RUN'"))['id'];
            if(!$check_mobile>0){
            
           if($login_details['type']==1){
               $branch_id=$_SESSION['userid'];  
             }else{
               $branch_id=$login_details['branch_id'];  
             }  
            $insert=mysqli_query($con,"insert into `user`(`branch_id`, `name`, `mobile`, `pass`, `email`, `r_date`, `state_id`,`pin`, `reg_no`) values('$branch_id', '$name', '$mobile', '$pass', '$email_id', '$t_date','$state_id','$pin', '$reg_no')");    
            if($insert){
                $insert_id=mysqli_insert_id($con);
               $update_count =  mysqli_query($con,"UPDATE website_data SET adm_count = adm_count + 1 WHERE id = 1");
               if($update_count){
                if($insert_id>0){
                  $insert_wallet=mysqli_query($con,"insert into `wallet`(`userid`) values('$insert_id')");
                  if($insert_wallet){
                     $create_course=mysqli_query($con,"insert into `course_book`(`branch_id`, `userid`, `course_id`, `session_id`, `fee`, `book_date`) values('$branch_id', '$insert_id', '$courseid', '$session_id', '$course_details[fee]', '$t_date')");
                    $course_inert_id=mysqli_insert_id($con);
                      if($create_course){
                         $update=mysqli_query($con,"update enquiry_details set status='CLOSE', convert_date='$t_date' where id='$id'");
                         if($update){
                              $send=  send_mail($email_id,"LOGIN DETAILS ",$text);
                              $mob=$mobile;
                       
                        if($send){
                           echo '<script>alert("Registration has been successfully completed. Please complete the course enrollment process. Panel login details have been sent to the registered email ID.");</script>';   
                        }else{
                            echo '<script>alert("Registration has been successfully completer but email not sends.");window.location.assign("enquiry_running");</script>';
                        }
                             
                         }else{
                         echo '<script>alert("Server Error 105.");window.location.assign("enquiry_running");</script>';     
                         }
                     }else{
                        echo '<script>alert("Server Error 104.");window.location.assign("enquiry_running");</script>'; 
                     }
                      
                  }else{
                     echo '<script>alert("Server Error 103.");window.location.assign("enquiry_running");</script>'; 
                  }
                  
                }else{
                    echo '<script>alert("Server Error 102.");window.location.assign("enquiry_running");</script>';  
                }
               }else{
                   echo '<script>alert("Error in updating Admission Count");window.location.assign("enquiry_running");</script>';
               }
            }else{
              echo '<script>alert("Server Error 101.");window.location.assign("enquiry_running");</script>';  
            }
            }else{
                echo '<script>alert("Registration number is already used");window.location.assign("enquiry_running");</script>';
            }
        }else{
            echo '<script>alert("Please select course.");window.location.assign("enquiry_running");</script>';
        }
    }else{
        echo '<script>alert("Please fill all feild.");window.location.assign("enquiry_running");</script>';
    }
           
          
       
        }else{
            echo '<script>alert("Server error 101.");window.location.assign("enquiry_running");</script>';
        }
        
    }else{
        echo '<script>alert("Not allowed.");window.location.assign("enquiry_running");</script>';
    }
}
$c_session = mysqli_fetch_array(mysqli_query($con, "select session_id from login_session where userid='$login_details[id]'"))['session_id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Running Enquiry|
        <?php echo $brand_name; ?>
    </title>
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
          .drop_enquiry{
    	background: #157daf !important;
    }
    
    .enquiry_running{
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
                            <h1>Running Follow-up Enquiry Details</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>


  <section class="content" id="data_view">
     
     </section>

           

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                      
                        <div class="col-12">
                            <br>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Follow-up Enquiry Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
                                                <th>Enquiry Date</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Course</th>
                                                <th>Coupen Code</th>
                                                <th>Discount (in %)</th>
                                                <th>Details</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $i=0;
                                            $sql_d = mysqli_query($con, "SELECT * FROM enquiry_details WHERE branch_id='$current_branch_id' AND status='RUN' and session_id='$c_session' ORDER BY next_date DESC");
                                            while ($row = mysqli_fetch_array($sql_d)) {
                                               
                                                $staff = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM user WHERE id='$row[create_by]'"));
                                                $course = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM course_details WHERE id='$row[course_id]'"));
                                                $batch = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM batch_details WHERE id='$row[batch_id]'"));
                                                
                                               $enquiry_date = date('d M Y', strtotime($row['enquiry_date']));
                                            $next_followup = date('d M Y', strtotime($row['next_date']));
                                            ?>
                                            <tr>
                                                <td><?= $i +=1; ?></td>
                                                <td><?= $enquiry_date ?></td>
                                                <td><?= $row['name'] ?></td>
                                                <td><?= $row['mobile1'] ?></td>
                                                <td><?= $course['name'] ?></td>
                                                <td> 
                                                    <?php 
                                                    if($row['coupen_code'] != ""){
                                                    echo "<b>" . $row['coupen_code'] . "</b>";
                                                    
                                                    }else{?>
                                                    <?php
                                                    echo "No Coupen Applied"; 
                                                    }?>
                                                    </td>
                                                <td><b><?= $row['coupen_discount'] ?> %</b></td>
                                                <td>
                                                  <button type="button" class="btn btn-md btn-info" data-toggle="modal" data-target="#viewModal<?= $row['id'] ?>">
                                                    <i class="fa fa-eye"></i> View
                                                  </button>
                                                </td>

                                                <td>
                                                  <div id="action<?= $row['id'] ?>">
                                                    <a href="enquiry_details?ids=<?= $row['id'] ?>" title="Add follow-up details" style="cursor:pointer; color:blue;">
                                                      <i class="fa fa-plus"></i> Add
                                                    </a><br>
                                                
                                                    <a href="enquiry_running?final_ids=<?= $row['id'] ?>" 
                                                       title="Verify for enroll process" 
                                                       onclick="return confirm('Are you sure for enroll process.')" 
                                                       style="cursor:pointer; color:green;">
                                                      <i class="fa fa-paper-plane"></i> Enroll
                                                    </a><br>
                                                
                                                    <a onclick="cancel_div('<?= $row['id'] ?>')" 
                                                       title="Cancel follow-up for this detail" 
                                                       style="cursor:pointer; color:red;">
                                                      <i class="fa fa-trash"></i> Cancel
                                                    </a>
                                                  </div>
                                                
                                                  <div id="cancel<?= $row['id'] ?>" style="display:none; margin-top: 10px;">
                                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                                      <strong>Enter Cancel Reason:</strong>
                                                      <span onclick="cancel_div_hide('<?= $row['id'] ?>')" style="color:red; cursor:pointer;">
                                                        <i class="fa fa-close"></i>
                                                      </span>
                                                    </div>
                                                    <form method="post" name="cancel_form<?= $row['id'] ?>">
                                                      <input type="hidden" name="data_id" value="<?= $row['id'] ?>">
                                                      <textarea name="des" class="form-control mb-2" rows="2" required></textarea>
                                                      <input type="submit" name="cancel_ids" value="Submit" class="btn btn-sm btn-success">
                                                    </form>
                                                  </div>
                                                </td>

                                            </tr>
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="viewModal<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                              <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header bg-light">
                                                    <h5 class="modal-title">Enquiry Details</h5>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <div class="row">
                                            
                                                      <div class="col-md-6 mb-2">
                                                        <label><strong>Enquiry Date:</strong></label>
                                                        <input type="text" class="form-control" value="<?= $enquiry_date ?>" readonly>
                                                      </div>
                                            
                                                      <div class="col-md-6 mb-2">
                                                        <label><strong>Created By:</strong></label>
                                                        <input type="text" class="form-control" value="<?= $staff['name'] ?>" readonly>
                                                      </div>
                                            
                                                      <div class="col-md-6 mb-2">
                                                        <label><strong>Name:</strong></label>
                                                        <input type="text" class="form-control" value="<?= $row['name'] ?>" readonly>
                                                      </div>
                                            
                                                      <div class="col-md-6 mb-2">
                                                        <label><strong>Mobile 1:</strong></label>
                                                        <input type="text" class="form-control" value="<?= $row['mobile1'] ?>" readonly>
                                                      </div>
                                            
                                                      <div class="col-md-6 mb-2">
                                                        <label><strong>Mobile 2:</strong></label>
                                                        <input type="text" class="form-control" value="<?= $row['mobile2'] ?>" readonly>
                                                      </div>
                                            
                                                      <div class="col-md-6 mb-2">
                                                        <label><strong>Course:</strong></label>
                                                        <input type="text" class="form-control" value="<?= $course['name'] ?>" readonly>
                                                      </div>
                                            
                                                      <div class="col-md-6 mb-2">
                                                        <label><strong>Batch:</strong></label>
                                                        <input type="text" class="form-control" value="<?= $batch['batch_name'] ?>" readonly>
                                                      </div>
                                            
                                            
                                                      <div class="col-md-6 mb-2">
                                                        <label><strong>Next Follow-Up Date:</strong></label>
                                                        <input type="text" class="form-control" value="<?= $next_followup ?>" readonly>
                                                      </div>
                                            
                                                      <div class="col-md-12 mb-2">
                                                        <label><strong>Last Discussion:</strong></label>
                                                        <input type="text" class="form-control" value="<?= $row['enquiry_note'] ?>" readonly>
                                                      </div>
                                                      <?php
                                                        if($row['coupen_code'] !== ""){
                                                      ?>
                                                      <div class="col-md-6 mb-2">
                                                        <label><strong>Coupen Code (if any):</strong></label>
                                                        <input type="text" class="form-control" value="<?= $row['coupen_code'] ?>" readonly>
                                                      </div>
                                                      <div class="col-md-6 mb-2">
                                                        <label><strong>Discount % (if any):</strong></label>
                                                        <input type="text" class="form-control" value="<?= $row['coupen_discount'] ?>" readonly>
                                                      </div>
                                                      <?php } ?>
                                                    </div>
                                                  </div>
                                                  <div class="modal-footer bg-light">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            
                                            <?php } ?>
                                            </tbody>


                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
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
    function cancel_div(val){
        document.getElementById("action"+val).style.display="none";
        document.getElementById("cancel"+val).style.display="block";
    }
    function cancel_div_hide(val){
        document.getElementById("action"+val).style.display="block";
        document.getElementById("cancel"+val).style.display="none";
    }
    function update_enquery_data(){
        document.getElementById("enquery_data_update_btn").style.display="none";
        document.getElementById("enquery_data_edit_btn").style.display="block";
        document.getElementById("name").readOnly=true;
        document.getElementById("guardian_name").readOnly=true;
        document.getElementById("guardian_relation").readOnly=true;
        
        document.getElementById("guardian_occupation_input").style.display="block";
        document.getElementById("guardian_occupation").style.display="none";
        $("#guardian_occupation_input").val($("#guardian_occupation").val());
        
        document.getElementById("category_input").style.display="block";
        document.getElementById("category").style.display="none";
        $("#category_input").val($("#category").val());
        
        document.getElementById("mobile1").readOnly=true;
        document.getElementById("mobile2").readOnly=true;
        document.getElementById("address1").readOnly=true;
        
        document.getElementById("employment_status_input").style.display="block";
        document.getElementById("employment_status").style.display="none";
        $("#employment_status_input").val($("#employment_status").val());
        
        document.getElementById("computer_literacy_input").style.display="block";
        document.getElementById("computer_literacy").style.display="none";
        $("#computer_literacy_input").val($("#computer_literacy").val());
        
        document.getElementById("qualification_input").style.display="block";
        document.getElementById("qualification").style.display="none";
        $("#qualification_input").val($("#qualification").val());
        
        document.getElementById("education_stream_input").style.display="block";
        document.getElementById("education_stream").style.display="none";
        $("#education_stream_input").val($("#education_stream").val());
        alert("Enquery Data Update Done.");
        
    }
    
    
    function edit_enquery_data(){
        document.getElementById("enquery_data_update_btn").style.display="block";
        document.getElementById("enquery_data_edit_btn").style.display="none";
        document.getElementById("name").readOnly=false;
        document.getElementById("guardian_name").readOnly=false;
        document.getElementById("guardian_relation").readOnly=false;
        document.getElementById("guardian_occupation_input").style.display="none";
        document.getElementById("guardian_occupation").style.display="block";
        document.getElementById("category_input").style.display="none";
        document.getElementById("category").style.display="block";
        document.getElementById("mobile1").readOnly=false;
        document.getElementById("mobile2").readOnly=false;
        document.getElementById("address1").readOnly=false;
        document.getElementById("employment_status_input").style.display="none";
        document.getElementById("employment_status").style.display="block";
        document.getElementById("computer_literacy_input").style.display="none";
        document.getElementById("computer_literacy").style.display="block";
        document.getElementById("qualification_input").style.display="none";
        document.getElementById("qualification").style.display="block";
        document.getElementById("education_stream_input").style.display="none";
        document.getElementById("education_stream").style.display="block";
        
    }
    
    function update_enquery_form_data(val,val2,val3){
        $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'update_enquery_form_data='+val3+'&data_fl='+val+'&data='+val2,
                success: function(data){
                   
                }
              } );
    }
    
    function data_view_close(){
        $("#data_view").html("");
    }
    function get_data_view(val){
         $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'get_data_report_view='+val,
                success: function(data){
                   $("#data_view").html(data);
                }
              } );
    }
    
    
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