<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

  function affiliate_refer_income($id,$name,$amt){
      global $con;
      global $t_date;
      global $c_date;
      $aff_com=($amt * 12.5)/100;
      $wallet=mysqli_fetch_array(mysqli_query($con,"select * from wallet where userid='$id'"));
      $main_b=$wallet['main_b'] + $aff_com;
      $des1="Credit Course Affiliate income by : ".$name;
      $insert1=mysqli_query($con,"insert into `transaction_main`(`userid`, `des`, `credit`, `date`, `c_date`) values('$id', '$des1', '$aff_com', '$t_date', '$c_date')");
      if($insert1){
      $update=mysqli_query($con,"update wallet set main_b='$main_b' where userid='$id'");
      
       if($update){
          return 1;
       }else{
         return "Function Error 102";  
       }   
      }else{
          return "Function Error 101";
      }
  }      
   
if(isset($_POST['pay_amt_aff'])){   
    $student_mobile=VerifyData($_POST['student_mobile']);
    $pay_fee=VerifyData($_POST['pay_fee_aff']);
    
    if(!$student_mobile=="" and !$pay_fee==""){
        $sql_student=mysqli_query($con,"select * from user where mobile='$student_mobile'");
        if(mysqli_num_rows($sql_student)==1){
            $student_details=mysqli_fetch_array($sql_student);
            if($student_details){
                
                 if($login_wallet['main_b']>=$pay_fee){
           
           $insert_fee_details=mysqli_query($con,"insert into `fee_pay_details`(`userid`, `type`, `amt`, `status`, `date`, `c_date`) values('$student_details[id]', 'CASH', '$pay_fee', 'OPEN', '$t_date', '$c_date')"); 
        if($insert_fee_details){   
            $pay_details_id=mysqli_insert_id($con);
           if($pay_details_id>0){
           $des2="Cash Pay Due Fee";
          $insert2=mysqli_query($con,"insert into `transaction_fee`(`userid`, `des`, `credit`, `date`, `c_date`) values('$student_details[id]', '$des2', '$pay_fee', '$t_date', '$c_date')");
          if($insert2){ 
              $student_wallet=mysqli_fetch_array(mysqli_query($con,"select * from wallet where userid='$student_details[id]'"));
              $w_fee =$student_wallet['fee'] - $pay_fee;
              $update_wallet=mysqli_query($con,"update wallet set fee='$w_fee' where userid='$student_details[id]'");
              if($update_wallet){
                  if($student_details['aff_by_id']>0){
                  $aff_function=affiliate_refer_income($student_details['aff_by_id'],$student_details['name'],$pay_fee);
                  }else{
                    $aff_function=1;  
                  }
                  if($aff_function==1){
               
               $pay_details_update=mysqli_query($con,"update fee_pay_details set status='CLOSE', c_date='$c_date' where id='$pay_details_id'");
               if($pay_details_update){
                   
                   $des3="Fee pay for : ".$student_details['mobile'];
                   $insert3=mysqli_query($con,"insert into `transaction_main`(`userid`, `des`, `debit`, `date`, `c_date`) values('$_SESSION[userid]', '$des3', '$pay_fee', '$t_date', '$c_date')");
                   $des4="Fee pay incentive by : ".$student_details['mobile'];
                   $incentive=($pay_fee*5)/100;
                   $insert4=mysqli_query($con,"insert into `transaction_main`(`userid`, `des`, `credit`, `date`, `c_date`) values('$_SESSION[userid]', '$des4', '$incentive', '$t_date', '$c_date')");
                   if($insert3 and $insert4){
                      $debt_amt= $pay_fee - $incentive;
                      $main_b=$login_wallet['main_b'] -$debt_amt;
                       $update_wallet_S=mysqli_query($con,"update wallet set main_b='$main_b' where userid='$_SESSION[userid]'");
                       if($update_wallet_S){
                          echo '<script>alert("Fee paid successfully done."); window.location.assign("bank_fee_paid");</script>'; 
                       }else{
                         echo '<script>alert("Server Error 106."); window.location.assign("bank_fee_paid");</script>';   
                       }
                   }else{
                    echo '<script>alert("Server Error 105."); window.location.assign("bank_fee_paid");</script>';   
                   }
                    
               }else{
                 echo '<script>alert("Server Error 104."); window.location.assign("bank_fee_paid");</script>';   
               }
              }else{
               echo '<script>alert("'.$aff_function.'"); window.location.assign("bank_fee_paid");</script>';   
              } 
              }else{
               echo '<script>alert("Server Error 103."); window.location.assign("bank_fee_paid");</script>';   
              }
          }else{
           echo '<script>alert("Server Error 102."); window.location.assign("bank_fee_paid");</script>';   
          }   
              
          }else{
            echo '<script>alert("Server Error 101."); window.location.assign("bank_fee_paid");</script>';  
          }
         
        }else{
          echo '<script>alert("Somthing went wrong."); window.location.assign("bank_fee_paid");</script>';   
        }
        
    }else{
        echo '<script>alert("Insufficient wallet Balance."); window.location.assign("bank_fee_paid");</script>';  
          
        }
                
            }else{
               echo '<script>alert("Server error 101."); window.location.assign("bank_fee_paid");</script>'; 
            }
        }else{
          echo '<script>alert("Mobile number not valid."); window.location.assign("bank_fee_paid");</script>';   
        }
        
        
    }else{
       echo '<script>alert("Please enter candidate mobile number and fee."); window.location.assign("bank_fee_paid");</script>'; 
    }
}
   
   
if(isset($_POST['pay_amt'])){
    $pay_fee=VerifyData($_POST['pay_fee']);
    if(!$pay_fee==""){
        
        if($login_wallet['main_b']>=$pay_fee){
           
           $insert_fee_details=mysqli_query($con,"insert into `fee_pay_details`(`userid`, `type`, `amt`, `status`, `date`, `c_date`) values('$_SESSION[userid]', 'WALLET', '$pay_fee', 'OPEN', '$t_date', '$c_date')"); 
        if($insert_fee_details){   
            $pay_details_id=mysqli_insert_id($con);
          $des1="Self Pay due fee";
          $insert1=mysqli_query($con,"insert into `transaction_main`(`userid`, `des`, `debit`, `date`, `c_date`) values('$_SESSION[userid]', '$des1', '$pay_fee', '$t_date', '$c_date')");
          if($insert1){
           $des2="Self credit by Main Wallet";
          $insert2=mysqli_query($con,"insert into `transaction_fee`(`userid`, `des`, `credit`, `date`, `c_date`) values('$_SESSION[userid]', '$des2', '$pay_fee', '$t_date', '$c_date')");
          if($insert2){ 
              $main_b=$login_wallet['main_b'] - $pay_fee;
              $w_fee =$login_wallet['fee'] - $pay_fee;
              $update_wallet=mysqli_query($con,"update wallet set main_b='$main_b', fee='$w_fee' where userid='$_SESSION[userid]'");
              if($update_wallet){
                  if($login_details['aff_by_id']>0){
                  $aff_function=affiliate_refer_income($login_details['aff_by_id'],$login_details['name'],$pay_fee);
                  }else{
                    $aff_function=1;  
                  }
                  if($aff_function==1){
               
               $pay_details_update=mysqli_query($con,"update fee_pay_details set status='CLOSE', c_date='$c_date' where id='$pay_details_id'");
               if($pay_details_update){
                   
                   $des4="Fee pay incentive by : ".$login_details['mobile'];
                   $incentive=($pay_fee*2)/100;
                   $insert4=mysqli_query($con,"insert into `transaction_main`(`userid`, `des`, `credit`, `date`, `c_date`) values('$login_details[bulk_aff_id]', '$des4', '$incentive', '$t_date', '$c_date')");
                   if($insert4){
                       $bulk_aff_wallet=mysqli_fetch_array(mysqli_query($con,"select * from wallet where userid='$login_details[bulk_aff_id]'"));
                       $main_b_aff=$bulk_aff_wallet['main_b'] + $incentive;
                       $update_wallet_S=mysqli_query($con,"update wallet set main_b='$main_b_aff' where userid='$login_details[bulk_aff_id]'");
                       if($update_wallet_S){
                     echo '<script>alert("Fee paid successfully done."); window.location.assign("bank_fee_paid");</script>';   
                       }else{
                         echo '<script>alert("Server Error 106."); window.location.assign("bank_fee_paid");</script>';  
                       }
                   }else{
                     echo '<script>alert("Server Error 105."); window.location.assign("bank_fee_paid");</script>';  
                   }
                       
                   }else{
                 echo '<script>alert("Server Error 104."); window.location.assign("bank_fee_paid");</script>';   
               }
              }else{
               echo '<script>alert("'.$aff_function.'"); window.location.assign("bank_fee_paid");</script>';   
              } 
              }else{
               echo '<script>alert("Server Error 103."); window.location.assign("bank_fee_paid");</script>';   
              }
          }else{
           echo '<script>alert("Server Error 102."); window.location.assign("bank_fee_paid");</script>';   
          }   
              
          }else{
            echo '<script>alert("Server Error 101."); window.location.assign("bank_fee_paid");</script>';  
          }
         
        }else{
          echo '<script>alert("Somthing went wrong."); window.location.assign("bank_fee_paid");</script>';   
        }
        
    }else{
        echo '<script>alert("Insufficient wallet Balance."); window.location.assign("bank_fee_paid");</script>';  
          
        }
    }else{
        
        echo '<script>alert("Please enter pay fee amount."); window.location.assign("bank_fee_paid");</script>'; 
       
    }
}


