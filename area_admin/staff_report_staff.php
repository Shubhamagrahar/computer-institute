<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if($branch_access_details['staff_system']=="YES"){
        $type = mysqli_fetch_array(mysqli_query($con, "select type from user where id='$_SESSION[userid]'"))['type'];
if(sub_menu_check("E","F",$_SESSION['userid'], $type)==1){
    
}else{
    echo '<script>alert("You are not permitted to access this option.");window.location.assign("index");</script>'; 
}
}else{
    mysqli_close($con);
    echo '<script>window.location.assign("index");</script>';
}
if(add_on_check("Staff Management System") == 1){
    
}else{
    echo '<script>alert("This is an add-on service. Please contact the administrator to activate or purchase access."); window.location.assign("./");</script>';

} 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student wise Student Attendance  |
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
          .staff_drop{
    	background: #157daf !important;
    }
    
    .staff_report_staff{
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
            
            <section class="content" id="fee_collection">
       
     </section>
            
            
            
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Staff Wise Student Attendance</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>

              

            <!-- Main content -->
            
            
            <?php 
            
            
            
            
            ?>
            
            
    
            
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <form method="post">
                        <div class="row">
                        <div class="col-4">
                            <label>Enter Staff Registered Mobile Number:</label>
                             <input type="number" value="" required name="search_mobile" class="form-control" placeholder="Please enter registered mobile number.">
                        </div>
                        <div class="col-6" style="margin-top: 30px;">
                            
                           
                             <input type="submit"  name="search"  Value="Search" class="btn btn-success">
                        </div>
                        
                        </div>
                        </form>
                        </div>
                        
                        
                        
                        <?php 
                        $filter=1;
                        if($filter==2){
                        ?>
                        
                        <div class="col-md-6">
                            <label bgcolor>Search By course:</label>
                            <select class="form-control" id="course_search" name="course_search" onchange="by_course(this.value)">
                                <option value="">Select</option>
                                <?php 
                                $sql_course=mysqli_query($con,"select * from course_details");
                                while($row=mysqli_fetch_array($sql_course)){
                                    ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php 
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Search By Batch:</label>
                            <select class="form-control" id="batch_search" name="batch_search" onchange="by_batch(this.value)">
                                <option value="">Select</option>
                                <?php 
                                $sql_course=mysqli_query($con,"select * from batch_details");
                                while($row=mysqli_fetch_array($sql_course)){
                                    ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['batch_name']; ?></option>
                                    <?php 
                                }
                                ?>
                            </select>
                        </div>
                        <script>
                            <?php 
                            if($_GET['batch_id']>0){
                                ?>
                                $("#course_search").val("");
                                $("#batch_search").val('<?php echo $_GET['batch_id'] ; ?>');
                                <?php
                            }
                            ?>
                            <?php 
                            if($_GET['course_id']>0){
                                
                                ?>
                                
                                $("#course_search").val(<?php echo $_GET['course_id'] ; ?>);
                                $("#batch_search").val("");
                                
                                <?php
                            }
                            ?>
                            
                            function by_course(val){
                                var url="student_daily_attendance?course_id="+val;
                                window.location.assign(url);
                            }
                            
                            function by_batch(val){
                                var url="student_daily_attendance?batch_id="+val;
                                window.location.assign(url);
                            }
                         
                        </script>
                        
                        <?php } ?>
                        
                        <?php 
                        if(isset($_POST['search'])){
                            $mob=VerifyData($_POST['search_mobile']);
                            if(!$mob==""){
                            $sql=mysqli_query($con,"select * from user where mobile='$mob'");
                            if(mysqli_num_rows($sql)==1){
                                $result=mysqli_fetch_array($sql);
                        ?>
                        <div class="col-12">
                        <br>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Staff Attendance for : <strong style="color:green;"><?php echo $result['name']." (".$result['mobile'].")" ; ?></strong> </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Date</th>
                                                
                                                <th>In Time</th>
                                                <th>Out Time</th>
                                                <th>Status</th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                             if($login_details['type']==1){
                                                $branch_id=$_SESSION['userid'];
                                            }else{
                                                $branch_id=$login_details['branch_id'];
                                            }
                                            $i=0;
                                            $sql_d=mysqli_query($con,"select * from attendance_staff where branch_id='$branch_id' and userid='$result[id]' order by id desc");
                                            while($row=mysqli_fetch_array($sql_d)){
                                           
                                            $user_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$row[userid]'"));
                                            
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                               
                                                <td><?php echo date_format(date_create($row['date']),"d-m-Y");?></td>
                                               
                                                
                                                <?php 
                                                if($row['status']=="P"){
                                                    $status="Present";
                                                    
                                                }else{
                                                   $status="Absent";
                                                }   
                                                  ?>
                                                   <td>
                                                     <div id="div_in_p<?php echo $row['id'] ; ?>">
                                                         <input type="time" readonly  value="<?php echo $row['in_time']; ?>" class="form-control">
                                                     </div>
                                                       
                                                   </td>
                                                    
                                                   <td>
                                                    <div id="div_out_p<?php echo $row['id'] ; ?>">
                                                     <input type="time" readonly  value="<?php echo $row['out_time']; ?>" class="form-control">    
                                                     </div>
                                                   </td>
                                                   
                                                   <td>
                                                     <?php 
                                                      echo $status ;
                                                     ?>
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
                        
                        <?php
                            }else{
                              echo '<script>alert("Student mobile number not registered.");</script>';  
                            }
                        }else{
                            echo '<script>alert("Please enter student registered mobile number.");</script>';
                        } 
                        }
                        ?>
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