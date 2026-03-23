<?php
include 'session.php';

$t_date=date("Y-m-d");
$dob_date=date("m-d");


//branch_id update in nook_course start 
 
 $count_data_book_course=mysqli_num_rows(mysqli_query($con,"select * from course_book where branch_id<1"));
 if($count_data_book_course>0){
     $sql_bcd_cd=mysqli_query($con,"select * from course_book where branch_id<1");
     while($row=mysqli_fetch_array($sql_bcd_cd)){
         $sql_ucid=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$row[userid]'"));
         if($sql_ucid['branch_id']==$current_branch_id){
             $update_ucid_id=mysqli_query($con,"update course_book set branch_id='$sql_ucid[branch_id]' where id='$row[id]'");
         }
     }
 }

//branch_id update in nook_course end

 $mainstafforadmin=0;
 $sql_totalb=mysqli_query($con,"select * from user where branch_id='$_SESSION[userid]' and type='3'");
 while($row=mysqli_fetch_array($sql_totalb)){
     $wallet=mysqli_fetch_array(mysqli_query($con,"select * from wallet where userid='$row[id]'"));
     $mainstafforadmin +=$wallet['main_b'];
 }

//  $walletTotalBalance=mysqli_fetch_array(mysqli_query($con,"select sum(main_b) from wallet "));
//  $userTotalWalletBalance=$walletTotalBalance['0'] - $mainstafforadmin ;


$_SESSION['search_date']="";
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
            <h1 class="m-0">Dashboard</h1>
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
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                  
                  
                  
                <h3><?php 
                if($mainstafforadmin<0){
                echo -($mainstafforadmin); 
                }else{
                   echo $mainstafforadmin; 
                }
                ?></h3>

                <p>Total Fee Due</p>
              </div>
              <div class="icon">
                <i class="fa fa-rupee"></i>
              </div>
              <a href="student_due_fee" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <?php
   
        $total_runing_course=0;
        $sql_book_course=mysqli_query($con,"select * from course_book where status='RUN'");
        while($row=mysqli_fetch_array($sql_book_course)){
            $total_runing_course +=mysqli_num_rows(mysqli_query($con,"select * from user where id='$row[userid]' and branch_id='$_SESSION[userid]'"));
        }
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
  
        $total_student=mysqli_num_rows(mysqli_query($con,"select * from user where branch_id='$_SESSION[userid]' and type='3'"));
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
             $sql_user=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$row[userid]' and branch_id='$_SESSION[userid]'"));
             if($sql_user){
             if($sql_user['next_fee_date']<=$t_date and $sql_user['fee_collect_type']=="YES"){
                $mothly_amt_deu +=$sql_user['monthly_fee'];
             }
             } 
         }
         ?>
        
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                  
                  
                  
                <h3><?php echo $mothly_amt_deu; ?></h3>

                <p>Monthly Fee Due</p>
              </div>
              <div class="icon">
                <i class="fa fa-rupee"></i>
              </div>
              <a href="student_due_fee_monthly" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                  
                  <?php 
                   $sql_due_fr=mysqli_fetch_array(mysqli_query($con,"select * from branch_details where userid='$_SESSION[userid]'"));
                  ?>
                  
                <h3><?php echo $sql_due_fr['wallet']; ?></h3>

                <p>Franchise Due</p>
              </div>
              <div class="icon">
                <i class="fa fa-rupee"></i>
              </div>
              <a href="branch_transaction" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
       <?php 
       
       if($branch_access_details['enquiry_system']=="YES"){
         if($_SESSION['userid']==1){
             $total_enquery=mysqli_num_rows(mysqli_query($con,"select * from enquiry_details "));
             $total_enquery_run=mysqli_num_rows(mysqli_query($con,"select * from enquiry_details where status='RUN'"));
            $total_enquery_convert=mysqli_num_rows(mysqli_query($con,"select * from enquiry_details where status='CLOSE'"));
            $total_enquery_cancel=mysqli_num_rows(mysqli_query($con,"select * from enquiry_details where status='CANCEL'"));
             ?>
             <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                  
                  
                  
                <h3><?php echo $total_enquery; ?></h3>

                <p>Total Enquiry</p>
              </div>
              <div class="icon">
                <i class="fa fa-list"></i>
              </div>
              <a href="enquiry_report" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                  
                  
                  
                <h3><?php echo $total_enquery_run; ?></h3>

                <p>Total Running Enquiry</p>
              </div>
              <div class="icon">
                <i class="fas fa-running"></i>
              </div>
              <a href="enquiry_report" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                  
                  
                  
                <h3><?php echo $total_enquery_convert; ?></h3>

                <p>Total Complete Enquiry</p>
              </div>
              <div class="icon">
                <i class="fa fa-check"></i>
              </div>
              <a href="enquiry_report" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
             
             <?php
         }
       }
         ?>
        
          <!-- ./col -->
        </div>
       
      </div><!-- /.container-fluid -->
    </section>
    
    
    <?php 
    
    $t_date=date("Y-m-d");
    if($branch_access_details['enquiry_system']=="YES"){
      ?>
      <section class="content">
                <div class="container-fluid">
                    
                    <div class="row">
                        <br>
                      
             <div class="col-12">
                 <h3>Today Follow-up Enquiry Details</h3>
             </div>
             <?php
             $total_enquery=mysqli_num_rows(mysqli_query($con,"select * from enquiry_details where enquiry_date='$t_date'"));
             $total_enquery_run=mysqli_num_rows(mysqli_query($con,"select * from enquiry_details where next_date='$t_date' and status='RUN'"));
            $total_enquery_convert=mysqli_num_rows(mysqli_query($con,"select * from enquiry_details where convert_date='$t_date' and status='CLOSE'"));
            $total_enquery_cancel=mysqli_num_rows(mysqli_query($con,"select * from enquiry_details where cancel_date='$t_date' and status='CANCEL'"));
             ?>
             <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                  
                  
                  
                <h3><?php echo $total_enquery; ?></h3>

                <p>Today Total Create Enquiry</p>
              </div>
              <div class="icon">
                <i class="fa fa-list"></i>
              </div>
             
            </div>
          </div>
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                  
                  
                  
                <h3><?php echo $total_enquery_run; ?></h3>

                <p>Today Total Follow-up Enquiry</p>
              </div>
              <div class="icon">
                <i class="fas fa-running"></i>
              </div>
              <!--<a href="enquiry_report" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>-->
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                  
                  
                  
                <h3><?php echo $total_enquery_convert; ?></h3>

                <p>Today Total Complete Enquiry</p>
              </div>
              <div class="icon">
                <i class="fa fa-check"></i>
              </div>
              <!--<a href="enquiry_report" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>-->
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                  
                  
                  
                <h3><?php echo $total_enquery_cancel; ?></h3>

                <p>Today Total Cancel Enquiry</p>
              </div>
              <div class="icon">
                <i class="fa fa-close"></i>
              </div>
              <!--<a href="enquiry_report" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>-->
            </div>
          </div>
        
        
          <!-- ./col -->
        </div>
  <div class="row">
                     
                        <div class="col-12">
                            <br>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Today Follow-up Enquiry Details</h3>
                                </div>
                                <!-- /.card-header -->
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
                                                
                                                
                                               
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                           
                                           
                                           
                                              $sql_d=mysqli_query($con,"select * from enquiry_details where next_date='$t_date' and status='RUN' order by next_date desc");   
                                        
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
                                             $sql_user=mysqli_query($con,"select * from user where branch_id='$_SESSION[userid]' and type='3' and dob LIKE '%$dob_date%' order by id desc");
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
