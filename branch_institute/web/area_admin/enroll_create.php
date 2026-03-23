<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");


$start=1;
if(isset($_POST['Next_process'])){
    $mobile=VerifyData($_POST['mobile']);
    if(!$mobile==""){
        
        $check=mysqli_query($con,"select * from user where mobile='$mobile'");
        if(mysqli_num_rows($check)==1){
           $start=2; 
           $result=mysqli_fetch_array($check);
           if($result['branch_id']==$_SESSION['userid']){
           $name=$result['name'];
           $email_id=$result['email'];
           $btn_name="old_enroll";
           }else{
            echo '<script>alert("Entered Mobile number already list with other franchise.");window.location.assign("enroll_create")</script>';   
            die();
           }
           
           
        }else{
           $start=2; 
           $name="";
           $email_id="";
           $btn_name="new_enroll";
        }
        
    }else{
        echo '<script>alert("Please enter mobile number.");window.location.assign("enroll_create")</script>';
    }
}



if(isset($_POST['old_enroll'])){
    
    $courseid=VerifyData($_POST['course_id']);
    $name=VerifyData($_POST['name']);
    $email_id=VerifyData($_POST['email']);
    $mobile=VerifyData($_POST['mobile']);
    
    if(!$courseid=="" and !$name=="" and !$email_id=="" and !$mobile=="" ){
        $check_course=mysqli_query($con,"select * from course_details where id='$courseid'");
        if(mysqli_num_rows($check_course)==1){
            $course_details=mysqli_fetch_array($check_course);
            $check_mobile=mysqli_num_rows(mysqli_query($con,"select * from user where mobile='$mobile'"));
            if($check_mobile==1){
              $user_details=mysqli_fetch_array(mysqli_query($con,"select * from user where mobile='$mobile'"));
              
            $update=mysqli_query($con,"update user set branch_id='$_SESSION[userid]', name='$name', email='$email_id' where id='$user_details[id]'");    
            if($update){
                
                if($update){
                 
                  if($update){
                     $create_course=mysqli_query($con,"insert into `course_book`(`userid`, `course_id`, `fee`, `book_date`) values('$user_details[id]', '$courseid', '$course_details[fee]', '$t_date')");
                    $course_inert_id=mysqli_insert_id($con);
                      if($create_course){
                         $link="enroll_final?ids=".$course_inert_id;
                        echo '<script>alert("Course Enroll successfully done. Please do next step.");window.location.assign("'.$link.'")</script>'; 
                        $form_status=2;
                     }else{
                        echo '<script>alert("Server Error 104.");</script>'; 
                     }
                      
                  }else{
                     echo '<script>alert("Server Error 103.");</script>'; 
                  }
                  
                }else{
                    echo '<script>alert("Server Error 102.");</script>';  
                }
            }else{
              echo '<script>alert("Server Error 101.");</script>';  
            }
            }else{
                echo '<script>alert("Mobile number not registered.");</script>';
            }
        }else{
            echo '<script>alert("Please select course.");</script>';
        }
    }else{
        echo '<script>alert("Please fill all feild.");</script>';
    }
}


