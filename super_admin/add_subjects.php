<?php
include 'session.php'; 

$c_date=date("Y-m-d H:i:s");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Course Subject | <?php echo $brand_name; ?></title>
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
      .drop_course{
	background: #157daf !important;
}

.course_subjects{
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
                <h3 class="card-title"><?php echo $btn_name ;?> Subject </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" id="subject_form">
                <div class="card-body">
                 
                  <div class="form-group">
                    <label for="short_about">Subject</label>
                    <input  class="form-control"  id="subject_name" name="subject_name" value=""  placeholder="Enter Subject Name.">
               
                  </div>
                  
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="Create" class="btn btn-primary">Create</button>
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
                                    <h3 class="card-title">Subjects Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Subject</th>
                                                <th>Edit</th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                             $sql_course=mysqli_query($con,"select * from subject_details order by id desc");
                                            while($row=mysqli_fetch_array($sql_course)){
                                            
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                             
                                                <td><?php echo $row['subject_name']; ?></td>
                                               
                                               
                                                <td>
                                                  <button class="btn btn-success" onclick="editSubject('<?php echo $row['id']; ?>', '<?php echo addslashes($row['subject_name']); ?>')">
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
  $("#subject_form").on("submit", function (e) {
    e.preventDefault(); // prevent default form submission

    let subject_name = $("#subject_name").val().trim();

    if (subject_name === "") {
      Swal.fire("Error!", "Please enter subject name.", "error");
      return;
    }

    $.ajax({
      type: "POST",
      url: "get_data", 
      data: {
        create_subject: 1,
        subject_name: subject_name
      },
      success: function (response) {
        if (response == "1") {
          Swal.fire("Success!", "Subject created successfully.", "success").then(() => {
            window.location.assign("add_subjects");
          });
        } else {
          Swal.fire("Error!", response, "error");
        }
      },
      error: function () {
        Swal.fire("Error!", "AJAX request failed.", "error");
      }
    });
  });
});
</script>
<script>
function editSubject(id, currentName) {
  Swal.fire({
    title: "Edit Subject Name",
    icon: "info",
    input: "text",
    inputValue: currentName,
    inputAttributes: {
      autocapitalize: "off"
    },
    showCancelButton: true,
    confirmButtonText: "Update",
    showLoaderOnConfirm: true,
    preConfirm: async (newName) => {
      if (!newName || !newName.trim()) {
        throw new Error("empty");
      }

      try {
        const data = await new Promise((resolve, reject) => {
          $.ajax({
            type: "GET",
            url: "get_data",
            data: {
              update_subject: 1,
              subject_id: id,
              subject_name: newName.trim()
            },
            success: function(response) {
              resolve(response);
            },
            error: function() {
              reject("AJAX request failed.");
            }
          });
        });

        if (data !== "1") {
          Swal.showValidationMessage(data);
          throw new Error("server error");
        }

        return data;
      } catch (error) {
        if (error.message !== "empty") {
          if (!Swal.isValidationMessageShown()) {
            Swal.showValidationMessage(error.message || error);
          }
        }
        throw error;
      }
    },
    allowOutsideClick: () => !Swal.isLoading()
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire("Success!", "Subject name updated.", "success").then(() => {
        location.reload();
      });
    } else if (result.dismiss === Swal.DismissReason.cancel) {
      
    }
  }).catch((error) => {
    if (error.message === "empty") {
      Swal.fire("Error", "Subject name cannot be empty!", "error");
    }
  });
}

</script>


</body>
</html>
