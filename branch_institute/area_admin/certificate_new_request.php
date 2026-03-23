<?php
include 'session.php'; 

    $type = mysqli_fetch_array(mysqli_query($con, "select type from user where id='$_SESSION[userid]'"))['type'];
if(sub_menu_check("G","A",$_SESSION['userid'], $type)==1){
    
}else{
    echo '<script>alert("You are not permitted to access this option.");window.location.assign("index");</script>'; 
}

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(isset($_POST['submit'])){
    $mobile=VerifyData($_POST['mobile']);
    $course_id=VerifyData($_POST['course_id']);
   
    if(!$course_id==""){
        if(!$mobile==""){
            
     $check=mysqli_query($con,"select * from user where branch_id='$_SESSION[userid]' and mobile='$mobile'");
      if(mysqli_num_rows($check)==1){
          $result=mysqli_fetch_array($check);
       
       $check_request=mysqli_num_rows(mysqli_query($con,"select * from student_certificate_request where mobile='$result[mobile]' and course_id='$course_id' and status!='CANCEL'"));
       
       
       if(!$check_request>0){
          
           $create=mysqli_query($con,"insert into `student_certificate_request`(`name`, `mobile`, `course_id`, `by_request`, `req_date`) values('$result[name]', '$result[mobile]', '$course_id', '$_SESSION[userid]', '$t_date')");
           if($create){
               echo '<script>alert("Certificate credited successfully done.");window.location.assign("certificate_new_request");</script>'; 
           }else{
               echo '<script>alert("Server Error 102.");window.location.assign("certificate_new_request");</script>';   
           }
       }else{
         echo '<script>alert("Entered Student already requested or approved certificate with selected course.");window.location.assign("certificate_new_request");</script>';   
       }
          
      }else{
          echo '<script>alert("Mobile Number Not Registered or student not in your franchise.");window.location.assign("certificate_new_request");</script>'; 
      }
            
        }else{
            echo '<script>alert("Please enter registered mobile number.");window.location.assign("certificate_new_request");</script>';  
        }
        
    }else{
       echo '<script>alert("Please select course.");window.location.assign("certificate_new_request");</script>';  
    }
}







?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>New Certificate Request |  <?php echo $brand_name; ?></title>
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
      .certificate_drop{
	background: #157daf !important;
}

.certificate_new_request{
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
           
                
            
            <div class="col-md-3">
                
            </div>
            <div class="col-md-6">
                <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Create Certificate Request</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="mobile">Mobile Number:</label>
                    <input type="number" class="form-control" required id="mobile" name="mobile" onkeyup="GetUserDetails(this.value)" placeholder="Enter Registered Mobile Number">
                    <span id="mathc1"></span>
                  </div>
                  <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" readonly id="name" name="name" value="" placeholder="Student Name.">
                  </div>
                  <div class="form-group">
                    <label for="main_b">Course:</label>
                    <select id="course_id" name="course_id" class="form-control" >
                    <option value="">Please select</option>
                    <?php
                    $sql_course=mysqli_query($con,"select * from course_details where status='OPEN'");
                    while($row=mysqli_fetch_array($sql_course)){
                    ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                    <?php } ?>
                    </select>
                  
                  </div>
                  
                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Create</button>
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


   function GetUserDetails(val){
        $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'checkUserByMobileNumber='+val,
                success: function(data){
                    if(data==1){
                      $("#mathc1").html("");
                        GetUserNameByMobileNumber(val);
                        //GetUserBalanceByMobileNumber(val);
                    }else{
                 $("#mathc1").html(data);
                    }
                }
              }
              );
   }
    
 function GetUserNameByMobileNumber(val){
      $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'GetUserNameBymobileNumber='+val,
                success: function(data){
                 
                 $("#name").val(data);
                  
                }
              }
              );
 }    
   
  function GetUserBalanceByMobileNumber(val){
      $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'GetUserBalanceByMobileNumber='+val,
                success: function(data){
                 
                 $("#main_b").val(data);
                  
                }
              }
              );
 }    
    
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
