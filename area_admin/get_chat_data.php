<?php
include('session.php');
header('Content-Type: application/json');

$t_date = date("Y-m-d");
$c_date = date("Y-m-d H:i:s");
$sender_id = $current_branch_id; 

if (isset($_GET['search_students'])) {
    $q = mysqli_real_escape_string($con, $_GET['q']);
    $branch_id = $current_branch_id; 

    if ($q == "") {
        $sql = "
          SELECT * FROM user 
          WHERE id IN (
            SELECT userid FROM course_book 
            WHERE branch_id = '$branch_id' AND status = 'RUN'
          )
          ORDER BY name ASC
        ";
    } else {
        $sql = "
          SELECT * FROM user 
          WHERE id IN (
            SELECT userid FROM course_book 
            WHERE branch_id = '$branch_id' AND status = 'RUN'
          )
          AND (name LIKE '%$q%' OR mobile LIKE '%$q%')
          ORDER BY name ASC
        ";
    }

    $res = mysqli_query($con, $sql);

    $html = "";
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_array($res)) {
            $photo = !empty($row['photo']) ? ($web_link.$row['photo']) : ($web_link."area_s/user_img/user.jpg");
            $html .= '<li class="list-group-item contact-item d-flex align-items-center" data-id="'.$row['id'].'">
                        <img src="'.$photo.'" 
                             style="height:35px; width:35px; border-radius:50%; margin-right:10px;">
                        <span>'.$row['name'].' ('.$row['mobile'].')</span>
                      </li>';
        }
    } else {
        $html = '<li class="list-group-item text-muted">No students found</li>';
    }

    echo json_encode(["status" => "success", "html" => $html]);
    exit;
}

if (isset($_GET['fetch_broadcast_messages'])) {
   
    $query = "SELECT * FROM broadcasts 
              WHERE sender_type='admin' and audience_type = 'branches' ORDER BY timestamp ASC";
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

if (isset($_GET['fetch_contact'])) {
    
    $html = '';

    $html .= '<li class="list-group-item contact-item d-flex align-items-center" data-id="broadcast">
                <img src="image/broadcast.webp" style="height:35px; width:35px; border-radius:50%; margin-right:10px;">
                <span>Boradcast</span>
              </li>';
    $html .= '<li class="list-group-item contact-item d-flex align-items-center" data-id="0">
                <img src="'.$brand_logo.'" style="height:35px; width:35px; border-radius:50%; margin-right:10px;">
                <span>'.$brand_name.'</span>
              </li>';
    

    $q = mysqli_query($con, "
        SELECT id, name, photo, mobile FROM user 
        WHERE status = '1' 
          AND id IN (
              SELECT sender_id FROM messages WHERE receiver_id = '$current_branch_id'
              UNION
              SELECT receiver_id FROM messages WHERE sender_id = '$current_branch_id'
          )
        ORDER BY name ASC
    ");

    while ($row = mysqli_fetch_assoc($q)) {
        $photo = !empty($row['photo']) ? ($web_link.$row['photo']) : ($web_link."area_s/user_img/user.jpg");
        $html .= '<li class="list-group-item contact-item d-flex align-items-center" data-id="'.$row['id'].'">
                    <img src="'.$photo.'" style="height:35px; width:35px; border-radius:50%; margin-right:10px;">
                   <span>
                <b>'.htmlspecialchars($row['name']).'</b><br>
                <p style="font-size:14px; margin:0;">('.$row['mobile'].')</p>
            </span>
                  </li>';
                  
    }

    echo json_encode(["status" => "success", "html" => $html]);
    exit;
    
}

if (isset($_GET['delete_message'])) {
    $msg_id = $_GET['message_id'];
    

    $query = "DELETE FROM messages WHERE id='$msg_id' AND sender_id='$current_branch_id'";
    if (mysqli_query($con, $query)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error"]);
    }
    exit;
}

if(isset($_GET['student_broadcast'])){
    $branch_id = VerifyData($_GET['branch_id']);
    $batch_id = VerifyData($_GET['batch_id']);
    $course_id = VerifyData($_GET['course_id']);
    $message = VerifyData($_GET['message']);
    $sender_type = "branch";
    $audience_type = "students";
    
     if (!empty($message)) {
        $query = "INSERT INTO broadcasts (sender_id, sender_type, audience_type, message, timestamp) 
                  VALUES ('$branch_id', '$sender_type', '$audience_type', '$message', 'NOW()')";
        if (mysqli_query($con, $query)) {
            echo json_encode(["status" => "success", "message" => "Message sent"]);
        } else {
            echo json_encode(["status" => "error", "message" => mysqli_error($con)]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Empty message"]);
    }
}


echo json_encode(["status" => "error", "message" => "Invalid request"]);
