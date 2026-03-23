<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(isset($_GET['batch_id'])){
    $get_batch_id=$_GET['batch_id'];
}else{
    $get_batch_id="";
}
if(isset($_GET['course_id'])){
    $get_course_id=$_GET['course_id'];
}else{
    $get_course_id="";
}

if(isset($_GET['complete'])){
    $book_course_id=VerifyData($_GET['complete']);
    if(!$book_course_id==""){
        $sql=mysqli_query($con,"select * from course_book where id='$book_course_id'");
        if(mysqli_num_rows($sql)==1){
            $result=mysqli_fetch_array($sql);
            $data_wallet=mysqli_fetch_array(mysqli_query($con,"select * from wallet where userid='$result[userid]'"));
            if($data_wallet['main_b']>=0){
                $update_course=mysqli_query($con,"update course_book set status='CLOSE', complete_date='$t_date' where id='$book_course_id'");
                if($update_course){
                   echo '<script>alert("Course completed successfull.");window.location.assign("enroll_runing")</script>'; 
                }else{
                 echo '<script>alert("Server Error 102.");window.location.assign("enroll_runing")</script>';   
                }
            }else{
                echo '<script>alert("Please pay due fee then eligible for complete course.");window.location.assign("enroll_runing")</script>';
            }
            
        }else{
            echo '<script>alert("Server Error 101.");window.location.assign("enroll_runing")</script>';
        }
        
    }else{
        echo '<script>alert("URl Error.");window.location.assign("enroll_runing")</script>';
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Runing Enrollments |
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
          .drop_enroll{
    	background: #157daf !important;
    }
    
    .enroll_runing{
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
                            <h1>Runing Enrollments </h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>

              

            <!-- Main content -->
            
            
    
            
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Search By course</label>
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
                            <label>Search By Batch</label>
                            <select class="form-control" id="batch_search" name="batch_search" onchange="by_batch(this.value)">
                                <option value="">Select</option>
                                <?php 
                                $sql_course=mysqli_query($con,"select * from batch_details");
                                while($row=mysqli_fetch_array($sql_course)){
                                    ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['batch_name']; ?></option>
                                    <?php 
                                }
                                ?>
                            </select>
                        </div>
                        <script>
                            <?php 
                            if($get_batch_id>0){
                                ?>
                                $("#course_search").val("");
                                $("#batch_search").val('<?php echo $get_batch_id ; ?>');
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
                            
                            function by_course(val){
                                var url="enroll_runing?course_id="+val;
                                window.location.assign(url);
                            }
                            
                            function by_batch(val){
                                var url="enroll_runing?batch_id="+val;
                                window.location.assign(url);
                            }
                         
                        </script>
                        
                        <div class="col-12">
                        <br>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Runing Enrollment </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Date</th>
                                                <th>Start Date</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Course Name</th>
                                                <th>Batch</th>
                                                <th>Due Fee</th>
                                                <th>Collect Fee</th>
                                                <th>Complete Course</th>
                                                <th>Details</th>
                                                <!--<th>Print</th>-->
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                            if($get_batch_id>0 or $get_course_id>0){
                                            if($get_batch_id>0){
                                               $sql_d=mysqli_query($con,"select * from course_book where status='RUN' and batch_id='$_GET[batch_id]'");
                                            }
                                            
                                            if($get_course_id>0){
                                              $sql_d=mysqli_query($con,"select * from course_book where course_id='$_GET[course_id]' and  status='RUN'");  
                                            }
                                            }else{
                                              $sql_d=mysqli_query($con,"select * from course_book where status='RUN'");   
                                            }
                                            while($row=mysqli_fetch_array($sql_d)){
                                            $date=date_create($row['book_date']);
                                            $date=date_format($date,"d-m-Y");
                                            $date1=date_create($row['start_date']);
                                            $date1=date_format($date1,"d-m-Y");
                                            $user_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$row[userid]'"));
                                            $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$row[course_id]'"));
                                            $user_wallet=mysqli_fetch_array(mysqli_query($con,"select * from wallet where userid='$row[userid]'"));
                                            $batch_details=mysqli_fetch_array(mysqli_query($con,"select * from batch_details where id='$row[batch_id]'"));
                                            
                                            if($user_details['branch_id']==$_SESSION['userid']){
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $date ;?></td>
                                                <td><?php echo $date1 ;?></td>
                                                <td><?php echo $user_details['name'];?></td>
                                                <td><?php echo $user_details['mobile'];?></td>
                                                <td><?php echo $course_details['name'];?></td>
                                                <td><?php echo $batch_details['batch_name'] ; ?></td>
                                                <td ><?php echo $user_wallet['main_b'];?></td>
                                              
                                                <td>
                                                    <?php 
                                                    if($user_wallet['main_b']>=0){
                                                       echo "Due Clear"; 
                                                    }else{
                                                    ?>
                                                    <i title="Collect Fee" class="fa fa-rupee" style="color:blue;cursor: pointer;" onclick="get_fee_pay_details(<?php echo $row['userid'] ;?>)"  >Collect</i>
                                                    <?php } ?>
                                                    </td>
                                                <td><a  href="enroll_runing?complete=<?php echo $row['id'] ; ?>" onclick="return confirm('Are you sure for complete this corse?')" title="Complete Course" style="color:green;"><i class="fa fa-check"></i>Complete</a></td>
                                                <td><a target="_blank" href="student_search?mobile=<?php echo $user_details['mobile'] ;?>&search=Search" title="Print Application Form" style="color:blue;"><i class="fa fa-eye"></i>View</a></td>
                                                <!--<td><a  href="javaScript:void(0)" onclick="alert('This option enable after software confirmation.')" title="Print Application Form" style="color:green;"><i class="fa fa-print"></i>Print</a></td>-->
                                            </tr>
                                            
                                            <?php } }  ?>
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