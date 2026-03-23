<?php

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="sample_question_template.csv"');
header('Pragma: no-cache');
header('Expires: 0');

$output = fopen('php://output', 'w');

$headers = ['test_series_type_id', 'question', 'ans_a', 'ans_b', 'ans_c', 'ans_d', 'correct_ans'];
fputcsv($output, $headers);

$sample_row = [
    1,
    'What does CPU stand for?',
    'Central Process Unit',
    'Central Processing Unit',
    'Computer Personal Unit',
    'Control Program Unit',
    'ans_b'
];
fputcsv($output, $sample_row);

fclose($output);
exit;
?>
