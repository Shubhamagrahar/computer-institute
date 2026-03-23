<?php
session_start();
require_once __DIR__ . '/config_gemini.php';

header('Content-Type: application/json');

$now = time();
if (isset($_SESSION['last_gemini_call']) && ($now - $_SESSION['last_gemini_call'] < 2)) {
    echo json_encode(['status' => 'error', 'message' => 'Please wait before asking again.']);
    exit;
}
$_SESSION['last_gemini_call'] = $now;

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

$question = trim($data['question'] ?? '');
$reset    = !empty($data['reset']);

if ($reset) {
    unset($_SESSION['gemini_history']);
    echo json_encode(['status' => 'success', 'message' => 'Chat reset.']);
    exit;
}

if ($question === '') {
    echo json_encode(['status' => 'error', 'message' => 'Question is empty.']);
    exit;
}

$history = $_SESSION['gemini_history'] ?? [];
if (empty($history)) {
    $history[] = ['role'=>'user','parts'=>[['text'=>"
You are a highly knowledgeable AI tutor integrated into a student panel of an educational institute that offers multiple courses including programming, web development, data science, and more. 
Your tasks:
1. Answer student questions clearly and concisely.
2. Explain coding concepts step by step.
3. Provide working code examples in multiple languages (Python, JavaScript, Java, C++, etc.).
4. Separate explanations from code clearly.
5. Format code using proper markdown-style blocks.
6. Provide comments in code in a readable way.
7. Always behave like a real AI tutor similar to ChatGPT or Gemini, friendly and professional.
8. If the student asks for debugging help, give corrected code and explain changes.
9. Keep answers student-friendly but accurate.
10. When giving code, make it copyable and properly indented.
"]]];
}


$history[] = ['role'=>'user','parts'=>[['text'=>$question]]];

$payload = [
    'contents' => $history,
    'generationConfig' => [
        'temperature' => 0.7,
        'maxOutputTokens' => 1024
    ]
];



$url = "https://generativelanguage.googleapis.com/v1beta/models/".GEMINI_MODEL.":generateContent?key=".GEMINI_API_KEY;

$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    CURLOPT_POSTFIELDS => json_encode($payload),
]);
$response = curl_exec($ch);
curl_close($ch);

$json = json_decode($response, true);
$answer = '';
if (isset($json['candidates'][0]['content']['parts'])) {
    foreach ($json['candidates'][0]['content']['parts'] as $part) {
        if (isset($part['text'])) {
            $answer .= $part['text'] . "\n";
        }
    }
}
$answer = trim($answer);


if ($answer === '') {
    echo json_encode([
        'status'=>'error',
        'message'=>'No answer from model (maybe safety filter).',
        'raw'=>$json
    ]);
    exit;
}


$history[] = ['role'=>'model','parts'=>[['text'=>$answer]]];
$_SESSION['gemini_history'] = $history;

echo json_encode(['status'=>'success','answer'=>$answer]);
