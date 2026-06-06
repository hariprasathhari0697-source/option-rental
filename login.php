<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.html');
    exit;
}

$email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$password = $_POST['password'] ?? '';

if (!$email || !$password) {
    header('Location: login.html?error=missing');
    exit;
}

$stmt = $mysqli->prepare('SELECT id, name, password, role FROM users WHERE email = ?');
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->bind_result($id, $name, $hash, $role);
if ($stmt->fetch()) {
    if (password_verify($password, $hash)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['name'] = $name;
        $_SESSION['role'] = $role;
        $stmt->close();
        header('Location: index.php');
        exit;
    }
}
$stmt->close();
header('Location: login.html?error=invalid');
exit;
