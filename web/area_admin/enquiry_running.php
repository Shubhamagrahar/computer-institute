<?php 
include 'session.php'; 


$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");
if($branch_access_details['enquiry_system']=="YES"){
    
}else{
    mysqli_close($con);
    echo '<script>window.location.assign("index");</script>';
}


if(isset($_POST['cancel_ids'])){
    $id=VerifyData($_POST['data_id']);
    $des=VerifyData($_POST['des']);
    
    if(!$id=="" and !$des==""){
        $check=mysqli_query($con,"select * from enquiry_details where id='$id'");
        if(mysqli_num_rows($check)){
          $enquiry_details=mysqli_fetch_array($check);
           $staff_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$enquiry_details[create_by]'"));
           $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$enquiry_details[course_id]'"));
           $batch_details=mysqli_fetch_array(mysqli_query($con,"select * from batch_details where id='$enquiry_details[batch_id]'"));
       
       $update=mysqli_query($con,"update enquiry_details set status='CANCEL', cancel_date='$t_date' where id='$id'");
         if($update){
             $insert_history=mysqli_query($con,"insert into `enquiry_follow_history`(`enquiry_id`, `follow_by`, `des`, `next_date`, `date`) values('$id', '$_SESSION[userid]', '$des', '$t_date', '$c_date')");
           if($insert_history){
          echo '<script>alert("Course Enroll proceess cancel.");window.location.assign("enquiry_running")</script>'; 
           }else{
            echo '<script>alert("Server Error 106.");window.location.assign("enquiry_running");</script>';    
           }
               
           }else{
         echo '<script>alert("Server Error 105.");window.location.assign("enquiry_running");</script>';     
         }
                       
          
       
        }else{
            echo '<script>alert("Server error 101.");window.location.assign("enquiry_running");</script>';
        }
        
    }else{
        echo '<script>alert("Not allowed.");window.location.assign("enquiry_running");</script>';
    }
}




// if(isset($_GET['final_ids'])){
//     $id=VerifyData($_GET['final_ids']);
//     if(!$id==""){
//         $check=mysqli_query($con,"select * from enquiry_details where id='$id'");
//         if(mysqli_num_rows($check)){
//           $enquiry_details=mysqli_fetch_array($check);
//           $staff_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$enquiry_details[create_by]'"));
//           $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$enquiry_details[course_id]'"));
//           $batch_details=mysqli_fetch_array(mysqli_query($con,"select * from batch_details where id='$enquiry_details[batch_id]'"));
       
          
//           $courseid=$enquiry_details['course_id'];
//           $name=$enquiry_details['name'];
//       $email_id="";
//     $mobile=$enquiry_details['mobile1'];
    
//     if(!$courseid=="" and !$name=="" and !$mobile=="" ){
//         $check_course=mysqli_query($con,"select * from course_details where id='$courseid'");
//         if(mysqli_num_rows($check_course)==1){
//             $course_details=mysqli_fetch_array($check_course);
//             $check_mobile=mysqli_num_rows(mysqli_query($con,"select * from user where mobile='$mobile'"));
//             if(!$check_mobile>0){
//              $pass=rand(100000,999999);
//             $insert=mysqli_query($con,"insert into `user`(`name`, `mobile`, `pass`, `email`, `r_date`) values('$name', '$mobile', '$pass', '$email_id', '$t_date')");    
//             if($insert){
//                 $insert_id=mysqli_insert_id($con);
//                 if($insert_id>0){
//                   $insert_wallet=mysqli_query($con,"insert into `wallet`(`userid`) values('$insert_id')");
//                   if($insert_wallet){
//                      $create_course=mysqli_query($con,"insert into `course_book`(`userid`, `course_id`, `fee`, `book_date`) values('$insert_id', '$courseid', '$course_details[fee]', '$t_date')");
//                     $course_inert_id=mysqli_insert_id($con);
//                       if($create_course){
//                          $update=mysqli_query($con,"update enquiry_details set status='CLOSE', convert_date='$t_date' where id='$id'");
//                          if($update){
//                           echo '<script>alert("Course Enroll proceess please in new enrollment request.");window.location.assign("enquiry_running")</script>'; 
//                          }else{
//                          echo '<script>alert("Server Error 105.");window.location.assign("enquiry_running");</script>';     
//                          }
//                      }else{
//                         echo '<script>alert("Server Error 104.");window.location.assign("enquiry_running");</script>'; 
//                      }
                      
