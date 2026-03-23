<?php
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

// Update Header Background Color
if (isset($_POST['save_header_bg'])) {
    $bgColor = $_POST['header_bg_color'];
    // $sql = "UPDATE website_data SET header_bg_color='$bgColor'";
    $sql = "UPDATE website_data SET header_bg_color='$bgColor' WHERE id=1;";
    mysqli_query($con, $sql);
}

// Update Header Text Color
if (isset($_POST['save_header_text'])) {
    $textColor = $_POST['header_text_color'];
    // $sql = "UPDATE website_data SET header_text_color='$textColor'";
    $sql = "UPDATE website_data SET header_text_color='$textColor' WHERE id=1;";
    mysqli_query($con, $sql);
}


// Fetch current values
$result = mysqli_query($con, "SELECT header_bg_color, header_text_color FROM website_data LIMIT 1");
$row = mysqli_fetch_assoc($result);
$headerBgColor = $row['header_bg_color'] ?? '#ffffff'; // default fallback
$headerTextColor = $row['header_text_color'] ?? '#000000';

// Footer Theme


if (isset($_POST['save_footer_bg'])) {
    $bgColor = $_POST['footer_bg_color'];
    // $sql = "UPDATE website_data SET header_bg_color='$bgColor'";
    $sql = "UPDATE website_data SET footer_bg_color='$bgColor' WHERE id=1;";
    mysqli_query($con, $sql);
}

// Update Header Text Color
if (isset($_POST['save_footer_text'])) {
    $textColor = $_POST['footer_text_color'];
    // $sql = "UPDATE website_data SET header_text_color='$textColor'";
    $sql = "UPDATE website_data SET footer_text_color='$textColor' WHERE id=1;";
    mysqli_query($con, $sql);
}


// Fetch current values
$result = mysqli_query($con, "SELECT footer_bg_color, footer_text_color FROM website_data LIMIT 1");
$row = mysqli_fetch_assoc($result);
$footerBgColor = $row['footer_bg_color'] ?? '#21466c'; // default fallback
$footerTextColor = $row['footer_text_color'] ?? '#ffffff';




// Button Theme


if (isset($_POST['save_button_bg'])) {
    $bgColor = $_POST['button_bg_color'];
    $sql = "UPDATE website_data SET button_bg_color='$bgColor' WHERE id=1;";
    mysqli_query($con, $sql);
}

// Update Header Text Color
if (isset($_POST['save_button_text'])) {
    $textColor = $_POST['button_text_color'];
    $sql = "UPDATE website_data SET button_text_color='$textColor' WHERE id=1;";
    mysqli_query($con, $sql);
}


// Fetch current values
$result = mysqli_query($con, "SELECT button_bg_color, button_text_color FROM website_data LIMIT 1");
$row = mysqli_fetch_assoc($result);
$buttonBgColor = $row['button_bg_color'] ?? '#000000'; 
$buttonTextColor = $row['button_text_color'] ?? '#ffffff';




//Breadcrumb Image

if (isset($_POST['update_img'])) {
    $photo = $_FILES["upload_file"]["name"];
    $photo2 = $_FILES["upload_file"]["tmp_name"];

   
    if ($content == "" && $photo == "") {
        echo '<script>alert("Please fill at least one field.");window.location.assign("web_theme")</script>';
        exit;
    }

    $check_name = mysqli_num_rows(mysqli_query($con, "SELECT * FROM website_data WHERE id='1'"));
    
    if ($check_name > 0) {
        $update_query = "UPDATE website_data SET "; 

        if ($photo != "") {
            $extension12 = explode(".", $photo);
            $extension1 = end($extension12);
            $nn_name = rand(1000, 9999);
            $newfilename1 = $_SESSION['userid'] . $nn_name . "." . $extension1;
            $photo_dr = "super_admin/user_img/" . $newfilename1;
            $upload_photo = move_uploaded_file($photo2, "user_img/" . $newfilename1);

            if ($upload_photo) {
                $update_query .= "bread_img='$photo_dr', "; 
            } else {
                echo '<script>alert("Image uploading failed.");window.location.assign("web_theme")</script>';
                exit;
            }
        }

        if ($content != "") {
            $update_query .= "intro_des='$content', "; 
        }

        $update_query = rtrim($update_query, ", ") . " WHERE id='1'";

        $update = mysqli_query($con, $update_query);

        if ($update) {
            echo '<script>alert("Breadcrumb Image Updated Successfully.");window.location.assign("web_theme")</script>';
        } else {
            echo '<script>alert("Server error 101.");window.location.assign("web_theme")</script>';
        }
    } else {
        echo '<script>alert("Server error 201.");window.location.assign("web_theme")</script>';
    }
}


