<?php
// session_start();

// if(isset($_SESSION['id']) && $_SESSION['login_type']=='st_kjjvgfh5242kvjjhgfnsjhfuygjhdfrtdggsdk'){
// include '../con.php';
// include '../assets.php';
// //include 'data.php'; 
// $login_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$_SESSION[userid]'"));
// $login_wallet=mysqli_fetch_array(mysqli_query($con,"select * from wallet where userid='$_SESSION[userid]'"));
// }else{
// echo '<script>alert("Access Denai.");window.location.assign("../");</script>';
// }

session_start();

if(isset($_SESSION['id']) && $_SESSION['login_type']=='st_kjjvgfh5242kvjjhgfnsjhfuygjhdfrtdggsdk'){
include '../con.php';
include '../assets.php';
//include 'data.php'; 
$login_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$_SESSION[userid]'"));
$login_wallet=mysqli_fetch_array(mysqli_query($con,"select * from wallet where userid='$_SESSION[userid]'"));
$branch_id = mysqli_fetch_array(mysqli_query($con, "select branch_id from course_book where userid='$_SESSION[userid]' and status IN ('RUN', 'CLOSE', 'OPEN')"))['branch_id'];
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
}

?>