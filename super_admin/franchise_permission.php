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
    <title>Franchise Permission |
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
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <script src="https://tvssolution.com/panel/staff/admin_area/js/jquery-3.3.1.min.js" type="text/jscript"></script>
    
     <style type="text/css">
          .branch_drop{
    	background: #157daf !important;
    }
    
    .franchise_permission{
    	background: #157daf !important;
    }
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ff0000;
  transition: 0.4s;
  border-radius: 34px;
  line-height: 34px;
  font-weight: bold;
  color: white;
  font-size: 13px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  transition: 0.4s;
  border-radius: 50%;
}

.slider::after {
  content: "NO";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  line-height: 34px;
  font-weight: bold;
  font-size: 12px;
  color: white;
  padding-right: 8px;
  text-align: right;
}


input:checked + .slider {
  background-color: #28a745;
  text-align: left;
}

input:checked + .slider:before {
  transform: translateX(26px);
}

input:checked + .slider::after {
  content: "YES";
  text-align: left;
  padding-left: 8px;
}

    
      </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?php include 'top_navbar.php'; ?>


        <?php include 'left_side_navbar.php'; ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Franchise Permission System</h1>
                        </div>

                    </div>
                    
            </section>


           
         
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                      
                        <div class="col-12">
                            <br>
                            <div class="card">
                                <div class="card-header">
                                    <strong><h3 class="card-title"> Franchise Permission</h3></strong>
                                </div>
                                 
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Franchise Name</th>
                                                <th width="60px">Mobile No.</th>
                                                <th width="50px">Enquiry System</th>
                                                <th width="50px">Student Attendance System</th>
                                                <th width="50px">Staff System</th>
                                                <th width="50px">LMS System</th>
                                                <th width="50px">Test Series System</th>
                                              
                                                <th width="50px">Online Exam System</th>
                                                <th width="50px">Coupen Code</th>
                                                <th width="50px">EduAI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                           $sql_d=mysqli_query($con,"select * from branch_details order by id desc");   
                                        while($row=mysqli_fetch_array($sql_d)){
                                                $branch_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$row[userid]'"));
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $branch_details['name'];?></td>
                                                <td><?php echo $branch_details['mobile'];?></td>
                                                 
                                                 <td>
                                                  <label class="switch">
                                                    <input type="checkbox" onchange="toggle_permission(this, <?php echo $row['id']; ?>, 'enquiry_system')" <?php echo ($row['enquiry_system'] == 'YES') ? 'checked' : ''; ?>>
                                                    <span class="slider round"></span>
                                                  </label>
                                                </td>
                                              
                                                
                                                
                                                 <?php
                                                 $addon_name = "Student Attendance System";
                                                    if(add_on_check("Student Attendance System") == 1){
                                                ?>
                                                 <td>
                                                  <label class="switch">
                                                    <input type="checkbox" onchange="toggle_permission(this, <?php echo $row['id']; ?>, 'student_attendance_system')" <?php echo ($row['student_attendance_system'] == 'YES') ? 'checked' : ''; ?>>
                                                    <span class="slider round"></span>
                                                  </label>
                                                </td>
                                                <?php } else { ?>
                                                 <td>
                                                    <button onclick="showAddonAlert('<?php echo $addon_name; ?>')" class="btn btn-warning btn-sm">Get Add-On</button>
                                                  </td>
                                                
                                                <?php } ?>
                                                
                                                 <?php
                                                 $addon_name = "Staff Management System";
                                                    if(add_on_check("Staff Management System") == 1){
                                                ?>
                                                 <td>
                                                  <label class="switch">
                                                    <input type="checkbox" onchange="toggle_permission(this, <?php echo $row['id']; ?>, 'staff_system')" <?php echo ($row['staff_system'] == 'YES') ? 'checked' : ''; ?>>
                                                    <span class="slider round"></span>
                                                  </label>
                                                </td>
                                                <?php } else { ?>
                                                 <td>
                                                    <button onclick="showAddonAlert('<?php echo $addon_name; ?>')" class="btn btn-warning btn-sm">Get Add-On</button>
                                                  </td>
                                                
                                                <?php } ?>
                                               
                                                <?php
                                                $addon_name = "Learning Management System";
                                                    if(add_on_check("Learning Management System") == 1){
                                                ?>
                                                 <td>
                                                  <label class="switch">
                                                    <input type="checkbox" onchange="toggle_permission(this, <?php echo $row['id']; ?>, 'lms_system')" <?php echo ($row['lms_system'] == 'YES') ? 'checked' : ''; ?>>
                                                    <span class="slider round"></span>
                                                  </label>
                                                </td>
                                                 <?php } else { ?>
                                                 <td>
                                                    <button onclick="showAddonAlert('<?php echo $addon_name; ?>')" class="btn btn-warning btn-sm">Get Add-On</button>
                                                  </td>
                                                
                                                <?php } ?>
                                               
                                             <?php
                                             $addon_name = "Test Series System";
                                                    if(add_on_check("Test Series System") == 1){
                                                ?>
                                                 <td>
                                                  <label class="switch">
                                                    <input type="checkbox" onchange="toggle_permission(this, <?php echo $row['id']; ?>, 'test_series_system')" <?php echo ($row['test_series_system'] == 'YES') ? 'checked' : ''; ?>>
                                                    <span class="slider round"></span>
                                                  </label>
                                                </td>
                                                <?php } else { ?>
                                                 <td>
                                                    <button onclick="showAddonAlert('<?php echo $addon_name; ?>')" class="btn btn-warning btn-sm">Get Add-On</button>
                                                  </td>
                                                
                                                <?php } ?>
                                                 
                                                 <?php
                                                 $addon_name = "Online Test & Admit Card";
                                                    if(add_on_check("Online Test & Admit Card") == 1){
                                                ?>
                                                 <td>
                                                  <label class="switch">
                                                    <input type="checkbox" onchange="toggle_permission(this, <?php echo $row['id']; ?>, 'online_exam_system')" <?php echo ($row['online_exam_system'] == 'YES') ? 'checked' : ''; ?>>
                                                    <span class="slider round"></span>
                                                  </label>
                                                </td>
                                               <?php } else { ?>
                                                 <td>
                                                    <button onclick="showAddonAlert('<?php echo $addon_name; ?>')" class="btn btn-warning btn-sm">Get Add-On</button>
                                                  </td>
                                                
                                                <?php } ?>
                                                 <?php
                                                 $addon_name = "Coupen Code";
                                                    if(add_on_check("Coupen Code") == 1){
                                                ?>
                                                 <td>
                                                  <label class="switch">
                                                    <input type="checkbox" onchange="toggle_permission(this, <?php echo $row['id']; ?>, 'coupen_code')" <?php echo ($row['coupen_code'] == 'YES') ? 'checked' : ''; ?>>
                                                    <span class="slider round"></span>
                                                  </label>
                                                </td>
                                               <?php } else { ?>
                                                 <td>
                                                    <button onclick="showAddonAlert('<?php echo $addon_name; ?>')" class="btn btn-warning btn-sm">Get Add-On</button>
                                                  </td>
                                                
                                                <?php } ?>
                                                 <?php
                                                 $addon_name = "EduAI";
                                                    if(add_on_check("EduAI") == 1){
                                                ?>
                                                 <td>
                                                  <label class="switch">
                                                    <input type="checkbox" onchange="toggle_permission(this, <?php echo $row['id']; ?>, 'EduAI')" <?php echo ($row['EduAI'] == 'YES') ? 'checked' : ''; ?>>
                                                    <span class="slider round"></span>
                                                  </label>
                                                </td>
                                               <?php } else { ?>
                                                 <td>
                                                    <button onclick="showAddonAlert('<?php echo $addon_name; ?>')" class="btn btn-warning btn-sm">Get Add-On</button>
                                                  </td>
                                                
                                                <?php } ?>
                                               
                                            </tr>
                                            
                                            <?php }  ?>
                                        </tbody>

                                    </table>
                                </div>
                                 
                            </div>
                             
                        </div>
                        
                    </div>
                    
                </div>
               
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
     <script src="plugins/toastr/toastr.min.js"></script>
     <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>

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
    <script>
        function toggle_permission(element, id, field) {
    let newStatus = element.checked ? 'YES' : 'NO';

    $.ajax({
        url: 'get_data',  
        type: 'GET',
        data: {
            change_permission: 1,
            id: id,
            field: field,           
            status: newStatus     
        },
        success: function(response) {
            toastr.success('Status updated successfully!');
        },
        error: function() {
            toastr.error('An error occurred. Please try again.');  
            element.checked = !element.checked; 
        }
    });
}

    </script>
   
<script>
function showAddonAlert(addonName) {
  Swal.fire({
    icon: 'info',
    title: 'Add-On Required',
    html: `
      <p>To access the <strong>${addonName}</strong> feature, please contact us to purchase this add-on.</p>
      <div style="margin-top: 20px; display: flex; justify-content: center; gap: 10px;">
        <a href="tel:+918899117706">
          <button class="swal2-confirm swal2-styled" style="background-color: #2884a7;"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;&nbsp;Call Now</button>
        </a>
        <a href="https://wa.me/915514050395?text=I%20want%20to%20buy%20${encodeURIComponent(addonName)}%20add-on service" target="_blank">
          <button class="swal2-cancel swal2-styled" style="background-color: #148f42;"><i class="fab fa-whatsapp"></i>&nbsp;&nbsp;WhatsApp Now</button>
        </a>
      </div>
    `,
    showConfirmButton: false,
    showCancelButton: false,
    allowOutsideClick: true
  });
}
</script>

</body>

</html>