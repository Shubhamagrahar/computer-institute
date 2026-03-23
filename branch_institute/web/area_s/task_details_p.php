<?php
include 'session.php';

$t_date=date("Y-m-d");

$c_date=date("Y-m-d H:i:s");


if($login_details['task_pr']=="YES"){
  
}else{
  echo '<script>window.location.assign("index");</script>';
  exit();
}


$sql=mysqli_query($con,"select * from r_data where userid='$_SESSION[userid]' and date=''");
while($row=mysqli_fetch_array($sql)){
    $date=date_create($row['m_date']);
    $date=date_format($date,"Y-m-d");
    $update=mysqli_query($con,"update r_data set date='$date' where id='$row[id]'");
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Promotional Task Details |  <?php echo $brand_name; ?></title>
    <!-- Favicons -->
  <link href="<?php echo $brand_logo; ?>" rel="icon">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  
  <style type="text/css">
      .drop_p_work{
	background: #157daf !important;
}

.promotion_task_details{
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
            <h1>Promotional Task Details </h1>
          </div>
         
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <div class="card">
              <div class="card-header">
                  <div class="col-md-3">
                      <label>Select Date</label>
                <input type="date" name="search_date" onchange="window.location.assign('task_details_p?search_date='+this.value)" class="form-control">
                </div>
              </div>
              
              <?php 
              if(isset($_GET['search_date'])){
              ?>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr.No.</th>
                    <th>Date</th>
                    <th>Mobile Number</th>
                    <th>Status</th>
                   
                  </tr>
                  </thead>
                  <tbody>
                      <?php 
                      $i=0;
                      $sql2=mysqli_query($con,"select * from r_data where userid='$_SESSION[userid]' and date='$_GET[search_date]' order by id desc");
                      while($row=mysqli_fetch_array($sql2)){
                         $date=date_create($row['m_date']);
                         $date=date_format($date,"d-m-Y H:i A");
                      ?>
                  <tr>
                     <td><?php echo $i +=1; ?></td>
                     <td><?php echo $date; ?></td>
                     <td><?php echo $row['mobile']; ?></td>
                     <td><?php 
                     if($row['status']=="OPEN"){
                         echo "Message sent";
                     }
                     if($row['status']=="RESP"){
                         echo "Message Response";
                     }
                     
                     if($row['status']=="PAID"){
                         echo "PAID.";
                     }
                     if($row['status']=="CLOSE"){
                         echo "Cancel.";
                     }
                     
                     ?></td>
                     
                     
                  </tr>
                  <?php } ?>
                 
                  </tbody>
                
                </table>
              </div>
              <!-- /.card-body -->
              <?php } ?>
              
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
