<?php
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");
if(add_on_check("Test Series System") == 1){
    
}else{
    echo '<script>alert("This is an add-on service. Please contact the administrator to activate or purchase access."); window.location.assign("./");</script>';

} 
if(isset($_POST['start'])){
    $row_id=VerifyData($_POST['row_id']);
    $series_id=VerifyData($_POST['series_id']);
    if(!$row_id=="" and !$series_id==""){
        $book_sql=mysqli_query($con,"select * from test_pkg_book_details where id='$row_id' and userid='$_SESSION[userid]' and use_series<total_series and status='RUN'");
        if(mysqli_num_rows($book_sql)==1){
            $book_details=mysqli_fetch_array($book_sql);
            $pkg_details=mysqli_fetch_array(mysqli_query($con,"select * from test_series_pkg_details where id='$book_details[pkg_id]'"));
            $total_insert_q= $pkg_details['ques_no_each_series'];
            $insert_test_series=mysqli_query($con,"insert into `test_series`(`userid`, `book_id`, `total_question`, `sdt`) values('$_SESSION[userid]', '$row_id', '$total_insert_q', '$c_date')");
            if($insert_test_series){
              $test_series_id=mysqli_insert_id($con);
              if(!$test_series_id==""){
                 
              
              
              $i=0;
              $go=1;
              $sql=mysqli_query($con,"select * from test_series_questions_type_details where test_series_type_id='$series_id' order by rand()");
               while($row_data=mysqli_fetch_array($sql)){
                   $check=mysqli_num_rows(mysqli_query($con,"select * from test_series_at_question where test_series_id='$test_series_id' and question_id='$row_data[test_series_questions_id]'"));
                   if(!$check>0){
                       $question_details=mysqli_fetch_array(mysqli_query($con,"select * from test_series_questions where id='$row_data[test_series_questions_id]'"));
                       if($question_details){
                           $ans_final=$question_details['ans_final'];
                           $question_details_id=$question_details['id'];
                           $question_details_question=$question_details['test_question'];
                           $question_ans_a=$question_details['ans_a'];
                           $question_ans_b=$question_details['ans_b'];
                           $question_ans_c=$question_details['ans_c'];
                           $question_ans_d=$question_details['ans_d'];
                           $insert_question=mysqli_query($con,"insert into `test_series_at_question`(`test_series_id`, `question_id`, `question`, `ans_a`, `ans_b`, `ans_c`, `ans_d`, `correct_ans`) values('$test_series_id', '$question_details_id', '$question_details_question', '$question_ans_a', '$question_ans_b', '$question_ans_c', '$question_ans_d', '$ans_final')");
                        
                          $i +=1; 
                       }
                   }
                   if($i==$total_insert_q){
                     $go=2;  
                   }
                   if($go==2){
                       break;
                   }
               }
               if($go==2){
               $use_series=$book_details['use_series'] + 1; 
               $update =mysqli_query($con,"update test_pkg_book_details set use_series='$use_series' where id='$row_id' and userid='$_SESSION[userid]' and status='RUN'");
               if($update){
                   $_SESSION['test_series_ques_id']=$test_series_id;
                 echo '<script>alert("Started Test.");window.location.assign("test_start");</script>';    
               }else{
                  echo '<script>alert("Server Error 103.");window.location.assign("test_series_runing");</script>';   
               }
               }
              }else{
                echo '<script>alert("Server Error 102.");window.location.assign("test_series_runing");</script>';  
              }
                
            }else{
              echo '<script>alert("Server Error 101.");window.location.assign("test_series_runing");</script>';  
            }
            
        }else{
          echo '<script>alert("Bad Request.");window.location.assign("test_series_runing");</script>';
        }
    }else{
        echo '<script>alert("Somthing went wrong.");window.location.assign("test_series_runing");</script>';
    }
}


if(mysqli_num_rows(mysqli_query($con,"select * from test_pkg_book_details where userid='$_SESSION[userid]' and use_series=total_series and status='RUN'"))>0){
$update_equal=mysqli_query($con,"update test_pkg_book_details set status='CLOSE' where userid='$_SESSION[userid]' and use_series=total_series and status='RUN'");
}


