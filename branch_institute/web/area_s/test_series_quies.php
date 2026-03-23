<?php 
include 'session.php';
$c_date=date("Y-m-d H:s:i");
if(isset($_SESSION['test_series_ques_id'])){
$test_series_id= $_SESSION['test_series_ques_id'];
if(!$test_series_id==""){
    $sql=mysqli_query($con,"select * from test_series where id='$test_series_id' and status='OPEN'");
    if(mysqli_num_rows($sql)==1){
      
      if(isset($_GET['submit_id'])){
         $submit_id=VerifyData($_GET['submit_id']);
         if(!$submit_id==""){
             if($submit_id==$test_series_id){
               $update_series=mysqli_query($con,"update test_series set edt='$c_date', status='CLOSE' where id='$test_series_id'");
               if($update_series){
                 unset($_SESSION['test_series_ques_id']);
                 mysqli_close($con);
                 $url="test_series_quies_details?ids=".$test_series_id;
                 echo '<script>alert("Final Submit successfull done.");window.location.assign("'.$url.'");</script>';
                  exit();   
      
               }else{
               mysqli_close($con);
               echo '<script>alert("Somthing worng in final submit");window.location.assign("test_series_quies");</script>';
               exit();   
             }
                 
             }else{
              mysqli_close($con);
         echo '<script>alert("Final submit series Id dose not match with current series Id.");window.location.assign("test_series_quies");</script>';
         exit();   
             }
         }else{
          mysqli_close($con);
         echo '<script>alert("Submit Data Null.");window.location.assign("test_series_quies");</script>';
         exit();   
         }
      }
        
    }else{
        mysqli_close($con);
        
      echo '<script>alert("Series Id wrong.");window.location.assign("test_series_runing");</script>';
       exit();
}
}else{
     mysqli_close($con);
    echo '<script>alert("Series Id not found.");window.location.assign("test_series_runing");</script>';
    
    exit();
}
}else{
     mysqli_close($con);
    echo '<script>alert("Series Id not found Error.");window.location.assign("test_series_runing");</script>';
    
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LIVE test series Question  |  <?php echo $brand_name; ?></title>
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
          .test_series{
    	background: #157daf !important;
    }
    
    .test_series_runing{
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
.btn2{
    padding: 5px 12px 5px 12px;
    color: #cf0199;
    border-color: #cf0199;
    background: none;
    border-radius: 8px;
}
.btn3{
    padding: 5px 23px 5px 21px;
    color: #cf0199;
    border-color: #cf0199;
    background: none;
    border-radius: 8px;
}
.q_count{
    border: 1px solid black;
    margin-left: 5px;
    margin-bottom: 2px; 
    width:25px;
    cursor: pointer;
    border-radius: 4px;
}
.q_count:hover{
    background-color:#157daf;
}

.q_content{
    color: #cf0199;
    font-size: 20px;
    border: 2px solid #11369e;
    border-radius: 5px;
    margin: 0px 0px 13px 0px;
    padding: 9px;
    background-color: #f5f6b4ab;
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
       
        
        <?php
         $present_q_no=1;
        ?>
        <p style="font-size: 20px;font-weight: 600;">Test Series No : <?php echo "MANAS".$test_series_id; ?></p>
       <div class="row mobile_view" id="q_data_div">
        <div class="col-md-12">
             <div class="card card-info">
             <div class="card-header" style="color:black;background-color: white;">
                 <div class="card-title">
                    
                     
                     <div class="row" style="padding-left: 10px;padding-right: 10px;padding-bottom: 6px;" align="center">
                   <?php 
                  
                   
                   $i=0;
                    $sql=mysqli_query($con,"select * from test_series_at_question where test_series_id='$test_series_id' order by id desc");
                    $count=mysqli_num_rows($sql);
                    while($row=mysqli_fetch_array($sql)){
                        $q_no_divstyle="";
                        $i +=1;
                        if($i==$present_q_no){
                            $q_no_divstyle='style=cursor:default;background-color:blue;color:white !importatnt"';
                        }else{
                            if($row['status']=="CLOSE"){
                               $q_no_divstyle='style="background-color:#80991070;" onclick="get_data('.$test_series_id.','.$i.')"';
                            }else{
                            $q_no_divstyle='onclick="get_data('.$test_series_id.','.$i.')"';
                            }
                            
                        }
                   ?>
                    <div class="q_count" id="q_no_div<?php echo $row['id']; ?>" <?php echo $q_no_divstyle; ?>><?php echo $i; ?></div>
                   <?php } ?>
                    
                    </div>
                     <p style="font-size: 20px;font-weight: 600;">Question No#:<?php echo $present_q_no;?> out <?php echo $count; ?></p>
                 </div>
                 
             </div>
             <div class="card-body">
                 <div class="row ">
                 <?php 
                 $ii=0;
                  $sql=mysqli_query($con,"select * from test_series_at_question where test_series_id='$test_series_id' order by id desc");
                  
                  while($row=mysqli_fetch_array($sql)){
                      $ii +=1;
                      if($ii==$present_q_no){
                 ?>
               
                   <div class="col-md-12" >
                       <p class="q_content" style="color:#cf0199;"><?php echo $row['question']; ?></p>
                   </div>
                   <div class="col-md-3" >
                     <div class="col-12" style="background-color: #e1dddd;margin-bottom: 10px;">
                          &nbsp;&nbsp;&nbsp;&nbsp;<input <?php if($row['ans1']==$row['your_ans']){ echo "checked"; } ?> onclick="ans_test_question('<?php echo $row['id']; ?>',this.value)" type="radio" name="final_ans" value="<?php echo $row['ans1']; ?>" id="ans1"> <label for="ans1" style="cursor:pointer;">&nbsp;&nbsp;<?php echo $row['ans1']; ?></label>
                     </div>
                   </div>
                   <div class="col-md-3" >
                      <div class="col-12" style="background-color: #e1dddd;margin-bottom: 10px;">
                          &nbsp;&nbsp;&nbsp;&nbsp;<input <?php if($row['ans2']==$row['your_ans']){ echo "checked"; } ?> onclick="ans_test_question('<?php echo $row['id']; ?>',this.value)" type="radio" name="final_ans"  value="<?php echo $row['ans2']; ?>" id="ans2"> <label for="ans2" style="cursor:pointer;">&nbsp;&nbsp;<?php echo $row['ans2']; ?></label>
                     </div>
                   </div>
                   <div class="col-md-3" >
                      <div class="col-12" style="background-color: #e1dddd;margin-bottom: 10px;">
                          &nbsp;&nbsp;&nbsp;&nbsp;<input <?php if($row['ans3']==$row['your_ans']){ echo "checked"; } ?> onclick="ans_test_question('<?php echo $row['id']; ?>',this.value)" type="radio" name="final_ans" value="<?php echo $row['ans3']; ?>" id="ans3"> <label for="ans3" style="cursor:pointer;">&nbsp;&nbsp;<?php echo $row['ans3']; ?></label>
                     </div>
                   </div>
                   <div class="col-md-3" >
                       <div class="col-12" style="background-color: #e1dddd;margin-bottom: 10px;">
                          &nbsp;&nbsp;&nbsp;&nbsp;<input <?php if($row['ans4']==$row['your_ans']){ echo "checked"; } ?> onclick="ans_test_question('<?php echo $row['id']; ?>',this.value)" type="radio" name="final_ans" value="<?php echo $row['ans4']; ?>" id="ans4"> <label for="ans4" style="cursor:pointer;">&nbsp;&nbsp;<?php echo $row['ans4']; ?></label>
                     </div>
                  </div>
                  <?php } 
                  } ?>  
                   
                  <div class="col-md-12" align="center" style="padding-top: 17px;">
                      <hr>
                     <?php 
                     if($present_q_no==1){ }else{
                     ?>
                     <button onclick="get_data('<?php echo $test_series_id ; ?>','<?php echo $present_q_no -1; ?>')" class="btn2">Previous</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php } ?>
                    <?php 
                    
                     if($count==$present_q_no){ }else{
                     ?>
                     <button class="btn3" onclick="get_data('<?php echo $test_series_id ; ?>','<?php echo $present_q_no + 1; ?>')">Next</button>
                     <?php } ?>
                 </div> 
               </div>
               
               
              
              
             </div>
             <div class="card-footer">
                 <?php
                  $sql_series_details=mysqli_fetch_array(mysqli_query($con,"select * from test_series where id='$test_series_id'"));
                 ?>
                 <span style="font-size: 13px;font-weight: 600;">Checked Question : <?php echo $sql_series_details['attemp_question']; ?> of <?php echo $sql_series_details['total_question']; ?> </span>
               <input type="submit" onclick="final_submit_series('<?php echo $test_series_id; ?>')" name="final_submit" class="btn btn-success" value="Submit" style="float: right;">
             </div>
         </div>
        </div>
        </div>
       <script>
    
    function final_submit_series(val){
        if(confirm('Are your sure for final submit this test series?')){
           window.location.assign("test_series_quies?submit_id="+val);
        }
    }
    
   function ans_test_question(at_id,val){
         $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'ans_test_question='+at_id+'&val='+val,
                success: function(data){
                if(data!==""){
                    alert(data);
                }
                }
              }
              );
   }
           function get_data(q_id,q_no){
                $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'get_series_question='+q_id+'&q_no='+q_no,
                success: function(data){
                 $("#q_data_div").html(data);
                }
              }
              );
              
           }
       </script>
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
