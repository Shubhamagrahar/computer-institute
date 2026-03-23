<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");


$c_session = mysqli_fetch_array(mysqli_query($con, "select session_id from login_session where userid='0'"))['session_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Student Details |
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
          .drop_student{
    	background: #157daf !important;
    }
    
    .student_all_details{
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
                            <h1>All Student Details</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>


           

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                           <label>Search By Franchise</label>
                            <select class="form-control" id="branch_id" name="branch_id" onchange="by_franchise(this.value)">
                                <option value="">Select</option>
                                <?php 
                                $sql_course=mysqli_query($con,"select * from user where type=1");
                                while($row=mysqli_fetch_array($sql_course)){
                                    ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php 
                                }
                                ?>
                            </select>
                        </div>
                       
                        <script>
                            <?php 
                            if(isset($_GET['branch_id'])){
                            if($_GET['branch_id']>0){
                                ?>
                               
                                $("#branch_id").val('<?php echo $_GET['branch_id'] ; ?>');
                                <?php
                            } }
                            ?>
                            
                            
                            function by_franchise(val){
                                var url="student_all_details?branch_id="+val;
                                window.location.assign(url);
                            }
                            
                           
                         
                        </script>
                         <?php 
                         if(isset($_GET['branch_id'])){
                         if(!$_GET['branch_id']==""){
                        ?>
                        
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
                                                <th>Register Date</th>
                                                <th>Reg No.</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Total Course</th>
                                                <!--<th>ID Card</th>-->
                                                <!--<th>Fee Due</th>-->
                                                <th>Details</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                            $sql_d=mysqli_query($con,"select * from user where branch_id='$_GET[branch_id]' and type='3' order by id desc");
                                            while($row=mysqli_fetch_array($sql_d)){
                                            $date=date_create($row['r_date']);
                                            $date=date_format($date,"d-m-Y");
                                            $branch_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$row[branch_id]'"));
                                            $total_course=mysqli_num_rows(mysqli_query($con,"select * from course_book where userid='$row[id]'"));
                                            $user_wallet=mysqli_fetch_array(mysqli_query($con,"select * from wallet where userid='$row[id]'"));
                                          
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $date ; ?></td>
                                                <td><?php echo $row['reg_no'] ;?></td>
                                                <td><?php echo $row['name'] ;?></td>
                                                <td><?php echo $row['mobile'] ;?></td>
                                                <td><?php echo $total_course; ?></td>
                                                <?php
                                              $check_course_status=mysqli_num_rows(mysqli_query($con,"select * from course_book where userid='$row[id]' and status='RUN'"));
                                              if($check_course_status>0){
                                              ?>
                                              <?php 
                                              if($branch_details['own_branch']=="YES"){ ?>
                                               <!--<td><a title="Print Id Card" target="_blank" style="color:blue;" href="student_id_card?data_id=<?php echo $row['id'] ;?>"> <button class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Print</button></a></td>   -->
                                            <?php  }else{ ?>
                                               <!--<td><a title="Print Id Card" target="_blank" style="color:blue;" href="student_id_card_2?data_id=<?php echo $row['id'] ;?>"> <button class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Print</button></a></td>      -->
                                           <?php   }
                                              
                                              ?>
                                               
                                             
                                              <?php 
                                              }else{
                                                  ?>
                                                  <!--<td>Course Not Running</td>-->
                                                  <?php }  ?>
                                                <!--<td><?php  echo $user_wallet['main_b'] ; ?></td>-->
                                               
                                                <td><a target="_blank" href="student_search?reg_no=<?php echo $row['reg_no'] ;?>&search=Search"><span class="btn btn-primary">Details</span></a></td>
                                            </tr>
                                            
                                            <?php }  ?>
                                        </tbody>

                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        
                        <?php } } ?>
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