<?php
include 'session.php'; 
$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(add_on_check("Coupen Code") == 1){
    
}else{
    echo '<script>alert("This is an add-on service. Please contact the administrator to activate or purchase access."); window.location.assign("./");</script>';

} 



if (isset($_POST['create'])) {
  
    $coupen_code = trim($_POST['coupen_code']);
    $course_ids = $_POST['course_id'] ?? [];
    $valid_date = $_POST['valid_till'];

    if ($coupen_code !== "" && $course_ids!==""  && $valid_date!=="") {
        echo '<script>alert("All Feilds are required");window.location.assign("coupen_code");</script>';
    } else {
        foreach ($course_ids as $course_id) {
            $course_id = intval($course_id); 

            $query = "INSERT INTO coupen_code (coupen_code, course_id, create_date, valid_date) 
                      VALUES ('$coupen_code', '$course_id', NOW(), '$valid_date')";

            $result = mysqli_query($con, $query);

            if (!$result) {
                echo '<script>alert("Coupen Created Successfully");window.location.assign("coupen_code");</script>';
                exit;
            }
        }

        echo '<script>';
    }
}



if(isset($_GET['delete'])){
    $status=VerifyData($_GET['delete']);
    $id=VerifyData($_GET['id']);
    if($status=="YES" && !$id==""){
        $delete =mysqli_query($con,"delete from video_details where id='$id'");
        if($delete){
            echo '<script>alert("Video Deleted Sucessfully Done.");window.location.assign("video");</script>';
        }else{
         echo '<script>alert("Server error 203.");window.location.assign("video");</script>';   
        }
    }else{
      echo '<script>alert("Somthing Went Wrong.");window.location.assign("video");</script>';   
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Coupen Code |  <?php echo $brand_name; ?></title>
    <!-- Favicons -->
  <link href="<?php echo $brand_logo; ?>" rel="icon">
  
   <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <script src="ckeditor/ckeditor.js"></script>
    
  <style type="text/css">
  

.coupen_code{
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

    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
           
                
            
            <div class="col-md-3">
                
            </div>
            <div class="col-md-6">
                <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Add Coupen Code</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="coupenForm">
                <div class="card-body">
                    <div class="form-group">
                    <label for="short_about">Select Course:</label>
                    <select class="form-control" name="course_id[]" id='course_id' multiple>
                        <?php
                            $course = mysqli_query($con, "select * from course_details where status='OPEN'");
                            while($row = mysqli_fetch_array($course)){
                        ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                        <?php } ?>
                    </select>
               
                  </div>
                 
                  <div class="form-group">
                    <label for="coupen_code">Coupen Code</label>
                    <input type="text" class="form-control" id="coupen_code" name="coupen_code" value="" placeholder="Enter Coupen Code">
               
                  </div>
                  <div class="form-group">
                    <label for="coupen_code">Discount (in %)</label>
                    <input type="number" class="form-control" id="discount" name="discount" value="" placeholder="Enter Discount (in %)">
               
                  </div>
                  <div class="form-group">
                    <label for="valid_till">Valid Till</label>
                    <input type="date" class="form-control" id="valid_till" name="valid_till" value="">
               
                  </div>
                 
                  
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="create" class="btn btn-primary">Create</button>
                </div>
              </form>
            </div>
            </div>
            
            
           
            
            
          </div>
        </div>
     </section>
     <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Coupen Code Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                               <th>Coupen Code</th>
                                               <th>Discount</th>
                                                <th>Course Name</th>
                                                <th>Create Date</th>
                                                <th>Valid Till</th>
                                                <th>Delete</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                             $sql_coupen=mysqli_query($con,"select * from coupen_code order by valid_date ");
                                            while($row=mysqli_fetch_array($sql_coupen)){
                                           $course_name = mysqli_fetch_array(mysqli_query($con, "select name from course_details where id='$row[course_id]'"))['name'];
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $row['coupen_code']; ?></td>
                                                <td><?php echo $row['discount']; ?>%</td>
                                                <td><?php echo $course_name; ?></td>
                                                <td><?php echo date('d-M Y', strtotime($row['create_date'])); ?></td>
                                                <td><?php echo date('d-M Y', strtotime($row['valid_date'])); ?></td>
                                               
                                                <td>
                                                    <button class="btn btn-danger delete_coupen" data-id="<?php echo $row['id']; ?>">Delete</button>
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
    <script src="plugins/select2/js/select2.full.min.js"></script>
    <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
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
    <script>
$(document).ready(function () {
    $('#course_id').select2({
        placeholder: "Select Course",
        allowClear: true
    });
});
</script>
<script>
    $(document).ready(function() {
    $("#coupenForm").on("submit", function(e) {
        e.preventDefault();

        let course_ids = $("#course_id").val();
        let coupen_code = $("#coupen_code").val().trim();
        let valid_till = $("#valid_till").val();
        let discount = $("#discount").val();

        if (course_ids.length === 0 && coupen_code === "" && valid_till === "" && discount === "") {
            Swal.fire("Error", "All fields are required!", "error");
            return;
        }

        $.ajax({
            url: "get_data",
            method: "GET",
            data: {
                create_coupen: 1,
                course_id: course_ids,
                coupen_code: coupen_code,
                valid_till: valid_till,
                discount: discount
            },
            success: function(response) {
                if (response.trim() === "success") {
                    Swal.fire("Success", "Coupon created successfully!", "success").then(() => {
                                    location.reload();
                                });
                    $("#coupenForm")[0].reset();
                    $("#course_id").val(null).trigger("change");
                } else {
                    Swal.fire("Error", response, "error");
                }
            },
            error: function() {
                Swal.fire("Error", "AJAX request failed!", "error");
            }
        });
    });
     $(document).on("click", ".delete_coupen", function() {
        let coupenId = $(this).data("id");

        Swal.fire({
            title: "Are you sure?",
            text: "Do you really want to delete this coupon?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "get_data",
                    method: "GET",
                    data: {
                        delete_coupen: 1,
                        id: coupenId
                    },
                    success: function(response) {
                        if (response.trim() === "success") {
                            Swal.fire("Deleted!", "Coupon has been deleted.", "success")
                                .then(() => {
                                    location.reload();
                                });
                        } else {
                            Swal.fire("Error", response, "error");
                        }
                    },
                    error: function() {
                        Swal.fire("Error", "AJAX request failed!", "error");
                    }
                });
            }
        });
    });
   
});
</script>

</body>
</html>
