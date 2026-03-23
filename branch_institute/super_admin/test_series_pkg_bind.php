<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");


$btnname="Create";
$test_type_nane="";
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
    <title>Bind Package Wise Question Type |
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
    
    .test_series_pkg_bind{
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
                            <h1>Bind Package Wise Question Type</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>


           

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                         
                         
                        
                        <div class="col-md-12">
                            <br>
                                <div class="card card-info">
                              <div class="card-header">
                                <h3 class="card-title"> Test Type</h3>
                              </div>
                              <!-- /.card-header --> 
                              <!-- form start -->
                             
                                <div class="card-body ">
                                <div class="row">
                                 <div class="col-md-6">
                                    <label>Select Package :</label>
                                   <select name="pkg_id" id="pkg_id" class="form-control" onchange="get_element_by_pkg(this.value)">
                                       <option value="">Select</option>
                                       <?php
                                        $sql_course=mysqli_query($con,"select * from test_series_pkg_details order by package_name");
                                        while($row=mysqli_fetch_array($sql_course)){
                                           ?>
                                           <option value="<?php echo $row['id']; ?>"><?php echo $row['package_name']; ?></option>
                                           <?php   
                                        }
                                       ?>
                                       
                                   </select>
                                </div>
                                <div class="col-md-6" id="series_type_div">
                                  
                                </div>
                                <div class="col-md-12" id="pkg_details_div">
                                 
                                </div>
                               
                                   
                                  </div>
                                  
                                </div>
                               
                          
                            </div>
                            </div>
                            
                            <div class="col-md-12" id="table_data">
                                
                            </div>
                            
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
    
    function tsp_pkg_series_insert(pkg_id,val){
        $.ajax(
              {
                type:"GET",
                url:"test_series_get_data",
                data:'tsp_pkg_series_insert='+pkg_id+'&series_id='+val,
                success: function(data){
                    if(data==1){
                     tsp_seriest_table(pkg_id);
                     tsp_series_selector(pkg_id);
                    }else{
                        alert(data);
                    }
                
                }
              }
              );
    }
    

    function tsp_table_data_delete(val, val1) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'Do you really want to delete this data?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "GET",
                url: "test_series_get_data",
                data: { tsp_table_data_delete: val },
                success: function(data) {
                    if (data == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'Data deleted successfully.',
                            confirmButtonText: 'OK'
                        });
                        tsp_series_selector(val1);
                        tsp_seriest_table(val1);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data,
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'AJAX request failed.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });
}

    function tsp_seriest_table(val){
        $.ajax(
              {
                type:"GET",
                url:"test_series_get_data",
                data:'tsp_seriest_table='+val,
                success: function(data){
                 $("#table_data").html(data);
                }
              }
              );
     }
    
    function tsp_series_selector(val){
        $.ajax(
              {
                type:"GET",
                url:"test_series_get_data",
                data:'tsp_series_selector='+val,
                success: function(data){
                 $("#series_type_div").html(data);
                }
              }
              );
     }
     
     function tsp_pkg_details(val){
        $.ajax(
              {
                type:"GET",
                url:"test_series_get_data",
                data:'tsp_pkg_details='+val,
                success: function(data){
                 $("#pkg_details_div").html(data);
                }
              }
              );
     }
    
    
    
      function get_element_by_pkg(val){
           tsp_pkg_details(val);
           tsp_series_selector(val);
           tsp_seriest_table(val);
        }
    
     
    
    
    
    
     
       
       $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                //"buttons": ["copy", "", "excel", "pdf", "print", "colvis"]
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