<?php
include 'session.php';
$t_date=date("Y-m-d");
$dob_date=date("m-d");
unset($_SESSION['cert_edit_refer_url']);


 $mainstafforadmin=0;
 $sql_totalb=mysqli_query($con,"select * from user where (type='1' or type='2')");
 while($row=mysqli_fetch_array($sql_totalb)){
     $wallet=mysqli_fetch_array(mysqli_query($con,"select * from wallet where userid='$row[id]'"));
     $mainstafforadmin +=$wallet['main_b'];
 }

 $walletTotalBalance=mysqli_fetch_array(mysqli_query($con,"select sum(main_b) from wallet "));
 $userTotalWalletBalance=$walletTotalBalance['0'] - $mainstafforadmin ;

$check = mysqli_query($con, "select id from login_session where userid='0'");
if(mysqli_num_rows($check) == 0){
    $session_id = mysqli_fetch_array(mysqli_query($con, "select id from session_details where status='RUN'"))['id'];
    $insert = mysqli_query($con, "insert into login_session (`userid`, `session_id`, `status`, `updated_at`) values('0', '$session_id', '1', NOW())");
}


$c_session = mysqli_fetch_array(mysqli_query($con, "select session_id from login_session where userid='0'"))['session_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard  |  <?php echo $brand_name; ?></title>
    <!-- Favicons -->
  <link href="<?php echo $brand_logo; ?>" rel="icon">
  
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
   <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/theme_style.css">
  <script src="ckeditor/ckeditor.js"></script>
  
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  
  <style type="text/css">
      .drop_a1{
	background: #157daf !important;
}

.select1{
	background: #157daf !important;
}

.bg-purple{
      background-color: #9158dd !important; 
}
  </style>
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader and Navbar -->
  

  <?php include 'top_navbar.php'; ?>
  
  <!-- /.navbar -->
<?php
$wesitedata=file_get_contents("https://sas.edug.in/popup.php");
echo $wesitedata;
?> 
  <!-- Main left Sidebar Container start-->
  
 <?php include 'left_side_navbar.php'; ?>
 
<!-- Main left Sidebar Container end-->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Super Admin Dashboard</h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $login_wallet['main_b']; ?></h3>

                <p>Your Balance</p>
              </div>
              <div class="icon">
                <i class="fa fa-rupee"></i>
              </div>
              <a href="bank_transaction" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
          
          <!--<div class="col-lg-3 col-6">-->
            <!-- small box -->
          <!--  <div class="small-box bg-info">-->
          <!--    <div class="inner">-->
                  
                  
                  
          <!--      <h3><?php echo -$userTotalWalletBalance; ?></h3>-->

          <!--      <p>Total Fee Due</p>-->
          <!--    </div>-->
          <!--    <div class="icon">-->
          <!--      <i class="fa fa-rupee"></i>-->
          <!--    </div>-->
          <!--    <a href="student_due_fee" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>-->
          <!--  </div>-->
          <!--</div>-->
          
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                  
                  <?php
                   $count_franchise=mysqli_num_rows(mysqli_query($con,"select * from user where type=1"));
                  ?>
                  
                <h3><?php echo $count_franchise; ?></h3>

                <p>Total Franchise</p>
              </div>
              <div class="icon">
                <i class="fa fa-home"></i>
              </div>
              <a href="branch_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <!-- ./col -->
          <?php
   
        
        $total_runing_course=mysqli_num_rows(mysqli_query($con,"select * from course_book where status='RUN' and session_id = '$c_session'"));
        ?>
       <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $total_runing_course ;?></h3>

                <p>Total Running Course</p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
              <a href="enroll_runing" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> 
        
        
     
          <!-- ./col -->
         
         <?php
  
        $total_student=mysqli_num_rows(mysqli_query($con,"select * from user where type='3'"));
        ?>
       <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-purple">
              <div class="inner">
                <h3><?php echo $total_student ; ?></h3>

                <p>Total Register Student </p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="student_all_details" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> 
        
         <?php
          $t_date =date("Y-m-d");
          $mothly_amt_deu=0;
         $sql_due_fee_w=mysqli_query($con,"select * from wallet where main_b<0");
         while($row=mysqli_fetch_array($sql_due_fee_w)){
             $sql_user=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$row[userid]'"));
             if($sql_user['next_fee_date']<=$t_date and $sql_user['fee_collect_type']=="YES"){
                $mothly_amt_deu += $sql_user['monthly_fee'];
             }
         }
         ?>
        
     
        </div>
       
      </div><!-- /.container-fluid -->
    </section>
        <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Birthday Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Date of Birth</th>
                                                <th>Age</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                             $sql_user=mysqli_query($con,"select * from user where type='3' and dob LIKE '%$dob_date%' order by id desc");
                                            while($row=mysqli_fetch_array($sql_user)){
                                             $date=date_create($row['dob']);
                                             $date=date_format($date,"d-m-Y");
                                            $date1 = new DateTime($row['dob']);
                                            $date2 = new DateTime($t_date);
                                            $interval = $date1->diff($date2);
                                           
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['mobile']; ?></td>
                                                <td><?php echo $date; ?></td>
                                                <td><?php  echo $interval->y . " years "; //. $interval->m." months, ".$interval->d." days ";  ?></td>
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
<script>
    function myFunction23() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Copied the text: " + copyText.value);
}
</script>
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
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
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
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
