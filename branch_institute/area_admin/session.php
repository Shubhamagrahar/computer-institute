<?php
session_start();

if(isset($_SESSION['id']) && $_SESSION['login_type']=='st_ijnbvcs3ergb8uhhb5tfc89hbuftccgfcveddgk'){
include '../con.php';
include '../assets.php';
$login_details=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$_SESSION[userid]'"));
$login_wallet=mysqli_fetch_array(mysqli_query($con,"select * from wallet where userid='$_SESSION[userid]'"));
function main_menu_check($main,$userid,$type){
    global $con;
    if($type == 1){
        return 1;
    }else{
        $check=mysqli_num_rows(mysqli_query($con,"select * from session_menu_staff_permission where userid='$userid' and main_menu='$main' and status='YES'"));
        if($check>0){
            return 1;
        }else{
            return 2;
        }
    }
}

function sub_menu_check($main,$sub,$userid,$type){
    global $con;
    if($type==1){
        return 1;
    }else{
        $check=mysqli_num_rows(mysqli_query($con,"select * from session_menu_staff_permission where userid='$userid' and main_menu='$main' and sub_menu='$sub' and status='YES'"));
        if($check==1){
            return 1;
        }else{
            return 2;
        }
    }
}

function add_on_check($name){
    global $con;
    $check_add_on=mysqli_fetch_array(mysqli_query($con, "select * from controller where name='$name' and status = '1'"));
    if($check_add_on['status']==1){
        return 1;
    }else{
        return 2;
    }
}

function special_permission($name){
    global $con;
    $check_special_permission = mysqli_fetch_array(mysqli_query($con, "select * from controller where name='$name' and permission_to_branch = '1' and status='1'"));
    if($check_special_permission['permission_to_branch']==1){
        return 1;
    }else{
        return 2;
    }
}
}else{
echo '<script>alert("Access Denied.");window.location.assign("../");</script>';
exit();
}

if($login_details['type']==1){
    $current_branch_id=$_SESSION['userid'];
}else{
    $current_branch_id=$login_details['branch_id'];
}
$branch_access_details=mysqli_fetch_array(mysqli_query($con,"select * from branch_details where userid='$current_branch_id'"));


?>