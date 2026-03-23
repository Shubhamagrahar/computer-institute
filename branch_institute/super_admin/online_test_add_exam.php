<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(add_on_check("Online Test & Admit Card") == 1){
    
}else{
    echo '<script>alert("This is an add-on service. Please contact the administrator to activate or purchase access."); window.location.assign("./");</script>';

} 
$btnname="Create";
$course_id="";
$test_level="";
$exam_date="";
$start_time="";
$exam_time_min="";
$total_question="";
$pass_mark_percent="";
$exam_pass="";

if(isset($_POST['Create'])){
    $test_level=VerifyData($_POST['test_level']);
    $course_id=VerifyData($_POST['course_id']);
    $exam_date=VerifyData($_POST['exam_date']);
    $start_time=VerifyData($_POST['start_time']);
    $exam_time_min=VerifyData($_POST['exam_time_min']);
    $total_question=VerifyData($_POST['total_question']);
    $pass_mark_percent=VerifyData($_POST['pass_mark_percent']);
    $exam_pass=VerifyData($_POST['exam_pass']);
     
    if(!$exam_pass=="" and !$test_level=="" and !$course_id=="" and !$exam_date=="" and !$start_time=="" and !$exam_time_min=="" and !$total_question=="" and !$pass_mark_percent==""){
        // $check_exam=mysqli_num_rows(mysqli_query($con, "select * from online_test_exam_details where course_id='$course_id' and test_level='$test_level'"));
        // if(!$check_exam>0){
           
                $insert=mysqli_query($con,"insert into `online_test_exam_details`(`course_id`, `test_level`, `exam_date`, `start_time`, `exam_time_min`, `total_question`, `pass_mark_percent`, `pass`, `c_date`, `create_by`) values('$course_id', '$test_level', '$exam_date', '$start_time', '$exam_time_min', '$total_question', '$pass_mark_percent', '$exam_pass', '$t_date', '$_SESSION[userid]')");
               if($insert){
                   echo '<script>alert("Exam created successfuly done."); window.location.assign("online_test_add_exam")</script>'; 
               }else{
                 echo '<script>alert("Server error 101."); window.location.assign("online_test_add_exam")</script>';  
               } 
        // }else{
        //   echo '<script>alert("This exam name already exist."); window.location.assign("online_test_add_exam")</script>'; 
        // }
       }else{
     echo '<script>alert("Please fill all the fields"); window.location.assign("online_test_add_exam")</script>';   
    }
}


if(isset($_GET['status'])){
    $status=VerifyData($_GET['status']);
    $id=VerifyData($_GET['id']);
    if(!$status=="" && !$id==""){
        $update =mysqli_query($con,"update online_test_exam_details set status='$status' where id='$id'");
        if($update){
            echo '<script>alert("Status update Sucessfully Done."); window.location.assign("online_test_add_exam");</script>';
        }else{
         echo '<script>alert("Server error 202."); window.location.assign("online_test_add_exam");</script>';   
        }
    }else{
      echo '<script>alert("Somthing Went Wrong."); window.location.assign("online_test_add_exam");</script>';   
    }
}

if(isset($_GET['edit'])){
    $id=VerifyData($_GET['edit']);
    if(!$id==""){
        $exam_details=mysqli_query($con,"select * from online_test_exam_details where id='$id'");
        if(mysqli_num_rows($exam_details)>0){
            $exam_details=mysqli_fetch_array($exam_details);
            $course_id=$exam_details['course_id'];
            $test_level=$exam_details['test_level'];
            $exam_date=$exam_details['exam_date'];
            $start_time=$exam_details['start_time'];
            $exam_time_min=$exam_details['exam_time_min'];
            $total_question=$exam_details['total_question'];
            $pass_mark_percent=$exam_details['pass_mark_percent'];
            $exam_pass=$exam_details['pass'];
            $btnname="Update";
        }else{
         echo '<script>alert("Exam not availabel."); window.location.assign("online_test_add_exam");</script>';    
        }
    }else{
      echo '<script>alert("Somthing Went Wrong."); window.location.assign("online_test_add_exam");</script>';   
    }
}

