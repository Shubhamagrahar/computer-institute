<?php
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

function frenchise_course_fee($ida,$mob){
    global $con;
    global $t_date;
    global $c_date;
    $sql_data=mysqli_fetch_array(mysqli_query($con,"select * from branch_details where userid='$ida'"));
    if($sql_data['student_course_fee']=="Yes"){
        $op_bal=$sql_data['wallet'];
       $cl_bal=$op_bal - $sql_data['per_course_fee'] ;
       $update_wallet=mysqli_query($con,"update branch_details set wallet='$cl_bal' where userid='$ida'");
       if($update_wallet){
          
           
           $description="New Course book franchise charge for : ".$mob;
         $teransactionIntsert=mysqli_query($con,"insert into `branch_transaction`(`userid`, `des`, `debit`, `date`, `c_date`, `op_bal`, `cl_bal`, `by_userid`) values('$ida', '$description', '$sql_data[per_course_fee]', '$t_date', '$c_date', '$op_bal', '$cl_bal', '$ida')");  
        if($teransactionIntsert){
            return 1;
        }else{
           return "Function error 102."; 
        }
           
       }else{
           return "Function error 101.";
       }
    }else{
        return 1;
    }
}



if(isset($_GET['ids'])){
    $course_book_id=VerifyData($_GET['ids']);
    if(!$course_book_id==""){
       $sql=mysqli_query($con,"select * from course_book where id='$course_book_id' and status='OPEN'");
       if(mysqli_num_rows($sql)==1){
          $book_course_details=mysqli_fetch_array($sql) ;
          $user_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$book_course_details[userid]' and branch_id='$_SESSION[userid]'"));
       }else{
        echo '<script>alert("Course id not valid.");window.location.assign("enroll_new");</script>';    
       }
    }else{
      echo '<script>window.location.assign("enroll_new");</script>';   
    }
}else{
   echo '<script>window.location.assign("enroll_new");</script>'; 
}

