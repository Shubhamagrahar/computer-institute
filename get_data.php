<?php
include 'con.php';


if (isset($_GET['check_coupon'])) {
    $coupon_code = trim($_GET['coupon_code']);
    $course_id   = intval($_GET['course_id']);
    $branch_id = $_GET['branch_id'];
    if ($coupon_code === '' || $course_id === 0) {
        echo "Please provide coupon and course.";
        exit;
    }
    
    if($branch_id === ""){
        echo "Please select Valid Center.";
        exit;
    }

    $sql = mysqli_query(
        $con,
        "SELECT discount, valid_date 
         FROM coupen_code 
         WHERE coupen_code = '$coupon_code' 
           AND course_id = '$course_id' AND branch_id = '$branch_id'
         LIMIT 1"
    );

    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);

        if (strtotime($row['valid_date']) >= strtotime(date('Y-m-d'))) {
            echo "VALID:" . $row['discount']; 
        } else {
            echo "Coupon expired.";
        }
    } else {
        echo "Invalid coupon code.";
    }
}

if (isset($_GET['get_course_fee'])) {
    $course_id = intval($_GET['course_id']);

    $sql = mysqli_query($con, "SELECT max_fee FROM course_details WHERE id = '$course_id' LIMIT 1");
    if ($row = mysqli_fetch_assoc($sql)) {
        echo $row['max_fee']; 
    }
    exit;
}
?>