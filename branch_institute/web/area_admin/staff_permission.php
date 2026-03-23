<?php 
include 'session.php'; 

// if(sub_menu_check("E","F",$_SESSION['userid'])==1){
    
// }else{
//     echo '<script>alert("You are not permitted to access this option.");window.location.assign("index");</script>'; 
// }

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");








?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff Permission |
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
          .staff_drop{
    	background: #157daf !important;
    }
    
    .staff_permission{
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
                            <h1>Staff Permission System</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>


           

            <!-- Main content -->
            
             <section class="content">
                 <div class="container-fluid">
                    
                    
                     <div class="row">
                        
                        <div class="form-group col-md-3">
                             <label>Select staff:</label>
                             <select name="staff_select_id" id="staff_select_id" required class="form-control" onchange="window.location.assign('staff_permission?staff_id='+this.value)">
                                 <option value="">Select Staff</option>
                                 
                                 <?php
                                  $sql_staff=mysqli_query($con,"select * from user where type='2'");
                                  while($row=mysqli_fetch_array($sql_staff)){
                                      ?>
                                      <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                      <?php 
                                  }
                                 ?>
                                 
                             </select>
                        </div>
                        
                     </div>
                   
                     
                 </div>
                 
             </section>
            
            
            
            <?php 
           $show="";
            if(isset($_GET['staff_id'])){
                $staff_id=VerifyData($_GET['staff_id']);
               
                if(!$staff_id==""){
                  
                   
                   $staff_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$staff_id'"));
                   $sql=mysqli_query($con,"select * from session_menu order by main_menu");
                   while($row=mysqli_fetch_array($sql)){
                       $check=mysqli_num_rows(mysqli_query($con,"select * from session_menu_staff_permission where userid='$staff_id' and session_menu_id='$row[id]' and main_menu='$row[main_menu]' and sub_menu='$row[sub_menu]'"));
                       if(!$check>0){
                           $insert=mysqli_query($con,"insert into `session_menu_staff_permission`(`userid`, `session_menu_id`, `menu_name`, `main_menu`, `sub_menu`) values('$staff_id', '$row[id]', '$row[menu_name]', '$row[main_menu]', '$row[sub_menu]')");
                       }
                   }
                    $show=1;
                }else{
                  echo '<script>alert("Please select data.");window.location.assign("staff_permission");</script>';  
                }
            }
            
            if($show==1){
                
           
            ?>
            <script>
                $("#staff_select_id").val(<?php echo $staff_id; ?>);
            </script>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                      
                        <div class="col-12">
                            <br>
                            <div class="card">
                                <div class="card-header">
                                    <strong><h3 class="card-title">Permission for <?php echo $staff_details['name'] ;?>
                                   
                                    </h3></strong>
                                </div>
                                 
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Menu Name</th>
                                                <th width="100px;">Permission Status</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                           
                                           
                                           
                                              $sql_d=mysqli_query($con,"select * from session_menu_staff_permission where userid='$staff_id' order by main_menu asc");   
                                        
                                            while($row=mysqli_fetch_array($sql_d)){
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $row['menu_name'] ;?></td>
                                                <td >
                                                    
                                                    <select onchange="permission_grant(<?php echo $row['id'];?>,this.value)" id="status_select<?php echo $row['id'];?>" class="form-control">
                                                        <option value="YES">YES</option>
                                                        <option value="NO">NO</option>
                                                    </select>
                                                    <script>
                                                        $("#status_select<?php echo $row['id'];?>").val('<?php echo $row['status'] ;?>');
                                                    </script>
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
    function permission_grant(val,val2){
         $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'permission_grant='+val+'&data='+val2,
                success: function(data){
                
                }
              }
              );
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