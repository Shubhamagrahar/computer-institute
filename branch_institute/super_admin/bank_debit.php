<?php
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");



if(isset($_POST['submit'])){
    $mobile=VerifyData($_POST['mobile']);
    $amt=VerifyData($_POST['amt']);
    $des=VerifyData($_POST['des']);
    $credit_type=VerifyData($_POST['credit_type']);
    if(!$amt==""){
        if(!$mobile==""){
          if(!$credit_type==""){ 
     $check=mysqli_query($con,"select * from user where mobile='$mobile' and type='1'");
      if(mysqli_num_rows($check)==1){
          $result=mysqli_fetch_array($check);
       
        $walletDetails=mysqli_fetch_array(mysqli_query($con,"select * from branch_details where userid='$result[id]'"));
       $op_bal=$walletDetails['wallet'];
       $cl_bal=$op_bal - $amt ;
       $update_wallet=mysqli_query($con,"update branch_details set wallet='$cl_bal' where userid='$result[id]'");
       if($update_wallet){
           if(!$des==""){
           $desciption="Debit By ".$login_details['name']."/".$des;
           }else{
            $desciption="Debit By ".$login_details['name'];   
           }
           
           $teransactionIntsert=mysqli_query($con,"insert into `branch_transaction`(`userid`, `des`, `debit`, `date`, `c_date`, `op_bal`, `cl_bal`, `by_userid`) values('$result[id]', '$desciption', '$amt', '$t_date', '$c_date', '$op_bal', '$cl_bal', '$_SESSION[userid]')");
           if($teransactionIntsert){
               if($credit_type==1){
                   $op_bal=$login_wallet['main_b'];
                   $cl_bal=$op_bal - $amt ;
                   $update_wallet=mysqli_query($con,"update wallet_main set main_b='$cl_bal' where userid='$_SESSION[userid]'"); 
                if($update_wallet){
                   
                   if(!$des==""){
                       $desciption_admin="Debit for ".$result['name']."(".$result['mobile'].") /".$des;
                       }else{
                        $desciption_admin="Debit for ".$result['name']."(".$result['mobile'].")";   
                       }
                   
                   $teransactionIntsert=mysqli_query($con,"insert into `super_admin_transaction`(`userid`, `des`, `debit`, `date`, `c_date`, `op_bal`, `cl_bal`, `by_userid`) values('$_SESSION[userid]', '$desciption_admin', '$amt', '$t_date', '$c_date', '$op_bal', '$cl_bal', '$_SESSION[userid]')");
                   if($teransactionIntsert){
                       echo '<script>alert("Amount Debit Succussfully done..");window.location.assign("bank_debit");</script>';
                   }else{
                     echo '<script>alert("Server Error 104.");window.location.assign("bank_debit");</script>';  
                   }
                }else{
                  echo '<script>alert("Server Error 103.");window.location.assign("bank_debit");</script>';  
                }
                   
               }else{
               
               echo '<script>alert("Reversal Entry successfully done.");window.location.assign("bank_debit");</script>'; 
               }
                   
               }else{
               echo '<script>alert("Server Error 102.");window.location.assign("bank_debit");</script>';   
           }
       }else{
         echo '<script>alert("Server Error 101.");window.location.assign("bank_debit");</script>';   
       }
          
      }else{
          echo '<script>alert("Mobile Number Not Registered with franchise base.");window.location.assign("bank_debit");</script>'; 
      }
         
        }else{
           echo '<script>alert("Please select credit type.");window.location.assign("bank_debit");</script>';  
        }    
        }else{
            echo '<script>alert("Please enter registered mobile number.");window.location.assign("bank_debit");</script>';  
        }
        
    }else{
       echo '<script>alert("Please enter credit amount.");window.location.assign("bank_debit");</script>';  
    }
}







?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Debit to anyone |  <?php echo $brand_name; ?></title>
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
      .bank_drop{
	background: #157daf !important;
}

.bank_debit{
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
                <h3 class="card-title">Debit Amount</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="mobile">Mobile Number:</label>
                    <input type="number" required class="form-control" id="mobile" name="mobile" onkeyup="GetUserDetails(this.value)" placeholder="Enter Registered Mobile Number">
                    <span id="mathc1"></span>
                  </div>
                  <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" readonly id="name" name="name" value="" placeholder="Name.">
                  </div>
                  <div class="form-group">
                    <label for="main_b">Balance:</label>
                    <input type="text" class="form-control" readonly id="main_b" name="main_b" value="" placeholder="Available Balance">
                  
                  </div>
                  <div class="form-group">
                    <label for="amt">Amount:</label>
                    <input type="number" required class="form-control" id="amt" name="amt" onkeyup="getFinalBalance(main_b.value,this.value)" placeholder="Enter Debit Amount.">
                   <span id="totalBal" style="font-size: 20px;"></span>
                  </div>
                  <div class="form-group">
                    <label for="des">Description:</label>
                    <textarea  class="form-control" id="des" name="des"  placeholder="Enter Description."></textarea>
                   
                  </div>
                  
                  <div class="form-group">
                    <label for="main_b">Debit Type:</label>
                    <select name="credit_type" id="credit_type" class="form-control" required >
                        <option value="">Select Credit Type</option>
                        <option value="1">Cash Refund</option>
                        <option value="2">Reversal Entry</option>
                    </select>
                  
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Credit</button>
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

 function getFinalBalance(main_b,amount){
     var total =Number(main_b) - Number(amount);
   
     document.getElementById("totalBal").innerHTML = "Final Balance Rs."+total;
 }
   function GetUserDetails(val){
        $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'checkUserByMobileNumber='+val,
                success: function(data){
                    if(data==1){
                      //document.getElementById("mathc1").style.display="none";
                      $("#mathc1").html("");
                        GetUserNameByMobileNumber(val);
                        GetUserBalanceByMobileNumber(val);
                    }else{
                 $("#mathc1").html(data);
                 $("#name").val("");
                 $("#main_b").val("");
                 document.getElementById("totalBal").innerHTML = "";
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
