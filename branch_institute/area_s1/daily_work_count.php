<?php
include 'session.php';

$t_date=date("Y-m-d");

$c_date=date("Y-m-d H:i:s");


if($login_details['task_pr']=="YES"){
  
}else{
  echo '<script>window.location.assign("index");</script>';
  exit();
}


if(isset($_GET['collect'])){
    $id=VerifyData($_GET['collect']);
    if(!$id==""){
        $sql=mysqli_query($con,"select * from daily_task_count where id='$id' and userid='$_SESSION[userid]'");
        if(mysqli_num_rows($sql)==1){
            $result=mysqli_fetch_array($sql);
            if($result['status']=="OPEN"){
                $amt=($result['b_data'] + $result['r_data']) * 0.10;
               $main_b= $login_wallet['main_b'] + $amt ;
                $update_wallet=mysqli_query($con,"update wallet set main_b='$main_b' where userid='$_SESSION[userid]'");
                if($update_wallet){
                    $des="Task income credit for date :".$result['date'];
                    $insert_transaction=mysqli_query($con,"insert into `transaction_main`(`userid`, `des`, `credit`, `date`, `c_date`) values('$_SESSION[userid]', '$des', '$amt', '$t_date', '$c_date')");
                    if($insert_transaction){
                       $update=mysqli_query($con,"update daily_task_count set total_amt='$amt', status='CLOSE' where id='$id' and userid='$_SESSION[userid]'") ;
                       if($update){
                         echo '<script>alert("Selected task income collected done and work close.");window.location.assign("daily_work_count");</script>';  
                       }else{
                         echo '<script>alert("Server error 105");window.location.assign("daily_work_count");</script>';  
                       }
                    }else{
                       echo '<script>alert("Server error 104");window.location.assign("daily_work_count");</script>'; 
                    }
                }else{
                   echo '<script>alert("Server error 103");window.location.assign("daily_work_count");</script>';  
                }
                
            }else{
              echo '<script>alert("Server error 102");window.location.assign("daily_work_count");</script>';    
            }
        }else{
          echo '<script>alert("Server error 101");window.location.assign("daily_work_count");</script>';  
        }
    }else{
       echo '<script>alert("Somthing went wrong");window.location.assign("daily_work_count");</script>'; 
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Daily Task Count |  <?php echo $brand_name; ?></title>
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

.task_count_daily{
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
            <h1>Task Count Details </h1>
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
                <!--<h3 class="card-title">DataTable with default features</h3>-->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr.No.</th>
                    <th>Date</th>
                    <th>Business Data</th>
                    <th>Promotional Data</th>
                   <th>Amount</th>
                   <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                      <?php 
                      $i=0;
                      $sql2=mysqli_query($con,"select * from daily_task_count where userid='$_SESSION[userid]' order by id desc");
                      while($row=mysqli_fetch_array($sql2)){
                         $date=date_create($row['date']);
                         $date=date_format($date,"d-m-Y");
                      ?>
                  <tr>
                     <td><?php echo $i +=1; ?></td>
                     <td><?php echo $date; ?></td>
                     <td><?php echo $row['b_data']; ?></td>
                     <td><?php echo $row['r_data']; ?></td>
                     <td>Rs.
                         <?php 
                         if($row['status']=="OPEN"){
                             echo ($row['b_data'] + $row['r_data']) *0.10;
                         }else{
                             echo $row['total_amt'];
                         }
                         ?>
                         
                     </td>
                     <td>
                         <?php 
                         if($row['status']=="OPEN"){
                            ?>
                            <a onclick="return confirm('Are you sure for collect amount and today work close?')" href="daily_work_count?collect=<?php echo $row['id']; ?>"><button class="btn btn-success">Collect</button></a>
                            <?php
                         }else{
                             echo "Collected and Work Close.";
                         }
                         ?>
                         
                         
                         </td>
                  </tr>
                  <?php } ?>
                 
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
