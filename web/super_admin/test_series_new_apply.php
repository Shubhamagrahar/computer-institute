<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");


if(isset($_GET['action'])){
    $id=VerifyData($_GET['action']);
    $type=VerifyData($_GET['type']);
    if(!$id=="" and !$type==""){
      $sql=mysqli_query($con,"select * from test_pkg_book_details where id='$id' and status='OPEN'");
      if(mysqli_num_rows($sql)==1){
         $sql_details=mysqli_fetch_array($sql);
         if($type=="PAID"){
             $op_bal=$login_wallet['main_b'];
             $cl_bal=$login_wallet['main_b'] + $sql_details['price'];
             $update_wallet=mysqli_query($con,"update wallet set main_b='$cl_bal' where userid='$_SESSION[userid]'");
             if($update_wallet){
                 $id_user_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$sql_details[userid]'"));
                 $des1="Test Series Package Amount Pay By : ".$id_user_details['name']."(".$id_user_details['mobile'].")";
                $tr_cr_admin=mysqli_query($con,"insert into `transaction`(`userid`, `des`, `credit`, `type`, `date`, `c_date`, `op_bal`, `cl_bal`) values('$_SESSION[userid]', '$des1', '$sql_details[price]', '2', '$t_date', '$c_date', '$op_bal', '$cl_bal')");
                 if($tr_cr_admin){
                  $id_user_wallet=mysqli_fetch_array(mysqli_query($con,"select * from wallet where userid='$sql_details[userid]'"));
                  $main_b=$id_user_wallet['main_b'];
                 $cl_bal=$main_b + $sql_details['price'];
                   $des2="Amount Credit By ADMIN ";
                   $tr_cr_user=mysqli_query($con,"insert into `transaction`(`userid`, `des`, `credit`, `type`, `date`, `c_date`, `op_bal`, `cl_bal`) values('$sql_details[userid]', '$des2', '$sql_details[price]', '2', '$t_date', '$c_date', '$main_b', '$cl_bal')");  
                  if($tr_cr_user){
                     $des3="Book TEST Series Package.";
                   $tr_cr_user=mysqli_query($con,"insert into `transaction`(`userid`, `des`, `debit`, `type`, `date`, `c_date`, `op_bal`, `cl_bal`) values('$sql_details[userid]', '$des2', '$sql_details[price]', '2', '$t_date', '$c_date', '$cl_bal', '$main_b')");   
                   if($tr_cr_user){
                         $update=mysqli_query($con,"update test_pkg_book_details set status='RUN' where id='$id'");
                         if($update){
                          mysqli_close($con);
                          echo '<script>alert("Book data Paid Verify Successfully done.");window.location.assign("test_series_new_apply");</script>';
                          exit();   
                         }else{
                          mysqli_close($con);
                          echo '<script>alert("Server Error 101.");window.location.assign("test_series_new_apply");</script>';
                          exit();       
                         }  
                   }else{
                    mysqli_close($con);
                    echo '<script>alert("Server Error 106.");window.location.assign("test_series_new_apply");</script>';
                    exit();   
                   }
                      
                  }else{
                  mysqli_close($con);
                  echo '<script>alert("Server Error 105.");window.location.assign("test_series_new_apply");</script>';
                  exit();  
                  }   
                 }else{
                  mysqli_close($con);
                  echo '<script>alert("Server Error 104.");window.location.assign("test_series_new_apply");</script>';
                  exit();    
                 }
             }else{
              mysqli_close($con);
              echo '<script>alert("Server Error 103.");window.location.assign("test_series_new_apply");</script>';
              exit();   
             }
             
           }elseif($type=="FREE"){
             
             $update=mysqli_query($con,"update test_pkg_book_details set type='FREE', status='RUN' where id='$id'");
             if($update){
              mysqli_close($con);
              echo '<script>alert("Book data FREE approved Successfully done.");window.location.assign("test_series_new_apply");</script>';
              exit();   
             }else{
              mysqli_close($con);
              echo '<script>alert("Server Error 102.");window.location.assign("test_series_new_apply");</script>';
              exit();       
             }
             
             
          }elseif($type=="CANCEL"){
             $update=mysqli_query($con,"update test_pkg_book_details set status='CANCEL' where id='$id'");
             if($update){
              mysqli_close($con);
              echo '<script>alert("Book data Cancel Successfully done.");window.location.assign("test_series_new_apply");</script>';
              exit();   
             }else{
              mysqli_close($con);
              echo '<script>alert("Server Error 101.");window.location.assign("test_series_new_apply");</script>';
              exit();       
             }
             
         }else{
          mysqli_close($con);
          echo '<script>alert("Book data type accoured found.");window.location.assign("test_series_new_apply");</script>';
          exit();   
         }
      }else{
         mysqli_close($con);
         echo '<script>alert("Book data not found.");window.location.assign("test_series_new_apply");</script>';
         exit(); 
      }
        
    }else{
        mysqli_close($con);
        echo '<script>alert("Proper Data not found.");window.location.assign("test_series_new_apply");</script>';
        exit();
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New PKG Apply |
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
    <script src="https://tvssolution.com/panel/staff/admin_area/js/jquery-3.3.1.min.js" type="text/jscript"></script>
    
     <style type="text/css">
          .test_drop{
    	background: #157daf !important;
    }
    
    .test_series_new_apply{
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
                            <h1>New Request PKG</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>


           

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                       
                     
                     
                        <div class="col-12">
                
                            <div class="card">
                                
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Name </th>
                                                <th>Mobile</th>
                                                <th>Pkg Name</th>
                                                <th>total Series</th>
                                                <th>Price</th>
                                                <th>Discount</th>
                                                <th>action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                            $sql_d=mysqli_query($con,"select * from test_pkg_book_details where status='OPEN' order by id desc");
                                            while($row=mysqli_fetch_array($sql_d)){
                                             $data_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$row[userid]'"));
                                             $data_pkg_details=mysqli_fetch_array(mysqli_query($con,"select * from test_series_pkg_details where id='$row[pkg_id]'"));
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $data_details['name'] ?></td>
                                                <td><?php echo $data_details['mobile'] ?></td>
                                                <td><?php echo $data_pkg_details['package_name'] ?></td>
                                                <td><?php echo $row['total_series'] ?></td>
                                                <td><?php echo $row['price'] ?></td>
                                                <td><?php echo $row['discount'] ?></td>
                                                <td>
                                                  <a onclick="return confirm('Are you sure for Verify in Paid Test Series?')" href="test_series_new_apply?action=<?php echo $row['id']; ?>&type=PAID" style="color:blue;cursor:pointer;"><i class="fa fa-rupee"></i> Paid</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                  <a onclick="return confirm('Are you sure for Verify in Free Test Series?')" href="test_series_new_apply?action=<?php echo $row['id']; ?>&type=FREE" style="color:green;cursor:pointer;"><i class="fa fa-paper-plane"></i> Free</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                  <a onclick="return confirm('Are you sure for Cancel Test Series?')" href="test_series_new_apply?action=<?php echo $row['id']; ?>&type=CANCEL" style="color:red;cursor:pointer;"><i class="fa fa-close"></i> Cancel</a>
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
                        
                       
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
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
                "buttons": ["copy", "", "excel", "pdf", "print", "colvis"]
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