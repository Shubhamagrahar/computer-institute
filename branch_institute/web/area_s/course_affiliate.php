<?php 
include 'session.php';



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Course Affiliate |  <?php echo $brand_name; ?></title>
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
          .drop_course{
    	background: #157daf !important;
    }
    
    .affiliate_course_details{
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
            <h1><?php
            if($login_details['bulk_aff']=="YES"){
                echo "Direct";
            }else{
               echo "Your" ;
            }
            ?> Affiliate</h1>
          </div>
         
      </div><!-- /.container-fluid -->
    </section>
    
    <!--Refer Link section start-->
    <section class="content">
        <div class="row">
          <!-- /.info-box start-->  
          <div class="col-md-4 col-sm-6 col-12" style="padding-top:0px; padding-left:15px; padding-right:15px;">
            
          </div>
          <!-- /.info-box end-->
          <!-- /.info-box start-->
          <div class="col-md-4 col-sm-6 col-12" style="padding-top:0px; padding-left:15px; padding-right:15px;">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa fa-handshake-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Your Affiliate Link</span>
               <span class="info-box-number"><input type="text" id="myInput" readonly value="<?php echo "https://edug.in/registration?ref_data=".$login_details['aff_code']; ?>" class="form-control"></span>
                <span class="info-box-number"><button class="btn btn-success" onclick="myFunction23()">Copy</button></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </div>
          <!-- /.info-box end-->
          <!-- /.info-box start-->
          <div class="col-md-4 col-sm-6 col-12" style="padding-top:0px; padding-left:15px; padding-right:15px;">
            
            
          </div>
           <!-- /.info-box end--> 
        </div>
    </section>
    <!--Refer Link section end-->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?php
            if($login_details['bulk_aff']=="YES"){
                echo "Direct";
            }else{
               echo "Your" ;
            }
            ?> affiliate details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S. No.</th>
                    <th>Name</th>
                    <th>Register Date</th>
                    <th>Runing Course</th>
                    <th>Complete Course</th>
                    <th>Total Course</th>
                    
                    
                    
                  </tr>
                  </thead>
                  <tbody>
                      <?php 
                      $i=0;
                      $sql_aff=mysqli_query($con,"select * from user where aff_by_id='$_SESSION[userid]'");
                      while($row=mysqli_fetch_array($sql_aff)){
                          $aff_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$row[id]'"));
                          $r_date=date_create($aff_details['r_date']);
                          $r_date=date_format($r_date,"d-m-Y");
                          $total_aff_runing=mysqli_num_rows(mysqli_query($con,"select * from course_book where userid='$row[id]' and (status='OPEN' or status='RUN')"));
                          $total_aff_complete=mysqli_num_rows(mysqli_query($con,"select * from course_book where userid='$row[id]' and status='CLOSE'"));
                      ?>
                  <tr>
                    <td><?php echo $i +=1;?></td>
                    <td><?php echo $aff_details['name'] ;?></td>
                    <td><?php echo $r_date ; ?></td>
                    <td><?php echo $total_aff_runing; ?></td>
                    <td><?php echo $total_aff_complete; ?></td>
                    <td><?php echo $total_aff_runing + $total_aff_complete; ?></td>
                    
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
