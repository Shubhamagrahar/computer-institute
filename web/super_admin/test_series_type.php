<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");


$btnname="Create";
$test_type_nane="";


if(isset($_POST['Create'])){
    
    $test_type_nane=VerifyData($_POST['test_type_nane']);
  
   
     
     
    if(!$test_type_nane=="" ){
        $check_package_type=mysqli_num_rows(mysqli_query($con, "select * from test_series_type where name='$test_type_nane'"));
        if(!$check_package_type>0){
                $insert=mysqli_query($con,"insert into `test_series_type`(`name`) values('$test_type_nane')");
               if($insert){
                   echo '<script>alert("Test Series type name created successfuly done.");window.location.assign("test_series_type")</script>'; 
               }else{
                 echo '<script>alert("Server error 101.");window.location.assign("test_series_type")</script>';  
               } 
            }else{
           echo '<script>alert("This Test Series type name already exist.");window.location.assign("test_series_type")</script>'; 
        }
      }else{
     echo '<script>alert("Please fill all the fields");window.location.assign("test_series_type")</script>';   
    }
}



if(isset($_GET['edit'])){
    $id=VerifyData($_GET['edit']);
    if(!$id==""){
        $test_series_type_sql=mysqli_query($con,"select * from test_series_type where id='$id'");
        if(mysqli_num_rows($test_series_type_sql)>0){
           $test_series_type_details=mysqli_fetch_array($test_series_type_sql); 
           $test_type_nane=$test_series_type_details['name'];
            $btnname="Update";
        }else{
         echo '<script>alert("data not availabel.");window.location.assign("test_series_type");</script>';    
        }
    }else{
      echo '<script>alert("Somthing Went Wrong.");window.location.assign("test_series_type");</script>';   
    }
}

if(isset($_POST['Update'])){
    
    $test_type_nane=VerifyData($_POST['test_type_nane']);
   
     
   if(!$test_type_nane==""){
    //   $check_package_name=mysqli_num_rows(mysqli_query($con, "select * from test_series_pkg_details where package_name='$package_name'"));
    //     if(!$check_package_name>0){
        
                $update=mysqli_query($con,"update test_series_type set name='$test_type_nane' where id='$id'");
               if($update){
                   
                   echo '<script>alert("Test series type name update successfuly done.");window.location.assign("test_series_type")</script>'; 
                  
               }else{
                 echo '<script>alert("Server error 101.");window.location.assign("test_series_type")</script>';  
               } 
        //   }else{
        //   echo '<script>alert("This package name already exist.");window.location.assign("test_series_type")</script>'; 
        // }
          
    }else{
     echo '<script>alert("Please fill all the fields");window.location.assign("test_series_type")</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test Series Type Name |
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
    
    .test_series_type{
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
                            <h1>Test Series Type Manage</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>


           

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                         
                         <div class="col-md-4">
                             
                         </div>
                        
                        <div class="col-md-4">
                            <br>
                <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"><?php echo $btnname;?> Test Type</h3>
              </div>
              <!-- /.card-header --> 
              <!-- form start -->
              <form method="post" name="form_2">
                <div class="card-body ">
                <div class="row">
                 <div class="col-sm-12" >
                    <label>Type Name :</label>
                    <input type="text" class="form-control" required value="<?php echo $test_type_nane; ?>" name="test_type_nane" id="test_type_nane" placeholder="Enter type name.">
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
                                                <th>Name</th>
                                               
                                                <th width="60px">Edit</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                            $sql_test_series_package=mysqli_query($con,"select * from test_series_type order by id desc");
                                            while($row=mysqli_fetch_array($sql_test_series_package)){
                                            // $date=date_create($row['c_date']);
                                            // $date=date_format($date,"d-m-Y H:i A");
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                              
                                                <td><a href="test_series_type?edit=<?php echo $row['id']; ?>" onclick="return confirm('Are your sure for edit this type name?')"><button class="btn btn-primary"><i class="fa fa-edit"></i> Edit</button></a></td>
                                                
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