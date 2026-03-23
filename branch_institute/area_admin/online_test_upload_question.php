<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(add_on_check("Online Test & Admit Card") == 1){
    
}else{
    echo '<script>alert("This is an add-on service. Please contact the administrator to activate or purchase access."); window.location.assign("./");</script>';

} 
$sql_question=mysqli_query($con,"select status from test_series_questions where status='OPEN'");
if(mysqli_num_rows($sql_question)>0){
    if(mysqli_num_rows($sql_question)==1){
      $current_question_details=mysqli_fetch_array(mysqli_query($con,"select * from test_series_questions where status='OPEN' LIMIT 1")); 
    }else{
      mysqli_close($con);
      echo '<script>alert("Somthing went wrong please contact your service provider.");window.location.assign("index");</script>';
      exit();
    }
    
}else{
  $insert_question_data =mysqli_query($con,"insert into `test_series_questions`(`status`, `date`) values('OPEN', '$t_date')");
  if($insert_question_data){
      $insert_id=mysqli_insert_id($con);
      $current_question_details=mysqli_fetch_assoc(mysqli_query($con,"select * from test_series_questions where id='$insert_id'"));
  }else{
    mysqli_close($con);
      echo '<script>alert("Somthing went wrong server please contact your service provider.");window.location.assign("index");</script>';
      exit();  
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Test Question Upload |
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
          .drop_online_test{
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
                            <h1>Upload Online Exam Question</h1>
                        </div>
                       
                    </div>
                    <!-- /.container-fluid -->
            </section>
 <hr>
                        <div class="col-md-12 mx-auto" style="text-align:end;"><a href="online_test_add_question"><button class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Add Questions</button></a></div>
                        
                         <div class="row justify-content-center mb-4">
    
  </div>
                            <div class="container mt-5">
                              <div class="row justify-content-center">
                                <div class="col-md-6">
                                  <div class="card">
                                    <div class="card-header bg-info text-white">
                                      <h4 class="mb-0">Upload Online Test Questions CSV</h4>
                                    </div>
                                    <div class="card-body">
                                      <form id="csv_upload_form" enctype="multipart/form-data">
                                        <div class="form-group">
                                          <label for="csv_file">Upload CSV File:</label>
                                          <input type="file" id="csv_file" name="csv_file" accept=".csv" class="form-control" required>
                                        </div>
                                        <div class="d-flex justify-content-between mt-4">
                                          <button type="submit" class="btn btn-primary">Upload</button>
                                          <a href="download_online_question_sample.php" id="download_template" class="btn btn-success">Download Template</a>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="card">
                                    <div class="card-header bg-warning text-dark">
                                      <h5 class="mb-0">Available Course Type Types</h5>
                                    </div>
                                    <div class="card-body p-3">
                                      <table class="table table-bordered table-sm mb-0">
                                        <thead class="thead-light">
                                          <tr>
                                            <th>Course ID</th>
                                            <th>Course Name</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                         
                                          <?php
                                          
                                          $query = mysqli_query($con, "SELECT id, name FROM course_details where status='OPEN' ORDER BY id ASC");
                                          while ($row = mysqli_fetch_assoc($query)) {
                                          ?>
                                          <tr>
                                              <td><?php echo $row['id']; ?></td>
                                              <td><?php echo $row['name']; ?></td>
                                          </tr>
                                          <?php } ?>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>





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
  $(document).ready(function () {
    // Upload form submit handler (as before)
    $("#csv_upload_form").on("submit", function (e) {
      e.preventDefault();

      Swal.fire({
        icon: 'warning',
        title: 'Important Notice',
   html: `
    <p><b>Important Guidelines Before Uploading:</b></p>
  <div style="text-align: justify;">
    <ul style="padding-left: 20px;">
  <li style="margin-bottom: 12px;"><b>Do not change the column headers</b> in the CSV file. The structure must remain exactly as downloaded.</li>
  <li style="margin-bottom: 12px;">Ensure that the <code>ans_final</code> field contains only the column names like <code>ans_a</code>, <code>ans_b</code>, etc. — not the actual answer text.</li>
  <li style="margin-bottom: 12px;"><b>Make sure the <code>course_id</code> and <code>test_level</code> is valid</b> and matches one of the IDs listed on the page.</li>
  <li style="margin-bottom: 12px;"><b>Warning:</b> If the file format or column headers are changed, the system might still accept the upload, but it could lead to errors while processing the data.</li>
  <li style="margin-bottom: 0;"><b>Proceed carefully.</b> You are fully responsible for the accuracy and structure of the data you upload.</li>
</ul>

  </div>
`,


        showCancelButton: true,
        confirmButtonText: 'I Understand, Proceed',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          var formData = new FormData(this);

          $.ajax({
            url: "online_exam_upload_csv",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (res) {
              Swal.fire({
                icon: 'success',
                title: 'Upload Successful',
                text: 'CSV data has been uploaded successfully.'
              });
            },
            error: function () {
              Swal.fire("Error", "Something went wrong while uploading.", "error");
            }
          });
        }
      });
    });

    // Download button click handler to show warning before download
    $("#download_template").on("click", function (e) {
      e.preventDefault(); // prevent default link action

      Swal.fire({
        icon: 'warning',
        title: 'Important Notice',
        html: `
          <p>Please <b>do not edit the header</b> of the CSV file.</p>
          <p>In the <code>ans_final</code> column, use the column names like <code>ans_a</code>, <code>ans_b</code>, etc.</p>
          <p>For your convenience, we have included one sample question in the template to guide you with the correct format.</p>
          <p><b>Be careful!</b> Any changes to the header may cause upload errors.</p>
        `,
        showCancelButton: true,
        confirmButtonText: 'I Understand, Download',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          // Proceed with download
          window.location.href = $(this).attr("href");
        }
      });
    });
  });
</script>




</body>

</html>