//                   }else{
//                      echo '<script>alert("Server Error 103.");window.location.assign("enquiry_running");</script>'; 
//                   }
                  
//                 }else{
//                     echo '<script>alert("Server Error 102.");window.location.assign("enquiry_running");</script>';  
//                 }
//             }else{
//               echo '<script>alert("Server Error 101.");window.location.assign("enquiry_running");</script>';  
//             }
//             }else{
//                 echo '<script>alert("Mobile number already registered.");window.location.assign("enquiry_running");</script>';
//             }
//         }else{
//             echo '<script>alert("Please select course.");window.location.assign("enquiry_running");</script>';
//         }
//     }else{
//         echo '<script>alert("Please fill all feild.");window.location.assign("enquiry_running");</script>';
//     }
           
          
       
//         }else{
//             echo '<script>alert("Server error 101.");window.location.assign("enquiry_running");</script>';
//         }
        
//     }else{
//         echo '<script>alert("Not allowed.");window.location.assign("enquiry_running");</script>';
//     }
// }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Running Enquiry|
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
          .drop_enquiry{
    	background: #157daf !important;
    }
    
    .enquiry_running{
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
                            <h1>Running Follow-up Enquiry Details</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>


  <section class="content" id="data_view">
     
     </section>

           

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                      
                        <div class="col-12">
                            <br>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Follow-up Enquiry Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Enquiry Date</th>
                                                <th>Enquiry Create By</th>
                                                <th>Name</th>
                                                <th>Mobile1</th>
                                                <th>Mobile2</th>
                                                <th>Course Name</th>
                                                <th>Batch</th>
                                                <th>Last Discussion</th>
                                                <th>Next Follow-Up Date</th>
                                                <th>Details</th>
                                                <th width="100%">Action</th>
                                               
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                           
                                           
                                           
                                              $sql_d=mysqli_query($con,"select * from enquiry_details where branch_id='$current_branch_id' and status='RUN' order by next_date desc");   
                                        
                                            while($row=mysqli_fetch_array($sql_d)){
                                            $date=date_create($row['enquiry_date']);
                                            $date=date_format($date,"d-m-Y");
                                            $date_next=date_create($row['next_date']);
                                            $date_next=date_format($date_next,"d-m-Y");
                                           
                                            $staff_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$row[create_by]'"));
                                            $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$row[course_id]'"));
                                            $batch_details=mysqli_fetch_array(mysqli_query($con,"select * from batch_details where id='$row[batch_id]'"));
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $date ;?></td>
                                                <td><?php echo $staff_details['name'];?></td>
                                                <td><?php echo $row['name'];?></td>
                                                <td><?php echo $row['mobile1'];?></td>
                                                <td><?php echo $row['mobile2'];?></td>
                                                <td><?php echo $course_details['name'];?></td>
                                                <td><?php echo $batch_details['batch_name'];?></td>
                                                <td><?php echo $row['enquiry_note'];?></td>
                                                <td><?php echo $date_next ;?></td>
                                                <td><span onclick="get_data_view(<?php echo $row['id'];?>)" style="cursor:pointer;color:blue;"><i class="fa fa-eye"></i> Details</span></td>
                                                <td>
                                                  <div id="action<?php echo $row['id'] ; ?>">
                                                  <a title="Add follow-up details" href="enquiry_details?ids=<?php echo $row['id'] ; ?>" style="cursor:pointer;color:blue;"><i class="fa fa-plus"></i> Add</a>&nbsp;&nbsp;&nbsp;<br>
                                                   <a onclick="return confirm('Are you sure for enroll process.')" title="Verify for enroll process" href="enquiry_running?final_ids=<?php echo $row['id'] ; ?>" style="cursor:pointer;color:green;"><i class="fa fa-paper-plane"></i> Enroll</a>&nbsp;&nbsp;&nbsp;<br>
                                                   <a onclick="cancel_div('<?php echo $row['id'] ; ?>')" title="Cancel follow-up this details"  style="cursor:pointer;color:red;"><i class="fa fa-trash"></i> Cancel</a>
                                                  </div>
                                                  <div id="cancel<?php echo $row['id'] ; ?>" style="display:none;">
                                                      <span>Enter Cancel Reason:</span><span onclick="cancel_div_hide('<?php echo $row['id'] ; ?>')" style="color:red;cursor:pointer; float:right;"><i class="fa fa-close"></i></span>
                                                      <form method="post" name="cancel_form<?php echo $row['id']; ?>">
                                                          <input type="hidden" value="<?php echo $row['id'] ?>" name="data_id">
                                                          <textarea name="des" required value="" class="form-control" row="5"></textarea>
                                                          <input type="submit" name="cancel_ids" value="Submit" class="btn btn-success">
                                                          
                                                      </form>
                                                  </div>
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
    function cancel_div(val){
        document.getElementById("action"+val).style.display="none";
        document.getElementById("cancel"+val).style.display="block";
    }
    function cancel_div_hide(val){
        document.getElementById("action"+val).style.display="block";
        document.getElementById("cancel"+val).style.display="none";
    }
    function update_enquery_data(){
        document.getElementById("enquery_data_update_btn").style.display="none";
        document.getElementById("enquery_data_edit_btn").style.display="block";
        document.getElementById("name").readOnly=true;
        document.getElementById("guardian_name").readOnly=true;
        document.getElementById("guardian_relation").readOnly=true;
        
        document.getElementById("guardian_occupation_input").style.display="block";
        document.getElementById("guardian_occupation").style.display="none";
        $("#guardian_occupation_input").val($("#guardian_occupation").val());
        
        document.getElementById("category_input").style.display="block";
        document.getElementById("category").style.display="none";
        $("#category_input").val($("#category").val());
        
        document.getElementById("mobile1").readOnly=true;
        document.getElementById("mobile2").readOnly=true;
        document.getElementById("address1").readOnly=true;
        
        document.getElementById("employment_status_input").style.display="block";
        document.getElementById("employment_status").style.display="none";
        $("#employment_status_input").val($("#employment_status").val());
        
        document.getElementById("computer_literacy_input").style.display="block";
        document.getElementById("computer_literacy").style.display="none";
        $("#computer_literacy_input").val($("#computer_literacy").val());
        
        document.getElementById("qualification_input").style.display="block";
        document.getElementById("qualification").style.display="none";
        $("#qualification_input").val($("#qualification").val());
        
        document.getElementById("education_stream_input").style.display="block";
        document.getElementById("education_stream").style.display="none";
        $("#education_stream_input").val($("#education_stream").val());
        alert("Enquery Data Update Done.");
        
    }
    
    
    function edit_enquery_data(){
        document.getElementById("enquery_data_update_btn").style.display="block";
        document.getElementById("enquery_data_edit_btn").style.display="none";
        document.getElementById("name").readOnly=false;
        document.getElementById("guardian_name").readOnly=false;
        document.getElementById("guardian_relation").readOnly=false;
        document.getElementById("guardian_occupation_input").style.display="none";
        document.getElementById("guardian_occupation").style.display="block";
        document.getElementById("category_input").style.display="none";
        document.getElementById("category").style.display="block";
        document.getElementById("mobile1").readOnly=false;
        document.getElementById("mobile2").readOnly=false;
        document.getElementById("address1").readOnly=false;
        document.getElementById("employment_status_input").style.display="none";
        document.getElementById("employment_status").style.display="block";
        document.getElementById("computer_literacy_input").style.display="none";
        document.getElementById("computer_literacy").style.display="block";
        document.getElementById("qualification_input").style.display="none";
        document.getElementById("qualification").style.display="block";
        document.getElementById("education_stream_input").style.display="none";
        document.getElementById("education_stream").style.display="block";
        
    }
    
    function update_enquery_form_data(val,val2,val3){
        $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'update_enquery_form_data='+val3+'&data_fl='+val+'&data='+val2,
                success: function(data){
                   
                }
              } );
    }
    
    function data_view_close(){
        $("#data_view").html("");
    }
    function get_data_view(val){
         $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'get_data_report_view='+val,
                success: function(data){
                   $("#data_view").html(data);
                }
              } );
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