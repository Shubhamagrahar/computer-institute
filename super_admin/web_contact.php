<?php
include 'session.php'; 

$c_date=date("Y-m-d H:i:s");


$web_contact = mysqli_fetch_array(mysqli_query($con, "select * from website_data where id='1'"));


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Web Contact |  <?php echo $brand_name; ?></title>
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
    <script src="ckeditor/ckeditor.js"></script>
    
  <style type="text/css">
      .website_drop{
	background: #157daf !important;
}

.web_contact{
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
           
                
            <div class="row col-md-11 mx-auto">
           
            <div class="col-md-7">
                <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Address</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body">
                 
                  <div class="form-group">
                    <label for="address_1">Address 1</label>
                    <textarea  class="form-control" rows="3" id="address_1" name="address_1"  placeholder="Enter Address 1"  onkeyup="updateWebContactField('address', this.value)"><?php echo $web_contact['address']; ?></textarea>
               
                  </div>
                  <div class="form-group">
                    <label for="address_2">Address 2</label>
                    <textarea  class="form-control" rows="3" id="address_2" name="address_2" placeholder="Enter Address 2"  onkeyup="updateWebContactField('address_2', this.value)"><?php echo $web_contact['address_2']; ?></textarea>
               
                  </div>
                  <div class="form-group">
                    <label for="map">Google Map</label>
                    <textarea  class="form-control" rows="4" id="map" name="map" placeholder="Enter Google Map"  onkeyup="updateWebContactField('map', this.value)"><?php echo $web_contact['map']; ?></textarea>
               
                  </div>
                   
                  
                  
                </div> 
              </form>
            </div>
            </div>
            
            
            <div class="col-md-5">
                <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Mobile</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body">
                 
                  <div class="form-group">
                    <label for="mobile_1">Mobile 1</label>
                    <input type="text"  class="form-control" id="mobile_1" name="mobile_1" value="<?php echo $web_contact['mob1']; ?>"  onkeyup="updateWebContactField('mob1', this.value)"  placeholder="Enter Mobile 1" />
               
                  </div>
                  <div class="form-group">
                    <label for="mobile_2">Mobile 2</label>
                    <input type="text"  class="form-control" id="mobile_2" name="mobile_2" value="<?php echo $web_contact['mob2']; ?>"  onkeyup="updateWebContactField('mob2', this.value)"  placeholder="Enter Mobile 2" />
               
                  </div>
                  <div class="form-group">
                    <label for="call_no">Calling Number</label>
                    <input type="text"  class="form-control" id="call_no" name="call_no" value="<?php echo $web_contact['call_no']; ?>"  onkeyup="updateWebContactField('call_no', this.value)"  placeholder="Enter Calling Number" />
               
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text"  class="form-control" id="email" name="email" value="<?php echo $web_contact['email']; ?>"  onkeyup="updateWebContactField('email', this.value)"  placeholder="Enter Email" />
               
                  </div>
                  <div class="form-group">
                    <label for="email_2">Email 2</label>
                    <input type="text"  class="form-control" id="email_2" name="email_2" value="<?php echo $web_contact['email_2']; ?>"  onkeyup="updateWebContactField('email_2', this.value)"  placeholder="Enter Alternative Email" />
               
                  </div>
                  
                  
                  
                </div> 
              </form>
            </div>
            </div>
            
            </div>
            
            <div class="col-md-11 mx-auto">
                <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Social Media</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body row">
                 
                  <div class="form-group col-md-4">
                    <label for="whatsapp">Whatsapp</label>
                    <input type="text"  class="form-control" id="whatsapp" name="whatsapp" value="<?php echo $web_contact['w_mob']; ?>"  onkeyup="updateWebContactField('w_mob', this.value)"  placeholder="Enter Whatsapp Number" />
               
                  </div>
                  <div class="form-group col-md-4">
                    <label for="facebook">Facebook</label>
                    <input type="url"  class="form-control" id="facebook" name="facebook" value="<?php echo $web_contact['facebook']; ?>"  onkeyup="updateWebContactField('facebook', this.value)"  placeholder="Enter Facebook URL" />
               
                  </div>
                  <div class="form-group col-md-4">
                    <label for="instagram">Instagram</label>
                    <input type="url"  class="form-control" id="instagram" name="instagram" value="<?php echo $web_contact['instagram']; ?>"  onkeyup="updateWebContactField('instagram', this.value)"  placeholder="Enter Instagram URL" />
               
                  </div>
                  <div class="form-group col-md-4">
                    <label for="youtube">Youtube</label>
                    <input type="url"  class="form-control" id="youtube" name="youtube" value="<?php echo $web_contact['youtube']; ?>"  onkeyup="updateWebContactField('youtube', this.value)"  placeholder="Enter Youtube URL" />
               
                  </div>
                  <div class="form-group col-md-4">
                    <label for="linkedin">LinkedIn</label>
                    <input type="url"  class="form-control" id="linkedin" name="linkedin" value="<?php echo $web_contact['linkedin']; ?>"  onkeyup="updateWebContactField('linkedin', this.value)"  placeholder="Enter LinkedIn URL" />
               
                  </div>
                  <div class="form-group col-md-4">
                    <label for="twitter">Twitter (Now X)</label>
                    <input type="url"  class="form-control" id="twitter" name="twitter" value="<?php echo $web_contact['twiter']; ?>"  onkeyup="updateWebContactField('twiter', this.value)"  placeholder="Enter Twitter (X) URL" />
               
                  </div>
                  <div class="form-group col-md-4">
                    <label for="telegram">Telegram</label>
                    <input type="url"  class="form-control" id="telegram" name="telegram" value="<?php echo $web_contact['telegram']; ?>"  onkeyup="updateWebContactField('telegram', this.value)"  placeholder="Enter Telegram URL" />
               
                  </div>
                  <div class="form-group col-md-4">
                    <label for="threads">Threads</label>
                    <input type="url"  class="form-control" id="threads" name="threads" value="<?php echo $web_contact['threads']; ?>"  onkeyup="updateWebContactField('threads', this.value)"  placeholder="Enter Threads URL" />
               
                  </div>
                  <div class="form-group col-md-4">
                    <label for="threads">Skype</label>
                    <input type="url"  class="form-control" id="skype" name="skype" value="<?php echo $web_contact['skype']; ?>"  onkeyup="updateWebContactField('skype', this.value)"  placeholder="Enter Skype URL" />
               
                  </div>
                  
                  
                </div> 
              </form>
            </div>
            </div>
            
            
           
            
            
          </div>
        </div>
     </section>
     
    
    
    
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
function updateWebContactField(field, value) {
    $.ajax({
        type: "GET",
        url: "get_data",
        data: {
            update_contact: 1,
            field: field, 
            data: value
        },
        success: function(response) {
            if (response == 1) {
                toastr.success(field + " updated successfully");
            } else {
                toastr.error("Update failed: " + response);
            }
        },
        error: function(xhr, status, error) {
            toastr.error("AJAX Error: " + error);
        }
    });
}
document.addEventListener('contextmenu', function(e) {
  e.stopPropagation(); // prevent any other handler from blocking
}, true);
</script>
</body>
</html>
