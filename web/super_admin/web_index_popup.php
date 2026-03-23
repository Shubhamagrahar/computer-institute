<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(isset($_POST['update'])){
 
      $content=VerifyData($_POST['content']);
     $hading=VerifyData($_POST['hading']);
     $b_link=VerifyData($_POST['b_link']);
     $b_name=VerifyData($_POST['b_name']);
     
     
    if(!$content=="" and !$hading==""){
       
                $update=mysqli_query($con,"update index_popup set hading='$hading', content='$content', b_link='$b_link', b_name='$b_name', update_date='$c_date' where id='1'");
               if($update){
                   echo '<script>alert("Home Page Popup Update Successfully.");window.location.assign("web_index_popup")</script>'; 
               }else{
                 echo '<script>alert("Server error 202.");window.location.assign("web_index_popup")</script>';  
               } 
         
    }else{
     echo '<script>alert("Please fill all the fields");window.location.assign("web_index_popup")</script>';   
    }
}

if(isset($_GET['status'])){
    $status=VerifyData($_GET['status']);
    $id=VerifyData($_GET['id']);
    if(!$status=="" && !$id==""){
        $update =mysqli_query($con,"update index_popup set status='$status' where id='1'");
        if($update){
            echo '<script>alert("Status update Sucessfully Done.");window.location.assign("web_index_popup");</script>';
        }else{
         echo '<script>alert("Server error 202.");window.location.assign("web_index_popup");</script>';   
        }
    }else{
      echo '<script>alert("Somthing Went Wrong.");window.location.assign("web_index_popup");</script>';   
    }
}

$popup_details=mysqli_fetch_array(mysqli_query($con,"select * from index_popup where id='1'"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Page Popup |
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
    <script src="ckeditor/ckeditor.js"></script>
    
     <style type="text/css">
          .website_drop{
    	background: #157daf !important;
    }
    
    .web_index_popup1{
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
                            <h1>Home Page Popup</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
                    
            </section>

            <!--Main Content section start-->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Home Page Popup Details</h3>
                                    <div align="right">
                                    <?php 
                                                                                
                                    if($popup_details['status']=="ACTIVE"){
                                    ?>
                                    <a href="web_index_popup?status=DEACTIVE&id=<?php echo $popup_details['id']; ?>" onclick="return confirm('Are you sure to disable the home page popup?')"><button class="btn btn-danger">HIDE</button></a>  
                                    <?php
                                    }
                                    if($popup_details['status']=="DEACTIVE"){
                                    ?>
                                    <a href="web_index_popup?status=ACTIVE&id=<?php echo $popup_details['id']; ?>" onclick="return confirm('Are you sure to enable the home page popup?')"><button class="btn btn-success">SHOW</button></a>  
                                    <?php } ?>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" name="form_2">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-12" >
                                           
                                            <label>Heading: </label>
                                            <input type="text" name="hading" id="hading" value="<?php echo $popup_details['hading']; ?>" class="form-control" placeholder="Enter content heading" >
                                           
                                            </div>
                                            <br>
                                       
                                        
                                        <div class="col-sm-12" style="margin-top:5px;">
                                            <label>Content:</label> <br>
                                            <textarea name="content" rows="5" cols="80"><?php echo $popup_details['content']; ?></textarea>
                    
                                        </div>
                                        <div class="col-12" >
                                           <label>Button Link: </label>
                                            <input type="text" name="b_link" id="b_link" value="<?php echo $popup_details['b_link']; ?>" class="form-control" placeholder="Enter button Link" >
                                           </div>
                                        <div class="col-12" >
                                           <label>Button Name: </label>
                                            <input type="text" name="b_name" id="b_name" value="<?php echo $popup_details['b_name']; ?>" class="form-control" placeholder="Enter button name" >
                                           </div>
                                        
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                         <button style="margin-bottom:10px;" name="update" class="btn btn-success">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </section>
            <!--Main content section end-->

            <!-- Main content -->
        
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
    <script>
        CKEDITOR.replace('content');
    </script>
    <script>
        function getImagePreview(event) {
            var image = URL.createObjectURL(event.target.files[0]);
            var imagediv = document.getElementById('preview');
            var newimg = document.createElement('img');
            imagediv.innerHTML = '';
            newimg.src = image;
            newimg.width = "300";
            imagediv.appendChild(newimg);
        }
       
    </script>
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