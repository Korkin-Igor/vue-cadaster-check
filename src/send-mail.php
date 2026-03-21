<?php

header('Content-Type: application/json; charset=utf-8');

$_POST = json_decode(file_get_contents('php://input'), true) ?? $_POST;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false]);
    exit;
}

$address = trim($_POST['address'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');

$to = 'contact@obuchenie-lider.ru';
$from = $to;

// если это заявка на получение инструкции
if ($phone && !$address && !$email) {
    $subject = 'Запрос инструкции по недвижимости';
    $message = "Клиент запросил инструкцию\n";
    $message .= "Телефон: $phone\n";
}
// иначе это заявка на проверку объекта
else {
    $subject = 'Новая заявка на проверку объекта';
    $message = "Адрес/Кадастр: $address\n";
    $message .= "Телефон: $phone\n";
    $message .= $email ? "Email: $email\n" : '';
}
$message .= 'Дата: ' . date('d.m.Y H:i:s');

$headers = "From: contact@obuchenie-lider.ru\r\n";
if ($email) $headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=utf-8\r\n";

if (!mail($to, $subject, $message, $headers, "-f$from")) {
    http_response_code(500);
    echo json_encode(['success' => false]);
    exit;
}

echo json_encode(['success' => true]);
exit;
