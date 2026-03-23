<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");
if(isset($_GET['test_level'])){
    $get_test_level=$_GET['test_level'];
}else{
    $get_test_level="";
}
if(isset($_GET['course_id'])){
    $get_course_id=$_GET['course_id'];
}else{
    $get_course_id="";
}
if(add_on_check("Online Test & Admit Card") == 1){
    
}else{
    echo '<script>alert("This is an add-on service. Please contact the administrator to activate or purchase access."); window.location.assign("./");</script>';

} 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Admit Card|
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
    <script src="https://tvssolution.com/panel/staff/admin_area/js/jquery-3.3.1.min.js" type="text/jscript"></script>
    
     <style type="text/css">
          .drop_online_test{
    	background: #157daf !important;
    }
    
    .online_test_student_admit_card{
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
            
            <section class="content" id="fee_collection">
       
     </section>
            
            
            
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Student Admit Card </h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>

              

            <!-- Main content -->
            
            
    
            
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Select Course</label>
                            <select class="form-control" id="course_search" name="course_search" onchange="by_course(this.value)">
                                <option value="">Select</option>
                                <?php 
                                $sql_course=mysqli_query($con,"select * from course_details");
                                while($row=mysqli_fetch_array($sql_course)){
                                    ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php 
                                }
                                ?>
                            </select>
                        </div>
                         <div class="col-md-6">
                            <label>Select Test Level</label>
                           <select name="test_level" id="test_level" required class="form-control" onchange="by_course_and_level(this.value,course_search.value)">
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
                        </div>
                        <?php
                        $sction=1;
                        if($sction==2){ ?>
                             <div class="col-md-6">
                            <label>Search Exam Date</label>
                            <input type="date" class="form-control" id="exam_date" name="exam_date" value="" onchange="by_date(this.value)">
                            <!--<select class="form-control" id="batch_search" name="batch_search" onchange="by_batch(this.value)">-->
                            <!--    <option value="">Select</option>-->
                             <?php 
                                $sql_course=mysqli_query($con,"select * from batch_details");
                               while($row=mysqli_fetch_array($sql_course)){
                                ?>
                            <!--        <option value="<?php echo $row['id']; ?>"><?php echo $row['batch_name']; ?></option>-->
                                  <?php
                             }
                              ?>
                            <!--</select>-->
                        </div>
                       <?php }
                        ?>
                       
                        <script>
                            <?php 
                            if($get_date_id>0){
                                ?>
                                $("#course_search").val("");
                                $("#batch_search").val('<?php echo $get_date_id ; ?>');
                                <?php
                            }
                            ?>
                            <?php 
                            if($get_course_id>0){
                                
                                ?>
                                
                                $("#course_search").val(<?php echo $get_course_id ; ?>);
                                $("#batch_search").val("");
                                
                                <?php
                            }
                            ?>
                             <?php 
                            if($get_test_level>0){
                                
                                ?>
                                
                                $("#test_level").val(<?php echo $get_test_level ; ?>);
                              
                                
                                <?php
                            }
                            ?>
                            
                            function by_course(val){
                                var url="online_test_student_admit_card?course_id="+val;
                                window.location.assign(url);
                            }
                            function by_course_and_level(val,val2){
                                var url="online_test_student_admit_card?course_id="+val2+'&test_level='+val;
                                window.location.assign(url);
                            }
                            
                            function by_date(val){
                                var url="online_test_student_admit_card?date_id="+val;
                                window.location.assign(url);
                            }
                         
                        </script>
                        
                        <div class="col-12">
                        <br>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Student Admit Card</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Course Name</th>
                                                <th>Batch</th>
                                                <th>Exam Date</th>
                                                <th>Test Level</th>
                                                <th>Details</th>
                                                <th>Admit Card</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                            if($get_test_level>0 or $get_course_id>0){
                                             if($get_course_id>0){
                                               $sql_d=mysqli_query($con,"select * from online_test_exam_details where course_id='$get_course_id' and status='OPEN'");
                                             }
                                            
                                            if($get_course_id>0 and $get_test_level>0){
                                               $sql_d=mysqli_query($con,"select * from online_test_exam_details where course_id='$get_course_id' and test_level='$get_test_level' and status='OPEN'");
                                             }
                                            
                                            
                                            }else{
                                              $sql_d=mysqli_query($con,"select * from online_test_exam_details where status='OPEN'");   
                                            }
                                            while($row=mysqli_fetch_array($sql_d)){
                                                $sql_course_book=mysqli_query($con,"select * from course_book where course_id='$row[course_id]' and (status='RUN' or status='CLOSE')");
                                                if($sql_course_book>0){
                                             while($course_book_details=mysqli_fetch_array($sql_course_book)){       
                                                // $course_book_details=mysqli_fetch_array($sql_course_book);    
                                                
                                           $exam_date=date_create($row['exam_date']);
                                            $exam_date=date_format($exam_date,"d-m-Y");
                                            // $date1=date_create($row['start_date']);
                                            // $date1=date_format($date1,"d-m-Y");
                                            $user_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$course_book_details[userid]'"));
                                            $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$row[course_id]'"));
                                            $batch_details=mysqli_fetch_array(mysqli_query($con,"select * from batch_details where id='$course_book_details[batch_id]'"));
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $user_details['name'];?></td>
                                                <td><?php echo $user_details['mobile'];?></td>
                                                <td><?php echo $course_details['name'];?></td>
                                                <td><?php echo $batch_details['batch_name'] ; ?></td>
                                                <td><?php echo $exam_date; ?></td>
                                                <td> <?php
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
                                                    ?></td>
                                                <td><a target="_blank" href="student_search?mobile=<?php echo $user_details['mobile'] ;?>&search=Search" title="Print Application Form" style="color:blue;"><i class="fa fa-eye"></i>View</a></td>
                                                <td><a target="_blank" href="online_test_admit_card_print?exam_id=<?php echo $row['id'];?>&user_id=<?php echo $user_details['id'];?>" title="Print Application Form" style="color:green;"><i class="fa fa-print"></i> Print</a></td>
                                            </tr>
                                            
                                            <?php } } } ?>
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
     
      
      function fee_paid(val){
          var deu_fee1=Number($("#deu_fee").val());
          if(deu_fee1>0){
              var deu_fee=deu_fee1;
          }else{
              var deu_fee=-deu_fee1;
          }
          var pay_fee=Number($("#pay_fee").val());
          var pay_type=$("#pay_type").val();
          var pay_des=$("#pay_des").val();
          if(pay_fee>0){
              if(pay_type!==""){
                  //var amt=Number(deu_fee) + Number(pay_fee);
                  if(deu_fee>=pay_fee){
                        $.ajax(
                        {
                        type:"GET",
                        url:"get_data",
                        data:'paid_due_fee='+val+'&pay_fee='+pay_fee+'&pay_type='+pay_type+'&pay_des='+pay_des,
                        success: function(data){
                          if(data==1){
                             document.getElementById('fee_collection').style.display='none'; 
                             alert("Fee Collection Done.");window.location.assign("enroll_runing");
                          }else{
                              alert(data);
                          }
                        }
                        }
                        );
                  }else{
                    alert("Do not enter an amount more than the fee payable.");
                    $("#pay_fee").val("");
                  }
              }else{
                 alert("Please select pay fee type."); 
              }
          }else{
              alert("Please enter pay fee amount.");
          }
      }
    
       function get_fee_pay_details(val){
       
        
           $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'get_fee_pay_details='+val,
                success: function(data){
                 $("#fee_collection").html(data);
                 document.getElementById('fee_collection').style.display='block';
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
</body>

</html>