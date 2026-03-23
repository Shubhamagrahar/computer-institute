<?php
session_start();

if(isset($_SESSION['id']) && $_SESSION['login_type']=='super_cjgfdsaqertyuimbvcxsdsrd45tr8778hj5t4ry63b6f'){
include '../con.php';
include '../asset.php';
$login_details=mysqli_fetch_array(mysqli_query($con,"select * from website_data where id='$_SESSION[userid]'"));
$login_wallet=mysqli_fetch_array(mysqli_query($con,"select * from wallet_main where userid='$_SESSION[userid]'"));
}else{
echo '<script>alert("Access Denai.");window.location.assign("../");</script>';
exit();
}

?>