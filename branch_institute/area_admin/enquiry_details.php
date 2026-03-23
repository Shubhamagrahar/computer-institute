<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if($branch_access_details['enquiry_system']=="YES"){
    
}else{
    mysqli_close($con);
    echo '<script>window.location.assign("index");</script>';
}


if(isset($_GET['ids'])){
    $id=VerifyData($_GET['ids']);
    if(!$id==""){
        $check=mysqli_query($con,"select * from enquiry_details where id='$id'");
        if(mysqli_num_rows($check)){
          $enquiry_details=mysqli_fetch_array($check);
           $staff_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$enquiry_details[create_by]'"));
           $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$enquiry_details[course_id]'"));
           $batch_details=mysqli_fetch_array(mysqli_query($con,"select * from batch_details where id='$enquiry_details[batch_id]'"));
        }else{
            echo '<script>alert("Server error 101.");window.location.assign("enquiry_running");</script>';
        }
        
    }else{
        echo '<script>alert("Not allowed.");window.location.assign("enquiry_running");</script>';
    }
}else{
        echo '<script>alert("Bad URL.");window.location.assign("enquiry_running");</script>';
    }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Running Enquiry|
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
          .drop_enquiry{
    	background: #157daf !important;
    }
    
    .enquiry_running{
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
                            <h1>Follow-up Enquiry Details</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>


           

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                      <?php 
                       if(isset($_POST['create_note'])){
                           $enquiry_note=VerifyData($_POST['enquiry_note']);
                           $next_date=VerifyData($_POST['next_date']);
                           if(!$enquiry_note=="" and !$next_date==""){
                          $insert_history=mysqli_query($con,"insert into `enquiry_follow_history`(`enquiry_id`, `follow_by`, `des`, `next_date`, `date`) values('$id', '$_SESSION[userid]', '$enquiry_note', '$next_date', '$c_date')"); 
                           if($insert_history){
                               $update = mysqli_query($con,"update enquiry_details set next_date='$next_date', enquiry_note='$enquiry_note' where id='$id'");
                             if($update){
                                 echo '<script>alert("Enquiry Note Created Success.");</script>';   
                             }else{
                                 echo '<script>alert("Server Error 102.");</script>';   
                             }
                               
                           }else{
                            echo '<script>alert("Server Error 101.");</script>';   
                           }    
                           }else{
                            echo '<script>alert("Please fill all field.");</script>';   
                           }
                       }
                      ?>
                      
                      
                        <div class="col-12">
                            <br>
                            <div class="card">
                                <div class="card-header">
                                
                                   <div class="row">
    <div class="col-md-3 mb-3">
        <label><strong>Enquiry Created By:</strong></label>
        <input type="text" class="form-control" value="<?php echo $staff_details['name']; ?>" readonly>
    </div>

    <div class="col-md-3 mb-3">
        <label><strong>Name:</strong></label>
        <input type="text" class="form-control" value="<?php echo $enquiry_details['name']; ?>" readonly>
    </div>

    <div class="col-md-3 mb-3">
        <label><strong>Mobile 1:</strong></label>
        <input type="text" class="form-control" value="<?php echo $enquiry_details['mobile1']; ?>" readonly>
    </div>

    <div class="col-md-3 mb-3">
        <label><strong>Mobile 2:</strong></label>
        <input type="text" class="form-control" value="<?php echo $enquiry_details['mobile2']; ?>" readonly>
    </div>

    <div class="col-12"><hr></div>

    <div class="col-md-4 mb-3">
        <label><strong>Course Name:</strong></label>
        <input type="text" class="form-control" value="<?php echo $course_details['name']; ?>" readonly>
    </div>

    <div class="col-md-4 mb-3">
        <label><strong>Batch Name:</strong></label>
        <input type="text" class="form-control" value="<?php echo $batch_details['batch_name']; ?>" readonly>
    </div>

    <div class="col-md-4 mb-3">
        <label><strong>Next Date:</strong></label>
        <input type="text" class="form-control" value="<?php 
            $date_next = date_create($enquiry_details['next_date']);
            echo date_format($date_next, "d-m-Y"); 
        ?>" readonly>
    </div>
</div>

                                     <hr>
                                     <form method="post">
                                    <div class="row">
                                        
                                        <div class="col-md-6 form-group">
                                            <label>Enquiry Note</label>
                                           <textarea required name="enquiry_note" value="" class="form-control"></textarea>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Next Follow-up Date</label>
                                           <input type="date" required name="next_date" value="" class="form-control">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <br>
                                           <input style="margin-top: 7px;" type="submit" name="create_note" value="Create" class="btn btn-success">
                                        </div>
                                      
                                    </div>
                                     </form> 
                                    
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Date</th>
                                                <th>Note Create By</th>
                                                <th>Note</th>
                                                <th>Next follow-up date</th>
                                                
                                               
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                           
                                           
                                           
                                              $sql_d=mysqli_query($con,"select * from enquiry_follow_history where enquiry_id='$enquiry_details[id]' order by id desc");   
                                        
                                            while($row=mysqli_fetch_array($sql_d)){
                                            $date=date_create($row['date']);
                                            $date=date_format($date,"d-m-Y h:i:A");
                                            $date_next=date_create($row['next_date']);
                                            $date_next=date_format($date_next,"d-m-Y");
                                           
                                            $staff_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$row[follow_by]'"));
                                            
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $date ;?></td>
                                                <td><?php echo $staff_details['name'];?></td>
                                                <td><?php echo $row['des'];?></td>
                                                <td><?php echo $date_next ;?></td>
                                               
                                              
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