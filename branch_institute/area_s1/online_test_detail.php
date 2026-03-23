<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(add_on_check("Online Test & Admit Card") == 1){
    
}else{
    echo '<script>alert("This is an add-on service. Please contact the administrator to activate or purchase access."); window.location.assign("./");</script>';

} 
$c_session = mysqli_fetch_array(mysqli_query($con, "select id from session_details where status='RUN'"))['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Exam Details |
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
    
     <style type="text/css">
          .drop_online_test{
    	background: #157daf !important;
    }
    
    .online_test_detail{
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
                            <h1>Online Exam Details</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>


           

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Online Exam Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Exam Date</th>
                                                <th>Test Level</th>
                                                <th>Course</th>
                                                <!--<th>Test Level</th>-->
                                                <th>Exam Start Time</th>
                                                <th>Exam Time (Minutes)</th>
                                                <th>Total Question</th>
                                                <!--<th>Try Free</th>-->
                                                <th>Action</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                             <?php
                                             //for exam over update 
                                             $sql_exam=mysqli_query($con,"select * from online_test_exam_details where status='OPEN' order by id desc");
                                             if(mysqli_num_rows($sql_exam)>0){
                                                 $result=mysqli_fetch_array($sql_exam);
                                                 $data_time=explode(":",$result['start_time']);
                                                 $min=$data_time['1'];
                                                 $next_minute=$min + $result['exam_time_min'];
                                                 if($next_minute>59){
                                                     $h=$data_time['0'] + 1;
                                                     $m=$next_minute-60;
                                                     $s="00";
                                                     $test_dt= $result['exam_date']." ".$h.":".$m.":".$s;
                                                 }else{
                                                     $h=$data_time['0'] ;
                                                     $m=$next_minute;
                                                     $s="00";
                                                     $test_dt= $result['exam_date']." ".$h.":".$m.":".$s;
                                                 }
                                                 if($c_date>$test_dt){
                                                     $update=mysqli_query($con,"update online_test_exam_details set status='CLOSE' where id='$result[id]'");
                                                 }
                                             }
                                             
                                             
                                             
                                             
                                                      
                                             
                                             
                                             
                                             if(isset($_POST['start'])){
                                                 $id=VerifyData($_POST['row_id']);
                                                 $pass=VerifyData($_POST['row_pass']);
                                                 if(!$id=="" and !$pass==""){
                                                     $sql=mysqli_query($con,"select * from online_test_exam_details where id='$id' and pass='$pass' and status='OPEN'");
                                                     if(mysqli_num_rows($sql)==1){
                                                         $result=mysqli_fetch_array($sql);
                                                         
                                                        $sql_attempt=mysqli_query($con,"select * from online_test_attempt where userid='$login_details[id]' and online_test_exam_id='$id'");
                                                        if(mysqli_num_rows($sql_attempt)==1){
                                                            $attempt_details=mysqli_fetch_array($sql_attempt);
                                                            
                                                        }else{
                                                           $data_time=explode(":",$result['start_time']);
                                                        $min=$data_time['1'];
                                                        $next_minute=$min + 10;// set for maximum delay exam join
                                                        if($next_minute>59){
                                                         $h=$data_time['0'] + 1;
                                                         $m=$next_minute-60;
                                                         $s="00";
                                                         $test_dt= $result['exam_date']." ".$h.":".$m.":".$s;
                                                         }else{
                                                          $h=$data_time['0'] ;
                                                          $m=$next_minute;
                                                          $s="00";
                                                          $test_dt= $result['exam_date']." ".$h.":".$m.":".$s;
                                                         }
                                                         if($c_date<$test_dt){
                                                           $start_time=date("H:i:s");
                                                           $insert=mysqli_query($con,"insert into `online_test_attempt`(`userid`, `online_test_exam_id`, `session_id`, `date`, `start_time`, `status`) values('$login_details[id]', '$id', '$c_session', '$result[exam_date]', '$start_time', 'OPEN')");
                                                           if($insert){
                                                              $attempt_details=mysqli_fetch_array(mysqli_query($con,"select * from online_test_attempt where userid='$login_details[id]' and online_test_exam_id='$id'")); 
                                                           }else{
                                                             echo '<script>alert("Server data inserting failed.");window.location.assign("online_test_detail");</script>';  
                                                           }     
                                                         }else{
                                                            echo '<script>alert("Sorry Exam already started. Your are 10 minute late.");window.location.assign("online_test_detail");</script>'; 
                                                         }   
                                                        }
                                                        
                                                        if(isset($attempt_details)){
                                                           
                                                           $count_inserted_q=mysqli_num_rows(mysqli_query($con,"select * from online_test_use_details where userid='$login_details[id]' and test_attempt_id='$attempt_details[id]'"));
                                                           $insert_pending_q=$result['total_question']-$count_inserted_q;
                                                           if($insert_pending_q>0){
                                                               
                                                               $go=0;
                                                               $count=0;
                                                               $sql_q=mysqli_query($con,"select online_test_question_id from online_test_question_details where course_id='$result[course_id]' and test_level='$result[test_level]'");
                                                               while($row=mysqli_fetch_array($sql_q)){
                                                                if(mysqli_num_rows(mysqli_query($con,"select id from online_test_use_details where userid='$login_details[id]' and test_attempt_id='$attempt_details[id]' and test_question_id='$row[online_test_question_id]'"))<1){
                                                                    $question=mysqli_fetch_array(mysqli_query($con,"select * from online_test_question where id='$row[online_test_question_id]'"));
                                                                    $insert=mysqli_query($con,"insert into `online_test_use_details`(`userid`, `test_attempt_id`, `test_question_id`, `test_question`, `ans_a`, `ans_b`, `ans_c`, `ans_d`, `ans_final`, `date`) values('$login_details[id]', '$attempt_details[id]', '$row[online_test_question_id]', '$question[test_question]', '$question[ans_a]', '$question[ans_b]', '$question[ans_c]', '$question[ans_d]', '$question[ans_final]', '$c_date')");
                                                                   if($insert){
                                                                       $count +=1;
                                                                     if($count==$insert_pending_q){
                                                                       $go=1;  
                                                                       break;
                                                                     }
                                                                   }
                                                                    
                                                                }
                                                                  
                                                               }
                                                             if($go==1){
                                                              $_SESSION['test_series_ques_id']=$attempt_details['id'];
                                                            echo '<script>alert("Started Test.");window.location.assign("exam_start");</script>';   
                                                             }else{
                                                              echo '<script>alert("Server Error 104.");window.location.assign("online_test_detail");</script>';   
                                                             }  
                                                           }else{
                                                            $_SESSION['test_series_ques_id']=$attempt_details['id'];
                                                            echo '<script>alert("Started Test.");window.location.assign("exam_start");</script>';
                                                           }
                                                            
                                                        }else{
                                                         echo '<script>alert("Server Error 103.");window.location.assign("online_test_detail");</script>';   
                                                        }
                                                         
                                                     }else{
                                                        echo '<script>alert("Server Error 101.");window.location.assign("online_test_detail");</script>'; 
                                                     }
                                                 }else{
                                                     echo '<script>alert("Server Error.");window.location.assign("online_test_detail");</script>';
                                                 }
                                             }
                                             
                                             
                                            $i=0;
                                            // $sql_course_book=mysqli_query($con,"select * from course_book where userid='$login_details[id]' and status='RUN' order by id desc");
                                            $sql_course_book = mysqli_query($con, "SELECT * FROM course_book WHERE userid='$login_details[id]' AND status IN ('RUN', 'CLOSE') ORDER BY id DESC");

                                            while($row=mysqli_fetch_array($sql_course_book)){
                                                $sql_exam=mysqli_query($con,"select * from online_test_exam_details where course_id='$row[course_id]' and status='OPEN' order by id desc");
                                            if(mysqli_num_rows($sql_exam)>0){
                                            $exam_details=mysqli_fetch_array($sql_exam);
                                            $exam_date=date_create($exam_details['exam_date']);
                                            $exam_date=date_format($exam_date,"d-m-Y");
                                            $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$row[course_id]'"));
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $exam_date ;?></td>
                                                <td><?php
                                                    if($exam_details['test_level']==1){
                                                        echo "1st Exam";
                                                    }
                                                    if($exam_details['test_level']==2){
                                                        echo "2nd Exam";
                                                    }
                                                    if($exam_details['test_level']==3){
                                                        echo "3rd Exam";
                                                    }
                                                    if($exam_details['test_level']==4){
                                                        echo "4th Exam";
                                                    }
                                                    if($exam_details['test_level']==5){
                                                        echo "5th Exam";
                                                    }
                                                    if($exam_details['test_level']==6){
                                                        echo "6th Exam";
                                                    }
                                                    if($exam_details['test_level']==7){
                                                        echo "7th Exam";
                                                    }
                                                    if($exam_details['test_level']==8){
                                                        echo "8th Exam";
                                                    }
                                                    if($exam_details['test_level']==9){
                                                        echo "9th Exam";
                                                    }
                                                    if($exam_details['test_level']==10){
                                                        echo "10th Exam";
                                                    }
                                                    ?></td>
                                                <td><?php echo $course_details['name'] ;?></td>
                                                <td><?php echo date_format(date_create($exam_details['start_time']), "h:i A"); ?></td>
                                                <td><?php echo $exam_details['exam_time_min']." Min."; ?></td>
                                                <td><?php echo $exam_details['total_question']; ?></td>
                                               <td>
                                                   
                                                   <?php 
                                                   if(mysqli_num_rows(mysqli_query($con,"select * from online_test_attempt where online_test_exam_id='$exam_details[id]' and status='CLOSE'"))<1){
                                                   ?>
                                                <form method="post" name="start_form<?php echo $exam_details['id'] ; ?>">
                                                    
                                                        
                                                         <input type="hidden" name="row_id" id="row_id<?php echo $exam_details['id']; ?>"  value="<?php echo $exam_details['id'] ; ?>" required>
                                                         <input type="text" name="row_pass"  id="row_pass<?php echo $exam_details['id']; ?>" value="" required>
                                                       <button type="submit" name="start" id="start<?php echo $exam_details['id']; ?>" class="btn btn-success" onclick="go_process('<?php echo $exam_details['id']; ?>')" value="Start" >Start</button>
                                                       <span style="color:blue;display:none;" id="span<?php echo $exam_details['id']; ?>">Please wait..</span>
                                                       
                                                    
                                                </form>  
                                                 <?php }else{
                                                 echo "Already Attend.";
                                                 } ?>   
                                                </td>
                                            </tr>
                                            
                                            <?php } }  ?>
                                        </tbody>
                                         <script>
                                         function go_process(val){
                                             
                                             let row_pass =$("#row_pass"+val).val();
                                             let row_id=$("#row_id"+val).val();
                                            
                                            if(row_pass!==""){
                                                if(row_id!==""){
                                                    document.getElementById("start"+val).style.display="none";
                                                    document.getElementById("span"+val).style.display="block";
                                                }
                                            }
                                         }
                                     </script>
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
function goFullscreenAndStart() {
    document.documentElement.requestFullscreen().then(() => {
        window.location.href = "exam_start";
    }).catch(() => {
        window.location.href = "exam_start";
    });
}
</script>

</body>

</html>