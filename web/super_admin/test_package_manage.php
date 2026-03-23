<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

$refer_url=$_SERVER['HTTP_REFERER'];
$btnname="Create";
$test_package_nane="";
$test_series_total="";
$ques_no_each_series="";
$test_series_valid_day="";
$test_free_series="";
$test_price="";
$test_discount="";

if(isset($_POST['Create'])){
    
    $package_name=VerifyData($_POST['package_name']);
    $total_test_series=VerifyData($_POST['total_test_series']);
    $ques_no_each_series=VerifyData($_POST['ques_no_each_series']);
    $validity_in_days=VerifyData($_POST['validity_in_days']);
    $total_free_series=VerifyData($_POST['total_free_series']);
    $price=VerifyData($_POST['price']);
    $discount_amt=VerifyData($_POST['discount_amt']);
   
     
     
    if(!$package_name=="" and !$total_test_series=="" and !$ques_no_each_series=="" and !$validity_in_days=="" and !$total_free_series=="" and !$price==""){
        $check_package_name=mysqli_num_rows(mysqli_query($con, "select * from test_series_pkg_details where package_name='$package_name'"));
        if(!$check_package_name>0){
                $insert=mysqli_query($con,"insert into `test_series_pkg_details`(`package_name`, `total_test_series`, `ques_no_each_series`, `validity_in_days`, `total_free_series`, `price`, `discount_amt`) values('$package_name', '$total_test_series', '$ques_no_each_series', '$validity_in_days', '$total_free_series', '$price', '$discount_amt')");
               if($insert){
                   echo '<script>alert("Package created successfuly done.");window.location.assign("test_package_manage")</script>'; 
               }else{
                 echo '<script>alert("Server error 101.");window.location.assign("test_package_manage")</script>';  
               } 
            }else{
           echo '<script>alert("This package name already exist.");window.location.assign("test_package_manage")</script>'; 
        }
      }else{
     echo '<script>alert("Please fill all the fields");window.location.assign("test_package_manage")</script>';   
    }
}


if(isset($_GET['status'])){
    $status=VerifyData($_GET['status']);
    $id=VerifyData($_GET['id']);
    if(!$status=="" && !$id==""){
        $update =mysqli_query($con,"update test_series_pkg_details set status='$status' where id='$id'");
        if($update){
            echo '<script>alert("Status update Sucessfully Done.");window.location.assign("test_package_manage");</script>';
        }else{
         echo '<script>alert("Server error 202.");window.location.assign("test_package_manage");</script>';   
        }
    }else{
      echo '<script>alert("Somthing Went Wrong.");window.location.assign("test_package_manage");</script>';   
    }
}

if(isset($_GET['edit'])){
    $id=VerifyData($_GET['edit']);
    if(!$id==""){
        $test_package_details=mysqli_query($con,"select * from test_series_pkg_details where id='$id'");
        if(mysqli_num_rows($test_package_details)>0){
           $test_series_package_details=mysqli_fetch_array($test_package_details); 
           $test_package_nane=$test_series_package_details['package_name'];
           $test_series_total=$test_series_package_details['total_test_series'];
           $ques_no_each_series=$test_series_package_details['ques_no_each_series'];
           $test_series_valid_day=$test_series_package_details['validity_in_days'];
           $test_free_series=$test_series_package_details['total_free_series'];
           $test_price=$test_series_package_details['price'];
           $test_discount=$test_series_package_details['discount_amt'];
            $btnname="Update";
        }else{
         echo '<script>alert("Course not availabel.");window.location.assign("test_package_manage");</script>';    
        }
    }else{
      echo '<script>alert("Somthing Went Wrong.");window.location.assign("test_package_manage");</script>';   
    }
}

