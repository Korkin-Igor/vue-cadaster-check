<?php

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}

// Получаем данные
$address = trim($_POST['address']);
$phone = trim($_POST['phone']);
$email = trim($_POST['email']);

// Валидация
if (!$address || !$phone) {
    http_response_code(400);
    exit;
}

// Формируем письмо
$to = 'contact@obuchenie-lider.ru'; // отправляем на доменную почту
$from = $to;
$subject = 'Новая заявка на проверку объекта';

$message = "Телефон: $phone\n";
$message .= $email ? "Email: $email\n" : '';
$message .= 'Дата: ' . date('d.m.Y H:i:s');

$headers = "From: contact@obuchenie-lider.ru\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=utf-8\r\n";

// Отправляем
if (!mail($to, $subject, $message, $headers, "-f$from")) {
    http_response_code(500);
}

header('Location: /?success=1');
exit;
