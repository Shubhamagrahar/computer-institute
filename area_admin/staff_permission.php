<?php 
include 'session.php'; 

if($branch_access_details['staff_system']=="YES"){
    $type = mysqli_fetch_array(mysqli_query($con, "select type from user where id='$_SESSION[userid]'"))['type'];
if(sub_menu_check("E","C",$_SESSION['userid'], $type)==1){
    
}else{
    echo '<script>alert("You are not permitted to access this option.");window.location.assign("index");</script>'; 
}
}else{
    mysqli_close($con);
    echo '<script>window.location.assign("index");</script>';
}


$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(add_on_check("Staff Management System") == 1){
    
}else{
    echo '<script>alert("This is an add-on service. Please contact the administrator to activate or purchase access."); window.location.assign("./");</script>';

} 






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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
    
     <style type="text/css">
          .staff_drop{
    	background: #157daf !important;
    }
    
    .staff_permission{
    	background: #157daf !important;
    }
    .card{
        height: 325px;
    }
     
  .border-column {
    border-right: 1px solid #ccc;
  }

  /* Remove right border from every 3rd column (last in the row) */
  .no-border {
    border-right: none;
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
                             <label>Select staff</label>
                             <select name="staff_select_id" id="staff_select_id" required class="form-control" onchange="window.location.assign('staff_permission?staff_id='+this.value)">
                                 <option value="">Select Staff</option>
                                 
                                 <?php
                                  $sql_staff=mysqli_query($con,"select * from user where type='2' and branch_id = '$current_branch_id'");
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
            
            if($show==5){ 
                ?>
                <div align="center">
                    <h5 style="color:red;">All setting not complete in admin panel</h5>
                </div>
                <?php
            }
             if($show==1){ 
                
          
            ?>
            <script>
                $("#staff_select_id").val(<?php echo $staff_id; ?>);
               
            </script>
            <section class="content bg-white p-4 rounded border m-2">
  <div class="container-fluid">
    <div class="row">
      <?php
      $sql_menus = mysqli_query($con, "SELECT DISTINCT main_menu FROM session_menu_staff_permission WHERE userid='$staff_id' ORDER BY main_menu ASC");

      $count = 0;
      while ($menu = mysqli_fetch_array($sql_menus)) {
        if ($count % 3 == 0 && $count != 0) {
          echo '</div><hr><div class="row">';
        }

        $main_menu = $menu['main_menu'];
      ?>
        <div class="col-md-4 mb-3 <?php echo ($count % 3 == 2) ? 'no-border' : 'border-column'; ?>">

          <h5 class="text-primary">
            <?php 
              if($main_menu == "A"){ echo "Enquiry Details";
              } else if($main_menu == "B"){ echo "Enrollment Details";
              } else if($main_menu == "C"){ echo "Banking Management";
              } else if($main_menu == "D"){ echo "Student Management";
              } else if($main_menu == "E"){ echo "Staff Management";
              } else if($main_menu == "F"){ echo "Courses Management";
              } else if($main_menu == "G"){ echo "Certificate & Marksheet";
              } else if($main_menu == "H"){ echo "Student Attendance";
              
              } else { echo "Other"; }
            ?>
          </h5>
          <hr>

          <?php
          $sql_permissions = mysqli_query($con, "SELECT * FROM session_menu_staff_permission WHERE userid='$staff_id' AND main_menu='$main_menu'");
          while ($perm = mysqli_fetch_array($sql_permissions)) {
            $menu_parts = explode('->', $perm['menu_name']);
            $display_name = isset($menu_parts[1]) ? trim($menu_parts[1]) : trim($perm['menu_name']);
          ?>
            <div class="form-check mb-1">
              <input class="form-check-input" type="checkbox" id="perm_<?php echo $perm['id']; ?>" 
                     onchange="permission_grant(<?php echo $perm['id']; ?>, this.checked ? 'YES' : 'NO')" 
                     <?php echo $perm['status'] == 'YES' ? 'checked' : ''; ?>>
              <label class="form-check-label" for="perm_<?php echo $perm['id']; ?>">
                <?php echo $display_name; ?>
              </label>
            </div>
          <?php } ?>
        </div>
      <?php $count++; } ?>
    </div>
  </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
    function permission_grant(val, val2) {
    $.ajax({
        type: "GET",
        url: "get_data",
        data: {
            permission_grant: val,
            data: val2
        },
        success: function(response) {
            toastr.success('Permission updated to ' + val2);
        },
        error: function(xhr) {
            toastr.error('Failed to update permission');
        }
    });
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
    <script>
toastr.options = {
  "closeButton": true,
  "progressBar": false,
  "positionClass": "toast-top-right"
}
</script>
</body>

</html>