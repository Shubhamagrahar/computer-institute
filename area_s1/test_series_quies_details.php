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
             echo '<script>window.location.assign("test_start");</script>';
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
  <title><?php echo $brand_short_code." ".$test_series_id; ?> Test Series Details  |  <?php echo $brand_name; ?></title>
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
            <div class="card-header bg-secondary">
  <div class="card-title">
    <p style="font-size: 20px;">
      Test Series Report of: <strong><?php echo htmlspecialchars($brand_short_code . " " . $test_series_id); ?></strong>
    </p>

    <?php 
      $total_questions = (int) $ids_details['total_question'];

      $attempted_questions = (int) $ids_details['attemp_question'];

      $correct_q_count = (int) mysqli_num_rows(mysqli_query($con, "
        SELECT * FROM test_series_at_question 
        WHERE test_series_id = '$test_series_id' AND correct_ans = your_ans
      "));

      $wrong_questions = $attempted_questions - $correct_q_count;
      if ($wrong_questions < 0) {
          $wrong_questions = 0; 
      }

      $start_datetime = new DateTime($ids_details['sdt']);
      $end_datetime = new DateTime($ids_details['edt']);
      $diff = $start_datetime->diff($end_datetime);

      $time_parts = [];
      if ($diff->y > 0) $time_parts[] = $diff->y . " Year" . ($diff->y > 1 ? "s" : "");
      if ($diff->m > 0) $time_parts[] = $diff->m . " Month" . ($diff->m > 1 ? "s" : "");
      if ($diff->d > 0) $time_parts[] = $diff->d . " Day" . ($diff->d > 1 ? "s" : "");
      if ($diff->h > 0) $time_parts[] = $diff->h . " Hour" . ($diff->h > 1 ? "s" : "");
      if ($diff->i > 0) $time_parts[] = $diff->i . " Minute" . ($diff->i > 1 ? "s" : "");
      if ($diff->s > 0) $time_parts[] = $diff->s . " Second" . ($diff->s > 1 ? "s" : "");
      $total_time = $time_parts ? implode(" ", $time_parts) : "0 Seconds";
    ?>

    <p>
      <strong>Total Questions:</strong> <?php echo $total_questions; ?> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
      <strong>Attempted Questions:</strong> <?php echo $attempted_questions; ?> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
      <span><strong>Correct Questions:</strong> <?php echo $correct_q_count; ?></span> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
      <span><strong>Wrong Questions:</strong> <?php echo $wrong_questions; ?></span> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
      <span><strong>Time Taken:</strong> <?php echo htmlspecialchars($total_time); ?></span>
    </p>

    <p>
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
                       <p>Q.<?php echo $i +=1; ?>:<b>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo htmlspecialchars(base64_decode($row['question'])); ?></b></p>
                   </div>
                   <div class="col-md-3" <?php if($row['correct_ans']=='ans_a'){ echo 'style="color:green;font-weight: 600;"'; }else if($row['your_ans'] == 'ans_a'){echo 'style="color:red;font-weight:600;"';} ?>>
                       &nbsp;&nbsp;&nbsp;&nbsp;<input <?php echo ('ans_a'==$row['your_ans']) ? 'checked' : 'disabled'; ?>  type="radio" name="final_ans<?php echo $row['id']; ?>" value="ans_a">&nbsp;&nbsp;<?php echo htmlspecialchars(base64_decode($row['ans_a'])); ?>
                   </div>
                   <div class="col-md-3" <?php if($row['correct_ans']=='ans_b'){ echo 'style="color:green;font-weight: 600;"'; }else if($row['your_ans'] == 'ans_b'){echo 'style="color:red;font-weight:600;"';} ?>>
                       &nbsp;&nbsp;&nbsp;&nbsp;<input <?php echo ('ans_b'==$row['your_ans']) ? 'checked' : 'disabled'; ?>  type="radio" name="final_ans<?php echo $row['id']; ?>" value="ans_b">&nbsp;&nbsp;<?php echo htmlspecialchars(base64_decode($row['ans_b'])); ?>
                   </div>
                   <div class="col-md-3" <?php if($row['correct_ans']=='ans_c'){ echo 'style="color:green;font-weight: 600;"'; }else if($row['your_ans'] == 'ans_c'){echo 'style="color:red;font-weight:600;"';} ?>>
                       &nbsp;&nbsp;&nbsp;&nbsp;<input <?php echo ('ans_c'==$row['your_ans']) ? 'checked' : 'disabled'; ?>  type="radio" name="final_ans<?php echo $row['id']; ?>" value="ans_c">&nbsp;&nbsp;<?php echo htmlspecialchars(base64_decode($row['ans_c'])); ?>
                   </div>
                   <div class="col-md-3" <?php if($row['correct_ans']=='ans_d'){ echo 'style="color:green;font-weight: 600;"'; }else if($row['your_ans'] == 'ans_d'){echo 'style="color:red;font-weight:600;"';} ?>>
                       &nbsp;&nbsp;&nbsp;&nbsp;<input <?php echo ('ans_d'==$row['your_ans']) ? 'checked' : 'disabled'; ?>  type="radio" name="final_ans<?php echo $row['id']; ?>" value="ans_d">&nbsp;&nbsp;<?php echo htmlspecialchars(base64_decode($row['ans_d'])); ?>
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
