<?php
include 'session.php'; 

if($login_details['bulk_aff']=="YES"){
    echo '<script>window.location.assign("index");</script>';
}

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(isset($_GET['book'])){
    $course_id=VerifyData($_GET['book']);
    if(!$course_id==""){
        $check_course=mysqli_query($con,"select * from course_details where id='$course_id' and status='OPEN'");
        if(mysqli_num_rows($check_course)==1){
         $course_details=mysqli_fetch_array($check_course);
          $chek_pre_booking=mysqli_num_rows(mysqli_query($con,"select * from course_book where userid='$_SESSION[userid]' and course_id='$course_id' and status!='CANCEL'"));
          if(!$chek_pre_booking>0){
            
            $insert_course_book=mysqli_query($con,"insert into `course_book`(`userid`, `course_id`, `fee`, `book_date`) values('$_SESSION[userid]', '$course_id', '$course_details[fee]', '$t_date')");
            if($insert_course_book){
             
                   echo '<script>alert("Course enrollment successfully done.");window.location.assign("course_running");</script>'; 
               
                
            }else{
             echo '<script>alert("Server error 101.");window.location.assign("course_book");</script>';     
            } 
              
          }else{
            echo '<script>alert("Hello dear, You have already done this course.");window.location.assign("course_book");</script>';  
          }
            
        }else{
          echo '<script>alert("Course not found or not active.");window.location.assign("course_book");</script>';   
        }
    }else{
       echo '<script>alert("Somthing Went wrong.");window.location.assign("course_book");</script>'; 
    }
} 
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Course Book |  <?php echo $brand_name; ?></title>
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
      .drop_course{
	background: #157daf !important;
}

.course_book{
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
          <h4>All Courses</h4>
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
           
                
            <?php 
            
            $sql_course=mysqli_query($con,"select * from course_details where status='OPEN'");
            while($row=mysqli_fetch_array($sql_course)){
                
            ?>
            
            <div class="col-md-4">
                <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title"><?php echo $row['name'] ?></h3>
              </div>
              <!-- /.card-header -->
             
              
                <div class="card-body">
                  <div class="row" >
				 <div >
				     <img width="100%" style="border: 1px solid #c4f10c;" src="<?php echo $web_link.$row['img'] ?>">
				 </div>
				
					 <div class="col-md-12">
					     <p style="text-align:center;font-size: 20px;font-style: italic;">Course Code: <?php echo $row['course_code']; ?></p>
					 </div>
					 <div class="col-md-12">
					     <p style="text-align:center;font-size: 20px;font-style: italic;">Duration: <?php echo $row['duration']; ?> Month</p>
					 </div>
					 <div class="col-md-12" align="center"><h5>Total Fees</h5></div>
					 <div class="col-md-12" align="center">
					     <h5 style="font-weight: 700; font-family: 'Frank Ruhl Libre', serif;">Rs.<del><?php echo ($row['duration']*600)-1; ?>.00</del></h5>
					     <h3 style="color: #5d9913; font-weight: 700; font-family: 'Frank Ruhl Libre', serif;">Rs: <?php echo $row['fee']; ?></h3>
					 </div>
                        <div class="col-md-12" align="center">
                          <button type="button" class="btn btn-block btn-outline-success btn-flat" data-toggle="modal" data-target="#desModal<?php echo $row['id']; ?>">
                            View Details
                          </button>
                        </div>
                        
                        
                        <div class="modal fade" id="desModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="desModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
                          <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                        
                              <div class="modal-header">
                                <h5 class="modal-title" id="desModalLabel<?php echo $row['id']; ?>">Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                        
                              <div class="modal-body">
                                <?php echo $row['des']; ?>
                              </div>
                        
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </div>
                        
                            </div>
                          </div>
                        </div>

					
					 
				 </div>
                  
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer" align="center">
                  <button type="button" class="btn btn-success" onclick="confirmEnroll('<?php echo $row['id']; ?>', '<?php echo htmlspecialchars($row['name'], ENT_QUOTES); ?>')">Enroll Now</button>
                </div>

              
            </div>
            </div>
            
          <?php } ?>
            
            <script>
                function show_des_function(val,val1){
                    document.getElementById(val).style.display="block";
                    document.getElementById(val1).style.display="none";
                }
                function hide_des_function(val,val1){
                    document.getElementById(val).style.display="none";
                    document.getElementById(val1).style.display="block";
                }
            </script>
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
   function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
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
<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script>
function confirmEnroll(bookId, bookName) {
  Swal.fire({
    title: 'Are you sure?',
    text: `Do you want to enroll in "${bookName}"?`,
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#28a745',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, enroll me!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = 'course_book?book=' + bookId;
    }
  });
}
</script>

</body>
</html>
