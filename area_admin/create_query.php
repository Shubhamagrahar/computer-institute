<?php 
session_start();
$user_name = $_SESSION['user_name'];
include 'session.php';

// Handle Reply to Query
if (isset($_POST['reply_query'])) {
    $convers_id = $_POST['convers_id'];
    $reply_text = $_POST['reply_query'];
    $userid = $login_details['id'];
   if($convers_id !=="" && $reply_text !=="" && $userid !==""){
    $reply_sql = mysqli_query($con, "insert into query (`convers_id`, `userid`, `role`, `query`, `created_at`) values ('$convers_id','$userid','2','$reply_text',NOW())");
    if($reply_sql){
        echo '<script>alert("Message Sent Successfully");window.location.assign("create_query")</script>';
    }
    else{
        echo '<script>alert("Error Sending Reply");window.location.assign("create_query")</script>';
    }
   }else{
       echo '<script>alert("Missing Parameters");window.location.assign("create_query")</script>';
   }
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Query Manage</title>

    <!-- Favicons -->
  
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/theme_style.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <script src="ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">

    <style type="text/css">
       
        .create_query {
            background: #157daf !important;
        }
        
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?php
        // include 'header.php';
        include 'top_navbar.php';
        include 'left_side_navbar.php';
        ?>
        
        <div class="content-wrapper">
            
            <!-- Content Header (Page header) -->
            <div class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Queries</h5>
                    </div>
                </div><!-- /.row -->
              </div><!-- /.container-fluid -->
            </div>
            
            <section class="content">
              <div class="container-fluid">
                <div class="row">
                    
                    <div class="col-md-12" id="create_span">
                        <span onclick="create_query_fld()" style="float: right; margin-right:10px; color: #50af06; cursor: pointer;"><i class="fa fa-plus"></i> Create Query</span>
                    </div>
                    
                    <div class="col-md-3"></div>
                    <div class="col-md-6" id="create_query"></div>
                  </div>
                </div>
            </section>
             
             
     
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12" id="tabel_data_">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Your Previous Queries</h3>
                                </div>
                                <!-- /.card-header -->
                                <div style="overflow-x: auto" class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.no</th>
                                            <th>Query</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Status</th>
                                            <th>Read</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        
                                        $sql = mysqli_query($con, "select * from query where userid = '$login_details[id]' group by convers_id order by created_at desc");
                                        while ($row = mysqli_fetch_array($sql)) {
                                            
                                        ?>
                                        <tr>
                                            <td><?php echo ++$i; ?></td>
                                            <td><?php echo $row['query']; ?></td>
                                            <td><?php echo date('d-M Y', strtotime($row['created_at'])); ?></td>
                                            <td><?php echo date('h:i A', strtotime($row['created_at'])); ?></td>
                                            <td>
                                                <?php
                                                    if($row['status'] == 1){
                                                        echo 'OPEN';
                                                    }else{
                                                        echo 'CLOSE';
                                                    }
                                                ?>
                                            </td>
                                           
                                            <td>
                                        <button class="btn <?php echo ($row['status'] == 1) ? 'btn-success' : 'btn-secondary'; ?>" 
                                                onclick="viewFull(<?php echo $row['convers_id']; ?>)">
                                            Read Full
                                        </button>
                                    </td>

                                        </tr>
                                        <?php } ?>
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
                    
                    <!-- Modal for View Full Conversation -->
                    <div class="modal fade" id="viewFullModal" tabindex="-1" role="dialog" aria-labelledby="viewFullModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewFullModalLabel">Full Conversation</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="fullConversationContent">
                                    <!-- Full conversation will be loaded here dynamically -->
                                </div>
                                <form  method="POST">
                                    <div id="reply-form" class="modal-body">
                                        <textarea id="replyText" name="reply_query" class="form-control" placeholder="Reply to query..."></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <input style="display: none" name="convers_id" id="convers_id">
                                        <button id="replyBtn" type="submit" class="btn btn-primary">Reply</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
      
    <?php include 'footer.php' ?>
    
    </div><!-- ./wrapper -->
  

    <script>
    
    function viewFull(convers_id) {
        $.ajax({
            url: 'get_conversation',
            type: 'GET',
            data: { convers_id: convers_id},
            success: function(response) {
                $('#fullConversationContent').html(response);
                $('#convers_id').val(convers_id);
                $('#viewFullModal').modal('show');
            }
        });
    }
    
    function create_query_fld(){
        $.ajax({
            type:"GET",
            url:"get_data",
            data:'new_create_query_data=<?php echo session_id();?>',
            success: function(data){
                document.getElementById("create_span").style.display="none";
             $("#create_query").html(data);
            }
        });
    }
    
    function create_new_query() {
        var query_detail = $("#query-detail-new").val().trim();
       
        
        if (query_detail !== "") {
            $.ajax({
                type: "GET",
                url: "get_data",
                data: { query_detail: query_detail},
                success: function (data) {
                    if (data == 1) {
                        document.getElementById("create_span").style.display = "none";
                        location.reload();
                        toastr.success('Query Submitted successfully!');
                    } else {
                        toastr.error(data);
                    }
                }
            });
        } else {
            toastr.warning('Please enter your Query.');
        }
    }
    
    function cancel_fld(){
        $("#create_query").html("");
        document.getElementById("create_span").style.display="block";
    }
    
    
</script>
    
<!-- REQUIRED SCRIPTS -->
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
        });
    </script>
    </body>
</html>
