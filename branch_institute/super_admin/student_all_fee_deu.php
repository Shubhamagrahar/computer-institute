<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Due Fee Student Details |
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
    
    .student_all_fee_deu{
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
                            <h1>Own Franchise Student Fee Due</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>


           

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                           <label>Select Franchise</label>
                            <select class="form-control" id="branch_id" name="branch_id" onchange="by_franchise(this.value)">
                                <option value="">Select</option>
                                <?php 
                                $sql_course=mysqli_query($con,"select * from user where type=1 and own_branch='YES'");
                                while($row=mysqli_fetch_array($sql_course)){
                                    ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php 
                                }
                                ?>
                            </select>
                        </div>
                        <div align="left" id="total_due_fee_div" class="col-md-6" style="margin-top: 35px;font-size: 20px;color: #914a07;">
                            
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
                                var url="student_all_fee_deu?branch_id="+val;
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
                                                
                                                <th>Name</th>
                                                <th>Mobile</th>
                                               
                                                <th>Fee Type</th>
                                                <th>Fee Due</th>
                                                <th>Details</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total_deu_fee=0;
                                            $i=0;
                                            $sql_d=mysqli_query($con,"select * from user where branch_id='$_GET[branch_id]' and type='3' order by id desc");
                                            while($row=mysqli_fetch_array($sql_d)){
                                            $date=date_create($row['r_date']);
                                            $date=date_format($date,"d-m-Y");
                                            $total_course=mysqli_num_rows(mysqli_query($con,"select * from course_book where userid='$row[id]'"));
                                            $user_wallet=mysqli_fetch_array(mysqli_query($con,"select * from wallet where userid='$row[id]'"));
                                            if($user_wallet['main_b']<0){
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                        
                                                <td><?php echo $row['name'] ;?></td>
                                                <td><?php echo $row['mobile'] ;?></td>
                                                
                                                <td><?php 
                                                
                                                if($row['fee_collect_type']=="NO"){
                                                    echo "Part Payment";
                                                }
                                                if($row['fee_collect_type']=="YES"){
                                                    echo "Monthly Payment";
                                                }
                                                if($row['fee_collect_type']=="OTP"){
                                                    echo "One Time Paymentt";
                                                }
                                                
                                                ?></td>
                                                <td><?php
                                                if( $row['fee_collect_type']=="YES"){
                                                if($row['next_fee_date']<=$t_date){
                                                    $total_deu_fee +=$row['monthly_fee'];
                                                   echo -$row['monthly_fee'];
                                                 }else{
                                                     echo "Next Date : ".date_format(date_create($row['next_fee_date']),"d-m-Y");
                                                 }
                                                 
                                                 }else{
                                                     $total_deu_fee +=$user_wallet['main_b'];
                                                   echo -$user_wallet['main_b'] ; 
                                                 }
                                                ?></td>
                                               
                                                <td><a style="color:blue;" target="_blank" href="student_search?reg_no=<?php echo $row['reg_no'] ;?>&search=Search"><i class="fa fa-eye"></i>Details</a></td>
                                            </tr>
                                            
                                            <?php } }  ?>
                                        </tbody>

                                    </table>
                                </div>
                                
                                <script>
                                   var fee_deu_all="Total Due Fee : Rs.<?php echo -$total_deu_fee ?>"
                                    $("#total_due_fee_div").html(fee_deu_all);
                                </script>
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