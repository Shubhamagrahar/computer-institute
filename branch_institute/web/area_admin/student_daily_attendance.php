<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if($branch_access_details['student_attendance_system']=="YES"){
    
}else{
    mysqli_close($con);
    echo '<script>window.location.assign("index");</script>';
}

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
                
                $sql=mysqli_query($con,"select * from course_book where branch_id='$current_branch_id' and status='RUN'");
                while($row=mysqli_fetch_array($sql)){
                   $sql_check=mysqli_num_rows(mysqli_query($con,"select * from attendance_student where branch_id='$current_branch_id' and userid='$row[userid]' and date='$_SESSION[search_date]'"));
                    if(!$sql_check>0){ 
                     $sql_insert=mysqli_query($con,"insert into `attendance_student`(`branch_id`, `userid`, `date`, `create_by`) values('$current_branch_id', '$row[userid]', '$_SESSION[search_date]', '$_SESSION[userid]')");
                      
                        
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
                                <div class="card-header">
                                    <h3 class="card-title">Student Attendance for : <strong style="color:green;"><?php echo $show_date ; ?></strong> </h3>
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
                                            $sql_d=mysqli_query($con,"select * from attendance_student where branch_id='$current_branch_id' and date='$_SESSION[search_date]'");
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