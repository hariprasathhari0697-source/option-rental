<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.html');
    exit;
}

$name = sanitize($_POST['name'] ?? '');
$email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$message = sanitize($_POST['message'] ?? '');

if (!$name || !$email || !$message) {
    header('Location: contact.html?error=missing');
    exit;
}

$file = __DIR__ . '/contact_messages.txt';
$entry = sprintf("[%s] %s <%s>\n%s\n---\n", date('Y-m-d H:i:s'), $name, $email, $message);
file_put_contents($file, $entry, FILE_APPEND | LOCK_EX);

header('Location: contact.html?sent=1');
exit;
