<?php 
include 'session.php'; 


if(add_on_check("Student Attendance System") == 1){
    
}else{
    echo '<script>alert("This is an add-on service. Please contact the administrator to activate or purchase access."); window.location.assign("./");</script>';

} 
$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if($branch_access_details['student_attendance_system']=="YES"){
   $type = mysqli_fetch_array(mysqli_query($con, "select type from user where id='$_SESSION[userid]'"))['type'];
if(sub_menu_check("H","A",$_SESSION['userid'], $type)==1){
    
}else{
    echo '<script>alert("You are not permitted to access this option.");window.location.assign("index");</script>'; 
} 
}else{
    mysqli_close($con);
    echo '<script>window.location.assign("index");</script>';
}

$c_session = mysqli_fetch_array(mysqli_query($con, "select session_id from login_session where userid='$login_details[id]'"))['session_id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daily Student Attendance  |
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
          .drop_attendance{
    	background: #157daf !important;
    }
    
    .student_daily_attendance{
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
                            <h1>Daily Student Attendance</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>

              

            <!-- Main content -->
            
            
            <?php 
             if(isset($_GET['search_date'])){
                 $_SESSION['search_date']=VerifyData($_GET['search_date']);
             }
            
            
            if(!$_SESSION['search_date']==""){
                
                $sql=mysqli_query($con,"select * from course_book where branch_id='$current_branch_id' and status='RUN' and session_id='$c_session'");
                while($row=mysqli_fetch_array($sql)){
                   $sql_check=mysqli_num_rows(mysqli_query($con,"select * from attendance_student where branch_id='$current_branch_id' and userid='$row[userid]' and date='$_SESSION[search_date]'"));
                    if(!$sql_check>0){ 
                     $sql_insert=mysqli_query($con,"insert into `attendance_student`(`branch_id`, `session_id`, `userid`, `date`, `create_by`) values('$current_branch_id', '$c_session', '$row[userid]', '$_SESSION[search_date]', '$_SESSION[userid]')");
                      
                        
                    }
                }
            }
            
            
            ?>
            
            
    
            
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Select Date:</label>
                             <input type="date" value="" name="search_date" class="form-control" onchange="window.location.assign('student_daily_attendance?search_date='+this.value)">
                        </div>
                        
                        
                        <?php 
                        if(!$_SESSION['search_date']==""){
                            $show_date = date_format(date_create($_SESSION['search_date']),"d-m-Y");
                        ?>
                        <div class="col-12">
                        <br>
                            <div class="card">
                                <?php
                               
                                $check_absent = mysqli_query($con, "
                                    SELECT 1 
                                    FROM attendance_student 
                                    WHERE date = '$_SESSION[search_date]' 
                                      AND status = 'A' 
                                      AND attendance_notification = 'NO' 
                                    LIMIT 1
                                ");
                                
                                $show_button = mysqli_num_rows($check_absent) > 0;
                                ?>
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3 class="card-title mb-0">Student Attendance for : <?php echo $show_date; ?></h3>
                                    <?php if ($show_button){ ?>
                                        <button class="btn btn-warning" onclick="sendAbsentEmail('<?php echo $_SESSION['search_date']; ?>')">
                                            Send Absent Email
                                        </button>
                                    <?php }else{ ?>
                                   <button class="btn btn-outline-success d-flex align-items-center gap-2" disabled>
                                        <i class="bi bi-check-circle-fill"></i> 
                                        All Email Sent Successfully 🎉🎉🎉
                                    </button>

                                    <?php } ?>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Student name </th>
                                                <th>Mobile Number</th>
                                                <th>In Time</th>
                                                <th>Out Time</th>
                                                <th>Status</th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                            $sql_d=mysqli_query($con,"select * from attendance_student where branch_id='$current_branch_id' and date='$_SESSION[search_date]' and session_id='$c_session'");
                                            while($row=mysqli_fetch_array($sql_d)){
                                           
                                            $user_sql= mysqli_query($con,"select * from user where id='$row[userid]'");
                                            $sql_num=mysqli_num_rows($user_sql);
                                            if($sql_num>0){
                                                $user_details=mysqli_fetch_array($user_sql);
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                               
                                                <td><?php echo $user_details['name'];?></td>
                                                <td><?php echo $user_details['mobile'];?></td>
                                                
                                                <?php 
                                                if($row['status']=="P"){
                                                    $hide_read_only="readonly";
                                                    $btn1="none";
                                                    $btn2="block";
                                                }else{
                                                   $hide_read_only=""; 
                                                   $btn1="block";
                                                    $btn2="none";
                                                }   
                                                  ?>
                                                   <td>
                                                     <div id="div_in_p<?php echo $row['id'] ; ?>">
                                                         <input type="time" <?php echo $hide_read_only ; ?> id="input_in<?php echo $row['id'] ; ?>" onchange="in_time_set(<?php echo $row['id'] ?>, this.value)" value="<?php echo $row['in_time']; ?>" class="form-control">
                                                     </div>
                                                       
                                                   </td>
                                                    
                                                   <td>
                                                    <div id="div_out_p<?php echo $row['id'] ; ?>">
                                                     <input type="time" <?php echo $hide_read_only ; ?> id="input_out<?php echo $row['id'] ; ?>" onchange="out_time_set(<?php echo $row['id'] ?>, this.value)" value="<?php echo $row['out_time']; ?>" class="form-control">    
                                                     </div>
                                                   </td>
                                                   
                                                   <td>
                                                       
                                                      
                                                        
                                                        <button id="submit_p<?php echo $row['id'] ; ?>" style="display:<?php echo $btn1; ?>" onclick="att_present(<?php echo $row['id'] ;?>)" class="btn btn-success">Submit</button>
                                                        
                                                        <button id="edit_p<?php echo $row['id'] ; ?>" style="display:<?php echo $btn2; ?>" onclick="att_edit(<?php echo $row['id'] ;?>)" class="btn btn-info"><i class="fa fa-edit"></i> Edit</button>
                                                 
                                                     
                                                   </td>
                                                  
                                                 
                                                
                                              
                                              
                                               
                                            </tr>
                                            
                                            <?php } }  ?>
                                        </tbody>

                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        
                        <?php } ?>
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
  
    <script>
        
        function att_present(val){
          
           $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'att_st_submit_st='+val,
                success: function(data){
                    if(data==1){
                       document.getElementById("input_in"+val).readOnly = true;
                       document.getElementById("input_out"+val).readOnly = true;
                       document.getElementById("submit_p"+val).style.display="none";
                       document.getElementById("edit_p"+val).style.display="block";
                    }else{
                        alert(data);
                    }
               
                }
              } );
        }
        
        
        function att_edit(val){
           
           $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'att_st_edit_st='+val,
                success: function(data){
                    if(data==1){
                       document.getElementById("input_in"+val).readOnly = false;
                       document.getElementById("input_out"+val).readOnly = false;
                       document.getElementById("submit_p"+val).style.display="block";
                       document.getElementById("edit_p"+val).style.display="none";
                    }else{
                        alert(data);
                    }
               
                }
              } );
        }
        
        function out_time_set(id,val){
          
           $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'att_out_time_st='+id+"&val="+val,
                success: function(data){
                    if(data==1){
                        
                    }else{
                        alert(data);
                    }
               
                }
              }
              );   
        }
        
        
        function in_time_set(id,val){
             
           $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'att_in_time_st='+id+"&val="+val,
                success: function(data){
                    if(data==1){
                        
                    }else{
                        alert(data);
                    }
               
                }
              }
              );   
        }
        
    </script>
  
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
    <script>
        function sendAbsentEmail(search_date) {
    Swal.fire({
        title: "Are you sure?",
        text: "Send absent email to all absent students for " + search_date + "?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, send it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "GET",
                url: "get_data",
                data: {
                    send_absent_email: 1,
                    search_date: search_date
                },
                success: function(response) {
                    if (response.trim() == "1") {
                        Swal.fire("Success!", "Absent emails sent successfully.", "success").then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire("Error!", response, "error");
                    }
                },
                error: function() {
                    Swal.fire("Error!", "Server error occurred.", "error");
                }
            });
        }
    });
}
    </script>
</body>

</html>