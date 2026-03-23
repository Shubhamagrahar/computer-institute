<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");
unset($_SESSION['cert_edit_refer_url']);

if(isset($_GET['delete_id'])){
    $id=VerifyData($_GET['delete_id']);
    if(!$id==""){
        $sql=mysqli_query($con,"select * from student_certificate where id='$id'");
        if(mysqli_num_rows($sql)==1){
            $result=mysqli_fetch_array($sql);
            $photo=end(explode("/",$result['img_certificate']));
            $unlink=unlink("certificate_img/".$photo);
            if($unlink){
                $delete=mysqli_query($con,"delete from student_certificate where id='$id'");
                if($delete){
                    echo '<script>alert("Certificate deleted successfully done.");window.location.assign("certificate_all")</script>';
                }else{
                   echo '<script>alert("Server Error 103.");window.location.assign("certificate_all")</script>'; 
                }
            }else{
             echo '<script>alert("Server Error 102.");window.location.assign("certificate_all")</script>';    
            }
            
        }else{
          echo '<script>alert("Server Error 101.");window.location.assign("certificate_all")</script>';  
        }
        
    }else{
        echo '<script>alert("Something went wrong.");window.location.assign("certificate_all")</script>';
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Certificate | <?php echo $brand_name; ?></title>
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
                            <h1>All Verified Certificate</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>


           
           
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">All Verified Certificate Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <!--<th>Email</th>-->
                                                <!--<th>Date Of Birth</th>-->
                                                <th>Certificate No.</th>
                                                <th>Course Name</th>
                                                <th>create Date</th>
                                                <th>Certificate</th>
                                                <th>Marksheet</th>
                                              <th width="60px">Action</th>
                                                
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php
                                            $i=0;
                                            
                                            
                                            $sql_certificate=mysqli_query($con,"select * from student_certificate where status='VERIFY' order by id desc");
                                            while($row=mysqli_fetch_array($sql_certificate)){
                                            $date_dob=date_create($row['dob']);
                                             $date_dob=date_format($date_dob,"d-m-Y");
                                             $date_upload=date_create($row['upload_date']);
                                             $date_upload=date_format($date_upload,"d-m-Y");
                                           $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$row[course_id]'"));
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['mobile']; ?></td>
                                                <!--<td><?php echo $row['email']; ?></td>-->
                                                <!--<td><?php echo $date_dob; ?></td>-->
                                                <td><?php echo $row['certificate_no']; ?></td>
                                                <td><?php echo $course_details['name'];?></td>
                                                <td><?php echo $date_upload; ?></td>
                                               <td><a title="Print Certificate" target="_blank" style="color:blue;" href="print_certificate?data_id=<?php echo $row['id'] ;?>"><i class="fa fa-print" aria-hidden="true"></i> Print</a></td>
                                             <td><a title="Print Certificate" target="_blank" style="color:blue;" href="print_marksheet?data_id=<?php echo $row['id'] ;?>"><i class="fa fa-print" aria-hidden="true"></i> Print</a></td>
                                             <td><a title="Edit Certificate" onclick="return confirm('Are you sure for edit this certificate?')" style="color:blue;" href="certificate_edit?data_id=<?php echo $row['id'] ;?>"><i class="fa fa-edit" aria-hidden="true"></i>Edit</a></td>
                                            </tr>
                                            
                                          <?php }  ?>  
                                        </tbody>

                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            
                            
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