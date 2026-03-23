<?php
include 'session.php';

$t_date=date("Y-m-d");

$c_date=date("Y-m-d H:i:s");


          
$current_time=date("H:i");
if($_SESSION['userid']==3){
    $start_time="07:30";
}else{
  $start_time="10:00";  
}

if($current_time>$start_time and $current_time<"20:00"){
  
}else{
  echo '<script>alert("Your daily working time is 10:00 am to 08:00 pm. Please complete your work at this time only.");window.location.assign("index");</script>';
  exit();
}
if($login_details['task_pr']=="YES"){
  
}else{
  echo '<script>window.location.assign("index");</script>';
  exit();
}
         

$check=mysqli_num_rows(mysqli_query($con,"select * from today_task where userid='$_SESSION[userid]' and type='B'"));
if($check>0){
    
}else{
    $sql=mysqli_query($con,"select * from data_work where status='OPEN' LIMIT 10");
     while($row=mysqli_fetch_array($sql)){
         $insert=mysqli_query($con,"insert into `today_task`(`userid`, `type`, `mobile`) values('$_SESSION[userid]', 'B', '$row[mobile]')");
         $update=mysqli_query($con,"update data_work set status='PENDING' where id='$row[id]'");
         
     }
}

if(isset($_GET['done'])){
    $id=VerifyData($_GET['done']);
    if(!$id==""){
        $sql=mysqli_query($con,"select * from today_task where id='$id' and userid='$_SESSION[userid]'");
        if(mysqli_num_rows($sql)==1){
            $result=mysqli_fetch_array($sql);
            
                
                $daily_data_details=mysqli_fetch_array(mysqli_query($con,"select * from daily_task_count where userid='$_SESSION[userid]' and date='$t_date'"));
            if($daily_data_details['status']=="OPEN"){
             
              $update_data=mysqli_query($con,"update data_work set status='DONE' where mobile='$result[mobile]'");
             if($update_data){
                
                 $insert=mysqli_query($con,"insert into `b_data`(`userid`, `mobile`, `m_date`) values('$_SESSION[userid]', '$result[mobile]', '$c_date')") ;  
               if($insert){
                   $b_data=$daily_data_details['b_data'] + 1;
                   $update=mysqli_query($con,"update daily_task_count set b_data='$b_data' where id='$daily_data_details[id]'");
                   if($update){
                      $delete=mysqli_query($con,"delete from today_task where id='$id' and userid='$_SESSION[userid]'");
                if($delete){
                    echo '<script>alert("Task Complete done.");window.location.assign("b_task");</script>';
                }else{
                  echo '<script>alert("Server error 104");window.location.assign("b_task");</script>';  
                } 
                   }else{
                    echo '<script>alert("Server error 103");window.location.assign("b_task");</script>';   
                   }
                   
               }else{
                 echo '<script>alert("Server error 102");window.location.assign("b_task");</script>'; 
               }
             }else{
               echo '<script>alert("Server error 101");window.location.assign("b_task");</script>'; 
            }
              
              
            }else{
                 echo '<script>alert("Today work closed by self.");window.location.assign("b_task");</script>'; 
            }   
            
               
            
            
        }else{
         echo '<script>alert("Task Id not found");window.location.assign("b_task");</script>';   
        }
    }else{
        echo '<script>alert("Somthing went wrong");window.location.assign("b_task");</script>';
    }
}




if(isset($_GET['cancel'])){
    $id=VerifyData($_GET['cancel']);
    if(!$id==""){
        $sql=mysqli_query($con,"select * from today_task where id='$id' and userid='$_SESSION[userid]'");
        if(mysqli_num_rows($sql)==1){
            $result=mysqli_fetch_array($sql);
            $update_data=mysqli_query($con,"update data_work set status='CANCEL' where mobile='$result[mobile]'");
            if($update_data){
                $delete=mysqli_query($con,"delete from today_task where id='$id' and userid='$_SESSION[userid]'");
                if($delete){
                    echo '<script>alert("Task Cancel done.");window.location.assign("b_task");</script>';
                }else{
                  echo '<script>alert("Server error 102");window.location.assign("b_task");</script>';  
                }
            }else{
               echo '<script>alert("Server error 101");window.location.assign("b_task");</script>'; 
            }
            
        }else{
         echo '<script>alert("Task Id not found");window.location.assign("b_task");</script>';   
        }
    }else{
        echo '<script>alert("Somthing went wrong");window.location.assign("b_task");</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Business Task |  <?php echo $brand_name; ?></title>
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

.business_task{
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
            <h1>Business Task</h1>
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
                    <th>Message</th>
                    <th>Done</th>
                    <th>Cancel</th>
                   
                  </tr>
                  </thead>
                  <tbody>
                      <?php 
                      $i=0;
                      $sql2=mysqli_query($con,"select * from today_task where userid='$_SESSION[userid]' and type='B'");
                      while($row=mysqli_fetch_array($sql2)){
                      ?>
                  <tr>
                     <td><?php echo $i +=1; ?></td>
                     <td><a target="_blank" href="whatsapp://send?phone=+91<?php echo $row['mobile']; ?>"><button class="btn btn-primary">Send Msg</button></a></td>
                     <td><a onclick="return confirm('Are you sure complete this task?')"  href="b_task?done=<?php echo $row['id']; ?>"><button class="btn btn-success">Done</button></a></td>
                     <td><a onclick="return confirm('Are you sure this number is not on whatsapp?')" href="b_task?cancel=<?php echo $row['id']; ?>"><button class="btn btn-danger">Cancel</button></a></td>
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
