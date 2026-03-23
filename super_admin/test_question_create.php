<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if(add_on_check("Test Series System") == 1){
    
}else{
    echo '<script>alert("This is an add-on service. Please contact the administrator to activate or purchase access."); window.location.assign("./");</script>';

} 
$sql_question=mysqli_query($con,"select status from test_series_questions where status='OPEN'");
if(mysqli_num_rows($sql_question)>0){
    if(mysqli_num_rows($sql_question)==1){
      $current_question_details=mysqli_fetch_array(mysqli_query($con,"select * from test_series_questions where status='OPEN' LIMIT 1")); 
    }else{
      mysqli_close($con);
      echo '<script>alert("Somthing went wrong please contact your service provider.");window.location.assign("index");</script>';
      exit();
    }
    
}else{
  $insert_question_data =mysqli_query($con,"insert into `test_series_questions`(`status`, `date`) values('OPEN', '$t_date')");
  if($insert_question_data){
      $insert_id=mysqli_insert_id($con);
      $current_question_details=mysqli_fetch_assoc(mysqli_query($con,"select * from test_series_questions where id='$insert_id'"));
  }else{
    mysqli_close($con);
      echo '<script>alert("Somthing went wrong server please contact your service provider.");window.location.assign("index");</script>';
      exit();  
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test Question Create |
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
          .test_drop{
    	background: #157daf !important;
    }
    
    .test_question_create{
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
                            <h1>Create Test Question</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>

            <div class="col-md-12 mx-auto" style="text-align:end;"><a href="test_series_upload_questions"><button class="btn btn-success"><i class="fa fa-upload" aria-hidden="true"></i>&nbsp;Upload Questions</button></a></div>
           

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                       
                     
                       <div class="col-md-12">
                            <br>
                <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Create Test Question</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
           
                <div class="card-body ">
                <div class="row">
                 
                    <div class="col-sm-12" >
                    <label> Question : </label>
                    <textarea type="text" class="form-control" required value="" name="test_question" id="test_question" onkeyup="update_encoded_data('test_question',this.value)" placeholder="Enter Test Question."><?php echo htmlspecialchars(base64_decode($current_question_details['test_question'])); ?></textarea>
                    <input type="hidden" name="question_data" id="question_data" value="<?php echo $current_question_details['id']; ?>">
                    </div>
                     <div class="col-sm-3" >
                    <label>Option A : </label>
                    <input type="text" class="form-control" required onkeyup="update_encoded_data('ans_a',this.value)" value="<?php echo htmlspecialchars(base64_decode($current_question_details['ans_a'])); ?>" name="ans_a" id="ans_a" placeholder="Enter Anser Option A.">
                    </div>
                    <div class="col-sm-3" >
                    <label> Option B : </label>
                    <input type="text" required class="form-control" onkeyup="update_encoded_data('ans_b',this.value)" value="<?php echo htmlspecialchars(base64_decode($current_question_details['ans_b'])); ?>" name="ans_b" id="ans_b" placeholder="Enter Anser Option B.">
                    </div>
                    <div class="col-sm-3" >
                    <label>Option C :</label>
                    <input type="text" required class="form-control" onkeyup="update_encoded_data('ans_c',this.value)" value="<?php echo htmlspecialchars(base64_decode($current_question_details['ans_c'])); ?>" name="ans_c" id="ans_c" placeholder="Enter Anser Option C.">
                    </div>
                    <div class="col-sm-3" >
                    <label> Option D :</label>
                    <input  required class="form-control" onkeyup="update_encoded_data('ans_d',this.value)" value="<?php echo htmlspecialchars(base64_decode($current_question_details['ans_d'])); ?>" name="ans_d" id="ans_d" placeholder="Enter Anser Option D.">
                    </div>
                    <div class="col-sm-3" >
                    <label> Answer This Question :</label>
                    <select name="ans_final" id="ans_final" class="form-control" onchange="update_question_data('ans_final',this.value)">
                        <option value="">Select</option>
                        <option value="ans_a">Option A</option>
                        <option value="ans_b">Option B</option>
                        <option value="ans_c">Option C</option>
                        <option value="ans_d">Option D</option>
                    </select>
                    <script>
                        $("#ans_final").val('<?php echo $current_question_details['ans_final']; ?>');
                    </script>
                    
                    </div>
                    <div class="col-sm-9" id="question_type_div">
                        
                    <div class="row">
                    <div class="col-sm-3" >   
                    <label> This Question Type:</label>
                    <select name="test_question_type" id="ans_final" onchange="set_question_type_details('<?php echo $current_question_details['id'] ;?>',this.value)" class="form-control">
                        <option value="">Select</option>
                        <?php 
                        $sql=mysqli_query($con,"select * from test_series_type");
                        while($row=mysqli_fetch_array($sql)){
                           $sql_check=mysqli_num_rows(mysqli_query($con,"select * from test_series_questions_type_details where test_series_questions_id='$current_question_details[id]' and test_series_type_id='$row[id]'")) ;
                          if(!$sql_check>0){
                        ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                        }
                        <?php } } ?>
                        
                    </select>
                    </div>
                    <div class="col-sm-8" style="margin-top: 30px;">
                       <p id="q_type_list"><?php 
                      
                       $sql=mysqli_query($con,"select * from test_series_questions_type_details where test_series_questions_id='$current_question_details[id]'");
                       while($row=mysqli_fetch_array($sql)){
                           $q_type_data=mysqli_fetch_array(mysqli_query($con,"select * from test_series_type where id='$row[test_series_type_id]'"));
                         
                       ?>
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:20px;color:blue;"><?php echo $q_type_data['name'] ; ?> <i onclick="delete_select_q_type('<?php echo $current_question_details['id'] ;?>','<?php echo $row['id'] ;?>')" class="fa fa-close" style="font-size: 15px;position: absolute;color: red;cursor:pointer;"></i></span> 
                     <?php } ?></p>
                    </div>
                    </div>
                    
                    
                    </div>
                   
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="create" id="final_creat_btn" onclick="final_submit('<?php echo $current_question_details['id'] ;?>')" class="btn btn-success">Submit</button>
                  <span style="color:blue;font-size:15px;display:none;" id="final_creat_span">Please wait..</span>
                </div>
             
            </div>
            </div>    
                       
                    <?php 
                    $show_area=1;
                    if($show_area==2){
                    ?>   
                    <div class="col-12">
                  <br>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"></h3>
                                </div>
                                 /.card-header 
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                            $sql_d=mysqli_query($con,"select * from user order by id desc");
                                            while($row=mysqli_fetch_array($sql_d)){
                                            // $date=date_create($row['c_date']);
                                            // $date=date_format($date,"d-m-Y H:i A");
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                             </tr>
                                            
                                            <?php }  ?>
                                        </tbody>

                                    </table>
                                </div>
                                 /.card-body 
                            </div>
                             /.card 
                        </div>
                    <?php
                    }
                    ?>    
                       
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
     
    
    function final_submit(val) {
    document.getElementById("final_creat_btn").style.display = "none";
    document.getElementById("final_creat_span").style.display = "block";

    $.ajax({
        type: "GET",
        url: "test_series_get_data",
        data: 'quertion_final_submit=' + val,
        success: function (data) {
            if (data == 1) {
                Swal.fire({
                    icon: 'success',
                    title: 'Question Created Successfully!',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.assign("test_question_create");
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data
                });
                document.getElementById("final_creat_btn").style.display = "block";
                document.getElementById("final_creat_span").style.display = "none";
            }
        }
    });
}

    function question_type_refresh(val){
        $.ajax(
              {
                type:"GET",
                url:"test_series_get_data",
                data:'question_type_refresh='+val,
                success: function(data){
                 $("#question_type_div").html(data);
                }
              }
              );
    }
    
    function delete_select_q_type(question_data,type_details_data){
         $.ajax(
              {
                type:"GET",
                url:"test_series_get_data",
                data:'set_question_type_details_delete='+question_data+'&type_details_data='+type_details_data,
                success: function(data){
                 if(data==1){
                   question_type_refresh(question_data);
                 }else{
                     alert(data);
                 }
                }
              }
              );
    }
    
    function set_question_type_details(question_data,type_data){
        $.ajax(
              {
                type:"GET",
                url:"test_series_get_data",
                data:'set_question_type_details='+question_data+'&type_data='+type_data,
                success: function(data){
                 if(data==1){
                    question_type_refresh(question_data);
                 }else{
                     alert(data);
                 }
                }
              }
              ); 
    }
    
      function update_question_data(val,val2){
       var x=$("#question_data").val();
         
         
           $.ajax(
              {
                type:"GET",
                url:"test_series_get_data",
                data:'update_question_data='+x+'&holder='+val+'&data='+encodeURIComponent(val2),
                success: function(data){
                //  alert(data);
                 $("#mathc1").html(data);
                }
              }
              );
              
         
    }
    
    function update_encoded_data(field, value) {
    var id = $("#question_data").val(); 
    var encoded = btoa(unescape(encodeURIComponent(value))); 

    $.ajax({
        type: "GET",
        url: "test_series_get_data",
        data: 'update_question_data_encoded=' + id + '&field=' + encodeURIComponent(field) + '&data=' + encodeURIComponent(encoded),
        success: function(response) {
            console.log(field + " saved!");
        }
    });
}
    
    
    
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "", "excel", "pdf", "print", "colvis"]
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