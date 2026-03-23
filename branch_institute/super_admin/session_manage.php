<?php 
include 'session.php'; 


$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Session Managment |
        <?php echo $brand_name; ?>
    </title>
    <!-- Favicons -->
    <link href="<?php echo $brand_logo; ?>" rel="icon">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    
     <style type="text/css">
          .session_drop{
    	background: #157daf !important;
    }
    
    .session_manage{
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
                            <h5>Session Managment</h5>
                        </div>
                        <div class="col-sm-6" id="create_span">
                            <span onclick="create_session_fld()" style="float:right; margin-right:10px; color: #50af06; cursor: pointer;"><i class="fa fa-plus"></i> Create Session</span>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
            </section>
            
      
            
            <section class="content-header" style="display:none;" id="create_session">
               
            </section>

  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  
           

            <!-- Main content -->
            <section class="content" id="data_table">
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
                                                <th>Session</th>
                                                <th>Session Start Date</th>
                                                <th>Session End Date</th>
                                                <th>Status</th>
                                                <th>Edit</th>
                                                
                                                
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                            $sql_d=mysqli_query($con,"select * from session_details order by id desc");
                                            while($row=mysqli_fetch_array($sql_d)){
                                             
                                             $date_se1=date_create($row['sed']);
                                             $date_se=date_format($date_se1,"y");
                                             $date_ss1=date_create($row['ssd']);
                                             $date_ss=date_format($date_ss1,"Y");
                                             $date_sed=date_format($date_se1,"d-m-Y");
                                             $date_ssd=date_format($date_ss1,"d-m-Y");
                                             
                                             ?>
                                            <tr>
                                                <td><?php echo $i +=1; ?></td>
                                                <td><?php echo $date_ss."-".$date_se ; ?></td>
                                                <td><?php echo $date_ssd ;?></td>
                                                <td><?php echo $date_sed ;?></td>
                                                <td><?php 
                                                if($row['status']=="RUN"){
                                                    ?>
                                                 <span>Selected</span>    
                                                    <?php
                                                }
                                                
                                                if($row['status']=="STOP"){
                                                    ?>
                                                    <button class="btn btn-success" onclick="selected_session_y(<?php echo $row['id'] ;?>)">Select</button>
                                                    <?php 
                                                }
                                                
                                                ?></td>
                                                <td><span style="cursor:pointer; color:blue;font-size: 15px;" onclick="selected_session_edit('<?php echo $row['id'] ;?>')"><i class="fa fa-edit"></i>Edit</span></td>
                                               
                                                
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
<script>

    function update_data_session(val){
        var update_ssd=$("#update_ssd").val();
        var update_sed=$("#update_sed").val();
        if(!update_ssd==""){
          if(!update_sed==""){
              document.getElementById("create_data_btn").style.display="none";
               document.getElementById("create_data_span").style.display="block";
               $.ajax(
              {
                type:"GET",
                url:"session_manage_data",
                data:'update_session_data='+val+'&update_ssd='+update_ssd+'&update_sed='+update_sed,
                success: function(data){
                 
                 if(data=="1"){
                     get_table_data();
                     toastr.success('<span style="font-size:15px;">Session update successfully done.</span>');
                     document.getElementById("create_session").style.display="none";
                 }else{
                  toastr.error('<span style="font-size:15px;">server error '+data+'.</span>');  
                 }
                 document.getElementById("create_data_btn").style.display="block";
               document.getElementById("create_data_span").style.display="none";
                }
              }
                );
              
          }else{
            toastr.warning('<span style="font-size:15px;">Please select session end date.</span>');  
          }  
        }else{
          toastr.warning('<span style="font-size:15px;">Please select session start date.</span>');   
        }
    }
    
    function selected_session_edit(val){
        if(!val==""){
            //document.getElementById("create_session").style.display="block";
           // $("#create_session").html(val);
            $.ajax(
              {
                type:"GET",
                url:"session_manage_data",
                data:'get_edbl_data='+val,
                success: function(data){
                 if(data==101){
                  toastr.error('<span style="font-size:15px;">server error '+data+'.</span>');    
                 }else if(data==102){
                    toastr.error('<span style="font-size:15px;">server error '+data+'.</span>');  
                 }else{
                         document.getElementById("create_session").style.display="block";
                        $("#create_session").html(data); 
                        window.location.assign("session_manage#create_session")
                 }
              
                
                }
              }
                );
           
        }
    }
    
  function selected_session_y(val){
    
       $.ajax(
              {
                type:"GET",
                url:"session_manage_data",
                data:'selected_session_data='+val,
                success: function(data){
                 
                 if(data=="Yes"){
                     get_table_data();
                     toastr.success('<span style="font-size:15px;">Session Create successfully done.</span>');
                     
                 }else{
                  toastr.error('<span style="font-size:15px;">server error '+data+'.</span>');  
                 }
                }
              }
                );
  }

function get_table_data(){
     $.ajax(
              {
                type:"GET",
                url:"session_manage_data",
                data:'session_table_data=<?php echo session_id(); ?>',
                success: function(data){
                 $("#data_table").html(data);
                 
                }
              }
                );
}

  function create_data_session(){
      var create_ssd=$("#create_ssd").val();
      var create_sed=$("#create_sed").val();
      
       if(!create_ssd==""){
           if(!create_sed==""){
               document.getElementById("create_data_btn").style.display="none";
               document.getElementById("create_data_span").style.display="block";
               
              $.ajax(
              {
                type:"GET",
                url:"session_manage_data",
                data:'create_session_ssd='+create_ssd+'&create_sed='+create_sed,
                success: function(data){
                    
                  if(data==1){
                      $("#create_ssd").val("0000-00-00");
                    $("#create_sed").val("0000-00-00");
                    toastr.success('<span style="font-size:15px;">Session Create successfully done.</span>');   
                   document.getElementById("create_session").style.display="none";
                   document.getElementById("create_span").style.display="block";
                    get_table_data();
                  }else{
                     toastr.error(data); 
                  }
                   document.getElementById("create_data_btn").style.display="block";
                      document.getElementById("create_data_span").style.display="none"; 
                }
              }
              );
              
           }else{
             toastr.warning('<span style="font-size:15px;">Please select session end date.</span>');  
           }
           
       }else{
         toastr.warning('<span style="font-size:15px;">Please select session start date.</span>');  
       }
  }

  function create_session_fld(){
      document.getElementById("create_session").style.display="block";
      document.getElementById("create_span").style.display="none";
      $.ajax(
              {
                type:"GET",
                url:"session_manage_data",
                data:'new_create_session_data=<?php echo session_id(); ?>',
                success: function(data){
                 $("#create_session").html(data);
                 
                }
              }
                );
     
  }
  
   function cancel_session_fld(){
      document.getElementById("create_session").style.display="none";
      document.getElementById("create_span").style.display="block";
  }
    function test(){
        toastr.success('<span style="font-size:15px;">Data succesfully submited.</span>');
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
    <script src="plugins/toastr/toastr.min.js"></script>
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