<?php
include('session.php');
header('Content-Type: application/json');
$t_date=date("Y-m-d");
$c_date=date("Y-m-d H:i:s");
$sender_id = 0;

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
                $row['user_photo'] = $web_link . "default.png";
            }
        }
        $messages[] = $row;
    }

    echo json_encode(["status" => "success", "messages" => $messages]);
    exit;
}
if (isset($_GET['fetch_broadcast_messages'])) {
   
    $query = "SELECT * FROM broadcasts 
              WHERE sender_id='$sender_id' AND sender_type='admin' and audience_type = 'branches' ORDER BY timestamp ASC";
    $result = mysqli_query($con, $query);

    $messages = [];
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['sender_id'] == 0) {
            $row['user_photo'] = $brand_logo;  
        } 
        $messages[] = $row;
    }

    echo json_encode(["status" => "success", "messages" => $messages]);
    exit;
}

if (isset($_GET['send_message']) && isset($_GET['receiver_id']) && isset($_GET['message'])) {
    $receiver_id = intval($_GET['receiver_id']);
    $message = mysqli_real_escape_string($con, $_GET['message']);

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

if (isset($_GET['send_broadcast']) && isset($_GET['message'])) {
    $message = mysqli_real_escape_string($con, $_GET['message']);
    $sender_id = 0; 
    $sender_type = 'admin'; 
    $audience_type = 'branches'; 

    if (!empty($message)) {
        $query = "INSERT INTO broadcasts (sender_id, sender_type, audience_type, message, timestamp)
                  VALUES ('$sender_id', '$sender_type', '$audience_type', '$message', NOW())";
        if (mysqli_query($con, $query)) {
            echo json_encode(["status" => "success", "message" => "Broadcast sent"]);
        } else {
            echo json_encode(["status" => "error", "message" => "DB Error"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Empty message"]);
    }
    exit;
}
if (isset($_GET['delete_message'])) {
    $msg_id = $_GET['message_id'];
    

    $query = "DELETE FROM messages WHERE id='$msg_id' AND sender_id='$sender_id'";
    if (mysqli_query($con, $query)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error"]);
    }
    exit;
}

echo json_encode(["status" => "error", "message" => "Invalid request"]);
