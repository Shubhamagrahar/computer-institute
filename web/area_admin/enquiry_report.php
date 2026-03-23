<?php 
include 'session.php'; 



$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if($branch_access_details['enquiry_system']=="YES"){
    
}else{
    mysqli_close($con);
    echo '<script>window.location.assign("index");</script>';
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Report Enquiry|
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
    
    .enquiry_report{
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
                            <h1>Report Follow-up Enquiry Details</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>


           

            <!-- Main content -->
            
             <section class="content">
                 <div class="container-fluid">
                     <div class="row">
                         <div class="col-md-3" >
                            <label>Select Report Type</label>
                            <select name="" class="form-control" onchange=data_redirect(this.value)>
                            <option value="">Select</option>
                            <option value="enquiry_date_wise">Date Wise Report</option>
                            <option value="enquiry_two_date_wise">Between two Date Wise Report</option>
                            <option value="enquiry_staff_date_wise">Staff With Two Date Wise Report</option>
                            <option value="enquiry_staff_wise">Staff Wise All Report</option>
                            <option value="enquiry_course_wise">Course wise Report</option>
                            <option value="enquiry_follow_up_date_wise">Follow-up date wise Report</option>
                            </select>
                         </div>
                         
                         
                     </div>
                     
                 </div>
                 
             </section>
            
            
            
            <?php 
            $show=2;
            
            if($show==1){
            ?>
            
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                      
                        <div class="col-12">
                            <br>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Follow-up Enquiry Details</h3>
                                </div>
                                 /.card-header 
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Enquiry Date</th>
                                                <th>Enquiry Create By</th>
                                                <th>Name</th>
                                                <th>Mobile1</th>
                                                <th>Mobile2</th>
                                                <th>Course Name</th>
                                                <th>Batch</th>
                                                <th>Last Discussion</th>
                                                <th>Next Follow-Up Date</th>
                                                <th>Details</th>
                                                <th width="80px">Action</th>
                                               
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                           
                                           
                                           
                                              $sql_d=mysqli_query($con,"select * from enquiry_details where status='RUN' order by next_date desc");   
                                        
                                            while($row=mysqli_fetch_array($sql_d)){
                                            $date=date_create($row['enquiry_date']);
                                            $date=date_format($date,"d-m-Y");
                                            $date_next=date_create($row['next_date']);
                                            $date_next=date_format($date_next,"d-m-Y");
                                           
                                            $staff_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$row[create_by]'"));
                                            $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$row[course_id]'"));
                                            $batch_details=mysqli_fetch_array(mysqli_query($con,"select * from batch_details where id='$row[batch_id]'"));
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $date ;?></td>
                                                <td><?php echo $staff_details['name'];?></td>
                                                <td><?php echo $row['name'];?></td>
                                                <td><?php echo $row['mobile1'];?></td>
                                                <td><?php echo $row['mobile2'];?></td>
                                                <td><?php echo $course_details['name'];?></td>
                                                <td><?php echo $batch_details['batch_name'];?></td>
                                                <td><?php echo $row['enquiry_note'];?></td>
                                                <td><?php echo $date_next ;?></td>
                                                <td><span style="cursor:pointer;color:blue;"><i class="fa fa-eye"></i> Details</span></td>
                                                <td>
                                                  
                                                  <a target="_blank" title="Add follow-up details" href="enquiry_details?ids=<?php echo $row['id'] ; ?>" style="cursor:pointer;color:blue;"><i class="fa fa-plus"></i> Add</a>&nbsp;&nbsp;&nbsp;<br>
                                                  
                                                </td>
                                              
                                              
                                              
                                            </tr>
                                            
                                            <?php }  ?>
                                        </tbody>

                                    </table>
                                </div>
                                 <!--/.card-body -->
                            </div>
                             <!--/.card -->
                        </div>
                         <!--/.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            
            <?php } ?>
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
    
    function data_redirect(val){
     
        if(!val==""){
        window.location.assign(val);
            
        }
    }
    
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