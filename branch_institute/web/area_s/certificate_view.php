<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(isset($_GET['data_id'])){
    $data_id=VerifyData($_GET['data_id']);
    if(!$data_id==""){
      
      $sql=mysqli_query($con,"select * from student_certificate where id='$data_id' and mobile='$login_details[mobile]'");
       if(mysqli_num_rows($sql)==1){
           $result=mysqli_fetch_array($sql);
          
           $name=$result['name'];
           $enrollment_no=$result['enrollment_no'];
           $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$result[course_id]'"));
           
        //   $date=date_create($result['date']);
        //   $date=date_format($date,"d MM Y");
           
       }else{
        echo '<script>window.close();</script>';  
        exit();
       } 
    }else{
        echo '<script>window.close();</script>';
        exit();
    }
}else{
    echo '<script>window.close();</script>';
    exit();
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Certificate | <?php echo $brand_name; ?></title>
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
    
    <style type="text/css">
          .certificate_drop{
    	background: #157daf !important;
    }
    
    .certificate_all1{
    	background: #157daf !important;
    }
    .container_box {
	margin: 0 auto;
	max-width: 1000px;
	padding: 20px;
	/*background-color: #fff;*/
	border-radius: 10px;
	box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
	 /*background-image: url(https://www.pngkey.com/png/full/724-7247106_confetti-party-celebrate-parties-celebrations.png);*/
	 background-image: linear-gradient(148deg, #07A3B2, #D9ECC7);
}

.verify_logo{
    max-width: 156px;
    width: 57%;
}

.certificate_img{
    max-width: 800px;
    width: 80%;
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
                            <h1>View Certificate</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>


           
            
            
           
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Certificate </h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                
                        <div class="card-body ">
                            <div class="row" >
                                <div class="col-sm-12" align="center">
                               <div class="col-sm-12 container_box" >
                        <div align="center">
                            <img class="verify_logo" src="../img_logo/verify1.webp" alt="Verified">
                        <h1 style="font-size: 30px; font-weight: 800; color: black; font-family: initial;">Congratulations!</h1>
                        <p style="font-size: 16px; font-weight: 800; color: black; font-family: ui-sans-serif;">Name: <?php echo $name; ?></p>
                       <p style="font-size: 16px; font-weight: 800; color: black; font-family: ui-sans-serif;">Enrollment No: <?php echo $enrollment_no; ?></p>
                       
                       <p style="color: black; font-family: ui-sans-serif;">You have successfully completed the <strong style="color: black;"><?php echo $course_details['name']; ?></strong> course. Click on the download button given below to download your certificate.</p>
                    </div> 
                    <br>
                    <div class="" align="center">
                        <img style="border: 2px solid white; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 1.2);" class="certificate_img" src="<?php echo $web_link.$result['img_certificate']; ?>" alt="certificate">
                    
                    </div>
                    <br>
                    <div class="" align="center">
                         <a  href="<?php echo $web_link.$result['img_certificate']; ?>" download ><button class="btn btn-success"><i class="fa fa-download" aria-hidden="true"></i> Download Certificate</button></a>
                    
                    </div>
                    
                   
                    </div>
                                            
                     <div class="" align="center">
                         <br>
                         <button onclick="window.close();" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> View All Certificate</button>
                    
                    </div> 
                    </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                            </div>
                            
                        </div>
                        
                        
                    </div>
                </div>
               
            </section>
            
           
            <!--Main content section end-->

            
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
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- Page specific script -->
     <script>
	
    		function get_fee(val){
    		  
    		    $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'fee_details='+val,
                success: function(data){
                    
                    if(data>0){
                        
                    document.getElementById("course_fee_label").style.display="block";
                   
                 $("#course_fee").val(data);
                    }
                }
              }
              );
    		}
    		
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