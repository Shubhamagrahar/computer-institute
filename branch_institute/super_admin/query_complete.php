<?php
session_start();
include 'session.php';


$sql =mysqli_query($con, "select * from query where status='2' and id in (select max(id) from query group by convers_id) order by created_at desc");
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete = mysqli_query($con, "DELETE FROM query WHERE convers_id = '$delete_id'");
    if ($delete) {
        echo "<script>alert('Message deleted successfully.'); window.location.href='query_complete';</script>";
        exit;
    } else {
        echo "<script>alert('Delete failed.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Queries</title>

    <!-- Include stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <style type="text/css">
        .query_complete {
            background: #157daf !important;
        }
        .drop_query {
            background: #157daf !important;
        }
        
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <?php include 'top_navbar.php'; ?>
    <?php include 'left_side_navbar.php'; ?>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Queries</h5>
                    </div>
                </div>
            </div>
        </section>
        
        <div class="container-fluid">
            <div id="data-table" class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">All Queries</h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.no</th>
                                            <th>User Name</th>
                                            
                                            <th>Last Message</th>
                                            <th>End date</th>
                                            <th>Status</th>
                                            <th>Read</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        while ($row = mysqli_fetch_array($sql)) {
                                           
                                            $user_details = mysqli_fetch_array(mysqli_query($con, "select name from user where id='$row[userid]'"));
                                            $user_name = $user_details['name'];
                                        ?>
                                        <tr>
                                            <td><?php echo ++$i; ?></td>
                                            <td><?php echo $user_name; ?></td>
                                            
                                            <td><?php echo ucfirst($row['query']); ?></td>
                                            <td><?php echo date('d-M Y h:i A', strtotime($row['created_at'])); ?></td>
                                            <td><?php if($row['status'] == 1){
                                                    echo 'OPEN';
                                                }else{
                                                    echo 'CLOSE';
                                                }
                                            ?></td>
                                            <td><button class="btn btn-secondary" 
                                                onclick="viewFull('<?php echo $row['convers_id']; ?>', '<?php echo $row['receiver_id']; ?>', '<?php echo $row['userid']; ?>')">
                                                Read Full</button></td>
                                            
                                            <td>
                                                <a href="?delete_id=<?php echo $row['convers_id']; ?>" 
                                                   onclick="return confirm('Are you sure you want to delete this message?');" 
                                                   class="btn btn-danger">
                                                    Delete
                                                </a>
                                            </td>
                                            
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                <form method="POST">
                    <div class="modal-body">
                        <textarea id="replyText" name="reply_query" class="form-control" placeholder="Reply to query..."></textarea>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="convers_id" id="convers_id"> 
                        <input type="hidden" name="role" id="role">
                        <input type="hidden" name="userid" id="userid">
                      
                        <button id="replyBtn" type="submit" class="btn btn-primary">Reply</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
  <?php 
  include'footer.php'; 
  ?>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

function viewFull(convers_id, receiver_id, userid) {
    $.ajax({
        url: 'get_conversation',
        type: 'GET',
        data: { convers_id: convers_id, receiver_id: receiver_id, userid: userid },
        success: function(response) {
            $('#fullConversationContent').html(response);
            $('#convers_id').val(convers_id);
            $('#role').val(role);  
            $('#userid').val(userid);  
            $('#viewFullModal').modal('show');
        }
    });
}

</script>

</body>
</html>