if(isset($_POST['final_process_enroll'])){
      $photo = $_FILES["photo"]["name"];
     $photo2 = $_FILES["photo"]["tmp_name"];
     $fee_collect_type=VerifyData($_POST['fee_collect_type']);
     $monthly_fee=VerifyData($_POST['monthly_fee']);
     $daily_late_fee=VerifyData($_POST['daily_late_fee']);
     $late_fee_count_after=VerifyData($_POST['late_fee_count_after']);
     
     // if(!$photo==""){
          if(!$fee_collect_type==""){
              
              if($fee_collect_type=="YES"){
                  if(!$monthly_fee=="" and !$daily_late_fee=="" and !$late_fee_count_after==""){
                      
                  }else{
                     echo '<script>alert("Please fill Fee collection type all details.");window.location.assign("enroll_final");</script>'; 
                     exit();
                  }
              }
              
              if($fee_collect_type=="OTP"){
                  $discount_in_per=number_format(VerifyData($_POST['discount_in_per']),2);
                  $discount_in_rs=VerifyData($_POST['discount_in_rs']);
                  $course_final_fee=VerifyData($_POST['course_final_fee']);
                  $pay_type=VerifyData($_POST['pay_type']);
                  $pay_des=VerifyData($_POST['pay_des']);
              }
                  
             
              
              if(!$photo==""){
            $extension12 = explode(".", $photo);

             $extension1 = end($extension12);
          
            $nn_name = rand(1000,9999);
            $newfilename1 =$user_details['id'].$nn_name.".".$extension1;
            $photo_dr="area_s/user_img/".$newfilename1 ;
            $upload_photo= move_uploaded_file($photo2,"../area_s/user_img/".$newfilename1) ;
              }else{
               $upload_photo =1; 
               $photo_dr=$user_details['photo'];
              }
        if($upload_photo){
            $update_dr=mysqli_query($con,"update user set photo='$photo_dr' where id='$user_details[id]'");
            if($update_dr){
                if($upload_photo==1){
                   $unlink_p=1; 
                }else{
                $last_check=end(explode("/",$user_details['photo']));
                
                if($last_check=="user.jpg"){
                   $unlink_p="1" ;
                }else{
                     $unlink_p=unlink("../area_s/user_img/".$last_check);
                 
                }
                
                }
                
                
                
                if($unlink_p){
                    
                
                frenchise_course_fee($_SESSION['userid'],$user_details['mobile']);
               
                $user_wallet=mysqli_fetch_array(mysqli_query($con,"select * from wallet where userid='$user_details[id]'"));
                $op_bal=$user_wallet['main_b'];
                $cl_bal=$op_bal - $book_course_details['fee'];
                $update_wallet=mysqli_query($con,"update wallet set main_b='$cl_bal' where userid='$user_details[id]'");
                if($update_wallet){
                $des="Course inrollment";
                $insert_transaction = mysqli_query($con,"insert into `transaction`(`userid`, `des`, `debit`, `type`, `date`, `c_date`, `op_bal`, `cl_bal`) values('$user_details[id]', '$des', '$book_course_details[fee]', '1', '$t_date', '$c_date', '$op_bal', '$cl_bal')");
                 if($insert_transaction){
                    $update_book_course=mysqli_query($con,"update course_book set status='RUN' where id='$book_course_details[id]'") ;
                    if($update_book_course){
                        
                        if($fee_collect_type=="YES"){ 
                           $update_user_data=mysqli_query($con,"update user set fee_collect_type='$fee_collect_type', monthly_fee='$monthly_fee', daily_late_fee='$daily_late_fee', late_fee_count_after='$late_fee_count_after', next_fee_date='$t_date' where id='$user_details[id]'") ;
                           if($update_user_data){
                               
                           echo '<script>alert("Enroll Course final Successfully Done.");window.location.assign("enroll_new");</script>';
                           }else{
                            echo '<script>alert("Server Error 104.");window.location.assign("enroll_final");</script>';   
                           }
                        }else{
                       echo '<script>alert("Enroll Course final Successfully Done.");window.location.assign("enroll_new");</script>'; 
                        }
                        
                         if($fee_collect_type=="OTP"){
                             $update_user_data=mysqli_query($con,"update user set fee_collect_type='$fee_collect_type' where id='$user_details[id]'") ;
                           $go_next_otpo_final=2;
                           if($discount_in_rs>0){
                                $user_wallet=mysqli_fetch_array(mysqli_query($con,"select * from wallet where userid='$user_details[id]'"));
                                $op_bal=$user_wallet['main_b'];
                                $cl_bal=$op_bal + $discount_in_rs;
                                $update_wallet=mysqli_query($con,"update wallet set main_b='$cl_bal' where userid='$user_details[id]'");
                                if($update_wallet){
                                    
                                    $des="One Time Payment Discount Offer  :".$discount_in_per."% of ".$book_course_details['fee'];
                           $insert_transaction = mysqli_query($con,"insert into `transaction`(`userid`, `des`, `credit`, `type`, `date`, `c_date`, `op_bal`, `cl_bal`) values('$user_details[id]', '$des', '$discount_in_rs', '2', '$t_date', '$c_date', '$op_bal', '$cl_bal')");
                                  if($insert_transaction){
                                      $go_next_otpo_final=1;
                                  } else{
                                      echo '<script>alert("SERVER ERROR OTP 102.");window.location.assign("enroll_new");</script>'; 
                                  }
                                }else{
                                   echo '<script>alert("SERVER ERROR OTP 101.");window.location.assign("enroll_new");</script>';  
                                }
                                
                           }else{
                               $go_next_otpo_final=1;
                           }
                           
                           if($go_next_otpo_final==1){
                              
                               $user_wallet=mysqli_fetch_array(mysqli_query($con,"select * from wallet where userid='$user_details[id]'"));
                                $op_bal=$user_wallet['main_b'];
                                $cl_bal=$op_bal + $course_final_fee;
                                $update_wallet=mysqli_query($con,"update wallet set main_b='$cl_bal' where userid='$user_details[id]'");
                                if($update_wallet){
                                    
                                    $des=$pay_type."/Course fee received by :".$login_details['name']."/ ".$pay_des;
                           $insert_transaction = mysqli_query($con,"insert into `transaction`(`userid`, `des`, `credit`, `type`, `date`, `c_date`, `op_bal`, `cl_bal`) values('$user_details[id]', '$des', '$course_final_fee', '2', '$t_date', '$c_date', '$op_bal', '$cl_bal')");
                                 $insert_fee_collect_details=mysqli_query($con,"insert into `fee_collect_details`(`userid`, `by_rcv`, `amt`, `date`) values('$user_details[id]', '$_SESSION[userid]', '$course_final_fee', '$t_date')");
                                  if($insert_transaction){
                                             $op_bal=$login_wallet['main_b'];
                               $cl_bal=$op_bal + $course_final_fee;
                               $update_wallet_self=mysqli_query($con,"update wallet set main_b='$cl_bal' where userid='$_SESSION[userid]'");
                               if($update_wallet_self){
                                   
                                   $des=$pay_type."/Course fee collect by :".$user_details['mobile']."/ ".$pay_des;
                                   $insert_transaction = mysqli_query($con,"insert into `transaction`(`userid`, `des`, `credit`, `type`, `date`, `c_date`, `op_bal`, `cl_bal`) values('$_SESSION[userid]', '$des', '$course_final_fee', '2', '$t_date', '$c_date', '$op_bal', '$cl_bal')");
                                   if($insert_transaction){
                                      echo '<script>alert("Enroll Course final Successfully Done.");window.location.assign("enroll_new");</script>';
                                   }else{
                                    echo '<script>alert("SERVER ERROR OTP 105.");window.location.assign("enroll_new");</script>'; 
                                   }
                               }else{
                                echo '<script>alert("SERVER ERROR OTP 104.");window.location.assign("enroll_new");</script>'; 
                               }
                                  } else{
                                      echo '<script>alert("SERVER ERROR OTP 102.");window.location.assign("enroll_new");</script>'; 
                                  }
                                }else{
                                   echo '<script>alert("SERVER ERROR OTP 101.");window.location.assign("enroll_new");</script>';  
                                } 
                               
                           }else{
                               echo '<script>alert("SERVER ERROR OTP 103.");window.location.assign("enroll_new");</script>'; 
                           }
                           
                       }else{
                         echo '<script>alert("Enroll Course final Successfully Done.");window.location.assign("enroll_new");</script>';  
                       }
                               
                       if($fee_collect_type=="NO"){ 
                           echo '<script>alert("Enroll Course final Successfully Done.");window.location.assign("enroll_new");</script>';
                       }
                        
                        
                    }else{
                      echo '<script>alert("Server Error 103.");window.location.assign("enroll_final");</script>';    
                    }
                 }else{
                   echo '<script>alert("Server Error 102.");window.location.assign("enroll_final");</script>';  
                 }   
                }else{
                  echo '<script>alert("Server Error 101.");window.location.assign("enroll_final");</script>';  
                }
                 
                
                }else{
                   echo '<script>alert("Photo Unlink Failed.");window.location.assign("enroll_final");</script>';  
                }
            }else{
                echo '<script>alert("Photo Update user Failed.");window.location.assign("enroll_final");</script>';     
            }
        }else{
          echo '<script>alert("Photo Upload Failed.");window.location.assign("enroll_final");</script>';     
        }
      }else{
        echo '<script>alert("Please select Fee collection type.");window.location.assign("enroll_final");</script>';
     }
    //  }else{
    //     echo '<script>alert("Please Select Photo.");window.location.assign("enroll_final");</script>';
    //  }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Enrollment Final Process |  <?php echo $brand_name; ?></title>
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
     table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
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
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

     <form name="form_1" method="post" enctype="multipart/form-data">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
           
              <div class="col-md-12">
                <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Application Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
           
                <div class="card-body">
                  <div class="row">
					  <div class="col-md-3">
                       <label>Registration No:</label>
                      <input type="text" readonly name="registration_no" value="<?php echo $brand_short_code.$book_course_details['id'] ;?>" class="form-control">
                     
                      </div>
                      <div class="col-md-2">
                       <label>Date :</label>
                      <input type="date"  name="start_date" id="start_date" required value="<?php echo $t_date ;?>" onchange="set_course_start_date(this.value)" class="form-control">
                     
                      </div>
                      <div class="col-md-3">
                       <label>Course Applied For:</label>
                        <select id="course_id" name="course_id" required onchange="get_fee(this.value)" class="form-control">
                            <option id="OPT_name" value="<?php 
                            $details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$book_course_details[course_id]'"));
                            echo $book_course_details['course_id'] ; ?>"><?php echo $details['name'] ;?></option>
                        <option value="">Please select</option>
                        <?php
                        $sql_course=mysqli_query($con,"select * from course_details where status='OPEN'");
                        while($row=mysqli_fetch_array($sql_course)){
                        ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                        <?php } ?>
                        </select> 
                     
                      </div>
                      <div class="col-md-2">
                       <label>Course Fee: </label>
                      <input type="text" id="course_fee" required readonly name="course_fee" value="<?php echo $book_course_details['fee'] ; ?>" class="form-control" required >
                     
                      </div>
                      <div class="col-md-2">
                       <label>Batch: &nbsp;&nbsp;&nbsp;&nbsp;<span style="float:right;color:blue;cursor:pointer;" ><a target="_blank" href="add_course_batch"><i class="fa fa-plus"></i>Add</span></a></label>
                      <select id="batch_id" name="batch_id" required class="form-control" onchange="update_course_batch(this.value)">
                            
                        <option value="">Please select</option>
                        <?php
                        $sql_course=mysqli_query($con,"select * from batch_details where branch_id='$_SESSION[userid]'");
                        while($row=mysqli_fetch_array($sql_course)){
                        ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['batch_name']; ?></option>
                        <?php } ?>
                        </select> 
                     
                      </div>
				</div>
                  
                  
                </div>
                <!-- /.card-body -->

               
           
            </div>
            </div>   
            
            
            <div class="col-md-4">
                <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Profile Photo</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             
                <div class="card-body">
                  <div class="row">
					    <div class="col-12">
        			     <div  style="text-align: center; margin-top:-40px;"><br>
                    	<img src="<?php echo $web_link.$user_details['photo'] ?>" class="img3" id="profile-img-tag" hight="125" width="160">
                          </div>
        			   </div>
					      <div class="col-12" align="center">
					         
						<div class="item form-group" style="argin-top: -30px;">
							<label for="last-name">Select Photo<span class="required">*</span>
							</label>
							<div class="col-12 ">
								<input type="file" name="photo" id="profile-img" value="" class="form-control">
							</div>
						</div>
					
						
						 </div>
						 <div class="col-md-12">
                       <label>Name :</label>
                      <input type="text" required name="student_name" onkeyup="update_user_data('name',this.value,'<?php echo $user_details['id'] ;?>')" value="<?php echo $user_details['name'] ;?>" class="form-control">
                     
                      </div>
                      <div class="col-md-12">
                       <label>Father Name:</label>
                      <input type="text" required name="father_name" onkeyup="update_user_data('father_name',this.value,'<?php echo $user_details['id'] ;?>')" value="<?php echo $user_details['father_name'] ;?>" class="form-control">
                     
                      </div>
                      
						</div>
                  
                  
                </div>
                <!-- /.card-body -->

                
          
            </div>
            </div>
            
             <div class="col-md-8">
                <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Profile Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             
                <div class="card-body ">
                <div class="row">
                  
                      <div class="col-md-6">
                       <label>Father Mobile Number:</label>
                      <input type="number" required name="father_mobile" onkeyup="update_user_data('father_mobile',this.value,'<?php echo $user_details['id'] ;?>')" value="<?php echo $user_details['father_mobile'] ;?>" class="form-control">
                     
                      </div>
                  <div class="col-md-6">
                      <label>Mobile No.: (Read Only)</label>
                      <input type="text" readonly name="mobile" value="<?php echo $user_details['mobile'] ;?>" class="form-control">
                  </div>
                   <div class="col-md-6">
                      <label>WhatsApp No.; </label>
                      <input type="number"   name="w_mob" id="w_mob" onkeyup="update_user_data('w_mob',this.value,'<?php echo $user_details['id'] ;?>')" required value="<?php echo $user_details['w_mob'] ;?>"  class="form-control">
                  </div>
                  <div class="col-md-6">
                      <label>Email ID.: </label>
                      <input type="email"  name="email" id="email" onkeyup="update_user_data('email',this.value,'<?php echo $user_details['id'] ;?>')" required value="<?php echo $user_details['email'] ;?>" class="form-control" pattern=".+@.+">
                  </div>
                 
                   <div class="col-md-6">
                      <label>Date of Birth: </label>
                      <input type="date"  name="dob" id="dob" onchange="update_user_data('dob',this.value,'<?php echo $user_details['id'] ;?>')" required value="<?php echo $user_details['dob'] ;?>" class="form-control">
                  </div>
                   <div class="col-md-6">
                <label>Gender:</label>
                <select name="gender"  id="gender"  required  class="form-control" onchange="update_user_data('gender',this.value,'<?php echo $user_details['id'] ;?>')">
                   <option value="">Select </option>
                    <option value="Male">Male </option>
                    <option value="Female">Female </option>
                    <option value="Other">Other </option>
                </select>
                
            </div>
                  
                
                  <script>
                    $("#gender").val('<?php echo $user_details['gender'] ;?>');
                  
                </script>
                 
                  
                   <div class="col-md-6 form-group">
                      <label>Present Address: </label>
                      <textarea class="form-control"  name="full_add" id="full_add"  onkeyup="update_user_data('full_add',this.value,'<?php echo $user_details['id'] ;?>')"  placeholder="Enter your full addres"><?php echo $user_details['full_add'] ;?></textarea>
                     
                  </div>
                  <div class="col-md-6 form-group">
                      <label>Permanent Address: </label> <span style="float:right;color:#6178e9;"><input type="checkbox" id="check_bx1" name="check_bx1" onclick="get_data_transfer('full_add_permanent','<?php echo $user_details['id'] ;?>',full_add.value)"  > Same as present address</span>
                      <textarea class="form-control"  name="full_add_permanent" id="full_add_permanent"  onkeyup="update_user_data('full_add_permanent',this.value,'<?php echo $user_details['id'] ;?>')"  placeholder="Enter your full addres"><?php echo $user_details['full_add_permanent'] ;?></textarea>
                     
                  </div>
                  
                <script>
                function check_chk_box(){
                      var full_add_permanent=$('#full_add_permanent').val();
                      var full_add=$('#full_add').val();
                      if(full_add_permanent==full_add){
                          
                         $('#check_bx1').prop('checked', true);
                      }else{
                           $('#check_bx1').prop('checked', false);
                      }
                  }
                  setInterval(function() {
                     check_chk_box() 
                  }, 500);
                function get_data_transfer(val1,val3,val4){
                   
                    $('input[type=checkbox][name=check_bx1]').change(function() {
                        if ($(this).is(':checked')) {
                           $("#full_add_permanent").val(val4);
                           var val2=$("#full_add_permanent").val();
                              update_user_data(val1,val2,val3);
                        }
                        else {
                          $("#full_add_permanent").val("");
                          var val2=$("#full_add_permanent").val();
                          update_user_data(val1,val2,val3);
                        }
                    });
               
                }
                </script>

                  </div>
                  
                </div>
                <!-- /.card-body -->

               
              
            </div>
            </div>
            <div class="col-md-12">
                <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Educational Details</h3>
                <span onclick="add_new_row('<?php echo $user_details['id'] ;?>')" style="float:right; cursor: pointer;"><i class="fa fa-plus"></i> Add</span>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            
                <div class="card-body ">
                <div class="row">
                  <div id="education_table" class="col-md-12">
                      
                  </div>
                   

                 </div>
                  
                </div>
                
                
                 <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Fee Collection Details</h3>
                
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            
                <div class="card-body ">
                <div class="row">
                
                      <div class="col-md-2">
                          <label>Fee Collection Type</label>
                          <select name="fee_collect_type" id="fee_collect_type" onchange="data_fee_details()" class="form-control" required >
                              <option value="" >Select</option>
                              <option value="OTP" >One Time Payment</option>
                              <option value="NO" >Part Payment</option>
                              <option value="YES" >Month Wise</option>
                          </select>
                      </div>
                     </div>
                      <div class="row" id="fee_details_data">
                         
                      </div>
                      
                 

                 </div>
                  
                </div>
                
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="final_process_enroll"  class="btn btn-success">Process</button>
                </div>
              
            </div>
            </div>
           
        
            
          </div>
        </div>
     </section>
    </form>
    
    
    
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
  function data_fee_details(){
      var fee_collect_type=$("#fee_collect_type").val();
      var course_id=$("#course_id").val();
      if(fee_collect_type=="YES"){
        
          $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'get_monthly_fee='+course_id,
                success: function(data){
                 //document.getElementById("fee_details_data").innrHTML=data;
                 $("#fee_details_data").html(data);
                }
              }
              );
      }
      if(fee_collect_type=="OTP"){
        
          $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'get_otp_fee='+course_id,
                success: function(data){
                 //document.getElementById("fee_details_data").innrHTML=data;
                 $("#fee_details_data").html(data);
                }
              }
              );
      }
      
      if(fee_collect_type=="NO"){
         //document.getElementById("fee_details_data").innrHTML=""; 
         $("#fee_details_data").html("");
        
      }
      
  }
   function delet_ex_row(val){
        if(confirm('Are you sure for delete this row?')){
            $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'delete_ex_table='+val,
                success: function(data){
                table_ex_refresh(); 
                }
              }
              );
        }
   }
   function update_ex_data(val,val2,id){
         $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'update_ex_user='+val2+'&id='+id+'&data_name='+val,
                success: function(data){
                
                   
                }
              }
              );
   }
   function add_new_row(val){
        $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'add_new_ex_table='+val,
                success: function(data){
                table_ex_refresh(); 
                }
              }
              );
   }
   
   function table_ex_refresh(){
       var val =<?php echo $user_details['id']; ?>;
        $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'refresh_ex_table='+val,
                success: function(data){
                $("#education_table").html(data);
                   
                }
              }
              );
   }
    table_ex_refresh();
    	function update_user_data(val,val2,id){
    
    	      $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'update_enroll_user='+val2+'&id='+id+'&data_name='+val,
                success: function(data){
                
                   
                }
              }
              );
    	}	
    		
    		function get_fee(val){
    		    if(val==""){
    		       document.getElementById("OPT_name").style.display="none";
                 $("#course_fee").val(0); 
                 
    		    }else{
    		    $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'fee_details='+val,
                success: function(data){
                    
                    if(data>0){
                       
                    document.getElementById("OPT_name").style.display="none";
                 $("#course_fee").val(data);
                 update_course_new_details(val,data);
                    data_fee_details();
                    }
                }
              }
              );
    		}
    		
    		    
    		     
    	
    		}
    		
    	function update_course_new_details(val,val2){
    	     $.ajax(
                      {
                        type:"GET",
                        url:"get_data",
                        data:'update_course_book_course='+<?php echo $book_course_details['id'] ;?>+'&course_id='+val+'&fee='+val2,
                        success: function(data){
                        
                           
                        }
                      }
                      );
    	}
    	
    	function update_course_batch(val){
    	     $.ajax(
                      {
                        type:"GET",
                        url:"get_data",
                        data:'update_course_batch='+<?php echo $book_course_details['id'] ;?>+'&batch_id='+val,
                        success: function(data){
                        
                           
                        }
                      }
                      );
    	}
    	
    	set_course_start_date($("#start_date").val());
    	function set_course_start_date(val){
    	      $.ajax(
                      {
                        type:"GET",
                        url:"get_data",
                        data:'update_course_start_date='+<?php echo $book_course_details['id'] ;?>+'&start_date='+val,
                        success: function(data){
                        
                           
                        }
                      }
                      );
    	}
    	
    	$("#batch_id").val(<?php echo $book_course_details['batch_id']; ?>);
    	</script>
<script>
   function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
                var x=e.target.result;
               
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
