<?php
require_once 'db_connect.php';

$bookings = [];
$query = "SELECT b.id, b.booking_date, u.name AS user_name, u.email AS user_email, p.title AS property_title, p.location AS property_location
          FROM bookings b
          JOIN users u ON b.user_id = u.id
          JOIN properties p ON b.property_id = p.id
          ORDER BY b.booking_date DESC";
$result = $mysqli->query($query);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
    $result->free();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings - Easy Rent</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="site-header">
        <div class="container header-inner">
            <a href="index.php" class="brand">Easy Rent</a>
            <nav class="navbar">
                <a href="view_property.php">Manage Properties</a>
                <a href="add_property.php">Add Property</a>
                <a href="logout.php">Logout</a>
            </nav>
        </div>
    </header>
    <main class="container properties-page">
        <section class="section">
            <div class="section-heading">
                <h2>Booking Requests</h2>
                <p>Review user booking requests for all properties.</p>
            </div>
            <?php if (empty($bookings)): ?>
                <p>No bookings have been made yet.</p>
            <?php else: ?>
                <div class="cards-grid">
                    <?php foreach ($bookings as $booking): ?>
                        <article class="property-card">
                            <div class="card-body">
                                <h3><?php echo htmlspecialchars($booking['property_title']); ?></h3>
                                <p>User: <?php echo htmlspecialchars($booking['user_name']); ?> (<?php echo htmlspecialchars($booking['user_email']); ?>)</p>
                                <p>Location: <?php echo htmlspecialchars($booking['property_location']); ?></p>
                                <p>Booking Date: <?php echo htmlspecialchars($booking['booking_date']); ?></p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
    </main>
    <footer class="site-footer">
        <div class="container footer-content">
            <p>© 2026 Easy Rent.</p>
        </div>
    </footer>
</body>
</html>
