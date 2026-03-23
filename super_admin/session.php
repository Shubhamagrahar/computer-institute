<?php
session_start();

if(isset($_SESSION['id']) && $_SESSION['login_type']=='super_cjgfdsaqertyuimbvcxsdsrd45tr8778hj5t4ry63b6f'){
include '../con.php';
include '../assets.php';
 $check = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM website_data LIMIT 1"));
    $today = date('Y-m-d');
    $end_date = $check['end_date'];
    $status = $check['status'];
    $days_left = (strtotime($end_date) - strtotime($today)) / (60 * 60 * 24);

    if ($status == 1 && $days_left < -5) {
        mysqli_query($con, "UPDATE website_data SET status = 2 WHERE id = {$check['id']}");
        echo "<script>window.location.href = '../expired';</script>";
        exit;
    }

    if ($status == 2) {
        echo "<script>window.location.href = '../expired';</script>";
        exit;
    }
$login_details=mysqli_fetch_array(mysqli_query($con,"select * from website_data where id='$_SESSION[userid]'"));
$login_wallet=mysqli_fetch_array(mysqli_query($con,"select * from wallet_main where userid='$_SESSION[userid]'"));

function add_on_check($name){
    global $con;
    $check_add_on=mysqli_fetch_array(mysqli_query($con, "select * from controller where name='$name' and status = '1'"));
    if($check_add_on['status']==1){
        return 1;
    }else{
        return 2;
    }
}
}else{
echo '<script>alert("Access Denied.");window.location.assign("../");</script>';


exit();
}

?>