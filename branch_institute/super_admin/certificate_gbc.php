<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");


if(isset($_POST['final_submit'])){
    
     $name=VerifyData($_POST['name']);
     $f_name=VerifyData($_POST['f_name']);
     $m_name=VerifyData($_POST['m_name']);
     $enrollment_no=VerifyData($_POST['enrollment_no']);
     $dob=VerifyData($_POST['dob']);
     $course=VerifyData($_POST['course']);
     $reg_date=VerifyData($_POST['reg_date']);
     $com_date=VerifyData($_POST['com_date']);
     $issue_date=VerifyData($_POST['issue_date']);
     $duration=VerifyData($_POST['duration']);
     $grade=VerifyData($_POST['grade']);
     $division=VerifyData($_POST['division']);
     
     if(!$name=="" && !$f_name=="" && !$m_name=="" && !$enrollment_no=="" && !$dob=="" && !$course=="" && !$reg_date=="" && !$com_date=="" && !$issue_date=="" && !$duration=="" && !$grade=="" && !$division==""){
         
        $sql_check=mysqli_num_rows(mysqli_query($con,"select * from student_certificate where enrollment_no='$enrollment_no' and course_id='$course'"));
        if(!$sql_check>0){
             $Insert_certificate=mysqli_query($con,"insert into  `student_certificate_gbc`(`name`, `f_name`, `m_name`, `enrollment_no`, `dob`, `course_id`, `reg_date`, `com_date`, `issue_date`, `duration`, `grade`, `division`, `create_date`, `create_by`) values('$name', '$f_name', '$m_name', '$enrollment_no', '$dob', '$course', '$reg_date', '$com_date', '$issue_date', '$duration', '$grade', '$division', '$t_date', '$_SESSION[userid]')");
                if($Insert_certificate){
                    echo '<script>alert("The certificate created successfully done.");window.location.assign("certificate_gbc")</script>';
                }else{
                echo '<script>alert("Server error 101.");window.location.assign("certificate_gbc")</script>';
            }
             
            
        }else{
          echo '<script>alert("This course certificate has been already generated for this student.");window.location.assign("certificate_gbc")</script>';  
        }
         
         
     }else{
        echo '<script>alert("Please fill all fields.");window.location.assign("certificate_gbc")</script>';
    }
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Certificate | <?php echo $brand_name; ?></title>
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
    
    .certificate_create1{
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
                            <h1>Create Certificate</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>


            <!--Main Content section start-->
            
            
           
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                             <form method="post" name="form_5" enctype="multipart/form-data">
                            
                                    
                                    
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Certificate Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                               
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <lable>Enrollment No:</lable>
                                                <input type="text" required name="enrollment_no" value="" class="form-control" placeholder="Enter enrollment number.">
                                            </div>
                                            <div class="col-md-6">
                                                <lable>Candidate Name:</lable>
                                                <input type="text" required name="name" value="" class="form-control" placeholder="Enter candidate name.">
                                            </div>
                                           
                                            <div class="col-md-6" id="course_fee_label" >
                                                 <lable >Father's Name:</lable>
                                                 <input type="text" id="f_name"  class="form-control" name="f_name"  value="" required placeholder="Enter father's name.">
                                            </div>
                                            <div class="col-md-6" id="course_fee_label" >
                                                 <lable >Mother's Name:</lable>
                                                 <input type="text" id="m_name"  class="form-control" name="m_name"  value="" required placeholder="Enter mother's name.">
                                            </div>
                                            <div class="col-md-6" id="course_fee_label" >
                                                 <lable >Date of Birth:</lable>
                                                 <input type="date" id="dob"  class="form-control" name="dob"  value="" required placeholder="Enter certificate number.">
                                            </div>
                                            <div class="col-md-6" id="course_fee_label" >
                                                 <lable>Course</lable>
                                                 <select name="course" required class="form-control">
                                                   <option value="">Select Course</option> 
                                                   <?php
                                                   $sql_course=mysqli_query($con,"select * from course_details order by id desc ");
                                                   while($row=mysqli_fetch_array($sql_course)){
                                                       ?>
                                                       <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option> 
                                                       <?php
                                                   }d
                                                   ?>
                                                 </select>
                                            </div>
                                             <div class="col-md-6" id="course_fee_label" >
                                                 <lable >Registration Date:</lable>
                                                 <input type="date" id="reg_date"  class="form-control" name="reg_date"  value="" required placeholder="Enter registration date.">
                                            </div>
                                             <div class="col-md-6" id="course_fee_label" >
                                                 <lable >Complete Date:</lable>
                                                 <input type="date" id="com_date"  class="form-control" name="com_date"  value="" required placeholder="Enter complete date.">
                                            </div>
                                             <div class="col-md-6" id="course_fee_label" >
                                                 <lable >Issue Date:</lable>
                                                 <input type="date" id="issue_date"  class="form-control" name="issue_date"  value="" required placeholder="Enter issue date.">
                                            </div>
                                            <div class="col-md-6" id="course_fee_label" >
                                                 <lable >Duration:</lable>
                                                 <input type="number" id="duration"  class="form-control" name="duration"  value="" required placeholder="Enter duration.">
                                            </div>
                                            <div class="col-md-6" id="course_fee_label" >
                                                 <lable >Grade:</lable>
                                                 <input type="text" id="grade"  class="form-control" name="grade"  value="" required placeholder="Enter grade.">
                                            </div>
                                            <div class="col-md-6" id="course_fee_label" >
                                                 <lable >Division:</lable>
                                                 <input type="text" id="division"  class="form-control" name="division"  value="" required placeholder="Enter division.">
                                            </div>
                                          </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer"> 
                                        <button type="submit" name="final_submit" id="submit"
                                             class="btn btn-primary">Submit</button>
                                       
                                    </div>
                                </div>
                                    
                                    
                                    
                            
                            
                            </form>
                        </div>
                        
                        
                    </div>
                </div>
            </section>
            <!--<div class="container">-->
            <!--    <div class="row">-->
            <!--        <div class="col-sm-12">-->
            <!--        <p style="font-size:14px;color:red;"><strong>*</strong>The certificate file format should be JPG or PNG or JPEG.</p>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
           
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