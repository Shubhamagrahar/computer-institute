<?php 
include 'session.php'; 

if(add_on_check("Learning Management System") == 1){
    
}else{
    echo '<script>alert("This is an add-on service. Please contact the administrator to activate or purchase access."); window.location.assign("./");</script>';

} 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");


$btnname="Create";

if(isset($_POST['Create'])){
    
    $heading=VerifyData($_POST['heading']);
    $content=VerifyData($_POST['content']);
    $course_id=VerifyData($_POST['course_id']);
     
     
    if(!$heading=="" and !$content=="" and !$course_id==""){
        // $check_name=mysqli_num_rows(mysqli_query($con, "select * from lms_content where name='$course_name'"));
        // if(!$check_name>0){
          $insert=mysqli_query($con,"insert into `lms_content`(`course_id`, `heading`, `content`) values('$course_id', '$heading', '$content')");
               if($insert){
                   echo '<script>alert("Content created successfuly done.");window.location.assign("lms_content")</script>'; 
               }else{
                 echo '<script>alert("Server error 101.");window.location.assign("lms_content")</script>';  
               } 
        //  }else{
        //   echo '<script>alert("This course name already exist.");window.location.assign("lms_content")</script>'; 
        // }
    }else{
     echo '<script>alert("Please fill all the fields");window.location.assign("lms_content")</script>';   
    }
}


if(isset($_GET['status'])){
    $status=VerifyData($_GET['status']);
    $id=VerifyData($_GET['id']);
    if(!$status=="" and !$id==""){
        $update =mysqli_query($con,"update lms_content set status='$status' where id='$id'");
        if($update){
            echo '<script>alert("Status update Sucessfully Done.");window.location.assign("lms_content");</script>';
        }else{
         echo '<script>alert("Server error 202.");window.location.assign("lms_content");</script>';   
        }
    }else{
      echo '<script>alert("Somthing Went Wrong.");window.location.assign("lms_content");</script>';   
    }
}

if(isset($_GET['edit'])){
    $id=VerifyData($_GET['edit']);
    if(!$id==""){
        $content_details=mysqli_query($con,"select * from lms_content where id='$id'");
        if(mysqli_num_rows($content_details)>0){
            $content_details=mysqli_fetch_array($content_details);
            $content_course_id=$content_details['course_id'];
            $content_heading=$content_details['heading'];
            $content_desc=$content_details['content'];
            $btnname="Update";
        }else{
         echo '<script>alert("Content not availabel.");window.location.assign("lms_content");</script>';    
        }
    }else{
      echo '<script>alert("Somthing Went Wrong.");window.location.assign("lms_content");</script>';   
    }
}

