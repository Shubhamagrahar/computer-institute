<?php
include("session.php"); 

if ($_FILES['csv_file']['name']) {
    $filename = $_FILES['csv_file']['tmp_name'];
    $file = fopen($filename, "r");

    $header = fgetcsv($file);
    $expected_header = ['test_series_type_id', 'question', 'ans_a', 'ans_b', 'ans_c', 'ans_d', 'correct_ans'];

    if ($header !== $expected_header) {
        echo "Invalid CSV header. Please use the sample template.";
        exit;
    }

    $inserted = 0;
    $errors = [];

    while (($row = fgetcsv($file)) !== false) {
        list($type_id, $question, $a, $b, $c, $d, $final) = $row;

        $type_id = trim($type_id);
        $question = trim($question);
        $a = trim($a);
        $b = trim($b);
        $c = trim($c);
        $d = trim($d);
        $final = trim($final);

        if ($type_id == "" || $question == "" || $a == "" || $b == "" || $c == "" || $d == "" || $final == "") {
            $errors[] = "Incomplete data in row: " . implode(", ", $row);
            continue;
        }

        if (!in_array($final, ['ans_a', 'ans_b', 'ans_c', 'ans_d'])) {
            $errors[] = "Invalid answer in row: " . implode(", ", $row);
            continue;
        }

        $question_enc = base64_encode($question);
        $a_enc = base64_encode($a);
        $b_enc = base64_encode($b);
        $c_enc = base64_encode($c);
        $d_enc = base64_encode($d);
        mysqli_query($con, "DELETE FROM test_series_questions WHERE status = 'OPEN'");
        $query = mysqli_query($con, "INSERT INTO test_series_questions(test_question, ans_a, ans_b, ans_c, ans_d, ans_final, status, date) 
            VALUES ('$question_enc', '$a_enc', '$b_enc', '$c_enc', '$d_enc', '$final', 'ACT', CURDATE())");

        if ($query) {
            $question_id = mysqli_insert_id($con);
            mysqli_query($con, "INSERT INTO test_series_questions_type_details(test_series_questions_id, test_series_type_id) 
                                VALUES ('$question_id', '$type_id')");
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