if(isset($_POST['new_enroll'])){
    
    $courseid=VerifyData($_POST['course_id']);
    $name=VerifyData($_POST['name']);
    $email_id=VerifyData($_POST['email']);
    $mobile=VerifyData($_POST['mobile']);
    
    if(!$courseid=="" and !$name=="" and !$email_id=="" and !$mobile=="" ){
        $check_course=mysqli_query($con,"select * from course_details where id='$courseid'");
        if(mysqli_num_rows($check_course)==1){
            $course_details=mysqli_fetch_array($check_course);
            $check_mobile=mysqli_num_rows(mysqli_query($con,"select * from user where mobile='$mobile'"));
            if(!$check_mobile>0){
             $pass=rand(100000,999999);
            $insert=mysqli_query($con,"insert into `user`(`branch_id`, `name`, `mobile`, `pass`, `email`, `r_date`) values('$_SESSION[userid]', '$name', '$mobile', '$pass', '$email_id', '$t_date')");    
            if($insert){
                $insert_id=mysqli_insert_id($con);
                if($insert_id>0){
                  $insert_wallet=mysqli_query($con,"insert into `wallet`(`userid`) values('$insert_id')");
                  if($insert_wallet){
                     $create_course=mysqli_query($con,"insert into `course_book`(`userid`, `course_id`, `fee`, `book_date`) values('$insert_id', '$courseid', '$course_details[fee]', '$t_date')");
                    $course_inert_id=mysqli_insert_id($con);
                      if($create_course){
                         $link="enroll_final?ids=".$course_inert_id;
                        echo '<script>alert("Course Enroll successfully done. Please do next step.");window.location.assign("'.$link.'")</script>'; 
                        $form_status=2;
                     }else{
                        echo '<script>alert("Server Error 104.");</script>'; 
                     }
                      
                  }else{
                     echo '<script>alert("Server Error 103.");</script>'; 
                  }
                  
                }else{
                    echo '<script>alert("Server Error 102.");</script>';  
                }
            }else{
              echo '<script>alert("Server Error 101.");</script>';  
            }
            }else{
                echo '<script>alert("Mobile number already registered.");</script>';
            }
        }else{
            echo '<script>alert("Please select course.");</script>';
        }
    }else{
        echo '<script>alert("Please fill all feild.");</script>';
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Enroll | <?php echo $brand_name; ?></title>
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
          .drop_enroll{
    	background: #157daf !important;
    }
    
    .enroll_create{
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
                            <h1>Enroll Student</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>


            <!--Main Content section start-->
            <?php 
            if($start==1){
            ?>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-4">
                            
                        </div>
                        <div class="col-4">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Enroll Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" name="form_23">
                                    <div class="card-body ">
                                        <div class="row">
                                           
                                            <div class="col-md-12">
                                                <label>Mobile No.</label>
                                                <input type="text" required name="mobile" value="" class="form-control" placeholder="Enter mobile number.">
                                            </div>
                                          
                                           
                                           
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" name="Next_process" class="btn btn-primary">Next</button>
                                       
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </section>
            <?php }?>
            
            
            <?php 
            if($start==2){
            ?>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Enroll Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" name="form_2">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name: <span style="color:red;">*</span></label>
                                                <input type="text" required name="name"
                                                    value="<?php echo $name ;?>" class="form-control" placeholder="Enter student name.">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Mobile No. <span style="color:red;">*</span></label>
                                                <input type="text" readonly name="mobile"
                                                    value="<?php echo $mobile ;?>" class="form-control" placeholder="Enter mobile number.">
                                            </div>
                                           <div class="col-md-6">
                                                <label>Email: <span style="color:red;">*</span></label>
                                                <input type="text" required name="email"
                                                    value="<?php echo $email_id ;?>" class="form-control" placeholder="Enter email Id.">
                                            </div>
                                            
                                            <div class="col-md-6">
                                                 <label for="course_id">Course Name: <span style="color:red;">*</span></label>
                                                    <select id="course_id" name="course_id" class="form-control" onchange="get_fee(this.value)">
                                                    <option value="">Please select</option>
                                                    <?php
                                                    $sql_course=mysqli_query($con,"select * from course_details where status='OPEN'");
                                                    while($row=mysqli_fetch_array($sql_course)){
                                                    ?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                                    <?php } ?>
                                                    </select>
                                            </div>
                                           <div class="col-md-6" id="course_fee_label" style="display:none;">
                                                 <label for="course_fee" >Course Fee: <span style="color:red;">*</span></label>
                                                 <input type="text" id="course_fee" readonly class="form-control" name="course_fee"  value="" required placeholder="Enter your name">
                                            </div>
                                           
                                            
                                            
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" name="<?php echo $btn_name ; ?>" id="update_bank"
                                             class="btn btn-primary">Next</button>
                                       
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </section>
            
            <?php } ?>
            <!--Main content section end-->

            
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
       		
    
    		
    		function get_fee(val){
    		  
    		    $.ajax(
              {
                type:"GET",
                url:"get_data",
                data:'fee_details='+val,
                success: function(data){
                    
                    if(data>0){
                        
                    document.getElementById("course_fee_label").style.display="block";
                   
                 $("#course_fee").val(data);
                    }
                }
              }
              );
    		}
    		
    	
            
  
    	
    	</script>
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
</body>

</html>