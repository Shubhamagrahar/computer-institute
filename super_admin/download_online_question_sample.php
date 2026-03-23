<?php

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="sample_online_exam_question.csv"');
header('Pragma: no-cache');
header('Expires: 0');

$output = fopen('php://output', 'w');

$headers =  ['course_id', 'test_level' , 'test_question', 'ans_a', 'ans_b', 'ans_c', 'ans_d', 'ans_final'];
fputcsv($output, $headers);

$sample_row = [
    1,
    1,
    'Who is the father of Computers?',
    'James Gosling',
    'Charles Babbage',
    'Dennis Ritchie',
    'Bjarne Stroustrup',
    'ans_b'
];
fputcsv($output, $sample_row);

fclose($output);
exit;
?>