//$_SESSION['test_series_ques_id']=42;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test Series Running |
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
          .test_series{
    	background: #157daf !important;
    }
    
    .test_series_runing{
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
                            <h1>Test Series Running</h1>
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
                                    <h3 class="card-title">Test Series Running</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Package Name</th>
                                                <th>Total Test Series</th>
                                                <th>Used Test Series</th>
                                                <th>Start</th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                            $sql_p=mysqli_query($con,"select * from test_pkg_book_details where userid='$_SESSION[userid]' and use_series<total_series and status='RUN'");
                                            while($row=mysqli_fetch_array($sql_p)){
                                            $pkg_details=mysqli_fetch_array(mysqli_query($con,"select * from test_series_pkg_details where id='$row[pkg_id]'"));
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $pkg_details['package_name'] ; ?></td>
                                                <td><?php echo $row['total_series'] ; ?></td>
                                                <td><?php echo $row['use_series'] ; ?></td>
                                                <td>
                                                <form id="start_form<?php echo $row['id']; ?>" name="start_form<?php echo $row['id'] ; ?>">
                                                     <div class="row">
                                                     <div class="col-md-8 form-group">
                                                         <select name="series_id" id="series_id<?php echo $row['id']; ?>" required class="form-control"> 
                                                             <option value="">Select Series Type</option>
                                                             <?php 
                                                             $series_sql=mysqli_query($con,"select * from test_course_pkg_wise_question_type where pkg_id='$row[pkg_id]'");
                                                             while($row1=mysqli_fetch_array($series_sql)){
                                                                 $series_details=mysqli_fetch_array(mysqli_query($con,"select * from test_series_type where id='$row1[series_type_id]'"));
                                                                 ?>
                                                                 <option value="<?php echo $series_details['id']; ?>"><?php echo $series_details['name']; ?></option>
                                                                 <?php 
                                                             }
                                                             ?>
                                                         </select>
                                                     </div>
                                                      <div class="col-md-4 form-group">
                                                        
                                                         <input type="hidden" name="row_id" id="row_id<?php echo $row['id']; ?>" class="btn btn-success" value="<?php echo $row['id'] ; ?>" required>
                                                       <button type="button" id="startBtn<?php echo $row['id']; ?>" class="btn btn-success" onclick="startTest('<?php echo $row['id']; ?>')">Start</button>

                                                       <span style="color:blue;display:none;" id="span<?php echo $row['id']; ?>">Please wait..</span>
                                                       
                                                     </div>
                                                 </div> 
                                                </form>  
                                                    
                                                </td>
                                                
                                              
                                            </tr>
                                            
                                            <?php }  ?>
                                        </tbody>
                                     <script>
                                         function go_process(val){
                                             let series_id =$("#series_id"+val).val();
                                             let row_id=$("#row_id"+val).val();
                                            if(series_id!==""){
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
    <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
    
    document.addEventListener("visibilitychange", () => {
         
      
         if (document.hidden) {
        //   // output.innerHTML += "browser tab is changed </br>";
        //   if(alert("Attemp Close because you change your window tab or some suspecious activies.")==true){
        //       window.location.href="./"; 
        //   } ;
         
         } 
      });
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
function startTest(val) {
    let series_id = $("#series_id" + val).val();
    let row_id = $("#row_id" + val).val();
     let btn = $("#startBtn" + val);
     
     
    if (series_id === "" || row_id === "") {
        Swal.fire("Missing Info", "Please select a series.", "warning");
        return;
    }

    btn.prop("disabled", true).html("Please wait...");

    $.ajax({
        url: "get_data",
        type: "POST",
        data: {
            series_id: series_id,
            row_id: row_id
        },
        success: function(response) {
            response = response.trim();

           if (response === "success") {
                      Swal.fire({
                        title: "Test Started",
                        text: "Good luck! Wishing you success.",
                        icon: "success",
                        confirmButtonText: "Proceed"
                      }).then(() => {
                        window.location.href = "test_start";
                      });
                    }

                 else {
                Swal.fire("Error", response, "error");
                btn.prop("disabled", false).html("Start");
            }
        },
        error: function() {
            Swal.fire("Error", "Server connection failed.", "error");
            btn.prop("disabled", false).html("Start");
        }
    });
}
</script>
</body>

</html>