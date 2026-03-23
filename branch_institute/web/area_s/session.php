<?php
session_start();

if(isset($_SESSION['id']) && $_SESSION['login_type']=='st_uhbcxs35468j56dtrfyghy67q2sfcgvhbhbu89o8ghy8jk'){
include '../con.php';
include '../asset.php';
//include 'data.php'; 
$login_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$_SESSION[userid]'"));
$login_wallet=mysqli_fetch_array(mysqli_query($con,"select * from wallet where userid='$_SESSION[userid]'"));
}else{
echo '<script>alert("Access Denai.");window.location.assign("../");</script>';
}

?>