if(isset($_POST['update_utr'])){
    $utr=VerifyData($_POST['utr']);
    $pay_fee=VerifyData($_POST['pay_fee']);
    if(!$utr=="" and !$pay_fee==""){
       $check_utr=mysqli_num_rows(mysqli_query($con,"select * from fee_pay_details where utr='$utr' and (status='OPEN' or status='CLOSE')"));
       if(!$check_utr>0){
          $insert_fee_details=mysqli_query($con,"insert into `fee_pay_details`(`userid`, `type`, `utr`, `amt`, `status`, `date`, `c_date`) values('$_SESSION[userid]', 'QR', '$utr', '$pay_fee', 'OPEN', '$t_date', '$c_date')");  
           if($insert_fee_details){
               echo '<script>alert("UTR No. submited successfully Done. Please wait for 1 hours to verify."); window.location.assign("bank_fee_paid");</script>';  
           }else{
             echo '<script>alert("Server error 101."); window.location.assign("bank_fee_paid");</script>';  
           }
       }else{
         echo '<script>alert("UTR No. already used."); window.location.assign("bank_fee_paid");</script>';  
       }
    }else{
     echo '<script>alert("Please enter utr and pay fee amount."); window.location.assign("bank_fee_paid");</script>';   
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pay Fee |
        <?php echo $brand_name; ?>
    </title>
    <!-- Favicons -->
    <link href="<?php echo $brand_logo; ?>" rel="icon">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    
     <style type="text/css">
          .bank_drop{
    	background: #157daf !important;
    }
    
    .fee_payment{
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
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Pay Due Fee</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>

           <?php if($login_details['bulk_aff']=="NO"){ ?>
            <!--Main Content section start-->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        
                        <?php 
                        $close_area=2;
                        if($close_area==1){
                        ?>
                        
                        <div class="col-md-6">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Pay By Wallet</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" name="form_2">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <lable>Name</lable>
                                                <input type="text" readonly name="student_name"
                                                    value="<?php echo $login_details['name'] ;?>" class="form-control">

                                            </div>
                                            <div class="col-md-6">
                                                <lable>Wallet Balance</lable>
                                                <input type="text" name="main_b" id="main_b" readonly
                                                    value="<?php echo $login_wallet['main_b'] ;?>" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <lable>Deu Fee</lable>
                                                <input type="text" readonly name="fee" readonly
                                                    value="<?php echo $login_wallet['fee'] ;?>" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <lable>Pay amount</lable>
                                                <input type="number" name="pay_fee" id="pay_fee_walllet" required
                                                    value="" class="form-control" placeholder="Enter pay amount.">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" name="pay_amt" id="pay_amt_wallet"
                                            onclick="hide_wallet_btn()" class="btn btn-primary">Pay</button>
                                        <span id="pay_fee_wallet_span" style="color:blue;display:none;">Please
                                            wait...</span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <script>
                            function hide_wallet_btn() {
                                var pay_fee_walllet = $("#pay_fee_walllet").val();
                                if (pay_fee_walllet)
                                    document.getElementById("pay_amt_wallet").style.display = "none";
                                document.getElementById("pay_fee_wallet_span").style.display = "block";
                            }
                        </script>
                        <?php }else{
                        ?>
                        <div class="col-md-3"></div>
                        <?php
                        } ?>
                        
                        <div class="col-md-6">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Pay By QR payment</h3>

                                </div>
                                <!-- /.card-header -->
                                <div class="col-12" align="center">
                                    <div style="text-align: center; margin-top:-15px;"><br>
                                        <img src="../qr_img/phonepay_qr7700.jpeg" class="img3" width="35%">
                                        <br />
                                        <a href="../qr_img/phonepay_qr7700.jpeg" download><button
                                                class="btn btn-success">Download QR</button></a>

                                    </div>
                                </div>
                                <!-- form start -->
                                <form name="form_1" method="post">
                                    <div class="card-body">
                                        <div class="row">
                                            <br />
                                            <div class="col-md-6">
                                                <lable>Name</lable>
                                                <input type="text" readonly name="student_name"
                                                    value="<?php echo $login_details['name'] ;?>" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <lable>Deu Fee</lable>
                                                <input type="text" readonly name="fee" readonly
                                                    value="<?php echo $login_wallet['main_b'] ;?>" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <lable>UTR No.</lable>
                                                <input type="text" name="utr" id="utr_number" required value=""
                                                    class="form-control" placeholder="Enter UTR No.">
                                            </div>
                                            <div class="col-md-6">
                                                <lable>Pay amount</lable>
                                                <input type="number" name="pay_fee" id="pay_fee_qr" required value="dfsd"
                                                    class="form-control" placeholder="Enter pay amount.">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" name="update_utr" class="btn btn-success">Pay</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <p style="font-size: 14px; font-style: italic;"><strong>Note:</strong> To pay through QR code,
                            scan the QR code and pay the amount. After making the payment enter the UTR number and
                            submit the amount to verify. Your payment request will be verified in 1 hour.</p>
                    </div>
                </div>
            </section>
            <!--Main content section end-->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Payment Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Date</th>
                                                <th>Pay By</th>
                                                <th>Pay Id</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                            $sql_d=mysqli_query($con,"select * from fee_pay_details where userid='$_SESSION[userid]' order by id desc");
                                            while($row=mysqli_fetch_array($sql_d)){
                                            $date=date_create($row['c_date']);
                                            $date=date_format($date,"d-m-Y H:i A");
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $date; ?></td>
                                                <td><?php echo $row['type']; ?></td>
                                                <td><?php echo $row['utr']; ?></td>
                                                <td><?php echo $row['amt']; ?></td>
                                                <td><?php 
                                                
                                                if($row['status']=="CLOSE"){
                                                    echo "PAID";
                                                }
                                                if($row['status']=="OPEN"){
                                                    if($row['type']=="QR"){
                                                        echo "Waiting for confirmation.";
                                                    }else{
                                                       echo "Technical issue please contact support."; 
                                                    }
                                                }
                                                if($row['status']=="CANCEL"){
                                                    if($row['type']=="QR"){
                                                        echo "Wrong UTR No.";
                                                    }else{
                                                       echo "Cancel By EDUG."; 
                                                    }
                                                }
                                                
                                                
                                                ?></td>
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
            
            
            <?php if($login_details['bulk_aff']=="YES"){ 
            ?>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Pay By Wallet</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" name="form_3">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <lable>Candidate Mobile Number</lable>
                                                <input type="text" required  name="student_mobile" onkeyup="get_userid(this.value)"
                                                    value="" class="form-control" placeholder="Enter candidate mobile number.">

                                            </div>
                                            <div class="col-md-6">
                                                <lable>Candidate Name</lable>
                                                <input type="text" readonly name="student_name" id="student_name_aff"
                                                    value="" class="form-control">

                                            </div>
                                            
                                            <div class="col-md-6">
                                                <lable>Deu Fee</lable>
                                                <input type="text" readonly name="fee_aff" id="deu_fee_aff"
                                                    value="" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <lable>Pay amount</lable>
                                                <input type="number" name="pay_fee_aff" id="pay_fee_walllet" required
                                                    value="" class="form-control" placeholder="Enter pay amount.">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" name="pay_amt_aff" id="pay_amt_wallet"
                                            onclick="hide_wallet_btn()" class="btn btn-primary">Pay</button>
                                        <span id="pay_fee_wallet_span" style="color:blue;display:none;">Please
                                            wait...</span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <script>
                            function hide_wallet_btn() {
                                var pay_fee_walllet = $("#pay_fee_walllet").val();
                                if (pay_fee_walllet)
                                    document.getElementById("pay_amt_wallet").style.display = "none";
                                document.getElementById("pay_fee_wallet_span").style.display = "block";
                            }
                        </script>
                       
                    </div>
                </div>
            </section>
            <?php
            
            }?>
            
            
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
   <script>
      
      function get_userid(val){
          $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'get_user_id='+val,
                success: function(data){
                    if(data=="NO"){
                       $("#student_name_aff").val("Please enter valid mobile number."); 
                    }else{
                       get_fee(data);
                       get_name(data);
                    }
                 
                }
              }
              );
      }
      
      function get_fee(val){
           $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'fee_id='+val,
                success: function(data){
                 $("#deu_fee_aff").val(data);
                }
              }
              );
       }
       
      
       function get_name(val){
           $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'name_id='+val,
                success: function(data){
                 $("#student_name_aff").val(data);
                }
              }
              );
       }
       
   </script>
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
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
    </script>
</body>

</html>