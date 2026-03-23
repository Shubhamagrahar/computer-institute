<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(isset($_GET['status'])){
    $status=VerifyData($_GET['status']);
    $id=VerifyData($_GET['id']);
    if(!$status=="" && !$id==""){
        $update =mysqli_query($con,"update user set status='$status' where id='$id'");
        if($update){
            echo '<script>alert("Status update Sucessfully Done.");window.location.assign("branch_list_own");</script>';
        }else{
         echo '<script>alert("Server error 202.");window.location.assign("branch_list_own");</script>';   
        }
    }else{
      echo '<script>alert("Somthing Went Wrong.");window.location.assign("branch_list_own");</script>';   
    }
}


if(isset($_GET['own_branch'])){
    $id=VerifyData($_GET['own_branch']);
 if(!$id==""){
     $check=mysqli_num_rows(mysqli_query($con,"select * from user where id='$id' and type='1' and own_branch='YES'"));
     if($check==1){
         $update=mysqli_query($con,"update user set own_branch='NO' where id='$id'");
         if($update){
             echo '<script>alert("Normal branch assign successfully done.");window.location.assign("branch_list");</script>';
         }else{
          echo '<script>alert("Server Error 101.");window.location.assign("branch_list_own");</script>';   
         }
     }else{
      echo '<script>alert("Server Error 101.");window.location.assign("branch_list_own");</script>';   
     }
     
 }else{
    echo '<script>alert("Somthing Went Wrong.");window.location.assign("branch_list_own");</script>';   
 }    
    
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Franchise List | <?php echo $brand_name; ?></title>
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
          .branch_drop{
    	background: #157daf !important;
    }
    
    .branch_list_own{
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
                            <h1>Own Franchise List</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>


           
           
            <section class="content">
                <div class="container-fluid">
                    
                    <?php 
                    if(isset($_GET['collect_id'])){
                        $id=VerifyData($_GET['collect_id']);
                        if(!$id==""){
                            $sql_data=mysqli_query($con,"select * from user where id='$id' and type='1' and own_branch='YES'");
                            if(mysqli_num_rows($sql_data)==1){
                                $result_data=mysqli_fetch_array($sql_data);
                                $wallet_collect=mysqli_fetch_array(mysqli_query($con,"select * from wallet where userid='$id'"));
                                if($wallet_collect['main_b']>0){
                                   $_SESSION['collect_id']=$id;
                                   
                                    if(isset($_POST['submit'])){
                                        $amount=VerifyData($_POST['amt']) ;
                                        $pay_type=VerifyData($_POST['pay_type']);
                                        $des=VerifyData($_POST['des']);
                                        
                                        if(!$amount=="" and !$pay_type==""){
                                         $wallet_collect=mysqli_fetch_array(mysqli_query($con,"select * from wallet where userid='$_SESSION[collect_id]'"));   
                                         if($wallet_collect['main_b']>=$amount){
                                             
                                            $op_bal=$wallet_collect['main_b'];
                                           $cl_bal=$op_bal - $amount;
                                           $update_wallet_fr=mysqli_query($con,"update wallet set main_b='$cl_bal' where userid='$_SESSION[collect_id]'");
                                           if($update_wallet_fr){ 
                                               
                                             $des12=$pay_type."/Amount pay to :".$login_details['short_name']."/ ".$des;
                                             $insert_transaction = mysqli_query($con,"insert into `transaction`(`userid`, `des`, `debit`, `type`, `date`, `c_date`, `op_bal`, `cl_bal`) values('$_SESSION[collect_id]', '$des12', '$amount', '2', '$t_date', '$c_date', '$op_bal', '$cl_bal')");  
                                             
                                             if($insert_transaction) {
                                                
                                                   $op_bal=$login_wallet['main_b'];
                                                   $cl_bal=$op_bal + $amount ;
                                                   $update_wallet=mysqli_query($con,"update wallet_main set main_b='$cl_bal' where userid='$_SESSION[userid]'");
                                                   
                                                  if($update_wallet){
                                                     $user_collect=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$_SESSION[collect_id]'"));
                                                    $des15=$pay_type."/Amount collect by :".$user_collect['name']." (".$user_collect['mobile'].")/ ".$des; 
                                                      
                                                   $teransactionIntsert=mysqli_query($con,"insert into `super_admin_transaction`(`userid`, `des`, `credit`, `date`, `c_date`, `op_bal`, `cl_bal`, `by_userid`) values('$_SESSION[userid]', '$des15', '$amount', '$t_date', '$c_date', '$op_bal', '$cl_bal', '$_SESSION[userid]')");  
                                                    if($teransactionIntsert){
                                                      echo '<script>alert("Amount collected successfully done.");window.location.assign("branch_list_own");</script>';  
                                                    }else{
                                                     echo '<script>alert("Server error 104.");window.location.assign("branch_list_own");</script>';   
                                                    }
                                                      
                                                  }else{
                                                   echo '<script>alert("Server error 103.");window.location.assign("branch_list_own");</script>';    
                                                  }               
                                                 
                                             }else{
                                                echo '<script>alert("Server error 102.");window.location.assign("branch_list_own");</script>';  
                                             }
                                               
                                           }else{
                                             echo '<script>alert("Server error 101.");window.location.assign("branch_list_own");</script>';  
                                           }
                                             
                                         }else{
                                          echo '<script>alert("Please enter vaid amount.");window.location.assign("branch_list_own");</script>';   
                                         }
                                         
                                        }else{
                                          echo '<script>alert("Somthing Went Wrong.");window.location.assign("branch_list_own");</script>';  
                                        } 
                                         
                                         
                                        
                                    }
                                     
                                     
                                   ?>
                                   
                                   
                                   <div class="row">
                        
                        <div class="col-4">
                            
                        </div>
                        <div class="col-4">
                            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Collect Amount</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body">
                  
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" readonly id="name" name="name" value="<?php echo $result_data['name']." (".$result_data['mobile'].")"; ?>" placeholder="Name.">
                  </div>
                  <div class="form-group">
                    <label for="main_b">Balance</label>
                    <input type="text" class="form-control" readonly id="main_b" name="main_b" value="<?php echo $wallet_collect['main_b']; ?>" placeholder="Available Balance">
                  
                  </div>
                  <div class="form-group">
                    <label for="amt">Amount</label>
                    <input type="number" required class="form-control" id="amt" name="amt" onkeyup="check(this.value)" placeholder="Enter amount.">
                   <span id="totalBal" style="font-size: 20px;"></span>
                  </div>
                  <div class="form-group">
                     <lable for="pay_type">Pay Type</lable>
                    <select id="pay_type" name="pay_type" required class="form-control">
                        <option value="">Select</option>
                        <option value="CASH">Cash</option>
                        <option value="BYQRPAYORUPI">By QR Scan Pay Or UPI ID</option>
                        <option value="BYIMPS">By IMPS</option>
                        <option value="BYNEFT">By NEFT</option>
                        
                    </select>
                  
                  </div>
                  <div class="form-group">
                    <label for="des">Description</label>
                    <textarea  class="form-control" id="des" name="des"  placeholder="Enter Description."></textarea>
                   
                  </div>
                  
                  
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Collect</button>
                </div>
              </form>
            </div>
                            
                            
                        </div>
                        
                    </div>
                        <script>
                            function check(val){
                                var main_b=$("#main_b").val();
                                if(main_b>val){
                                    
                                }else{
                                   $("#amt").val("");
                                }
                            }
                        </script>      
                                   
                                   
                                   <?php 
                                   
                                   
                                   
                                   
                                }else{
                                 echo '<script>alert("Min. Rs.1 wallet amount required.");window.location.assign("branch_list_own");</script>';    
                                }
                            }else{
                              echo '<script>alert("Server error 101.");window.location.assign("branch_list_own");</script>';  
                            }
                        }else{
                          echo '<script>alert("Somthing Went Wrong.");window.location.assign("branch_list_own");</script>';  
                        }
                    }
                    ?>
                    
                    
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Own Franchise Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Franchise Name</th>
                                                <th>Owner Name</th>
                                                <th>Mobile</th>
                                                <th>Whatsapp No.</th>
                                                <th>Email</th>
                                                <th>Wallet Amount</th>
                                                <th>State</th>
                                                <th>Pin code</th>
                                                <th>Address</th>
                                                <th>Register Date</th>
                                                <th>Status</th>
                                                <th>Edit</th>
                                                <th>Own Franchise</th>
                                                
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php
                                            $i=0;
                                            
                                            
                                            $sql_franchise=mysqli_query($con,"select * from user where type='1' and own_branch='YES' order by id desc");
                                            while($row=mysqli_fetch_array($sql_franchise)){
                                           
                                             $date_register=date_create($row['r_date']);
                                             $date_register=date_format($date_register,"d-m-Y");
                                           $state_details=mysqli_fetch_array(mysqli_query($con,"select * from states where id='$row[state_id]'"));
                                           $wallet_fr_details=mysqli_fetch_array(mysqli_query($con,"select * from wallet where userid='$row[id]'"));
                                           
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['father_name']; ?></td>
                                                <td><?php echo $row['mobile']; ?></td>
                                                <td><?php echo $row['w_mob']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $wallet_fr_details['main_b']."<br>"; 
                                                 if($wallet_fr_details['main_b']>0){
                                                     ?>
                                                     <a href="branch_list_own?collect_id=<?php echo $row['id']; ?>" style="cursor:pinter; color:blue;"><i class="fa fa-rupee"></i>Collect</a>
                                                     <?php 
                                                 }
                                                ?></td>
                                                <td><?php echo $state_details['name']; ?></td>
                                                <td><?php echo $row['pin']; ?></td>
                                                <td><?php echo $row['full_add'];?></td>
                                                <td><?php echo $date_register; ?></td>
                                               <td><?php 
                                                
                                                if($row['status']=="1"){
                                                    ?>
                                                <a href="branch_list_own?status=2&id=<?php echo $row['id']; ?>" onclick="return confirm('Are your sure for deactive this franchise?')"><button class="btn btn-danger"> Deactive</button></a>  
                                                  <?php
                                                }
                                                if($row['status']=="2"){
                                                    ?>
                                                  <a href="branch_list_own?status=1&id=<?php echo $row['id']; ?>" onclick="return confirm('Are your sure for active this franchise?')"><button class="btn btn-success"> Active</button></a>  
                                                   <?php
                                                }
                                                
                                                
                                                ?></td>
                                            <td><a href="branch_new?btn=Update&id=<?php echo $row['id']; ?>" ><button class="btn btn-primary"><i class="fa fa-edit"></i>Edit</button></a></td>   
                                           
                                           <td>
                                               <a href="branch_list_own?own_branch=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure for assign to normal franchise?')"><button class="btn btn-danger">No</button></a>
                                               
                                           </td>
                                            </tr>
                                            
                                          <?php }  ?>  
                                        </tbody>

                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            
                            
                        </div>
                        
                        
                    </div>
                </div>
            </section>
            
           
            <!--Main content section end-->

            
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
	
    		function get_fee(val){
    		  
    		    $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'fee_details='+val,
                success: function(data){
                    
                    if(data>0){
                        
                    document.getElementById("course_fee_label").style.display="block";
                   
                 $("#course_fee").val(data);
                    }
                }
              }
              );
    		}
    		
    	</script>
    	<script>
        function getImagePreview(event) {
            var image = URL.createObjectURL(event.target.files[0]);
            var imagediv = document.getElementById('preview');
            var newimg = document.createElement('img');
            imagediv.innerHTML = '';
            newimg.src = image;
            newimg.width = "300";
            imagediv.appendChild(newimg);
        }
       
    </script>
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