<?php
session_start();

if(isset($_SESSION['id']) && $_SESSION['login_type']=='st_ijnbvcs3ergb8uhhb5tfc89hbuftcfw23fcgfcveddgk'){
include '../con.php';
include '../asset.php';
$login_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$_SESSION[userid]'"));
$login_wallet=mysqli_fetch_array(mysqli_query($con,"select * from wallet where userid='$_SESSION[userid]'"));
}else{
echo '<script>alert("Access Denai.");window.location.assign("../");</script>';
exit();
}

if($login_details['type']==1){
    $current_branch_id=$_SESSION['userid'];
}else{
    $current_branch_id=$login_details['branch_id'];
}
$branch_access_details=mysqli_fetch_array(mysqli_query($con,"select * from branch_details where userid='$current_branch_id'"));
?>