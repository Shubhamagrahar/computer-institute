<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");
unset($_SESSION['cert_edit_refer_url']);


function frenchise_course_fee($ida,$mob){
    global $con;
    global $t_date;
    global $c_date;
    $sql_data=mysqli_fetch_array(mysqli_query($con,"select * from branch_details where userid='$ida'"));
    if($sql_data['student_certificate_fee']=="Yes"){
        $op_bal=$sql_data['wallet'];
       $cl_bal=$op_bal - $sql_data['per_certificate_fee'] ;
       $update_wallet=mysqli_query($con,"update branch_details set wallet='$cl_bal' where userid='$ida'");
       if($update_wallet){
          
           
           $description="New Certificate issue franchise charge for : ".$mob;
         $teransactionIntsert=mysqli_query($con,"insert into `branch_transaction`(`userid`, `des`, `debit`, `date`, `c_date`, `op_bal`, `cl_bal`, `by_userid`) values('$ida', '$description', '$sql_data[per_course_fee]', '$t_date', '$c_date', '$op_bal', '$cl_bal', '$ida')");  
        if($teransactionIntsert){
            return 1;
        }else{
           return "Function error 102."; 
        }
           
       }else{
           return "Function error 101.";
       }
    }else{
        return 1;
    }
}




if(isset($_GET['verify_id'])){
    $id=VerifyData($_GET['verify_id']);
    if(!$id==""){
     $sql=mysqli_query($con,"select * from student_certificate where id='$id' and status='DONE'");
     if(mysqli_num_rows($sql)==1){
         $result=mysqli_fetch_array($sql);
         $student_details=mysqli_fetch_array(mysqli_query($con,"select * from user where mobile='$result[mobile]'"));
         if($result and $student_details){
            if(frenchise_course_fee($student_details['branch_id'],$result['mobile'])==1){
               
               $update=mysqli_query($con,"update student_certificate set status='VERIFY' where id='$id'");
               if($update){
                 
              
                 $sql_req=mysqli_query($con,"select * from student_certificate_request where mobile='$result[mobile]' and course_id='$result[course_id]' and status='OPEN'") ; 
                      if(mysqli_num_rows($sql_req)==1) {
                        $result1=mysqli_fetch_array($sql_req)  ;
                        $update_req=mysqli_query($con,"update student_certificate_request set status='CLOSE' where id='$result1[id]'");
                        if($update_req){
                           echo '<script>alert("The certificate verified successfully done.");window.location.assign("certificate_pending")</script>'; 
                        }else{
                         echo '<script>alert("Server error 104.");window.location.assign("certificate_pending")</script>';    
                        }
                      }else{
                    echo '<script>alert("The certificate verified successfully done.");window.location.assign("certificate_pending")</script>';
                   
                      } 
              
                   
               }else{
                echo '<script>alert("Server Error 103.");window.location.assign("certificate_pending")</script>';   
               }
                
            }else{
             echo '<script>alert("Server Error 103.");window.location.assign("certificate_pending")</script>';   
            }
             
         }else{
            echo '<script>alert("Server Error 102.");window.location.assign("certificate_pending")</script>';  
         }
     }else{
      echo '<script>alert("Not valid URL.");window.location.assign("certificate_pending")</script>';    
     }
        
    }else{
     echo '<script>alert("Server Error 101.");window.location.assign("certificate_pending")</script>';   
    }
    
}



if(isset($_GET['delete_id'])){
    $id=VerifyData($_GET['delete_id']);
    if(!$id==""){
        $sql=mysqli_query($con,"select * from student_certificate where id='$id'");
        if(mysqli_num_rows($sql)==1){
            $result=mysqli_fetch_array($sql);
            
            $unlink=unlink("../".$result['photo']);
            if($unlink){
                $delete=mysqli_query($con,"delete from student_certificate where id='$id'");
                if($delete){
                    echo '<script>alert("Certificate deleted successfully done.");window.location.assign("certificate_pending")</script>';
                }else{
                   echo '<script>alert("Server Error 103.");window.location.assign("certificate_pending")</script>'; 
                }
            }else{
             echo '<script>alert("Server Error 102.");window.location.assign("certificate_pending")</script>';    
            }
            
        }else{
          echo '<script>alert("Server Error 101.");window.location.assign("certificate_pending")</script>';  
        }
        
    }else{
        echo '<script>alert("Something went wrong.");window.location.assign("certificate_pending")</script>';
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pending Certificate | <?php echo $brand_name; ?></title>
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
          .certificate_drop{
    	background: #157daf !important;
    }
    
    .certificate_pending{
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
                            <h1>Pending Certificate</h1>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>


           
           
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Pending Certificate Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                 <th>Reg No.</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                               
                                                <!--<th>Date Of Birth</th>-->
                                                <th>Certificate No.</th>
                                                <th>Course Name</th>
                                                <th>create Date</th>
                                                <th>Certificate</th>
                                                <th>Marksheet</th>
                                                <th width="60px">Action</th>
                                                
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php
                                            $i=0;
                                            
                                            
                                            $sql_certificate=mysqli_query($con,"select * from student_certificate where status='DONE' order by id desc");
                                            while($row=mysqli_fetch_array($sql_certificate)){
                                            $date_dob=date_create($row['dob']);
                                             $date_dob=date_format($date_dob,"d-m-Y");
                                             $date_upload=date_create($row['upload_date']);
                                             $date_upload=date_format($date_upload,"d-m-Y");
                                           $course_details=mysqli_fetch_array(mysqli_query($con,"select * from course_details where id='$row[course_id]'"));
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $row['reg_no']; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['mobile']; ?></td>
                                                <!--<td><?php echo $row['email']; ?></td>-->
                                                <!--<td><?php echo $date_dob; ?></td>-->
                                                <td><?php echo $row['certificate_no']; ?></td>
                                                <td><?php echo $course_details['name'];?></td>
                                                <td><?php echo $date_upload; ?></td>
                                               <td><a title="Print Certificate" target="_blank" style="color:blue;" href="print_certificate?data_id=<?php echo $row['id'] ;?>"><i class="fa fa-print" aria-hidden="true"></i> Print</a></td>
                                             <td><a title="Print Certificate" target="_blank" style="color:blue;" href="print_marksheet?data_id=<?php echo $row['id'] ;?>"><i class="fa fa-print" aria-hidden="true"></i> Print</a></td>
                                             <td>
                                                 
                                                 <a title="Verify Certificate" onclick="return confirm('Are you sure for verify this certificate?')" style="color:green;" href="certificate_pending?verify_id=<?php echo $row['id'] ;?>"><i class="fa fa-check" aria-hidden="true"></i>Verify</a><br>
                                               <a title="Delete Certificate" onclick="return confirm('Are you sure for delete this certificate?')" style="color:red;" href="certificate_pending?delete_id=<?php echo $row['id'] ;?>"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a><br>
                                               <a title="Edit Certificate" onclick="return confirm('Are you sure for edit this certificate?')" style="color:blue;" href="certificate_edit?data_id=<?php echo $row['id'] ;?>"><i class="fa fa-edit" aria-hidden="true"></i>Edit</a>
                                                 
                                                 
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
                        
                        
                    </div>
                </div>
            </section>
            
           
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