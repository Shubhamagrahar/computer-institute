<?php
include('session.php');
header('Content-Type: application/json');

$t_date = date("Y-m-d");
$c_date = date("Y-m-d H:i:s");
$sender_id = $_SESSION['userid']; 

if (isset($_GET['fetch_messages']) && isset($_GET['receiver_id'])) {
    $receiver_id = intval($_GET['receiver_id']);

    $query = "SELECT * FROM messages 
              WHERE (sender_id='$sender_id' AND receiver_id='$receiver_id') 
                 OR (sender_id='$receiver_id' AND receiver_id='$sender_id')
              ORDER BY timestamp ASC";
    $result = mysqli_query($con, $query);

    $messages = [];
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['sender_id'] == 0) {
            $row['user_photo'] = $brand_logo;  
        } else {
            $u_res = mysqli_query($con, "SELECT photo FROM user WHERE id='".$row['sender_id']."' LIMIT 1");
            if ($u_res && mysqli_num_rows($u_res) > 0) {
                $u = mysqli_fetch_assoc($u_res);
                $row['user_photo'] = $web_link . $u['photo'];
            } else {
                $row['user_photo'] = $web_link . "area_s/user_img/user.jpg";
            }
        }
        $messages[] = $row;
    }

    echo json_encode(["status" => "success", "messages" => $messages]);
    exit;
}



if (isset($_GET['send_message']) && isset($_GET['receiver_id']) && isset($_GET['message'])) {
    $receiver_id = intval($_GET['receiver_id']);
    $message = trim(mysqli_real_escape_string($con, $_GET['message']));

    if (!empty($message)) {
        $query = "INSERT INTO messages (sender_id, receiver_id, message, timestamp, is_read) 
                  VALUES ('$sender_id', '$receiver_id', '$message', NOW(), 0)";
        if (mysqli_query($con, $query)) {
            echo json_encode(["status" => "success", "message" => "Message sent"]);
        } else {
            echo json_encode(["status" => "error", "message" => mysqli_error($con)]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Empty message"]);
    }
    exit;
}


echo json_encode(["status" => "error", "message" => "Invalid request"]);
