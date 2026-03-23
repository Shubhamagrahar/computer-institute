<?php
$data = json_decode(file_get_contents("php://input"), true);

$code = $data['code'] ?? '';
$lang = $data['language'] ?? '';
$qid = $data['qid'] ?? 0;


if (!$code || !$lang || !$qid) {
  
    echo "<div class='text-danger'>Missing code, language, or question ID.</div>";
    exit;
}

$lang_map = [
    "python" => 71,
    "c_cpp" => 52
];

$language_id = $lang_map[$lang] ?? null;

if (!$language_id) {
    
    echo "<div class='text-danger'>Invalid language selected.</div>";
    exit;
}

$test_cases = [
    1 => [
        ["input" => "4", "expected" => "True\n"],
        ["input" => "5", "expected" => "False\n"],
        ["input" => "0", "expected" => "True\n"]
    ],
    2 => [
        ["input" => "5", "expected" => "120\n"],
        ["input" => "0", "expected" => "1\n"],
        ["input" => "1", "expected" => "1\n"]
    ]
];

function judge0_request($language_id, $source_code, $stdin, $expected_output) {
    $api_url = "https://judge0-ce.p.rapidapi.com/submissions?base64_encoded=false&wait=true";
    $headers = [
        "Content-Type: application/json",
        "X-RapidAPI-Host: judge0-ce.p.rapidapi.com",
        "X-RapidAPI-Key: " . "5b6b6083e0msh7840d89bb6dc857p13ababjsn0319e34dc2a7"
    ];

    $data = [
        "language_id" => $language_id,
        "source_code" => $source_code,
        "stdin" => $stdin,
        "expected_output" => $expected_output
    ];

    $ch = curl_init($api_url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POSTFIELDS => json_encode($data)
    ]);
    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

$results = [];
$cases = $test_cases[$qid] ?? [];

foreach ($cases as $index => $tc) {
    $res = judge0_request($language_id, $code, $tc['input'], $tc['expected']);
    $actual_output = trim($res['stdout'] ?? '');
    $expected_output = trim($tc['expected']);
    $pass = ($actual_output === $expected_output);
    $results[] = [
        'case' => $index + 1,
        'pass' => $pass
    ];
}

echo "<div class='p-3 bg-dark text-light rounded'>";
foreach ($results as $r) {
    $icon = $r['pass'] ? "✅" : "❌";
    $label = $r['pass'] ? "Pass" : "Fail";
    echo "<div>Test Case {$r['case']}: $icon $label</div>";
}
echo "</div>";
