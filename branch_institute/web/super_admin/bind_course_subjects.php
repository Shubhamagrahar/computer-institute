<?php
include 'session.php'; 

$c_date=date("Y-m-d H:i:s");



$btn_name="Create";
$subject_name="";

if(isset($_POST['Create'])){
  $subject_name=VerifyData($_POST['subject_name']);
  
  if(!$subject_name==""){
     $check=mysqli_num_rows(mysqli_query($con,"select * from subject_details where subject_name='$subject_name'"));
     if(!$check>0){
         $insert=mysqli_query($con,"insert into `subject_details`(`subject_name`) values('$subject_name')"); 
        if($insert){
            echo '<script>alert("Subject Name Create Sucessfully Done .");window.location.assign("add_subjects");</script>'; 
        }else{
            echo '<script>alert("Server Error 101.");window.location.assign("add_subjects");</script>'; 
        }
     }else{
      echo '<script>alert("This subject name already created.");window.location.assign("add_subjects");</script>';    
     } 
    
  }else{
      echo '<script>alert("Please fill All data.");window.location.assign("add_subjects");</script>'; 
  }
}


if(isset($_GET['edit'])){
  $id=VerifyData($_GET['edit']);
  
  if(!$id==""){
     $check=mysqli_num_rows(mysqli_query($con,"select * from subject_details where id='$id'"));
     if($check>0){
        $subject_details=mysqli_fetch_array(mysqli_query($con,"select * from subject_details where id='$id'"));
        if($subject_details){
           $btn_name="Update";
           $subject_name=$subject_details['subject_name'];
        }else{
            echo '<script>alert("Server Error 101.");window.location.assign("add_subjects");</script>'; 
        }
     }else{
      echo '<script>alert("Batch Not available.");window.location.assign("add_subjects");</script>';    
     } 
    
  }else{
      echo '<script>alert("Please fill All data.");window.location.assign("add_subjects");</script>'; 
  }
}


if(isset($_POST['Update'])){
  $subject_name=VerifyData($_POST['subject_name']);
  
  if(!$subject_name==""){
    
         $update=mysqli_query($con,"update subject_details set subject_name='$subject_name' where id='$id'"); 
        if($update){
            echo '<script>alert("Subject Name Update Sucessfully Done .");window.location.assign("add_subjects");</script>'; 
        }else{
            echo '<script>alert("Server Error 101.");window.location.assign("add_subjects");</script>'; 
        }
    
    
  }else{
      echo '<script>alert("Please fill All data.");window.location.assign("add_subjects");</script>'; 
  }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Course Bind Subject | <?php echo $brand_name; ?></title>
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
    
  <style type="text/css">
      .drop_course{
	background: #157daf !important;
}

.course_wise_subjects{
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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
            <div class="col-12">
                <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Bind course wise subject</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            
                <div class="card-body">
                 <div class="row">
                  <div class="col-md-4 form-group">
                    <label for="course_id">Select Course</label>
                      
                      <select name="course_id" id="course_id" class="form-control" onchange="get_feild_data(this.value)">
                          <option value="">Select</option>
                          
                          <?php 
                           $sql_course=mysqli_query($con,"select * from course_details order by name");
                           while($row=mysqli_fetch_array($sql_course)){
                               
                               ?>
                               <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                               <?php 
                           }
                           
                          ?>
                          
                      </select>
                  </div>
                  <div class="col-md-8">
                <div class="row" id="feild_data">
                    
                    
                  
                  </div>
                  </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="" id="Create_btn" onclick="create_data_sb()" class="btn btn-primary">Create</button>
                 <span style="color:blue;display:none;" id="Create_btn_span">Please wait ....</span>
                </div>
           
            </div>
            </div>
            
            
           
            
            
          </div>
        </div>
     </section>
     <!-- Main content -->
            
         <div  id="data_table_set"> 
            
            <!-- /.content -->
         </div>  
    
    
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
    
     function delete_selecte_bind_data(val,val2){
         if(confirm("Are you sure for delete this bind subject data?")){
          $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'delete_course_bind_data='+val,
                success: function(data){
              if(data==1){
                data_table_details(val2);
                $("#feild_data").html("");
                  $("#course_id").val("");
                alert("Targetd bind data deleted successfully done.");
              }else{
                  alert(data);
              }    
                }
              }
              );
         }
     }
    
      function data_table_details(val){
            $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'get_data_table_course_wise_subject='+val,
                success: function(data){
            
                $("#data_table_set").html(data);
                
                }
              }
              );
      }
    
       function create_data_sb(){
            var course_id=$("#course_id").val();
            var subject_id=$("#subject_id").val();
            var subject_marks=$("#subject_marks").val();
            if(!course_id==""){
                if(!subject_id==""){
                   if(!subject_marks==""){
                  document.getElementById("Create_btn").style.display="none";
                  document.getElementById("Create_btn_span").style.display="block";
                $.ajax(
                   {
                    type:"GET",
                    url:"get_data",
                    data:'create_subject_wise_course='+course_id+'&subject_id='+subject_id+'&subject_marks='+subject_marks,
                    success: function(data){
                   if(data==1){
                    $("#feild_data").html("");
                    $("#course_id").val("");
                    alert("Subject bind success fully done.");
                    document.getElementById("Create_btn").style.display="block";
                    document.getElementById("Create_btn_span").style.display="none";
                    data_table_details(course_id);
                    
                   }else{
                       alert(data);
                       $("#feild_data").html("");
                       $("#course_id").val("");
                       document.getElementById("Create_btn").style.display="block";
                       document.getElementById("Create_btn_span").style.display="none";
                   }        
                    }
                    }
                  );
                      
                   }else{
                    alert("Please insert max marks.");    
                   }
                    
                }else{
                  alert("Please select subject.");  
                }
            }else{
                alert("Please select course.");
            }
       }
    
    
        function get_feild_data(val){
            data_table_details(val);
             $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'get_add_course_subject_data='+val,
                success: function(data){
            
                $("#feild_data").html(data);
                }
              }
              );
              
        }
    
    
    
     
      
    </script>
</body>
</html>
