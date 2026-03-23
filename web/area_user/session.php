<?php
session_start();

if(isset($_SESSION['id']) && $_SESSION['login_type']=='st_ubn26erw4yh98g1ed2635f69e8ws94g6s54rjggsdk'){
include '../con.php';
// include 'data.php'; 
include'../asset.php';
$login_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$_SESSION[userid]'"));
$login_wallet=mysqli_fetch_array(mysqli_query($con,"select * from wallet where userid='$_SESSION[userid]'"));
}else{
echo '<script>alert("Access Denai.");window.location.assign("../");</script>';
}

?>