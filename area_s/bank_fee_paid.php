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
<html lang="en" dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title> Pay Fee | <?php echo $brand_name; ?> </title>
        
        
        <!-- Favicons -->
    <link href="<?php echo $brand_logo; ?>" rel="icon">

        <!-- Prevent the demo from appearing in search engines -->
        <meta name="robots" content="noindex">

        <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&amp;display=swap" rel="stylesheet">

        <!-- Preloader -->
        <link type="text/css" href="public/vendor/spinkit.css" rel="stylesheet">

        <!-- Perfect Scrollbar -->
        <link type="text/css" href="public/vendor/perfect-scrollbar.css" rel="stylesheet">

        <!-- Material Design Icons -->
        <link type="text/css" href="public/css/material-icons.css" rel="stylesheet">
        
        <!-- Material Icons from Google Fonts -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Font Awesome Icons -->
        <link type="text/css" href="public/css/fontawesome.css" rel="stylesheet">

        <!-- Preloader -->
        <link type="text/css" href="public/css/preloader.css" rel="stylesheet">

        <!-- App CSS -->
        <link type="text/css" href="public/css/app.css" rel="stylesheet">
        
        <!-- Bootstrap 5 -->
          <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">-->
        
          <!-- DataTables with Responsive Extension -->
          <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
          <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" rel="stylesheet">
          
          <!-- Font Awesome -->
          <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
          <!-- DataTables -->
          <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
          <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
          <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

        
        <style>
        
          .bank_drop{
    	background: #157daf !important;
    }
    
    .bank_fee_paid{
    	background: #157daf !important;
    }
            .mdk-drawer-layout .container {
                max-width: 100%;
            }
    .table_container {
      background: white;
      padding: 1rem;
      border-radius: 1rem;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    h4 {
      text-align: center;
      font-weight: bold;
      color: #333;
      margin-bottom: 2rem;
    }
    table.dataTable {
      border-collapse: collapse;
      width: 100%;
    }
    table.dataTable thead th {
      /*background-color: #343a40;*/
      background-color: #303956;
      color: white;
      text-align: center;
    }
    table.dataTable tbody td {
      text-align: center;
      vertical-align: middle;
    }
    table.dataTable tbody tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child::before {
      background-color: #303956;
      color: white;
      border: none;
      border-radius: 50%;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
      background-color: #303956;
      color: white !important;
      border-radius: 5px;
      margin: 0 2px;
      padding: 6px 12px;
    }
    [dir] .page-item.active .page-link {
        background-color: #303956;
        border-color: #303956;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
      background-color: #0056b3 !important;
    }
    .dataTables_wrapper .dataTables_filter input {
      border-radius: 5px;
      border: 1px solid #ccc;
      padding: 0.4rem;
      width: 200px;
    }
    .dataTables_wrapper .dataTables_length select {
      border-radius: 5px;
      padding: 0.4rem;
    }
    
    table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td {
        font-size: 15px;
    }
    [dir] .page-link {
        padding: 0;
    }
    [dir] .page-item.disabled .page-link {
        border: none;
    }
    table.dataTable.nowrap th, table.dataTable.nowrap td {
    white-space: wrap;
}
table.dataTable thead>tr>th.sorting {
    padding-right: 20px;
}

thead tr {
    background-color: #303956;
    text-align: center;
}
.table thead th {
    color: #ffffff;
    padding: 12px !important;
}
.table tbody td {
    font-size: 15px;
    text-align: center;
}
@media(max-width: 768px) {
    .table_container {
        width: 100%;
        overflow-x: scroll;
    }
    [dir] .table td {
        padding: 4px !important;
    }
}

.info-box {
    box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
    border-radius: .25rem;
    background-color: #fff;
    display: -ms-flexbox;
    display: flex;
    margin-bottom: 1rem;
    min-height: 80px;
    padding: .5rem;
    position: relative;
    width: 100%;
}
.info-box .info-box-icon {
    border-radius: .25rem;
    -ms-flex-align: center;
    align-items: center;
    display: -ms-flexbox;
    display: flex;
    font-size: 1.875rem;
    -ms-flex-pack: center;
    justify-content: center;
    text-align: center;
    width: 70px;
}
.info-box .info-box-content {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    -ms-flex-pack: center;
    justify-content: center;
    line-height: 1.8;
    -ms-flex: 1;
    flex: 1;
    padding: 0 10px;
    overflow: hidden;
}
.info-box .info-box-text, .info-box .progress-description {
    display: block;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.info-box .info-box-number {
    display: block;
    margin-top: .25rem;
    font-weight: 700;
}

.info-box .info-box-number {
    display: block;
    margin-top: .25rem;
    font-weight: 700;
}

@media(max-width: 768px) {
    .info-box {
        width: 95%;
    }
    .card {
        width: 100%;
    }
}
[dir] .card-header {
    background-color: #303956;
}
[dir] .card-title:last-child {
    color: #ffffff;
}
.card-info img {
    width: 30%;
    margin: 10px;
}
  </style>

    </head>

    <body class="layout-app ui ">

        <div class="preloader">
            <div class="sk-chase">
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
            </div>


        </div>

        <!-- Drawer Layout -->

        <div class="mdk-drawer-layout js-mdk-drawer-layout"
             data-push
             data-responsive-width="992px">
            <div class="mdk-drawer-layout__content page-content">

                <!-- Header -->

                <!-- Navbar -->

                <?php include 'top-navbar.php'; ?>


                <div class="container page__container page-section pb-0">
                
                
                 <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-50">

                            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                                <h2 class="mb-0">Pay Due Fee</h2>

                                <ol class="breadcrumb p-0 m-0">
                                    <li class="breadcrumb-item"><a href="">Banking</a></li>

                                    <li class="breadcrumb-item active"> Pay Due Fee </li>

                                </ol>

                            </div>
                        </div>
                </div>

                <div class="container page__container page-section">

                    <div class="page-separator">
                        <div class="page-separator__text">Pay Due Fee</div>
                    </div>
                    
                    
                    
                    <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        
                                                <div class="col-md-3"></div>
                                                
                        <div class="col-md-6">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Pay By QR payment</h3>

                                </div>
                                <!-- /.card-header -->
                                <div class="col-12" align="center">
                                    <div style="text-align: center; margin-top:-15px;"><br>
                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=testdata" class="img3" width="35%">
                                        <br>
                                        <a href="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=testdata" download>
                                            <button class="btn btn-success">Download QR</button></a>

                                    </div>
                                </div>
                                <!-- form start -->
                                <form name="form_1" method="post">
                                    <div class="card-body">
                                        <div class="row">
                                            <br>
                                            <div class="col-md-6">
                                                <lable>Name</lable>
                                                <input type="text" readonly="" name="student_name" value="Ashish Yadav " class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <lable>Due Fee</lable>
                                                <input type="text" readonly="" name="fee" value="0.00" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <lable>UTR No.</lable>
                                                <input type="text" name="utr" id="utr_number" required="" value="" class="form-control" placeholder="Enter UTR No.">
                                            </div>
                                            <div class="col-md-6">
                                                <lable>Pay amount</lable>
                                                <input type="number" name="pay_fee" id="pay_fee_qr" required="" value="dfsd" class="form-control" placeholder="Enter pay amount.">
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
                    
                    
                    
                    <div class="table_container">
                          <!--<h4>Running Course Details</h4>-->
                          <div class="test_table">
                          <table id="courseTable" class="display responsive nowrap table table-bordered" style="width:100%">
                            <thead>
                              <tr>
                                <th>S. No.</th>
                                <th>Date</th>
                                <th>Pay By</th>
                                <th>Pay Id</th>
                                <th>Amount </th>
                                <th>Status</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>1</td>
                                <td>02-06-2025</td>
                                <td>Someone</td>
                                <td>123456</td>
                                <td>1000</td>
                                <td>Paid</td>
                              </tr>
                              
                            </tbody>
                          </table>
                          </div>
                        </div>

                </div>

                <!-- // END Page Content -->

                <!-- Footer -->

                <?php include 'footer.php'; ?>

                <!-- // END Footer -->

            </div>

            <!-- // END drawer-layout__content -->

            <!-- Drawer -->

            <?php include 'left-navbar.php'; ?>

            <!-- // END Drawer -->

        </div>

        <!-- // END Drawer Layout -->
        
        
        
        
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
   
        
        <!-- jQuery + DataTables -->
            <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
            


        <!-- jQuery -->
        <script src="public/vendor/jquery.min.js"></script>

        <!-- Bootstrap -->
        <script src="public/vendor/popper.min.js"></script>
        <script src="public/vendor/bootstrap.min.js"></script>

        <!-- Perfect Scrollbar -->
        <script src="public/vendor/perfect-scrollbar.min.js"></script>

        <!-- DOM Factory -->
        <script src="public/vendor/dom-factory.js"></script>

        <!-- MDK -->
        <script src="public/vendor/material-design-kit.js"></script>

        <!-- App JS -->
        <script src="public/js/app.js"></script>

        <!-- Preloader -->
        <script src="public/js/preloader.js"></script>

        <!-- List.js -->
        <script src="public/vendor/list.min.js"></script>
        <script src="public/js/list.js"></script>

        <!-- Tables -->
        <script src="public/js/toggle-check-all.js"></script>
        <script src="public/js/check-selected-row.js"></script>
        
        
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


<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#courseTable').DataTable({
      paging: true,
      searching: true,
      ordering: true,
      info: true,
      responsive: false,
      lengthChange: false 
    });
  });
</script>


        <script>
    function myFunction23() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Copied the text: " + copyText.value);
}
</script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

    </body>

</html>