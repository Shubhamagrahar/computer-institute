<?php 
include 'session.php';

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");
unset($_SESSION['cert_edit_refer_url']);

$start=1;
 $student_photo="";
if(isset($_POST['Next_process'])){
    $mobile=VerifyData($_POST['mobile']);
    if(!$mobile==""){
       
        $check=mysqli_query($con,"select * from user where mobile='$mobile'");
        if(mysqli_num_rows($check)==1){
          $start=2; 
          $result=mysqli_fetch_array($check);
          $name=$result['name'];
          $email_id=$result['email'];
          $dob=$result['dob'];
          $father_name=$result['father_name'];
          $gender=$result['gender'];
          $student_photo=$result['photo'];
        }else{
          $start=2; 
          $name="";
          $email_id="";
          $dob="";
          $father_name="";
          $gender="";
          
        }
        
    }else{
        echo '<script>alert("Please enter mobile number.");window.location.assign("certificate_create")</script>';
    }
}



if(isset($_POST['final_submit'])){
    $photo = $_FILES["upload_file1"]["name"];
    $photo2 = $_FILES["upload_file1"]["tmp_name"];
    $name=VerifyData($_POST['name']);
    $father_name=VerifyData($_POST['father_name']);
    $mobile=VerifyData($_POST['mobile']);
    $email=VerifyData($_POST['email']);
    $enrollment_no=VerifyData($_POST['enrollment_no']);
    $certificate_no=VerifyData($_POST['certificate_no']);
    $dob=VerifyData($_POST['dob']);
    $course=VerifyData($_POST['course']);
    $start_date=VerifyData($_POST['start_date']);
    $complete_date=VerifyData($_POST['complete_date']);
    $issue_date=VerifyData($_POST['issue_date']);
    $gender=VerifyData($_POST['gender']);
    $student_img_old=VerifyData($_POST['student_img_old']);
     
    //  if($gender=="Male"){
    //      $ins_name=$name." S/O ".$father_name;
    //  }
    //  if($gender=="Female"){
    //      $ins_name=$name." D/O ".$father_name;
    //  }
    //  if($gender=="Other"){
    //      $ins_name=$name." C/O ".$father_name;
    //  }
     
     if(!$father_name=="" and !$name=="" and !$mobile=="" and !$enrollment_no=="" and !$course=="" and !$gender=="" and !$start_date=="" and !$complete_date=="" and !$issue_date==""){
         
        $sql_check=mysqli_num_rows(mysqli_query($con,"select * from student_certificate where mobile='$mobile' and course_id='$course'"));
        if(!$sql_check>0){
            
            //   $check_marks=mysqli_num_rows(mysqli_query($con,"select * from certificate_marks_details where mobile='$mobile' and course_id='$course' and obt_mark<1"));
            //   if(!$check_marks>0){
             $check_certificate_no=mysqli_num_rows(mysqli_query($con,"select * from student_certificate where certificate_no='$certificate_no'"));
               if(!$check_certificate_no>0){
                if(!$photo=="") {  
                $extension12 = explode(".", $photo);
                $extension1 = end($extension12); 
                $nn_name = rand(10000,99999);
                $newfilename1 =$mobile.$nn_name.".".$extension1;
                $photo_dr="area_s/user_img_certificate/".$newfilename1 ;
                //$upload_photo= move_uploaded_file($photo2,"../area_s/user_img/".$newfilename1) ;
                $upload_photo=uplodImageByResize($photo2,$newfilename1,"../area_s/user_img_certificate/");
                }else{
                  
                //   $ext_file=explode("/", $student_img_old);
                //   $ext_file=end($ext_file);
                  $extension12 = explode(".", $student_img_old);
                $extension1=end($extension12); 
                $nn_name = rand(10000,99999);
                $newfilename1 =$mobile.$nn_name.".".$extension1;
                $photo_dr="area_s/user_img_certificate/".$newfilename1 ;
                //$upload_photo= move_uploaded_file($photo2,"../area_s/user_img/".$newfilename1) ;
                $upload_photo=uplodImageByResize("../".$student_img_old,$newfilename1,"../area_s/user_img_certificate/");
                }
               
                if($upload_photo==1){
                 $Insert_certificate=mysqli_query($con,"insert into  `student_certificate`(`name`, `mobile`, `father_name`, `email`, `gender`, `certificate_no`, `enrollment_no`, `dob`, `photo`, `course_id`, `start_date`, `complete_date`, `upload_date`, `c_date`, `create_by`) values('$name', '$mobile', '$father_name', '$email', '$gender', '$certificate_no', '$enrollment_no', '$dob', '$photo_dr', '$course', '$start_date', '$complete_date', '$issue_date', '$t_date', '$_SESSION[userid]')");
                if($Insert_certificate){
                    $insert_id=mysqli_insert_id($con);
                    $update_msrks=mysqli_query($con,"update certificate_marks_details set student_certificate_id='$insert_id' where mobile='$mobile' and course_id='$course'");
                   if($update_msrks) {
                     
                     $sql_req=mysqli_query($con,"select * from student_certificate_request where mobile='$mobile' and course_id='$course' and status='OPEN'") ; 
                      if(mysqli_num_rows($sql_req)==1) {
                        $result1=mysqli_fetch_array($sql_req)  ;
                        $update_req=mysqli_query($con,"update student_certificate_request set status='DONE' where id='$result1[id]'");
                        if($update_req){
                           echo '<script>alert("The certificate created successfully done.");window.location.assign("certificate_create")</script>'; 
                        }else{
                         echo '<script>alert("Server error 104.");window.location.assign("certificate_create")</script>';    
                        }
                      }else{
                    echo '<script>alert("The certificate created successfully done.");window.location.assign("certificate_create")</script>';
                    }  
                    }else{
                     echo '<script>alert("Server error 103.");window.location.assign("certificate_create")</script>';  
                   }
                }else{
                echo '<script>alert("Server error 101.");window.location.assign("certificate_create")</script>';
                 }
                }else{
                 echo '<script>alert("Photo Upload Failed ('.$upload_photo.').");window.location.assign("certificate_create");</script>';     
                }
               }else{
                 echo '<script>alert("This certificate number already generated.");window.location.assign("certificate_create")</script>';  
               } 
        }else{
          echo '<script>alert("This course certificate has been already generated for this student.");window.location.assign("certificate_create")</script>';  
        }
         
         
     }else{
        echo '<script>alert("Please fill all fields.");window.location.assign("certificate_create")</script>';
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
                            <h1>Create Certificate & Marksheet</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>


            <!--Main Content section start-->
            <?php 
            if($start==1){
            ?>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-4">
                            
                        </div>
                        <div class="col-4">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Create Certificate & Marksheet</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" name="form_23">
                                    <div class="card-body ">
                                        <div class="row">
                                           
                                            <div class="col-md-12">
                                                <label>Mobile No.:</label>
                                                <input type="text" required name="mobile" value="" class="form-control" placeholder="Enter mobile number.">
                                            </div>
                                          
                                           
                                           
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" name="Next_process" class="btn btn-primary">Next</button>
                                       
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </section>
            <?php }?>
            
            
            <?php 
            if($start==2){
            ?>
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
                                            
                                           
                                             <div class="col-md-12" align="center">
                                          
                                            <label>Student Photo: <span style="color:red;">*</span></label>
                                            <input type="file" name="upload_file1" class="form-control" placeholder=""
                                                id="upload_file"  onchange="getImagePreview(event)">
                                                
                                            <br>
                                            <!--image preview div-->
                                            <div id="preview">
                                              <img width="120px" src="<?php echo $web_link.$student_photo; ?>">
                                            </div>
                    
                                        </div>
                                        <div>
                                            <input type="text" name="student_img_old" value="<?php echo $student_photo;?>" hidden>
                                        </div>
                                        
                                            <div class="col-md-4">
                                                <label>Name: <span style="color:red;">*</span></label>
                                                <input type="text" required name="name" value="<?php echo $name; ?>" class="form-control" placeholder="Enter student name.">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Mobile No.: <span style="color:red;">*</span></label>
                                                <input type="text" readonly name="mobile" id="mobile" value="<?php echo $mobile; ?>" class="form-control" placeholder="Enter mobile number.">
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <label>Fathre Name: <span style="color:red;">*</span></label>
                                                <input type="text" required name="father_name" value="<?php echo $father_name; ?>" class="form-control" placeholder="Enter father name.">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Gender: <span style="color:red;">*</span></label>
                                                <select name="gender" id="gender" required="" class="form-control">
                                                   <option value="">Select </option>
                                                    <option value="Male">Male </option>
                                                    <option value="Female">Female </option>
                                                    <option value="Other">Other </option>
                                                </select>
                                            </div>
                                            
                                           <div class="col-md-4">
                                                <label>Email:</label>
                                                <input type="email" name="email" value="<?php echo $email_id; ?>" class="form-control" placeholder="Enter email Id.">
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <label>Certificate No.: <span style="color:red;">*</span></label>
                                                <input type="text" required name="certificate_no" value="" class="form-control" placeholder="Enter certificate number.">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Enrollment No.: <span style="color:red;">*</span></label>
                                                <input type="text" required name="enrollment_no" value="" class="form-control" placeholder="Enter enrollment number.">
                                            </div>
                                            <div class="col-md-4" id="course_fee_label" >
                                                 <label >Date of Birth:</label>
                                                 <input type="date" id="dob"  class="form-control" name="dob"  value="<?php echo $dob; ?>" placeholder="">
                                            </div>
                                            <div class="col-md-4" id="course_fee_label" >
                                                 <label>Course: <span style="color:red;">*</span></label>
                                                 <select name="course" id="course" required class="form-control" onchange="get_subject_date_by_course(mobile.value,this.value)">
                                                   <option value="">Select Course</option> 
                                                   <?php
                                                   $sql_course=mysqli_query($con,"select * from course_details order by id desc ");
                                                   while($row=mysqli_fetch_array($sql_course)){
                                                       ?>
                                                       <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option> 
                                                       <?php
                                                   }
                                                   ?>
                                                   
                                                 </select>
                                            </div>
                                           
                                            
                                            
                                        </div>
                                         <div class="row" id="course_dated">
                                            
                                            
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    </div>
                            
                            <div id="certificate_mark_details">
                           
                            
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
            
            
            
            
            <?php } ?>
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
      function course_get_dated(course_id,mob){
          
           $.ajax(
                      {
                        type:"GET",
                        url:"get_data",
                        data:'course_dated_data_get='+course_id+'&mob='+mob,
                        success: function(data){
                        $("#course_dated").html(data);
                        }
                      }
                      );
          
      }
      function get_data_per(val){
         
          $.ajax(
                      {
                        type:"GET",
                        url:"get_data",
                        data:'data_per_get='+val,
                        success: function(data){
                        $("#data_per_span").html(data);
                        }
                      }
                      );
      }
       function data_insert_marks(val,val2){
           $.ajax(
                      {
                        type:"GET",
                        url:"get_data",
                        data:'data_insert_marks='+val+'&data='+val2,
                        success: function(data){
                       get_data_per(val); 
                        }
                      }
                      );
       }
     
       function get_subject_date_by_course(val,val2){
          
                 $.ajax(
                      {
                        type:"GET",
                        url:"get_data",
                        data:'get_subject_data_by_cr_mob='+val+'&course_id='+val2,
                        success: function(data){
                            if(data==1){
                               alert("Selected course certificate already issue for this condidate.");
                               $("#certificate_mark_details").html("");
                               $("#course").val("");
                            }else{
                                $("#certificate_mark_details").html(data);
                                course_get_dated(val2,val);
                            }
                        }
                      }
                      );
       }
     
     
      <?php 
      if(isset($gender)){
       if(!$gender==""){
           ?>
           
          $("#gender").val('<?php echo $gender ; ?>');
           <?php 
       }
      }
      ?>
	
    		
    		
    	</script>
    	<script>
        function getImagePreview(event) {
            var image = URL.createObjectURL(event.target.files[0]);
            var imagediv = document.getElementById('preview');
            var newimg = document.createElement('img');
            imagediv.innerHTML = '';
            newimg.src = image;
            newimg.width = "120";
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