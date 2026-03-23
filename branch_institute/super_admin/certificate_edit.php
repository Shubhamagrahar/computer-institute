<?php 
include 'session.php';

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

//unset($_SESSION['cert_edit_refer_url']);

if(isset($_SESSION['cert_edit_refer_url'])){
   $refer_url = $_SESSION['cert_edit_refer_url'];
}else{

$_SESSION['cert_edit_refer_url']=$_SERVER['HTTP_REFERER'];
$refer_url = $_SESSION['cert_edit_refer_url'];
}
if(isset($refer_url)){
    
}else{
    echo '<script>window.location.assign("index");</script>';
    mysqli_close($con);
    exit();
}


if(isset($_GET['data_id'])){
    $data_id=VerifyData($_GET['data_id']);
    if(!$data_id==""){
      
      $sql=mysqli_query($con,"select * from student_certificate where id='$data_id'");
       if(mysqli_num_rows($sql)==1){
           $go_move_update_url="certificate_edit?data_id=$data_id";
           $result=mysqli_fetch_array($sql);
          
            $name=$result['name'];
            $father_name=$result['father_name'];
            $mobile=$result['mobile'];
            $enrollment_no=$result['enrollment_no'];
            $email_id=$result['email'];
            $certificate_no=$result['certificate_no'];
            $photo=$result['photo'];
            // $examination_year=$result['examination_year'];
            $gender=$result['gender'];
            // $course_certificate_type=$result['certificate_type'];
            $course_id=$result['course_id'];
            // $eng_typing_speed=$result['eng_typing_speed'];
            // $hin_typing_speed=$result['hin_typing_speed'];
            // $eng_typing_accuracy=$result['eng_typing_accuracy'];
            // $hin_typing_accuracy=$result['hin_typing_accuracy'];
            // $secured_mark=$result['secured_mark'];
            $issue_date=$result['upload_date'];
            $dob=$result['dob'];
            // $dob=date_format($dob,"d-M-Y");
            $start_date=$result['start_date'];
            $complete_date=$result['complete_date'];
           
       }else{
            mysqli_close($con);
        echo '<script>alert("Certificate Number Not Valid.");window.close();</script>';  
        exit();
       } 
    }else{
         mysqli_close($con);
        echo '<script>window.close();</script>';
        exit();
    }
}else{
     mysqli_close($con);
    echo '<script>window.close();</script>';
    exit();
}