if(isset($_POST['Update'])){
    
    $test_level=VerifyData($_POST['test_level']);
    $course_id=VerifyData($_POST['course_id']);
    $exam_date=VerifyData($_POST['exam_date']);
    $start_time=VerifyData($_POST['start_time']);
    $exam_time_min=VerifyData($_POST['exam_time_min']);
    $total_question=VerifyData($_POST['total_question']);
    $pass_mark_percent=VerifyData($_POST['pass_mark_percent']);
    $exam_pass=VerifyData($_POST['exam_pass']); 
                $update=mysqli_query($con,"update online_test_exam_details set `course_id`='$course_id',`test_level`='$test_level',`exam_date`='$exam_date',`start_time`='$start_time',`exam_time_min`='$exam_time_min',`total_question`='$total_question',`pass_mark_percent`='$pass_mark_percent', pass='$exam_pass' where id='$id'");
               if($update){
                  
                   echo '<script>alert("Exam details update successfuly done."); window.location.assign("online_test_add_exam")</script>'; 
                  
               }else{
                 echo '<script>alert("Server error 101."); window.location.assign("online_test_add_exam")</script>';  
               } 
        
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Exam |
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
<script src="https://tvssolution.com/panel/staff/admin_area/js/jquery-3.3.1.min.js" type="text/jscript"></script>
    <style type="text/css">
        .drop_online_test {
            background: #157daf !important;
        }

        .online_test_add_exam {
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
                            <h1>Create Exam</h1>
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
                                    <h3 class="card-title">Create Exam</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" name="form_2" enctype="multipart/form-data">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label> Test Level :</label>
                                                <select name="test_level" id="test_level" required class="form-control">
                                                    <option value="">Select</option>
                                                    <?php
                                                 $online_max_count=mysqli_fetch_array(mysqli_query($con,"select online_test_max_count from website_data where id='1'"));
                                                 $online_max_count=$online_max_count['online_test_max_count'];
                                                 $i=1;
                                                 while($i<=$online_max_count){
                                                   if($i==1){
                                                       $data_html=$i."st Exam";
                                                   }elseif($i==2){
                                                      $data_html=$i."nd Exam"; 
                                                   }elseif($i==3){
                                                      $data_html=$i."rd Exam"; 
                                                   }else{
                                                     $data_html=$i."th Exam";  
                                                   }
                                                   ?>
                                                    <option value="<?php echo $i; ?>">
                                                        <?php echo $data_html; ?>
                                                    </option>
                                                    <?php  
                                                   $i++;
                                                 }
                                                ?>
                                                </select>
                                                <script>
                                                    $("#test_level").val('<?php echo $test_level; ?>');
                                                </script>

                                            </div>
                                            <br>
                                            <div class="col-sm-4">
                                                <label>Course: </label>
                                                <select id="course_id" name="course_id" required class="form-control">
                                                    <option value="">Please select</option>
                                                    <?php
                                            $sql_course=mysqli_query($con,"select * from course_details where status='OPEN'");
                                            while($row=mysqli_fetch_array($sql_course)){
                                            ?>
                                                    <option value="<?php echo $row['id']; ?>">
                                                        <?php echo $row['name']; ?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                                <script>
                                                    $("#course_id").val('<?php echo $course_id ;?>');
                                                </script>
                                            </div>
                                            <br>

                                            <div class="col-sm-4">
                                                <label>Exam Date: </label>
                                                <input type="date" class="form-control" required
                                                    value="<?php echo $exam_date ;?>" name="exam_date" id="exam_date"
                                                    placeholder="">
                                            </div>
                                            <br>
                                            <div class="col-sm-3">
                                                <label>Exam Start Time: </label>
                                                <input type="time" class="form-control" required
                                                    value="<?php echo $start_time ;?>" name="start_time" id="start_time"
                                                    placeholder="">
                                            </div>
                                            <br>
                                            <div class="col-sm-3">
                                                <label>Exam Time (Minutes): </label>
                                                <input type="number" class="form-control" required
                                                    value="<?php echo $exam_time_min ;?>" name="exam_time_min"
                                                    id="exam_time_min" placeholder="Enter exam time in minute">
                                            </div>
                                            <br>
                                            <div class="col-sm-3">
                                                <label>Total Question No.: </label>
                                                <input type="number" class="form-control" required
                                                    value="<?php echo $total_question ;?>" name="total_question"
                                                    id="total_question" placeholder="Enter total question number.">
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Pass Mark % : </label>
                                                <input type="text" class="form-control" required
                                                    value="<?php echo $pass_mark_percent ;?>" name="pass_mark_percent"
                                                    id="pass_mark_percent" placeholder="Enter pass mark percentage.">
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Exam Pass : </label>
                                                <input type="text" class="form-control" required
                                                    value="<?php echo $exam_pass ;?>" name="exam_pass"
                                                    id="exam_pass" placeholder="Enter exam password.">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button style="margin-bottom:10px;" name="<?php echo $btnname; ?>"
                                            class="btn btn-success">
                                            <?php echo $btnname; ?>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </section>
            <!--Main content section end-->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Exam Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Si. No.</th>
                                                <th>Exam Date</th>
                                                <th>Course</th>
                                                <th>Exam Level</th>
                                                <th>Exam Start Time</th>
                                                <th>Exam Time (Minutes)</th>
                                                <th>Total Question</th>
                                                <th>Pass Mark %</th>
                                                <th>Exam Pass</th>
                                                <th width="130px">Action</th>
                                                <!--<th>Status</th>-->

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                             $sql_exam=mysqli_query($con,"select * from online_test_exam_details where status='OPEN' or status='CLOSE' order by id desc");
                                            while($row=mysqli_fetch_array($sql_exam)){
                                            $exam_date=date_create($row['exam_date']);
                                            $exam_date=date_format($exam_date,"d-m-Y");
                                            $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$row[course_id]'"));
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $i +=1; ?>
                                                </td>
                                                <td>
                                                    <?php echo $exam_date; ?>
                                                </td>
                                                <td>
                                                    <?php echo $course_details['name']; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if($row['test_level']==1){
                                                        echo "1st Exam";
                                                    }
                                                    if($row['test_level']==2){
                                                        echo "2nd Exam";
                                                    }
                                                    if($row['test_level']==3){
                                                        echo "3rd Exam";
                                                    }
                                                    if($row['test_level']==4){
                                                        echo "4th Exam";
                                                    }
                                                    if($row['test_level']==5){
                                                        echo "5th Exam";
                                                    }
                                                    if($row['test_level']==6){
                                                        echo "6th Exam";
                                                    }
                                                    if($row['test_level']==7){
                                                        echo "7th Exam";
                                                    }
                                                    if($row['test_level']==8){
                                                        echo "8th Exam";
                                                    }
                                                    if($row['test_level']==9){
                                                        echo "9th Exam";
                                                    }
                                                    if($row['test_level']==10){
                                                        echo "10th Exam";
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['start_time']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['exam_time_min']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['total_question']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['pass_mark_percent']; ?>
                                                </td>
                                                <td>
                                                    <input type="text" value="<?php echo $row['pass']; ?>" id="pass<?php echo $row['id']; ?>">
                                                    <a href="javascript:void(0);" style="color:green;cursor:pointer;" onclick="update_exam_pass(<?php echo $row['id']; ?>,pass<?php echo $row['id']; ?>.value);"><i class="fa fa-refresh"></i> Update</a>
                                                </td>
                                                <!--<td></td>-->
                                                <td>
                                                    <a href="online_test_add_exam?edit=<?php echo $row['id']; ?>"
                                                        onclick="return confirm('Are your sure for edit this Exam?')" style="color:blue;"><i class="fa fa-edit"></i>
                                                            Edit</a><br>
                                                    <?php 
                                                
                                                if($row['status']=="OPEN"){
                                                    ?>
                                                    <a href="online_test_add_exam?status=CLOSE&id=<?php echo $row['id']; ?>"
                                                        onclick="return confirm('Are your sure for stop this Exam?')" style="color:red;"><i class="fa fa-eye-slash"></i> Deactive</a>
                                                    <?php
                                                }
                                                if($row['status']=="CLOSE"){
                                                    ?>
                                                    <a href="online_test_add_exam?status=OPEN&id=<?php echo $row['id']; ?>"
                                                        onclick="return confirm('Are your sure for start this Exam?')" style="color:green;"><i class="fa fa-eye"></i> Active</a>
                                                    <?php
                                                }
                                                
                                                
                                                ?>
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
    
    function update_exam_pass(id,val){
       $.ajax(
              {
                type:"GET",
                url:"online_test_data",
                data:'update_exam_pass='+id+'&val='+val,
                success: function(data){
                if(data==1){
                    alert("New Exam Pass Update Sucess.");
                }else{
                    alert(data);
                }
                }
              }
              );
    }
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
        function show_des_function(val, val1) {
            document.getElementById(val).style.display = "block";
            document.getElementById(val1).style.display = "none";
        }
        function hide_des_function(val, val1) {
            document.getElementById(val).style.display = "none";
            document.getElementById(val1).style.display = "block";
        }
    </script>
</body>

</html>