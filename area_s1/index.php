<?php
include 'session.php';



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard  |  <?php echo $brand_name; ?></title>
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
      .drop_a1{
	background: #157daf !important;
}

.select1{
	background: #157daf !important;
}

.bg-purple{
      background-color: #9158dd !important; 
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
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard
            <?php 
            if($login_details['bulk_aff']=="YES"){
                echo "(Bulk Affiliater)";
            }
            ?>
            </h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <!--<div class="col-lg-3 col-6"></div>-->
          <div class="col-md-3 col-12">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $login_wallet['main_b']; ?></h3>

                <p>Balance</p>
              </div>
              <div class="icon">
                <i class="fa fa-rupee"></i>
              </div>
              <a href="transaction_main" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <?php
           if($login_details['bulk_aff']=="NO"){
          ?>
         
          <!-- ./col -->
          <?php }
   
        
        $total_runing_course=mysqli_num_rows(mysqli_query($con,"select * from course_book where userid='$_SESSION[userid]' and (status='OPEN' or status='RUN')"));
        if($login_details['bulk_aff']=="NO"){
        ?>
       <div class="col-md-3 col-12">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $total_runing_course ; ?></h3>

                <p>Total Running Course</p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
              <a href="course_running" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> 
        <?php  } 
        
     if($login_details['bulk_aff']=="YES1"){
         $global_affiliate=mysqli_num_rows(mysqli_query($con,"select * from user where bulk_aff_id='$_SESSION[userid]' "));
        ?>
       <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $global_affiliate ; ?></h3>

                <p>Global Affilates</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="course_affiliate_global" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> 
        <?php  } ?>
          <!-- ./col -->
         
         <?php
  
        $total_affiliate=mysqli_num_rows(mysqli_query($con,"select * from user where aff_by_id='$_SESSION[userid]' "));
        if($login_details['bulk_aff']=="NO1"){
        ?>
       <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-purple">
              <div class="inner">
                <h3><?php echo $total_affiliate; ?></h3>

                <p><?php
                 if($login_details['bulk_aff']=="YES"){
                    echo "Direct" ;
                   
                 }else{
                     echo "Total";
                 }
                ?> Affilates </p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="course_affiliate" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> 
      
        <?php } ?>
      
        
        
          <!-- ./col -->
        </div>
       
      </div><!-- /.container-fluid -->
    </section>
    <?php 
     if($login_details['bulk_aff']=="NO1"){
    ?>
    <section class="content">
        <div class="row">
          <!-- /.info-box start-->  
          <div class="col-md-4 col-sm-6 col-12" style="padding-top:0px; padding-left:15px; padding-right:15px;">
            
          </div>
          <!-- /.info-box end-->
          <!-- /.info-box start-->
          <div class="col-md-4 col-sm-6 col-12" style="padding-top:0px; padding-left:15px; padding-right:15px;">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa fa-handshake-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Your Affiliate Link</span>
                <span class="info-box-number"><input type="text" id="myInput" readonly value="<?php echo "https://edug.in/registration?ref_data=".$login_details['aff_code']; ?>" class="form-control"></span>
                <span class="info-box-number"><button class="btn btn-success" onclick="myFunction23()">Copy</button></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </div>
          <!-- /.info-box end-->
          <!-- /.info-box start-->
          <div class="col-md-4 col-sm-6 col-12" style="padding-top:0px; padding-left:15px; padding-right:15px;">
            
            
          </div>
           <!-- /.info-box end--> 
        </div>
    </section>
   <?php } ?>
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
<script>
    function myFunction23() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Copied the text: " + copyText.value);
}
</script>
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