if(isset($_POST['update_photo'])){
     $photo = $_FILES["photo"]["name"];
     $photo2 = $_FILES["photo"]["tmp_name"];
     if(!$photo==""){ 
            $extension12 = explode(".", $photo);

             $extension1 = end($extension12);
          
            $nn_name = rand(1000,9999);
            $newfilename1 =$result['id'].$nn_name.".".$extension1;
            $photo_dr="area_s/user_img_certificate/".$newfilename1 ;
            // $upload_photo= move_uploaded_file($photo2,"../area_s/user_img/".$newfilename1) ;
             $upload_photo=uplodImageByResize($photo2,$newfilename1,"../area_s/user_img_certificate/");
        if($upload_photo==1){
            $update_dr=mysqli_query($con,"update student_certificate set photo='$photo_dr' where id='$result[id]'");
            if($update_dr){
                
                $last_check=end(explode("/",$result['photo']));
                
                if($last_check=="user.jpg"){
                   $unlink_p="1" ;
                }else{
                     $unlink_p=unlink("../area_s/user_img_certificate/".$last_check);
                 
                }
                
                if($unlink_p){
                    echo '<script>alert("Photo update successfully done.");window.location.assign("'.$go_move_update_url.'");</script>';
                }else{
        echo '<script>alert("Old Photo Unlink Failed.");window.location.assign("'.$go_move_update_url.'");</script>';
     }
                
            }else{
        echo '<script>alert("Photo Dir Update Failed.");window.location.assign("'.$go_move_update_url.'");</script>';
     }
            
            
        }else{
        echo '<script>alert("Photo Upload Failed ('.$upload_photo.').");window.location.assign("'.$go_move_update_url.'");</script>';
     }
        
     }else{
        echo '<script>alert("Please Select Photo.");window.location.assign("'.$go_move_update_url.'");</script>';
     }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Certificate Edit| <?php echo $brand_name; ?></title>
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
          .certificate_drop{
    	background: #157daf !important;
    }
    
    /*.certificate_create1{*/
    /*	background: #157daf !important;*/
    /*}*/
    
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
                            <h1>Certificate Edit</h1>
                           
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
                                    <h3 class="card-title">Certificate No.: <?php echo $certificate_no;?></h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                               
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-md-12" align="center">
                                          <!--image preview div-->
                                            <div id="preview">
                                               
                                              <img src="<?php echo $web_link.$photo ?>" class="img3" id="profile-img-tag" hight="120" width="100">
                                            </div>
                                            <br>
                                            <label>Student Photo: </label>
                                            
                                                <input type="file" name="photo" id="profile-img" required value="" class="form-control" onchange="getImagePreview(event)">
                                           <input style="margin: 6px 0px -20px 0px;" type="submit" name="update_photo"  value="Update" class="btn btn-info">
                                         
                                         </div>
                                        </div>
                                        <br>
                                         </form>
                                         <div class="row">
                                            <div class="col-md-4">
                                                <label>Name: <span style="color:red;">*</span></label>
                                                <input type="text" required name="name" value="<?php echo $name; ?>" onkeyup="course_get_dated('student_certificate',<?php echo $result['id'] ?>,'name',this.value)" class="form-control" placeholder="Enter student name.">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Mobile No. <span style="color:red;">*</span></label>
                                                <input type="text" readonly name="mobile" id="mobile" value="<?php echo $mobile; ?>" class="form-control" placeholder="Enter mobile number.">
                                            </div>
                                          
                                            <div class="col-md-4">
                                                <label>Father Name: <span style="color:red;">*</span></label>
                                                <input type="text" required name="father_name" value="<?php echo $father_name; ?>" onkeyup="course_get_dated('student_certificate',<?php echo $result['id'] ?>,'father_name',this.value)" class="form-control" placeholder="Enter father name.">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Gender: <span style="color:red;">*</span></label>
                                                <select name="gender" id="gender" required="" class="form-control" onchange="course_get_dated('student_certificate',<?php echo $result['id'] ?>,'gender',this.value)">
                                                   <option value="">Select </option>
                                                    <option value="Male">Male </option>
                                                    <option value="Female">Female </option>
                                                    <option value="Other">Other </option>
                                                </select>
                                            </div>
                                             <div class="col-md-4">
                                                <label>Email:</label>
                                                <input type="email" required name="email" value="<?php echo $email_id; ?>" onkeyup="course_get_dated('student_certificate',<?php echo $result['id'] ?>,'email',this.value)" class="form-control" placeholder="Enter email Id.">
                                            </div>
                                         <div class="col-md-4">
                                                <label>Enrollment No.: <span style="color:red;">*</span></label>
                                                <input type="text" required name="enrollment_no" value="<?php echo $enrollment_no;?>" onkeyup="course_get_dated('student_certificate',<?php echo $result['id'] ?>,'enrollment_no',this.value)" class="form-control" placeholder="Enter enrollment number.">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Certificate No.: <span style="color:red;">*</span></label>
                                                <input type="text" required name="certificate_no" value="<?php echo $certificate_no; ?>" onkeyup="course_get_dated('student_certificate',<?php echo $result['id'] ?>,'certificate_no',this.value)" class="form-control" placeholder="Enter Certificate number.">
                                            </div>
                                         
                                            <div class="col-md-4">
                                                <label>Date of Birth:</label>
                                                <input type="date" required name="dob" value="<?php echo $dob;?>" onkeyup="course_get_dated('student_certificate',<?php echo $result['id'] ?>,'dob',this.value)" class="form-control" placeholder="">
                                            </div>
                                            <!--<div class="col-md-4">-->
                                            <!--    <label>Grade: <span style="color:red;">*</span></label>-->
                                            <!--    <input type="text" required name="grade" id="grade" value="" onkeyup="course_get_dated('student_certificate',<?php echo $result['id'] ?>,'grade',this.value)" class="form-control" placeholder="Enter grade.">-->
                                            <!--</div>-->
                                            <!-- <div class="col-md-6" id="course_fee_label" >-->
                                            <!--     <label>Course Certificate Type: </label>-->
                                            <!--     <select name="certificate_type" id="certificate_type" required class="form-control" onchange="course_get_dated('student_certificate',<?php echo $result['id'] ?>,'certificate_type',this.value)">-->
                                            <!--      <option value="1">Computer Course Certificate</option>-->
                                            <!--       <option value="2">Typing Course Certificate</option>-->
                                            <!--       <option value="3">Other Course Certificate</option>-->
                                            <!--     </select>-->
                                            <!--</div>-->
                                                    
                                            <div class="col-md-4" id="course_fee_label" >
                                                 <label>Course: <span style="color:red;">*</span></label>
                                                 <select name="course" id="course" readonly class="form-control">
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
                                         <script>
                                        // $("#gender").val('<?php echo $gender ;?>');
                                        $("#course").val('<?php echo $course_id ;?>');
                                        </script>
                                        <?php
                                        // if($result['certificate_type']==2){ 
                                        ?>
                                            <!--<div class="col-md-2">-->
                                            <!--<label>English Typing Speed:</label>-->
                                            <!--<input type="text" name="eng_typing_speed" value="" onkeyup="course_get_dated('student_certificate',<?php echo $result['id'] ?>,'eng_typing_speed',this.value)" class="form-control" placeholder="Enter English Typing Speed.">-->
                                            <!--</div>-->
                                            <!--<div class="col-md-3">-->
                                            <!--<label>English Typing Accuracy:</label>-->
                                            <!--<input type="text" name="eng_typing_accuracy" value="" onkeyup="course_get_dated('student_certificate',<?php echo $result['id'] ?>,'eng_typing_accuracy',this.value)" class="form-control" placeholder="Enter English Typing accuracy.">-->
                                            <!--</div>-->
                                            <!--<div class="col-md-2">-->
                                            <!--<label>Hindi Typing Speed:</label>-->
                                            <!--<input type="text" name="hin_typing_speed" value="" onkeyup="course_get_dated('student_certificate',<?php echo $result['id'] ?>,'hin_typing_speed',this.value)" class="form-control" placeholder="Enter Hindi Typing Speed.">-->
                                            <!--</div>-->
                                            
                                            <!--<div class="col-md-3">-->
                                            <!--<label>Hindi Typing Accuracy:</label>-->
                                            <!--<input type="text" name="hin_typing_accuracy" value="" onkeyup="course_get_dated('student_certificate',<?php echo $result['id'] ?>,'hin_typing_accuracy',this.value)" class="form-control" placeholder="Enter Hindi Typing accuracy.">-->
                                            <!--</div>-->
                                            <!--<div class="col-md-2">-->
                                            <!--<label>Secured Mark: </label>-->
                                            <!--<input type="text" name="secured_mark" value="" onkeyup="course_get_dated('student_certificate',<?php echo $result['id'] ?>,'secured_mark',this.value)" class="form-control" placeholder="Enter Secured mark.">-->
                                            <!--</div> -->
                                        <?php
                                        // } 
                                        ?>
                                            
                                        <div class="col-md-4" id="course_fee_label" >
                                        <label >Course Start Date: <span style="color:red;">*</span></label>
                                        <input type="date" id="start_date"  class="form-control" name="start_date"  value="<?php echo $start_date;?>" onchange="course_get_dated('student_certificate',<?php echo $result['id'] ?>,'start_date',this.value)" required >
                                        </div>
                                        <div class="col-md-4" id="course_fee_label" >
                                        <label >Course Complete Date: <span style="color:red;">*</span></label>
                                        <input type="date" id="complete_date"  class="form-control" name="complete_date"  value="<?php echo $complete_date;?>" onchange="course_get_dated('student_certificate',<?php echo $result['id'] ?>,'complete_date',this.value)" required>
                                        </div>
                                        <div class="col-md-4" id="course_fee_label" >
                                        <label >Issue Date: <span style="color:red;">*</span></label>
                                        <input type="date" id="issue_date"  class="form-control" name="issue_date"  value="<?php echo $issue_date; ?>" onchange="course_get_dated('student_certificate',<?php echo $result['id'] ?>,'upload_date',this.value)" required>
                                        </div>    
                                        </div>
                                     
                                    </div>
                                    <!-- /.card-body -->
                                    </div>
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Certificate Marks Details <?php echo $mobile; ?></h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                    <div class="card-body">
                                    <table id="" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th  width="100px">S.No.</th>
                                                <th>Subject Name</th>
                                                <th  width="200px">Max. Marks</th>
                                                <!--<th  width="200px">Min. Marks</th>-->
                                                <th width="200px">Mark Secured</th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                             $sql_course=mysqli_query($con,"select * from certificate_marks_details where mobile='$mobile' and course_id='$course_id'");
                                            while($row=mysqli_fetch_array($sql_course)){
                                            
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                             
                                                <td><?php echo $row['subject_name']; ?></td>
                                               
                                               <td><?php echo $row['max_mark'] ; ?></td>
                                               <!--<td></td>-->
                                               <td><input type="number" onkeyup="course_get_dated('certificate_marks_details',<?php echo $row['id'] ?>,'obt_mark',this.value)" name="markSecured_<?php echo $row['id'] ?>"  value="<?php echo $row['obt_mark'] ?>" class="form-control"></td>
                                                
                                            </tr>
                                            
                                            <?php }  ?>
                                        </tbody>

                                    </table>
                                </div>
                                  
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                         
                                        <button onclick="window.location.assign('<?php echo $refer_url ;?>')" type="submit" name="final_submit" id="submit" class="btn btn-primary">Submit</button>
                                       
                                    </div>
                              
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
  
    function course_get_dated(tabl,id,clmn,data){
          
           $.ajax(
                      {
                        type:"GET",
                        url:"get_data",
                        //data:'edit_certificate='+tabl+'&edit_where='+id+'&edit_clmn='+clmn+'&edit_data='+data,
                        data: { edit_certificate: tabl, edit_where: id, edit_clmn: clmn, edit_data: data},
                        success: function(data){
                        if(data==1){
                            
                        }else{
                            alert(data);
                        }
                        }
                      }
                      );
          
      }
  

    // function set_typing_area_feild(val){
    //     if(val==2){
    //         document.getElementById("typing_feild_area").style.display="block";
    //     }else{
    //       document.getElementById("typing_feild_area").style.display="none"; 
    //     }
    // }

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