<?php
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");




$search_data=1;
if(isset($_GET['search'])){
    $mobile=VerifyData($_GET['mobile']);
    if(!$mobile==""){
        $go_move_update_url="staff_wise_details?mobile=".$mobile."&search=Search";
        $check=mysqli_query($con,"select * from user where (id='$mobile' or mobile='$mobile')");
        if(mysqli_num_rows($check)==1){
            $user_details=mysqli_fetch_array($check);
            $search_data=2;
            
        }else{
          echo '<script>alert("Mobile number not registered.");window.location.assign("staff_wise_details");</script>';   
        }
    }else{
       echo '<script>alert("Please enter registered mobile number.");window.location.assign("staff_wise_details");</script>'; 
    }
    
}

$staff_details=mysqli_fetch_array(mysqli_query($con,"select * from staff_details where userid='$user_details[id]'"));



if(isset($_POST['update_photo'])){
     $photo = $_FILES["photo"]["name"];
     $photo2 = $_FILES["photo"]["tmp_name"];
     if(!$photo==""){ 
            $extension12 = explode(".", $photo);

             $extension1 = end($extension12);
          
            $nn_name = rand(10000,99999);
            $newfilename1 =$user_details['id'].$nn_name.".".$extension1;
            $photo_dr="area_s/user_img/".$newfilename1 ;
            $upload_photo= move_uploaded_file($photo2,"../area_s/user_img/".$newfilename1) ;
        if($upload_photo){
            $update_dr=mysqli_query($con,"update user set photo='$photo_dr' where id='$user_details[id]'");
            if($update_dr){
                
                $last_check=end(explode("/",$user_details['photo']));
                
                if($last_check=="user.jpg"){
                   $unlink_p="1" ;
                }else{
                     $unlink_p=unlink("../area_s/user_img/".$last_check);
                 
                }
                
                
                if($unlink_p){
                    echo '<script>alert("Photo update successfully done.");window.location.assign("'.$go_move_update_url.'");</script>';
                }else{
        echo '<script>alert("Old Photo Unlink Failed.");window.location.assign("'.$go_move_update_url.'");</script>';
     }
                
            }else{
        echo '<script>alert("Photo Dir Update Failed.");window.location.assign("'.$go_move_update_url.'");</script>';
     }
            
            
        }else{
        echo '<script>alert("Photo Upload Failed.");window.location.assign("'.$go_move_update_url.'");</script>';
     }
        
     }else{
        echo '<script>alert("Please Select Photo.");window.location.assign("'.$go_move_update_url.'");</script>';
     }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Staff Details |  <?php echo $brand_name; ?></title>
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
  <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
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


    .staff_drop{
	background: #157daf !important;
}

.staff_details1{
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
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
   <?php 
   if($search_data==1){
   ?> 
  <form name="searchOption" method="get">
      <section class="content">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-md-12">
                    <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Staff Details Search By Mobile Number or Registration No</h3>
              </div>
                 <div class="card-body">
                  <div class="row">
					  <div class="col-md-3">
                       <label>Mobile Number or Registration No.:</label>
                      <input type="number"  name="mobile" required value="" class="form-control" placeholder="Enter Registered Mobile Number or Registration No.">
                     
                      </div>
                     <div class="col-md-3">
                       <br>
                      <input type="submit"  name="search" value="Search" class="btn btn-success" >
                     
                      </div>
                      
                     
                     
				</div>
                  
                  
                </div> 
                         
                         
                     </div>
                 </div>
             </div>
         </div> 
      </section>
  </form>
  
  <?php } ?>
  
  <?php 
   if($search_data==2){
   ?> 
    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
              
           
          <h3>Staff Details</h3>
           
          </div>  
            <div class="col-md-4">
                <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Profile Photo</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             
                <div class="card-body">
                     <form name="form_1_photo" method="post" enctype="multipart/form-data">
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
								<input type="file" name="photo" id="profile-img" required value="" class="form-control">
								<input style="margin: 6px 0px -20px 0px;" type="submit" name="update_photo"  value="Update" class="btn btn-info">
							</div>
						</div>
					</div>	
					</div>
					</form>
					
					<div class="row">
						
					
						 <div class="col-md-12">
                       <label>Name :</label>
                      <input type="text" required name="student_name" onkeyup="update_user_details('name',this.value,'<?php echo $user_details['id'] ;?>')" value="<?php echo $user_details['name'] ;?>" class="form-control">
                    
                      </div>
                      <div class="col-md-12">
                       <label>Father Name:</label>
                      <input type="text" required name="father_name" onkeyup="update_user_details('father_name',this.value,'<?php echo $user_details['id'] ;?>')" value="<?php echo $user_details['father_name'] ;?>" class="form-control">
                     
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
                      <input type="number" required name="father_mobile" onkeyup="update_user_details('father_mobile',this.value,'<?php echo $user_details['id'] ;?>')" value="<?php echo $user_details['father_mobile'] ;?>" class="form-control">
                     
                      </div>
                  <div class="col-md-6">
                      <label>Mobile No.: (Read Only)</label>
                      <input type="text" readonly name="mobile" value="<?php echo $user_details['mobile'] ;?>" class="form-control">
                  </div>
                   <div class="col-md-6">
                      <label>WhatsApp No.: </label>
                      <input type="number"   name="w_mob" id="w_mob" onkeyup="update_user_details('w_mob',this.value,'<?php echo $user_details['id'] ;?>')" required value="<?php echo $user_details['w_mob'] ;?>"  class="form-control">
                  </div>
                  <div class="col-md-6">
                      <label>Email ID.: </label>
                      <input type="email"  name="email" id="email" onkeyup="update_user_details('email',this.value,'<?php echo $user_details['id'] ;?>')" required value="<?php echo $user_details['email'] ;?>" class="form-control" pattern=".+@.+">
                  </div>
                 
                   <div class="col-md-6">
                      <label>Date of Birth: </label>
                      <input type="date"  name="dob" id="dob" onchange="update_user_details('dob',this.value,'<?php echo $user_details['id'] ;?>')" required value="<?php echo $user_details['dob'] ;?>" class="form-control">
                  </div>
                   <div class="col-md-6">
                <label>Gender:</label>
                <select name="gender"  id="gender"  required  class="form-control" onchange="update_user_details('gender',this.value,'<?php echo $user_details['id'] ;?>')">
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
                      <label>Permanent Address </label>
                      <textarea class="form-control"  name="full_add_permanent" onkeyup="update_user_details('full_add_permanent',this.value,'<?php echo $user_details['id'] ;?>')" id="full_add_permanent"  placeholder="Enter your full addres"><?php echo $user_details['full_add_permanent'] ;?></textarea>
                     
                  </div>
                  <div class="col-md-6 form-group">
                      <label>Present Address </label>
                      <textarea class="form-control"  name="full_add" id="full_add"  onkeyup="update_user_details('full_add',this.value,'<?php echo $user_details['id'] ;?>')"  placeholder="Enter your full addres"><?php echo $user_details['full_add'] ;?></textarea>
                     
                  </div>
               
                   <div class="col-md-6">
                      <label>Pin Code: </label>
                      <input type="number"   name="pin" id="pin" onkeyup="update_user_details('pin',this.value,'<?php echo $user_details['id'] ;?>')" required value="<?php echo $user_details['pin'] ;?>"  class="form-control">
                  </div>
                        <div class="col-md-6">
                      <label>State </label>
                     
                      <select name="state_id"  class="form-control"  id="state_id" onchange="update_user_details('state_id',this.value,'<?php echo $user_details['id'] ;?>')" >
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
                   
                    $("#state_id").val('<?php echo $login_details['state_id'] ;?>');
                </script>
                 <div class="col-md-6 form-group">
                      <label>Qualification: </label>
                      <input type="text" class="form-control"  name="qualification" onkeyup="update_user_details2('qualification',this.value,'<?php echo $staff_details['userid'] ;?>')" id="qualification" value="<?php echo $staff_details['qualification'] ;?>"  placeholder="Enter staff qualification.">
                     
                  </div>
                   <div class="col-md-6 form-group">
                      <label>Designation: </label>
                     <input type="text" class="form-control"  name="designation" onkeyup="update_user_details2('designation',this.value,'<?php echo $staff_details['userid'] ;?>')" id="designation" value="<?php echo $staff_details['designation'] ;?>" placeholder="Enter staff designation.">
                     
                  </div>
                   <div class="col-md-6">
                      <label>Date of Joining: </label>
                      <input type="date"  name="doj" id="doj" onchange="update_user_details2('doj',this.value,'<?php echo $staff_details['userid'] ;?>')" required value="<?php echo $staff_details['doj'] ;?>" class="form-control">
                  </div>
                  <div class="col-md-6 form-group">
                      <label>Monthly salary: </label>
                     <input type="number" class="form-control"  name="monthly_salary" onkeyup="update_user_details2('monthly_salary',this.value,'<?php echo $staff_details['userid'] ;?>')" id="monthly_salary" value="<?php echo $staff_details['monthly_salary'] ;?>" placeholder="Enter monthly salary.">
                     
                  </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->

               
              
            </div>
            </div>
            <!--<div class="col-md-12">-->
            <!--    <div class="card card-info">-->
            <!--  <div class="card-header">-->
            <!--    <h3 class="card-title">Educational Details</h3>-->
            <!--    <span onclick="add_new_row('<?php echo $user_details['id'] ;?>')" style="float:right; cursor: pointer;"><i class="fa fa-plus"></i> Add</span>-->
            <!--  </div>-->
              <!-- /.card-header -->
              <!-- form start -->
           
            <!--    <div class="card-body ">-->
            <!--    <div class="row">-->
            <!--      <div id="education_table" class="col-md-12">-->
                      
            <!--      </div>-->
                   

            <!--     </div>-->
                  
            <!--    </div>-->
                <!-- /.card-body -->

                <!--<div class="card-footer">-->
                <!--  <button type="submit" name="final_process_enroll" class="btn btn-success">Process</button>-->
                <!--</div>-->
              
            <!--</div>-->
            <!--</div>-->
           
        
            
          </div>
        </div>
     </section>
    
    
    <?php } ?>
    <?php
    $section=1;
    if($section==2){
    ?>
     <section class="content" id="fee_collection">
       
     </section>
    
    <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Runing Enrollment </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Date</th>
                                                <th>Start Date</th>
                                                
                                                <th>Course Name</th>
                                                <th>Batch</th>
                                                <th>Due Fee</th>
                                                <th>Collect Fee</th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                            $sql_d=mysqli_query($con,"select * from course_book where userid='$user_details[id]' ");
                                            while($row=mysqli_fetch_array($sql_d)){
                                            $date=date_create($row['book_date']);
                                            $date=date_format($date,"d-m-Y");
                                            $date1=date_create($row['start_date']);
                                            $date1=date_format($date1,"d-m-Y");
                                            $user_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$row[userid]'"));
                                            $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$row[course_id]'"));
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $date ;?></td>
                                                <td><?php echo $date1 ;?></td>
                                               
                                                <td><?php echo $course_details['name'];?></td>
                                                 <?php 
                                                if($row['status']=="OPEN"){
                                                  ?>
                                                    <td colspan="3"> Please complete erollment.</td>
                                                    <?php  
                                                }
                                                ?>
                                                
                                                   <?php 
                                                if($row['status']=="RUN"){
                                                  $user_wallet=mysqli_fetch_array(mysqli_query($con,"select * from wallet where id='$row[userid]'"));
                                            $batch_details=mysqli_fetch_array(mysqli_query($con,"select * from batch_details where id='$row[batch_id]'"));
                                              ?>
                                              <td><?php echo $batch_details['batch_name'] ; ?></td>
                                                <td ><?php echo $user_wallet['main_b'];?></td>
                                              
                                                <td>
                                                    <?php 
                                                    if($user_wallet['main_b']>=0){
                                                       echo "Due Clear"; 
                                                    }else{
                                                    ?>
                                                    <i title="Collect Fee" class="fa fa-rupee" style="color:blue;cursor: pointer;" onclick="get_fee_pay_details(<?php echo $row['userid'] ;?>)"  >Collect</i>
                                                    <?php } ?>
                                                    </td>
                                               
                                              <?php
                                                }
                                                ?>
                                                
                                                <?php 
                                                if($row['status']=="CLOSE"){
                                                     $batch_details=mysqli_fetch_array(mysqli_query($con,"select * from batch_details where id='$row[batch_id]'"));
                                                    ?>
                                                    <td><?php echo $batch_details['batch_name'] ; ?></td>
                                                    <td colspan="2"> Course complete</td>
                                                    <?php 
                                                }
                                                ?>
                                                <?php 
                                                if($row['status']=="CANCEL"){
                                                    ?>
                                                    <td colspan="3"> Course Canceled</td>
                                                    <?php 
                                                }
                                                ?>
                                               
                                             
                                                
                                                
                                            </tr>
                                            
                                            <?php }  ?>
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
            
    <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Fee Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                
                                                <th>Print Receipt</th>
                                                
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                            $sql_d=mysqli_query($con,"select * from fee_collect_details where userid='$user_details[id]' order by id desc");
                                            while($row=mysqli_fetch_array($sql_d)){
                                            $date=date_create($row['date']);
                                            $date=date_format($date,"d-m-Y");
                                           
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $date ;?></td>
                                                <td><?php echo $row['amt'] ;?></td>
                                               <td><a target="_blank" href="invoice_print?fee_id=<?php echo $row['id'] ;?>"><span class="btn btn-success">Print</span></a></td>
                                                
                                            </tr>
                                            
                                            <?php }  ?>
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
    
    <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Transaction</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Date</th>
                                                <th>Description</th>
                                                
                                                <th>Credit</th>
                                                <th>Debit</th>
                                                <th>Closing Balance</th>
                                                
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                            $sql_d=mysqli_query($con,"select * from transaction where userid='$user_details[id]' order by id desc");
                                            while($row=mysqli_fetch_array($sql_d)){
                                            $date=date_create($row['date']);
                                            $date=date_format($date,"d-m-Y");
                                           
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $date ;?></td>
                                                <td><?php echo $row['des'] ;?></td>
                                                <td><?php echo $row['credit'] ;?></td>
                                                <td><?php echo $row['debit'] ;?></td>
                                                <td><?php echo $row['cl_bal'] ;?></td>
                                               
                                                
                                            </tr>
                                            
                                            <?php }  ?>
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
  <?php } ?>  
    
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
      <?php 
   if($user_details['session_id']>0){
       ?>
       $("#select_session").val('<?php echo $user_details['session_id']; ?>');
       <?php 
   }
  ?>
 
 function select_change_session(val,val2){
    if(confirm("Are you sure for change session?")){
        $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'set_session_id='+val+'&val2='+val2,
                success: function(data){
                 
                }
              }
              ); 
    }else{
      $("#select_session").val('<?php echo $user_details['session_id']; ?>');  
    }
 }
      
      function fee_paid(val){
          var deu_fee1=Number($("#deu_fee").val());
          if(deu_fee1>0){
              var deu_fee=deu_fee1;
          }else{
              var deu_fee=-deu_fee1;
          }
          var pay_fee=Number($("#pay_fee").val());
          var pay_type=$("#pay_type").val();
          var pay_des=$("#pay_des").val();
          if(pay_fee>0){
              if(pay_type!==""){
                  //var amt=Number(deu_fee) + Number(pay_fee);
                  if(deu_fee>=pay_fee){
                      document.getElementById("collect_final_btn").style.display="none";
                      document.getElementById("collect_final_btn_span").style.display="block";
                        $.ajax(
                            
                        {
                        type:"GET",
                        url:"get_data",
                        data:'paid_due_fee='+val+'&pay_fee='+pay_fee+'&pay_type='+pay_type+'&pay_des='+pay_des,
                        success: function(data){
                          if(data==1){
                             document.getElementById('fee_collection').style.display='none'; 
                             alert("Fee Collection Done.");window.location.assign("student_search");
                          }else{
                              alert(data);
                          }
                        }
                        }
                        );
                  }else{
                    alert("Do not enter an amount more than the fee payable.");
                    $("#pay_fee").val("");
                  }
              }else{
                 alert("Please select pay fee type."); 
              }
          }else{
              alert("Please enter pay fee amount.");
          }
      }
    
       function get_fee_pay_details(val){
       
        
           $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'get_fee_pay_details='+val,
                success: function(data){
                 $("#fee_collection").html(data);
                 document.getElementById('fee_collection').style.display='block';
                }
              }
              );
              
         
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
         $(function () {
            $("#example2").DataTable({
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
 <script>
   
 function update_user_details(val,val2,id){
   
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
 function update_user_details2(val,val2,id){
   
    	      $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'update_enroll_user2='+val2+'&id='+id+'&data_name='+val,
                success: function(data){
                
                   
                }
              }
              );
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
