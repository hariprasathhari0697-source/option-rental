<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}

$property_id = intval($_POST['property_id'] ?? 0);
$booking_date = $_POST['booking_date'] ?? '';

if (!$property_id || !$booking_date) {
    header('Location: details.html?error=missing');
    exit;
}

$stmt = $mysqli->prepare('INSERT INTO bookings (user_id, property_id, booking_date) VALUES (?, ?, ?)');
$stmt->bind_param('iis', $_SESSION['user_id'], $property_id, $booking_date);
$result = $stmt->execute();
$stmt->close();

if ($result) {
    header('Location: details.html?booked=1');
    exit;
}

header('Location: details.html?error=general');
exit;
