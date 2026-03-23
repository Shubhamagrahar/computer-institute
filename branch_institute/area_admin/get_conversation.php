<?php
session_start();
include 'session.php';

ini_set('display_errors', 1); 
error_reporting(E_ALL);


if (isset($_GET['convers_id'])) {
    $convers_id = $_GET['convers_id'];
   

    $sql = "SELECT * FROM query WHERE convers_id = '$convers_id' ORDER BY created_at ASC";
    $result = mysqli_query($con, $sql);
    
    while ($row = mysqli_fetch_array($result)) {
        $status = $row['status'];
        
       
         $user_details = mysqli_fetch_array(mysqli_query($con, "select name from user where id='$login_details[id]'"));
    
        
        
        
        if ($row['role'] == 2) {
            
            echo "<div style='display: flex; justify-content: flex-end;'> 
                    <p style='background-color: #007bff; color: white; padding: 10px; border-radius: 10px;
                                max-width: 70%; margin: 5px 0; display: inline-block;'>";
        } else {
         
            echo "<div style='display: flex; justify-content: flex-start;'> 
                    <p style='background-color: #6c757d; color: white; padding: 10px; border-radius: 10px;
                                max-width: 70%; margin: 5px 0; display: inline-block;'><strong>SUPER ADMIN:</strong> ";
        }
       
        echo "" . $row['query'] . " <small><br>(" . date('d-m-Y h:i A', strtotime($row['created_at'])) . ")</small></p></div>";
    }
    
    if($status == '2'){
        echo "<script> $('#replyText').hide(); $('#replyBtn').hide(); </script>";
    }else{
        echo "<script> $('#replyText').show(); $('#replyBtn').show(); </script>";
    }
}


if (isset($_GET['query_id'])) {
    $convers_id = $_GET['query_id'];
    $session = $_GET['session'];
    $stmt_close = $con->prepare("UPDATE query SET status = 'close', session_id = ? WHERE convers_id = ?");
    $stmt_close->bind_param("ii", $session, $convers_id);
    $stmt_close->execute();
    
}

if (isset($_GET['query_id_cancel'])) {
     $convers_id = $_GET['query_id_cancel'];
    $sql = "UPDATE query SET status = '1' WHERE convers_id = '$convers_id'";
    $result = mysqli_query($con, $sql);
    
}
$con->close();
?>
