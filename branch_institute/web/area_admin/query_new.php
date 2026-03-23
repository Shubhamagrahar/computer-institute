<?php
include 'session.php'; 
echo '<script>window.location.assign("index");</script>';
exit();
$c_date=date("Y-m-d H:i:s");
if(isset($_GET['done'])){
    $done=VerifyData($_GET['done']);
    $id=VerifyData($_GET['id']);
    $note=VerifyData($_GET['note']);
    
    if(!$done=="" && $done=="YES" && !$id==""){
      $row=mysqli_num_rows(mysqli_query($con,"select * from query_data where id='$id'"))  ;
      if($row==1){
          $update=mysqli_query($con,"update query_data set note='$note', solve_date='$c_date', status='COMPLETE', solve_by='$_SESSION[userid]' where id='$id'");
          if($update){
              echo'<script> alert("Query Close Successfully Done.");windows.location.assign("query_new")</script>';
          }else{
            echo'<script> alert("Server Error 103");windows.location.assign("query_new")</script>';  
          }
      }else{
       echo'<script> alert("Server Error 102");windows.location.assign("query_new")</script>';   
      }
    }else{
        echo'<script> alert("Server Error 101");windows.location.assign("query_new")</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>New Query |  <?php echo $brand_name; ?></title>
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
    <script src="ckeditor/ckeditor.js"></script>
    
  <style type="text/css">
      .website_drop{
	background: #157daf !important;
}

.query_new1{
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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

  
     <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">All New Query</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                               <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Query</th>
                                                <th>Query Date</th>
                                                <th>Note</th>
                                                <th>Close</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                             $sql_query=mysqli_query($con,"select * from query_data where status='OPEN' order by id desc");
                                            while($row=mysqli_fetch_array($sql_query)){
                                            $date_submit=date_create($row['query_date']);
                                             $date_submit=date_format($date_submit,"d-m-Y h:i A");
                                            ?>
                                            <tr>
                                        <td><?php echo $i +=1; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['mobile']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['query']; ?></td>
                                        <td><?php echo $date_submit; ?></td>
                                        
                                        <td><textarea class="form-control" name="note" id="note<?php echo $row['id'] ?>" placeholder="write your note"></textarea></td>
                                       <td> <!--<a href="query_new?dones=YES&id=<?php echo $row['id']; ?>" >-->
                                            <button class="btn btn-primary" onclick="redirect_href(<?php echo $row['id'] ?>,note<?php echo $row['id'] ?>.value)"> Close</button></td>
                                            
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
    
       <script>
           function redirect_href(val,val2){
             var link="query_new?done=YES&id="+val+"&note="+val2;
               if(confirm('Are youe sure for close this query?')){
               window.location.assign(link);
               }
           }
       </script>
    
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
        function getImagePreview(event) {
            var image = URL.createObjectURL(event.target.files[0]);
            var imagediv = document.getElementById('preview');
            var newimg = document.createElement('img');
            imagediv.innerHTML = '';
            newimg.src = image;
            newimg.width = "300";
            imagediv.appendChild(newimg);
        }
       
    </script>
    
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
