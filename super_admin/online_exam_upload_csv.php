<?php
include("session.php"); 

if ($_FILES['csv_file']['name']) {
    $filename = $_FILES['csv_file']['tmp_name'];
    $file = fopen($filename, "r");

    $header = fgetcsv($file);
    $expected_header = ['course_id', 'test_level' , 'test_question', 'ans_a', 'ans_b', 'ans_c', 'ans_d', 'ans_final'];

    if ($header !== $expected_header) {
        echo "Invalid CSV header. Please use the sample template.";
        exit;
    }

    $inserted = 0;
    $errors = [];

    while (($row = fgetcsv($file)) !== false) {
        list($course_id, $test_level, $test_question, $a, $b, $c, $d, $final) = $row;
        
        $course_id = trim($course_id);
        $test_level = trim($test_level);
        $test_question = trim($test_question);
        $a = trim($a);
        $b = trim($b);
        $c = trim($c);
        $d = trim($d);
        $final = trim($final);

        if ($course_id == "" || $test_level =="" || $test_question == "" || $a == "" || $b == "" || $c == "" || $d == "" || $final == "") {
            $errors[] = "Incomplete data in row: " . implode(", ", $row);
            continue;
        }

        if (!in_array($final, ['ans_a', 'ans_b', 'ans_c', 'ans_d'])) {
            $errors[] = "Invalid answer in row: " . implode(", ", $row);
            continue;
        }

        $question_enc = base64_encode($test_question);
        $a_enc = base64_encode($a);
        $b_enc = base64_encode($b);
        $c_enc = base64_encode($c);
        $d_enc = base64_encode($d);
        mysqli_query($con, "DELETE FROM online_test_question WHERE status = 'OPEN'");
        $query = mysqli_query($con, "INSERT INTO online_test_question(test_question, ans_a, ans_b, ans_c, ans_d, ans_final, test_level, status, date) 
            VALUES ('$question_enc', '$a_enc', '$b_enc', '$c_enc', '$d_enc', '$final', '$test_level' ,'ACT', CURDATE())");

        if ($query) {
            $question_id = mysqli_insert_id($con);
            mysqli_query($con, "INSERT INTO online_test_question_details(online_test_question_id, course_id, test_level) 
                                VALUES ('$question_id', '$course_id', '$test_level')");
            $inserted++;
        } else {
            $errors[] = "Failed to insert row: " . implode(", ", $row);
        }
    }

    fclose($file);

    echo "Successfully inserted: $inserted<br>";
    if (!empty($errors)) {
        echo "Errors:<br>" . implode("<br>", $errors);
    }
} else {
    echo "No file uploaded.";
}
?>
