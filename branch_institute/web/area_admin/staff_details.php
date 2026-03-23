<?php 
include 'session.php'; 

$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

if($branch_access_details['staff_system']=="YES"){
    
}else{
    mysqli_close($con);
    echo '<script>window.location.assign("index");</script>';
}


if(isset($_GET['delete'])){
    $id=VerifyData($_GET['delete']);
    if(!$id==""){
        $delete=mysqli_query($con,"delete from user where id='$id'");
        if($delete){
           $delete1=mysqli_query($con,"delete from wallet where userid='$id'"); 
           if($delete1){
              echo '<script>alert("Staff data delete successfully done.");window.location.assign("staff_details");</script>';
           }else{
            echo '<script>alert("Server error 103.");window.location.assign("staff_details");</script>';    
           }
        }else{
         echo '<script>alert("Server error 102.");window.location.assign("staff_details");</script>';   
        }
    }else{
        echo '<script>alert("Server error 101.");window.location.assign("staff_details");</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Staff Details |
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
          .staff_drop{
    	background: #157daf !important;
    }
    
    .staff_details1{
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
                            <h1>All Staff Details</h1>
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
                                    <h3 class="card-title"></h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th>Mobile No.</th>
                                                <th>Father Name</th>
                                                <th>Email</th>
                                                <th>Date Of Birth</th>
                                                <th>Gender</th>
                                                <th>Whatsapp No.</th>
                                                <th>State</th>
                                               <th>Pin Code</th>
                                               <th>Full Address</th>
                                               <th>Qualification</th>
                                               <th>Designation</th>
                                               <th>Date Of Joining</th>
                                               <th>Monthly Salary</th>
                                               <th>ID Card</th>
                                               <th>Edit</th>
                                               <th>Delete</th>
                                              
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            
                                              if($login_details['type']==1){
                                                    $branch_id=$_SESSION['userid'];
                                                }else{
                                                   $branch_id=$login_details['branch_id'];
                                                }
                                                                            
                                            $i=0;
                                            $sql_d=mysqli_query($con,"select * from user where branch_id='$branch_id' and type='2' order by id desc");
                                            while($row=mysqli_fetch_array($sql_d)){
                                            $dob=date_create($row['dob']);
                                            $dob=date_format($dob,"d-m-Y");
                                           $sql_state=mysqli_fetch_array(mysqli_query($con,"select * from states where id='$row[state_id]'"));
                                            $staff_details=mysqli_fetch_array(mysqli_query($con,"select * from staff_details where userid='$row[id]'"));
                                           $doj=date_create($staff_details['doj']);
                                            $doj=date_format($doj,"d-m-Y");
                                            ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><img width="60px" src="<?php echo $web_link.$row['photo']; ?>"></td>
                                                <td style="text-transform: capitalize;"><?php echo $row['name'] ;?></td>
                                                <td style="text-transform: capitalize;"><?php echo $row['mobile'] ;?></td>
                                                <td style="text-transform: capitalize;"><?php echo $row['father_name'] ;?></td>
                                                <td><?php echo $row['email'] ;?></td>
                                                <td><?php echo $dob ;?></td>
                                                <td><?php echo $row['gender'] ;?></td>
                                                <td><?php echo $row['w_mob'] ;?></td>
                                                <td><?php echo $sql_state['name'];?></td>
                                                <td><?php echo $row['pin'];?></td>
                                                <td><?php echo $row['full_add'];?></td>
                                                <td><?php echo $staff_details['qualification'];?></td>
                                                <td><?php echo $staff_details['designation'];?></td>
                                                <td><?php echo $doj;?></td>
                                                <td><?php echo $staff_details['monthly_salary'];?></td>
                                                <td><a title="Print Id Card" target="_blank" style="color:blue;" href="staff_id_card?data_id=<?php echo $row['id'] ;?>"> <button class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Print</button></a></td>
                                                 <td><a target="_blank" href="staff_wise_details?mobile=<?php echo $row['mobile'] ;?>&search=Search"><span style="color:blue;"><i class="fa fa-edit"></i> Edit</span></a></td>
                                                <td><a onclick="return confirm('Are you sure for delete this staff?')" href="staff_details?delete=<?php echo $row['id'] ; ?>"><span style="color:red;"><i class="fa fa-trash"></i> Delete</span></a></td>
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