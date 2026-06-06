<?php
session_start();

$host = 'localhost';
$db   = 'easy_rent';
$user = 'root';
$pass = '';

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
$mysqli->set_charset('utf8mb4');

function sanitize($value) {
    return htmlspecialchars(trim($value));
}
?>