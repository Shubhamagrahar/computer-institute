<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(add_on_check("Test Series System") == 1){
    
}else{
    echo '<script>alert("This is an add-on service. Please contact the administrator to activate or purchase access."); window.location.assign("./");</script>';

} 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test Series Type Name |
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
          .test_drop{
    	background: #157daf !important;
    }
    
    .test_series_type{
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
                            <h1>Test Series Type Manage</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>


           

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                         
                         <div class="col-md-4">
                             
                         </div>
                        
                        <div class="col-md-4">
                            <br>
                <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"><?php echo $btnname;?> Test Type</h3>
              </div>
              <!-- /.card-header --> 
              <!-- form start -->
              <form id="type_form" name="form_2">
                <div class="card-body ">
                <div class="row">
                 <div class="col-sm-12" >
                    <label>Type Name :</label>
                    <input type="text" class="form-control" required value="" name="type_name" id="type_name" placeholder="Enter type name.">
                    </div>
                   
                   
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="Create" class="btn btn-success">Create</button>
                </div>
              </form>
            </div>
            </div>    
                        <div class="col-12">
                  <br>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"></h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Name</th>
                                               
                                                <th width="60px">Edit</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                            $sql_test_series_package=mysqli_query($con,"select * from test_series_type order by id desc");
                                            while($row=mysqli_fetch_array($sql_test_series_package)){
                                            // $date=date_create($row['c_date']);
                                            // $date=date_format($date,"d-m-Y H:i A");
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                              
                                                <td>
                                                      <button class="btn btn-info edit-btn" 
                                                              data-id="<?php echo $row['id']; ?>" 
                                                              data-name="<?php echo htmlspecialchars($row['name'], ENT_QUOTES); ?>">
                                                        <i class="fa fa-edit"></i> Edit
                                                      </button>
                                                    </td>

                                                
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
    <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
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
<script>
document.getElementById('type_form').addEventListener('submit', function(e) {
  e.preventDefault();

  const type_name = document.getElementById('type_name').value.trim();

  if (type_name === '') {
    Swal.fire('Warning', 'Please fill all the fields', 'warning');
    return;
  }

  $.ajax({
    url: 'test_series_get_data',
    type: 'GET',
    data: {
      insert_type_name: 1,
      type_name: type_name
    },
    success: function(response) {
      let title = 'Info';
      let icon = 'info';

      if (response.includes('successfully')) {
        title = 'Success';
        icon = 'success';
      } else if (response.includes('already exists') || response.includes('Please fill')) {
        title = 'Warning';
        icon = 'warning';
      } else if (response.includes('Server error')) {
        title = 'Error';
        icon = 'error';
      }

      Swal.fire(title, response, icon).then(() => {
        if (icon === 'success') {
          window.location.reload();
        }
      });
    },
    error: function() {
      Swal.fire('Error', 'AJAX request failed.', 'error');
    }
  });
});


$(document).ready(function() {
  $('.edit-btn').on('click', function() {
    const id = $(this).data('id');
    const currentName = $(this).data('name');

    Swal.fire({
      title: 'Edit Test Series Type',
      input: 'text',
      inputLabel: 'Type Name',
      inputValue: currentName,
      showCancelButton: true,
      confirmButtonText: 'Update',
      preConfirm: (newName) => {
        if (!newName || newName.trim() === '') {
          Swal.showValidationMessage('Type name cannot be empty');
        }
        return newName.trim();
      }
    }).then((result) => {
      if (result.isConfirmed) {
        // Send AJAX request to update name
        $.ajax({
          url: 'test_series_get_data',
          type: 'GET',
          data: {
            update_type_name: 1,
            id: id,
            new_name: result.value
          },
          success: function(response) {
            let title = 'Info';
            let icon = 'info';

            if (response.includes('updated successfully')) {
              title = 'Success';
              icon = 'success';
            } else if (response.includes('already exists') || response.includes('empty')) {
              title = 'Warning';
              icon = 'warning';
            } else if (response.includes('error')) {
              title = 'Error';
              icon = 'error';
            }

            Swal.fire(title, response, icon).then(() => {
              if (icon === 'success') {
                location.reload();
              }
            });
          },
          error: function() {
            Swal.fire('Error', 'AJAX request failed.', 'error');
          }
        });
      }
    });
  });
});

</script>


</body>

</html>