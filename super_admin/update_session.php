<?php
session_start();
include 'session.php'; 

$session_id = $_POST['session_id'] ?? null;
$userid = 0; // Super admin

if (!empty($session_id)) {
    $update = mysqli_query($con, "UPDATE login_session SET session_id='$session_id', updated_at=NOW() WHERE userid='$userid'");

    if ($update && mysqli_affected_rows($con) > 0) {
        echo "success";
    } else {
        echo "no rows updated";
    }
} else {
    echo "invalid session_id";
}
?>
