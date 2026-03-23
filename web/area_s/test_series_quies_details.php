<?php 
include 'session.php'; 
//$test_series_id= $_SESSION['test_series_ques_id'];

if(isset($_GET['ids'])){
    $id=VerifyData($_GET['ids']);
    if(!$id==""){
      $sql=mysqli_query($con,"select * from test_series where id='$id' and (status='CLOSE' or status='OPEN')");
      if(mysqli_num_rows($sql)==1){
          $ids_details=mysqli_fetch_array($sql);
          $test_series_id= $ids_details['id'];
          
          if($ids_details['status']=="OPEN"){
             mysqli_close($con);
             $_SESSION['test_series_ques_id']=$test_series_id;
             echo '<script>window.location.assign("test_series_quies");</script>';
             exit();
          }
          
      }else{
        mysqli_close($con);
        echo '<script>window.location.assign("test_series_report");</script>';
        exit();  
      }
    }else{
      mysqli_close($con);
      echo '<script>window.location.assign("test_series_report");</script>';
      exit();  
    }
    
}else{
 mysqli_close($con);
 echo '<script>window.location.assign("test_series_report");</script>';
 exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo "MANAS".$test_series_id; ?> Test Series Details  |  <?php echo $brand_name; ?></title>
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
      .test_series{
    	background: #157daf !important;
    }
    
    .test_series_report{
    	background: #157daf !important;
    }

.bg-purple{
      background-color: #9158dd !important; 
}
.span_head_s{
    border: 1px solid white;
    padding: 3px;
    margin: 4px;
    cursor: pointer;
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
        <div class="col-md-12">
             <div class="card card-info">
             <div class="card-header">
                 <div class="card-title">
                     <p style="font-size:20px;">Test Series Report of : <?php echo "MANAS".$test_series_id; ?></p>
                     <?php 
                      $correct_q_count=mysqli_num_rows(mysqli_query($con,"select * from test_series_at_question where test_series_id='$test_series_id' and correct_ans=your_ans"));
                     
                     $datetime_1 = $ids_details['sdt']; 
                     $datetime_2 = $ids_details['edt']; 
                     
                     $start_datetime = new DateTime($datetime_1); 
                     $diff = $start_datetime->diff(new DateTime($datetime_2)); 
                     
                    
                     $t_year= $diff->y; 
                     $t_month= $diff->m; 
                     $t_days= $diff->d; 
                     $t_hours= $diff->h; 
                     $t_minutes= $diff->i; 
                     $t_seconds= $diff->s;
                     $total_time="";
                     if($t_year>0){
                       $total_time.=" ".$t_year." Years,"; 
                     }
                     if($t_month>0){
                       $total_time.=" ".$t_month." Months,"; 
                     }
                     if($t_days>0){
                       $total_time.=" ".$t_days." Days,"; 
                     }
                     if($t_hours>0){
                       $total_time.=" ".$t_hours." Hours,"; 
                     }
                     if($t_minutes>0){
                       $total_time.=" ".$t_minutes." Minutes,"; 
                     }
                     if($t_seconds>0){
                       $total_time.=" ".$t_seconds." Seconds,"; 
                     }
                     ?>
                    <p>Total Question : <?php echo $ids_details['total_question']; ?>, &nbsp;&nbsp;&nbsp;Checked Question : <?php echo $ids_details['attemp_question']; ?>
                    , &nbsp;&nbsp;&nbsp;<span style="color:yellow;">Correct Question : <?php echo $correct_q_count; ?>
                    , &nbsp;&nbsp;&nbsp;<span style="color:blue;">Total Taken Time : <?php echo $total_time; ?>
                    </span>
                    </p>
                     
                 </div>
             </div>
             <div class="card-body">
                 <?php 
                 $i=0;
                  $sql=mysqli_query($con,"select * from test_series_at_question where test_series_id='$test_series_id' order by id desc");
                  while($row=mysqli_fetch_array($sql)){
                 ?>
               <div class="row">
                   <div class="col-md-12">
                       <p>Q. No <?php echo $i +=1; ?>: <br>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo utf8_decode($row['question']); ?></p>
                   </div>
                   <div class="col-md-3" <?php if($row['correct_ans']==$row['ans1']){ echo 'style="color:green;font-weight: 600;"'; } ?>>
                       &nbsp;&nbsp;&nbsp;&nbsp;<input <?php if($row['ans1']==$row['your_ans']){ echo "checked"; } ?> disabled type="radio" name="final_ans<?php echo $row['id']; ?>" value="ans1">&nbsp;&nbsp;<?php echo utf8_decode($row['ans1']); ?>
                   </div>
                   <div class="col-md-3" <?php if($row['correct_ans']==$row['ans2']){ echo 'style="color:green;font-weight: 600;"'; } ?>>
                       &nbsp;&nbsp;&nbsp;&nbsp;<input <?php if($row['ans2']==$row['your_ans']){ echo "checked"; } ?> disabled type="radio" name="final_ans<?php echo $row['id']; ?>" value="ans2">&nbsp;&nbsp;<?php echo utf8_decode($row['ans2']); ?>
                   </div>
                   <div class="col-md-3" <?php if($row['correct_ans']==$row['ans3']){ echo 'style="color:green;font-weight: 600;"'; } ?>>
                       &nbsp;&nbsp;&nbsp;&nbsp;<input <?php if($row['ans3']==$row['your_ans']){ echo "checked"; } ?> disabled type="radio" name="final_ans<?php echo $row['id']; ?>" value="ans3">&nbsp;&nbsp;<?php echo utf8_decode($row['ans3']); ?>
                   </div>
                   <div class="col-md-3" <?php if($row['correct_ans']==$row['ans4']){ echo 'style="color:green;font-weight: 600;"'; } ?>>
                       &nbsp;&nbsp;&nbsp;&nbsp;<input <?php if($row['ans4']==$row['your_ans']){ echo "checked"; } ?> disabled type="radio" name="final_ans<?php echo $row['id']; ?>" value="ans4">&nbsp;&nbsp;<?php echo utf8_decode($row['ans4']); ?>
                   </div>
               </div>
               <hr>
               <?php } ?>
             </div>
             <div class="card-footer">
               <input type="submit" onclick="window.location.assign('test_series_report')" name="final_submit" class="btn btn-success" value="Return">
             </div>
         </div>
        </div>
        </div>
       
      </div><!-- /.container-fluid -->
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