if(isset($_POST['Update'])){
    
    $package_name=VerifyData($_POST['package_name']);
    $total_test_series=VerifyData($_POST['total_test_series']);
    $ques_no_each_series=VerifyData($_POST['ques_no_each_series']);
    $validity_in_days=VerifyData($_POST['validity_in_days']);
    $total_free_series=VerifyData($_POST['total_free_series']);
    $price=VerifyData($_POST['price']);
    $discount_amt=VerifyData($_POST['discount_amt']);
     
   if(!$package_name=="" and !$total_test_series=="" and !$ques_no_each_series=="" and !$validity_in_days=="" and !$total_free_series=="" and !$price==""){
    //   $check_package_name=mysqli_num_rows(mysqli_query($con, "select * from test_series_pkg_details where package_name='$package_name'"));
    //     if(!$check_package_name>0){
        
                $update=mysqli_query($con,"update test_series_pkg_details set package_name='$package_name', total_test_series='$total_test_series', ques_no_each_series='$ques_no_each_series', validity_in_days='$validity_in_days', total_free_series='$total_free_series', price='$price', discount_amt='$discount_amt' where id='$id'");
               if($update){
                   
                   echo '<script>alert("Package details update successfuly done.");window.location.assign("test_package_manage")</script>'; 
                  
               }else{
                 echo '<script>alert("Server error 101.");window.location.assign("test_package_manage")</script>';  
               } 
        //   }else{
        //   echo '<script>alert("This package name already exist.");window.location.assign("test_package_manage")</script>'; 
        // }
          
    }else{
     echo '<script>alert("Please fill all the fields");window.location.assign("test_package_manage")</script>';   
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test Package Manage |
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
    
    .test_package_manage{
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
                            <h1>Test Package Manage</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>


           

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                       
                     
                        <div class="col-md-12">
                            <br>
                <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"><?php echo $btnname;?> Test Package</h3>
              </div>
              <!-- /.card-header --> 
              <!-- form start -->
              <form method="post" name="form_2">
                <div class="card-body ">
                <div class="row">
                 <div class="col-sm-3" >
                    <label>Package Name :</label>
                    <input type="text" class="form-control" required value="<?php echo $test_package_nane; ?>" name="package_name" id="package_name" placeholder="Enter package name.">
                    </div>
                   <div class="col-sm-3" >
                    <label>Total Test Series </label>
                    <input type="number" class="form-control" required value="<?php echo $test_series_total; ?>" name="total_test_series" id="total_test_series" placeholder="Enter total test series.">
                    </div>
                     <div class="col-sm-3" >
                    <label>Question in Each Series </label>
                    <input type="number" class="form-control" required value="<?php echo $ques_no_each_series; ?>" name="ques_no_each_series" id="ques_no_each_series" placeholder="Enter total question in each series.">
                    </div>
                    
                     <div class="col-sm-3" >
                    <label>Validity in days</label>
                    <input type="number" class="form-control" required value="<?php echo $test_series_valid_day; ?>" name="validity_in_days" id="validity_in_days" placeholder="Enter validity in days.">
                    </div>
                    <div class="col-sm-3" >
                    <label> Total Free Serise </label>
                    <input type="number" required class="form-control"  value="<?php echo $test_free_series; ?>" name="total_free_series" id="total_free_series" placeholder="Enter total free serise.">
                    </div>
                    <div class="col-sm-3" >
                    <label> Price </label>
                    <input type="number" required class="form-control"  value="<?php echo $test_price; ?>" name="price" id="price" placeholder="Enter Price.">
                    </div>
                    <div class="col-sm-3" >
                    <label> Any Discount amount </label>
                    <input type="number"  class="form-control"  value="<?php echo $test_discount; ?>" name="discount_amt" id="discount_amt" placeholder="Enter discount amount.">
                    </div>
                   
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="<?php echo $btnname; ?>" class="btn btn-success"><?php echo $btnname; ?></button>
                </div>
              </form>
            </div>
            </div>    
                        <div class="col-12">
                  <br>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"></h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Package Name</th>
                                                <th>Total Test Series</th>
                                                <th>Question in Each Series</th>
                                                <th>Validity In Dasy</th>
                                                <th>Total Free series</th>
                                                <th>Price</th>
                                                <th>Discount Amount</th>
                                                <th width="60px">Edit</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                            $sql_test_series_package=mysqli_query($con,"select * from test_series_pkg_details order by id desc");
                                            while($row=mysqli_fetch_array($sql_test_series_package)){
                                            // $date=date_create($row['c_date']);
                                            // $date=date_format($date,"d-m-Y H:i A");
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $row['package_name']; ?></td>
                                                <td><?php echo $row['total_test_series']; ?></td>
                                                <td><?php echo $row['validity_in_days']; ?></td>
                                                <td><?php echo $row['ques_no_each_series']; ?></td>
                                                <td><?php echo $row['total_free_series']; ?></td>
                                                <td><?php echo $row['price']; ?></td>
                                                <td><?php echo $row['discount_amt']; ?></td>
                                                <td><a href="test_package_manage?edit=<?php echo $row['id']; ?>" onclick="return confirm('Are your sure for edit this package?')"><button class="btn btn-primary"><i class="fa fa-edit"></i> Edit</button></a></td>
                                                 <td><?php 
                                                
                                                if($row['status']=="OPEN"){
                                                    ?>
                                                <a href="test_package_manage?status=CLOSE&id=<?php echo $row['id']; ?>" onclick="return confirm('Are your sure for deactive this package?')"><button class="btn btn-danger"> Deactive</button></a>  
                                                  <?php
                                                }
                                                if($row['status']=="CLOSE"){
                                                    ?>
                                                  <a href="test_package_manage?status=OPEN&id=<?php echo $row['id']; ?>" onclick="return confirm('Are your sure for active this package?')"><button class="btn btn-success"> Active</button></a>  
                                                   <?php
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