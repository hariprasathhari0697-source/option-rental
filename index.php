<?php
require_once 'db_connect.php';
$loggedIn = isset($_SESSION['user_id']);
$username = $loggedIn ? $_SESSION['name'] : 'Guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Easy Rent Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="site-header">
        <div class="container header-inner">
            <a href="index.php" class="brand">Easy Rent</a>
            <nav class="navbar">
                <a href="index.php">Home</a>
                <a href="houses.html">Houses</a>
                <a href="hostels.html">Hostels</a>
                <a href="contact.html">Contact</a>
                <?php if ($loggedIn): ?>
                    <a href="logout.php" class="btn btn-outline">Logout</a>
                <?php else: ?>
                    <a href="login.html" class="btn btn-secondary">Login</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
    <main class="container auth-page">
        <div class="auth-card">
            <h2>Welcome, <?php echo $username; ?></h2>
            <p>This is the Easy Rent dashboard. Use the navigation above to browse properties, register, or manage bookings.</p>
            <?php if (!$loggedIn): ?>
                <p><a href="register.html" class="btn btn-primary">Create an Account</a></p>
            <?php endif; ?>
        </div>
    </main>
    <footer class="site-footer">
        <div class="container footer-content">
            <p>© 2026 Easy Rent.</p>
        </div>
    </footer>
</body>
</html>
