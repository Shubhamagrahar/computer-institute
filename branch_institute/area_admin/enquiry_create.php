<?php
include 'session.php'; 
$type = mysqli_fetch_array(mysqli_query($con, "select type from user where id='$_SESSION[userid]'"))['type'];
if(sub_menu_check("A","A",$_SESSION['userid'], $type)==1){
    
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
                                              
if(isset($_POST['submit'])){
   $name=VerifyData($_POST['name']);
   $guardian_name=VerifyData($_POST['guardian_name']);
   $guardian_relation=VerifyData($_POST['guardian_relation']);
   $guardian_occupation=VerifyData($_POST['guardian_occupation']);
   $category=VerifyData($_POST['category']);
   $mobile1=VerifyData($_POST['mobile1']);
   $mobile2=VerifyData($_POST['mobile2']);
   $address1=VerifyData($_POST['address1']);
   $employment_status=VerifyData($_POST['employment_status']);
   $computer_literacy=VerifyData($_POST['computer_literacy']);
   $qualification=VerifyData($_POST['qualification']);
   $education_stream=VerifyData($_POST['education_stream']);
   $know_about_it=VerifyData($_POST['know_about_it']);
   $handbill=VerifyData($_POST['handbill']);
   $institute_student=VerifyData($_POST['institute_student']);
   $institute_friends=VerifyData($_POST['institute_friends']);
   $institute_other=VerifyData($_POST['institute_other']);
   $career_objective=VerifyData($_POST['career_objective']);
   $course_id=VerifyData($_POST['course_id']);
   $enquiry_date=VerifyData($_POST['enquiry_date']);
   $batch_id=VerifyData($_POST['batch_id']);
   $next_date=VerifyData($_POST['next_date']);
   $enquiry_note=VerifyData($_POST['enquiry_note']);
   $email=VerifyData($_POST['email']);
   
   if(!$name=="" and !$guardian_name=="" and !$guardian_occupation=="" and !$category=="" and !$mobile1=="" and !$address1=="" and !$employment_status=="" and !$computer_literacy=="" and !$qualification=="" and !$education_stream=="" and !$know_about_it=="" and !$handbill=="" and !$career_objective=="" and !$course_id=="" and !$enquiry_date=="" and !$batch_id=="" and !$next_date==""){
      $go_next_=1;
     if($handbill=="Yes"){
        if(!$institute_student=="" or !$institute_friends=="" or !$institute_other==""){
           $go_next_=2; 
        }else{
            $go_next_=1;
        } 
     }else{
        $institute_student=""; 
        $institute_friends="";
        $institute_other="";
       $go_next_=2;  
     }
     if($go_next_==2){ 
     $check_mobile=mysqli_num_rows(mysqli_query($con,"select * from enquiry_details where branch_id='$current_branch_id' and (mobile1='$mobile1' or mobile1='$mobile2')")); 
     if(!$check_mobile>0){
      $session_id = mysqli_fetch_array(mysqli_query($con, "select session_id from login_session where userid='$login_details[id]'"))['session_id'];
      $insert=mysqli_query($con,"insert into `enquiry_details`(`branch_id`, `session_id`, `create_by`, `name`, `guardian_name`, `guardian_relation`, `guardian_occupation`, `category`, `mobile1`, `mobile2`, `email`, `address1`, `employment_status`, `computer_literacy`, `qualification`, `education_stream`, `know_about_it`, `handbill`, `institute_student`, `institute_friends`, `institute_other`, `career_objective`, `course_id`, `enquiry_date`, `batch_id`, `next_date`, `enquiry_note`) values('$current_branch_id', '$session_id', '$_SESSION[userid]', '$name', '$guardian_name', '$guardian_relation', '$guardian_occupation', '$category', '$mobile1', '$mobile2', '$email', '$address1', '$employment_status', '$computer_literacy', '$qualification', '$education_stream', '$know_about_it', '$handbill', '$institute_student', '$institute_friends', '$institute_other', '$career_objective', '$course_id', '$enquiry_date', '$batch_id', '$next_date', '$enquiry_note')") ; 
      
      if($insert){
          
          $insert_id=mysqli_insert_id($con);
          if($insert_id){
              if($enquiry_note==""){
                  $des="New Enquiry Create.";
              }else{
                  $des=$enquiry_note."/ New Enquiry Create.";
              }
            
            $insert_history=mysqli_query($con,"insert into `enquiry_follow_history`(`enquiry_id`, `follow_by`, `des`, `next_date`, `date`) values('$insert_id', '$_SESSION[userid]', '$des', '$next_date', '$c_date')");
            
            if($insert_history){
                echo '<script>alert("Enquiry Create Successfully Done");window.location.assign("enquiry_running");</script>';
            }else{
              echo '<script>alert("Server error 103.");window.location.assign("enquiry_create");</script>';  
            }
              
          }else{
           echo '<script>alert("Server error 102.");window.location.assign("enquiry_create");</script>';    
          }
          
      }else{
       echo '<script>alert("Server error 101.");window.location.assign("enquiry_create");</script>';     
      }
       
         
     }else{
       echo '<script>alert("This enquiry already created.");window.location.assign("enquiry_create");</script>';  
     }
     }else{
      echo '<script>alert("Please fill all mandatory for Handbill.");window.location.assign("enquiry_create");</script>';   
     }   
   }else{
       echo '<script>alert("Please fill all mandatory.");window.location.assign("enquiry_create");</script>';
   }
   
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Create Enquiry |  <?php echo $brand_name; ?></title>
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
  
  <style type="text/css">
      .drop_enquiry{
	background: #157daf !important;
}

.enquiry_create{
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
                <h3 class="card-title">Enquiry Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body">
                  <div class="row">  
                  <div class="form-group col-md-3">
                    <label for="name">Name<span style="color:red;">*</span></label>
                    <input type="text" required style="text-transform: capitalize;" class="form-control" id="name" name="name" placeholder="Enter name.">
                    
                  </div>
                  <div class="form-group col-md-3">
                    <label for="guardian_name">Guardian Name<span style="color:red;">*</span></label>
                    <input type="text" required style="text-transform: capitalize;" class="form-control" id="guardian_name" name="guardian_name" placeholder="Enter Guardian Name.">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="guardian_relation">Relation With Guardian </label>
                    <input type="text" style="text-transform: capitalize;" class="form-control" id="guardian_relation" name="guardian_relation" placeholder="Enter Relation With Guardian.">
                 
                  </div>
                  <div class="form-group col-md-3">
                    <label for="guardian_occupation">Guardian Occupation<span style="color:red;">*</span></label>
                    
                    <select name="guardian_occupation" id="guardian_occupation" required class="form-control">
                          <option value="">Select</option>
                          <option value="Gov. Job">Gov. Job</option>
                          <option value="Private Job">Private Job</option>
                          <option value="Business">Business</option>
                          <option value="IT Field">IT Field</option>
                          <option value="Farmer">Farmer</option>
                          <option value="Other">Other</option>
                      </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="category">Category<span style="color:red;">*</span></label>
                     <select class="form-control" name="category" required id="category" >
                         <option value="">Select</option>
                         <option value="Gen">Gen</option>
                         <option value="OBC">OBC</option>
                         <option value="SC/ST">SC/ST</option>
                     </select>
                 
                  </div>
                  <div class="form-group col-md-3">
                    <label for="mobile1">Mobile 1<span style="color:red;">*</span></label>
                    <input type="number" class="form-control" required id="mobile1" name="mobile1" placeholder="Enter Mobile 1.">
                 
                  </div>
                  <div class="form-group col-md-3">
                    <label for="mobile2">Mobile 2</label>
                    <input type="number" class="form-control" id="mobile2" name="mobile2" placeholder="Enter Mobile 2.">
                 
                  </div>
                  <div class="form-group col-md-3">
                    <label for="email">Email Id</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Id.">
                 
                  </div>
                  <div class="form-group col-md-12">
                    <label for="address1">Address <span style="color:red;">*</span></label>
                    <textarea  class="form-control" id="address1" required name="address1" placeholder="Enter full address."></textarea>
                 
                  </div>
                  <div class="form-group col-md-2">
                      <label>Employment status<span style="color:red;">*</span></label>
                      <select name="employment_status" required id="employment_status" class="form-control">
                          <option value="">Select</option>
                          <option value="Employed">Employed</option>
                          <option value="Non Employed">Non Employed</option>
                      </select>
                  </div>
                  <div class="form-group col-md-2">
                      <label>Computer Literacy<span style="color:red;">*</span></label>
                      <select name="computer_literacy" required id="computer_literacy" class="form-control">
                          <option value="">Select</option>
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                      </select>
                  </div>
                  
                  <div class="form-group col-md-2">
                      <label>Qualification<span style="color:red;">*</span></label>
                      <select name="qualification" id="qualification" required class="form-control">
                          <option value="">Select</option>
                          <option value="Post Graduate">Post Graduate</option>
                          <option value="Graduate">Graduate</option>
                          <option value="Graduate">Intermediate</option>
                          <option value="High School">High School</option>
                      </select>
                  </div>
                  
                  <div class="form-group col-md-2">
                      <label>Stream<span style="color:red;">*</span></label>
                      <select name="education_stream" required id="education_stream" class="form-control">
                          <option value="">Select</option>
                          <option value="Art">Art</option>
                          <option value="Science">Science</option>
                          <option value="Graduate">Commerce</option>
                          <option value="High School">Any Other</option>
                      </select>
                  </div>
                  <div class="form-group col-md-3">
                      <label>How did you to came to know of <?php echo $brand_short_name; ?> <span style="color:red;">*</span></label>
                      <select name="know_about_it" id="know_about_it" required class="form-control">
                          <option value="">Select</option>
                          <option value="News Paper">News Paper</option>
                          <option value="Advertise">Advertise</option>
                          <option value="Online">Online</option>
                         
                      </select>
                  </div>
                  
                  <div class="form-group col-md-1">
                      <label>Handbill<span style="color:red;">*</span></label>
                      
                      <select name="handbill" id="handbill" required class="form-control" onchange="handbill_option_selector(this.value)">
                          <option value="">Select</option>
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                          
                         
                      </select>
                 </div>
                 
                
                   <div class="form-group col-md-4" id="handbill_option1" style="display:none;">
                    <label for="institute_student"><?php echo $brand_short_name; ?> Student</label>
                    <input type="text" style="text-transform: capitalize;" class="form-control" onkeyup="check_handbill_sub_cot()" id="institute_student" name="institute_student" placeholder="Enter <?php echo $brand_short_name; ?> Student.">
                 
                  </div>
                  <div class="form-group col-md-4" id="handbill_option2" style="display:none;">
                    <label for="institute_friends">Friends</label>
                    <input type="text" style="text-transform: capitalize;" class="form-control" onkeyup="check_handbill_sub_cot()" id="institute_friends" name="institute_friends" placeholder="Enter Friends.">
                 
                  </div>
                  <div class="form-group col-md-4" id="handbill_option3" style="display:none;">
                    <label for="institute_other">Other</label>
                    <input type="text" style="text-transform: capitalize;" class="form-control" onkeyup="check_handbill_sub_cot()" id="institute_other" name="institute_other" placeholder="Enter Other.">
                 
                  </div>
                 
                  <div class="form-group col-md-2">
                      <label for="career_objective">Career Objective <span style="color:red;">*</span></label>
                      <select name="career_objective" id="career_objective" required class="form-control">
                          <option value="">Select</option>
                          <option value="Gov. Job">Gov. Job</option>
                          <option value="Private Job">Private Job</option>
                          <option value="Business">Business</option>
                          <option value="IT Field">IT Field</option>
                      </select>
                  </div>
                  
                  <div class="form-group col-md-2">
                      <label for="course_id">Course Recommended<span style="color:red;">*</span></label>
                      <select name="course_id" id="course_id" required class="form-control">
                          <option value="">Select</option>
                          <?php 
                          $sql_course=mysqli_query($con,"select * from course_details order by id desc");
                          while($row=mysqli_fetch_array($sql_course)){
                              ?>
                              <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                              <?php
                          }
                          ?>
                          
                          
                      </select>
                  </div>
                  <div class="form-group col-md-2" >
                    <label for="enquiry_date">Enquiry Date<span style="color:red;">*</span></label>
                    <input type="date" class="form-control" id="enquiry_date" name="enquiry_date" required placeholder="Enter Other.">
                 
                  </div>
                  
                  <div class="form-group col-md-3">
                      <label for="batch_id">Batch<span style="color:red;">*</span></label>
                      <select name="batch_id" id="batch_id" required class="form-control">
                          <option value="">Select</option>
                          <?php 
                          $sql_course=mysqli_query($con,"select * from batch_details order by id desc");
                          while($row=mysqli_fetch_array($sql_course)){
                              ?>
                              <option value="<?php echo $row['id']; ?>"><?php echo $row['batch_name']; ?></option>
                              <?php
                          }
                          ?>
                          
                          
                      </select>
                  </div>
                  <div class="form-group col-md-3" >
                    <label for="next_date">To Be Come Again On(Date)<span style="color:red;">*</span></label>
                    <input type="date" class="form-control" id="next_date" name="next_date" required placeholder="Enter Other.">
                 
                  </div>
                  
                  <div class="form-group col-md-12" >
                    <label for="enquiry_note">Enquiry Note </label>
                    <textarea class="form-control" id="enquiry_note" name="enquiry_note" placeholder="Enter Enquiry Note."></textarea>
                 
                  </div>
                  
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" id="submit_btn" name="submit" class="btn btn-primary"> <span id="btn_text">Create</span>
                <span id="btn_loader" style="display:none;">
                  <i class="fa fa-spinner fa-spin"></i> Processing...
                </span></button>
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

  function check_handbill_sub_cot(){
      var val1=$("#institute_student").val();
      var val2=$("#institute_friends").val();
      var val3=$("#institute_other").val();
      
      var x="";
       if(!val1==""){
           var x="1";
       }else if(!val2==""){
           var x="1";
       }else if(!val3==""){
           var x="1";
       }else{
           var x="";
       }
       
      if(x==1){
        document.getElementById("submit_btn").style.display="block";  
      }else{
          document.getElementById("submit_btn").style.display="none";
      }
      
    //   if(!val1=="" OR !val2=="" OR !val3==""){
    //      document.getElementById("submit_btn").style.display="block"; 
    //   }else{
    //       document.getElementById("submit_btn").style.display="none";
    //   }
  }

  function handbill_option_selector(val){
      if(val==""){
          document.getElementById("handbill_option1").style.display="none";
          document.getElementById("handbill_option2").style.display="none";
          document.getElementById("handbill_option3").style.display="none";
          document.getElementById("submit_btn").style.display="block";
      }
      if(val=="Yes"){
          document.getElementById("handbill_option1").style.display="Block";
           document.getElementById("handbill_option2").style.display="Block";
            document.getElementById("handbill_option3").style.display="Block";
            document.getElementById("submit_btn").style.display="none";
      }
      if(val=="No"){
          document.getElementById("handbill_option1").style.display="none";
          document.getElementById("handbill_option2").style.display="none";
          document.getElementById("handbill_option3").style.display="none";
          document.getElementById("submit_btn").style.display="block";
      }
  }
     function get_user_pass(val){
       
        
           $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'get_user_userid12='+val,
                success: function(data){
                 $("#mathc1").html(data);
                }
              }
              );
              
         
    }
    function get_match(val){
            var new2 =$("#pass_new").val(); 
            if((val== new2)){
               
              document.getElementById("mathc_2").style.display="none";
              document.getElementById("mathc_3").style.display="block";
            }else{
                 
              document.getElementById("mathc_2").style.display="block";
              document.getElementById("mathc_3").style.display="none";  
            }
            
    }
    
    
</script>

<script>
$(function(){
  $("form").on("submit", function(){
      $("#submit_btn").prop("disabled", true);
      $("#btn_text").hide();
      $("#btn_loader").show();
  });
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
