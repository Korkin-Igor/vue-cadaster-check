<?php

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false]);
    exit;
}

$address = trim($_POST['address']);
$phone = trim($_POST['phone']);
$email = trim($_POST['email']);

if (!$address || !$phone) {
    http_response_code(400);
    echo json_encode(['success' => false]);
    exit;
}

$to = 'contact@obuchenie-lider.ru';
$from = $to;
$subject = 'Новая заявка на проверку объекта';

$message = "Адрес/Кадастр: $address\n";
$message .= "Телефон: $phone\n";
$message .= $email ? "Email: $email\n" : '';
$message .= 'Дата: ' . date('d.m.Y H:i:s');

$headers = "From: contact@obuchenie-lider.ru\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=utf-8\r\n";

if (!mail($to, $subject, $message, $headers, "-f$from")) {
    http_response_code(500);
    echo json_encode(['success' => false]);
    exit;
}

echo json_encode(['success' => true]);
exit;