$web_details=mysqli_fetch_array(mysqli_query($con,"select * from website_data where id='1'"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Web Theme |  <?php echo $brand_name; ?></title>
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
      .website_drop{
	background: #157daf !important;
}

.web_theme{
	background: #157daf !important;
}


.form-control {
    padding: 0;
    width: 50%;
}
.header {
    display: flex;
}
.card-footer {
    display: inline-block;
}
.img-form {
    padding: 3px;
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
            <div class="col-md-10" style="margin: auto;">
                
                <!-- Preview -->


                <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Header Theme</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
              <div class="header">
                  <div class="header_bg col-md-6">
                      <form method="post">
                          <div class="form-group col-md-12 mb-6">
                            <label for="header_bg_color" class="form-label fw-semibold">Header Background Color</label>
                            <input type="color" name="header_bg_color" id="header_bg_color" class="form-control form-control-color rounded-3 shadow-sm" value="<?php echo htmlspecialchars($headerBgColor); ?>" title="Choose Header Background color">
                          </div>
                          <div class="card-footer">
                            <button type="submit" name="save_header_bg" class="btn btn-primary">Save Header Background</button>
                          </div>
                        </form>
                  </div>
                  <div class="header_text col-md-6">
                      <form method="post">
                          <div class="form-group col-md-12 mb-6">
                            <label for="header_text_color" class="form-label fw-semibold">Header Text Color</label>
                            <input type="color" name="header_text_color" id="header_text_color" class="form-control form-control-color rounded-3 shadow-sm" value="<?php echo htmlspecialchars($headerTextColor); ?>" title="Choose Header Text color">
                          </div>
                          <div class="card-footer">
                            <button type="submit" name="save_header_text" class="btn btn-primary">Save Header Text</button>
                          </div>
                        </form>
                  </div>
              
              </div>
            </div>
            
            
            
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Footer Theme</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
              <div class="header">
                  <div class="header_bg col-md-6">
                      <form method="post">
                        
                        <div class="form-group col-md-12 mb-6">
                            <label for="tagColor" class="form-label fw-semibold">Footer Background Color</label>
                            <input type="color" name="footer_bg_color" id="footer_bg_color" class="form-control form-control-color rounded-3 shadow-sm" value="<?php echo htmlspecialchars($footerBgColor); ?>" title="Choose footer Background color">
                        </div>
        
                        <div class="card-footer">
                          <!--<button type="submit" name="create" class="btn btn-primary">Create</button>-->
                           <button type="submit" name="save_footer_bg" class="btn btn-primary">Save Footer Background</button>
                        </div>
                      </form>
                  </div>
                  <div class="header_text col-md-6">
                      <form method="post">
                        
                        <div class="form-group col-md-12 mb-6">
                            <label for="tagColor" class="form-label fw-semibold">Footer Text Color</label>
                            <input type="color" name="footer_text_color" id="footer_text_color" class="form-control form-control-color rounded-3 shadow-sm" value="<?php echo htmlspecialchars($footerTextColor); ?>" title="Choose Footer Text color">
                        </div>
        
                        <div class="card-footer">
                          <!--<button type="submit" name="create" class="btn btn-primary">Create</button>-->
                           <button type="submit" name="save_footer_text" class="btn btn-primary">Save Footer Text</button>
                        </div>
                      </form>
                  </div>
              
              </div>
            </div>
            
            
            
            
            <!--Button-->
            
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Button Theme</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
              <div class="header">
                  <div class="header_bg col-md-6">
                      <form method="post">
                        
                        <div class="form-group col-md-12 mb-6">
                            <label for="tagColor" class="form-label fw-semibold">Button Background Color</label>
                            <input type="color" name="button_bg_color" id="button_bg_color" class="form-control form-control-color rounded-3 shadow-sm" value="<?php echo htmlspecialchars($buttonBgColor); ?>" title="Choose footer Background color">
                        </div>
        
                        <div class="card-footer">
                          <!--<button type="submit" name="create" class="btn btn-primary">Create</button>-->
                           <button type="submit" name="save_button_bg" class="btn btn-primary">Save Button Background</button>
                        </div>
                      </form>
                  </div>
                  <div class="header_text col-md-6">
                      <form method="post">
                        
                        <div class="form-group col-md-12 mb-6">
                            <label for="tagColor" class="form-label fw-semibold">Button Text Color</label>
                            <input type="color" name="button_text_color" id="button_text_color" class="form-control form-control-color rounded-3 shadow-sm" value="<?php echo htmlspecialchars($buttonTextColor); ?>" title="Choose Footer Text color">
                        </div>
        
                        <div class="card-footer">
                           <button type="submit" name="save_button_text" class="btn btn-primary">Save Button Text</button>
                        </div>
                      </form>
                  </div>
              
              </div>
            </div>
            
            
            
            <!--Breadcrumb-->
            
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Breadcrumb Image</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
              <div class="header">
                  <div class="header_bg col-md-12">
                      <form method="post" name="form_2" enctype="multipart/form-data">
                        
                        <div class="col-12" align="center">
                                           
                            <lable>Breadcrumb Image : </lable>
                            <input type="file" name="upload_file" class="form-control img-form" placeholder="Enter Name"
                                id="upload_file" onchange="getImagePreview(event)">
                                                
                            <br>
                            <!--image preview div-->
                            <div id="preview">
                                <img src="<?php echo $web_link.$web_details['bread_img'] ?>" width="300">
                            </div>
                                            
                    
                        </div>
        
                        <div class="card-footer">
                          <!--<button type="submit" name="create" class="btn btn-primary">Create</button>-->
                           <button type="submit" name="update_img" class="btn btn-primary">Update Image</button>
                        </div>
                      </form>
                  </div>
              
              </div>
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

<script>
    document.addEventListener("contextmenu", (event) => {
    event.stopPropagation(); 
 }, true);
</script>


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
    
</body>
</html>
