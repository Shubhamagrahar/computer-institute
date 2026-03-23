<?php
session_start();
session_destroy();
//header("location:../login_register/index");

echo '<script>alert("Logout Successfully Done.");window.location.assign("../../");</script>';
?>