if(isset($_POST['Update'])){
    
    $heading=VerifyData($_POST['heading']);
    $content=VerifyData($_POST['content']);
    $course_id=VerifyData($_POST['course_id']);
    
              $update=mysqli_query($con,"update lms_content set course_id='$course_id', heading='$heading', content='$content' where id='$id'");
               if($update){
                   
                   echo '<script>alert("Content update successfuly done.");window.location.assign("lms_content")</script>'; 
                  
               }else{
                 echo '<script>alert("Server error 101.");window.location.assign("lms_content")</script>';  
               } 
          
}
if(isset($_GET['delete'])){
    $status=VerifyData($_GET['delete']);
    $id=VerifyData($_GET['id']);
    if($status=="YES" && !$id==""){
        $delete =mysqli_query($con,"delete from lms_content where id='$id'");
        if($delete){
            echo '<script>alert("Deleted Sucessfully Done.");window.location.assign("lms_content");</script>';
        }else{
         echo '<script>alert("Server error 203.");window.location.assign("lms_content");</script>';   
        }
    }else{
      echo '<script>alert("Somthing Went Wrong.");window.location.assign("lms_content");</script>';   
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LMS Content |
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
    <script src="ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    
     <style type="text/css">
          .drop_lms{
    	background: #157daf !important;
    }
    
    .lms_content{
    	background: #157daf !important;
    }
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ff0000;
  transition: 0.4s;
  border-radius: 34px;
  line-height: 34px;
  font-weight: bold;
  color: white;
  font-size: 13px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  transition: 0.4s;
  border-radius: 50%;
}

.slider::after {
  content: "NO";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  line-height: 34px;
  font-weight: bold;
  font-size: 12px;
  color: white;
  padding-right: 8px;
  text-align: right;
}


input:checked + .slider {
  background-color: #28a745;
  text-align: left;
}

input:checked + .slider:before {
  transform: translateX(26px);
}

input:checked + .slider::after {
  content: "YES";
  text-align: left;
  padding-left: 8px;
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
                            <h1>Content</h1>
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
                                    <h3 class="card-title">Add Content</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" name="form_2" enctype="multipart/form-data">
                                    <div class="card-body ">
                                        <div class="row">
                                            
                                            <div class="col-md-6" id="course_fee_label" >
                                                 <label>Course:</label>
                                                 <select name="course_id" id="course_id" required class="form-control" >
                                                   <option value="">Select</option> 
                                                   <?php
                                                   $sql_course=mysqli_query($con,"select * from course_details order by id desc ");
                                                   while($row=mysqli_fetch_array($sql_course)){
                                                       ?>
                                                       <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option> 
                                                       <?php
                                                   }
                                                   ?>
                                                   
                                                 </select>
                                            </div>
                                            <script>
                                           $("#course_id").val('<?php echo $content_details['course_id'];?>');
                                            </script>
                                            <br>
                                            <div class="col-sm-6" >
                                            <label>Heading: </label>
                                            <input type="text" class="form-control" required value="<?php echo $content_heading ;?>" name="heading" id="heading" placeholder="Enter heading.">
                                            </div>
                                            <br>
                                           
                                        <div class="col-sm-12" style="margin-top:5px;">
                                            <label>Content:</label> <br>
                                            <textarea name="content" rows="5" cols="80" ><?php echo $content_desc ;?></textarea>
                    
                                        </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                         <button style="margin-bottom:10px;" name="<?php echo $btnname; ?>" class="btn btn-success"><?php echo $btnname; ?></button>
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
                                    <h3 class="card-title">Content Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            <th width="40px">Sr. No.</th>
                                            <th>Course</th>
                                            <th>Heading</th>
                                            <th>Content</th>
                                            <th>Show</th>
                                            <th width="70px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                             $sql_content=mysqli_query($con,"select * from lms_content where status='SHOW' or status='HIDE' order by id desc");
                                            while($row=mysqli_fetch_array($sql_content)){
                                         
                                             $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$row[course_id]'"));
                                               
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $course_details['name']; ?></td>
                                                <td><?php echo $row['heading']; ?></td>
                                               <td>
                                              <!-- View Button -->
                                              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#contentModal<?php echo $row['id']; ?>">
                                                View
                                              </button>
                                            
                                              <!-- Modal -->
                                              <div class="modal fade" id="contentModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="contentModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
                                                <div class="modal-dialog modal-xl" role="document">
                                                  <div class="modal-content">
                                                  
                                                    <div class="modal-header">
                                                      <h5 class="modal-title" id="contentModalLabel<?php echo $row['id']; ?>">LMS CONTENT</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                      </button>
                                                    </div>
                                                    
                                                    <div class="modal-body" style="text-align: left;">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Course Name</label>
                                                                <input type="text" class="form-control" value="<?php echo $course_details['name']; ?>" readonly>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Heading</label>
                                                                <input type="text" class="form-control" value="<?php echo $row['heading']; ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <label>Content:</label>
                                                      <p><?php echo $row['content']; ?></p>
                                                     
                                                    </div>
                                                    
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                    
                                                  </div>
                                                </div>
                                              </div>
                                            </td>

                                              <td>
                                                  <label class="switch">
                                                    <input type="checkbox" onchange="toggle_lms_status(this, <?php echo $row['id']; ?>, 'status', 'lms_content')" <?php echo ($row['status'] == 'SHOW') ? 'checked' : ''; ?>>
                                                    <span class="slider round"></span>
                                                  </label>
                                                </td>
                                             <td>
                                                <a href="#" onclick="confirmEdit(<?php echo $row['id']; ?>)" style="color:blue;">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a><br>
                                            
                                                <a href="#" onclick="confirmDelete(<?php echo $row['id']; ?>)" style="color:red;">
                                                    <i class="fa fa-trash-o"></i> Delete
                                                </a>
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
      <script src="plugins/toastr/toastr.min.js"></script>
      <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>

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
        function show_des_function(val,val1){
            document.getElementById(val).style.display="block";
            document.getElementById(val1).style.display="none";
        }
        function hide_des_function(val,val1){
            document.getElementById(val).style.display="none";
            document.getElementById(val1).style.display="block";
        }
        
             function toggle_lms_status(element, id, field, table) {
    let newStatus = element.checked ? 'SHOW' : 'HIDE';

    $.ajax({
        url: 'get_data',  
        type: 'GET',
        data: {
            change_lms_content: 1,
            id: id,
            field: field,           
            status: newStatus,
            table : table
        },
        success: function(response) {
            toastr.success('Status updated successfully!');
        },
        error: function() {
            toastr.error('An error occurred. Please try again.');  
            element.checked = !element.checked; 
        }
    });
}
    </script>
    
    <script>
        function confirmEdit(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to edit this course?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, edit it!',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'lms_content?edit=' + id;
        }
    });
}

function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You will not be able to recover this course!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#e3342f',
        cancelButtonColor: '#6c757d'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'lms_content?delete=YES&id=' + id;
        }
    });
}

    </script>
</body>

</html>