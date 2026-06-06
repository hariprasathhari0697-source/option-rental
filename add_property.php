<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $property_type = sanitize($_POST['property_type'] ?? 'house');
    $title = sanitize($_POST['title'] ?? '');
    $location = sanitize($_POST['location'] ?? '');
    $rent = floatval($_POST['rent'] ?? 0);
    $description = sanitize($_POST['description'] ?? '');
    $image = '';

    if (!empty($_FILES['image']['name'])) {
        $uploadDir = __DIR__ . '/images/';
        $imageName = basename($_FILES['image']['name']);
        $target = $uploadDir . $imageName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $image = 'images/' . $imageName;
        }
    }

    if ($title && $location && $rent && $description) {
        $stmt = $mysqli->prepare('INSERT INTO properties (property_type, title, location, rent, description, image) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('ssdsss', $property_type, $title, $location, $rent, $description, $image);
        $stmt->execute();
        $stmt->close();
        header('Location: view_property.php?added=1');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Property - Easy Rent</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="site-header">
        <div class="container header-inner">
            <a href="index.php" class="brand">Easy Rent</a>
            <nav class="navbar">
                <a href="index.php">Home</a>
                <a href="view_property.php">Manage Properties</a>
                <a href="logout.php">Logout</a>
            </nav>
        </div>
    </header>
    <main class="container auth-page">
        <div class="auth-card">
            <h2>Add Property</h2>
            <form action="add_property.php" method="post" enctype="multipart/form-data">
                <label for="property_type">Property Type</label>
                <select id="property_type" name="property_type" required>
                    <option value="house">House</option>
                    <option value="hostel">Hostel</option>
                </select>
                <label for="title">Title</label>
                <input type="text" id="title" name="title" required>
                <label for="location">Location</label>
                <input type="text" id="location" name="location" required>
                <label for="rent">Rent</label>
                <input type="number" id="rent" name="rent" step="0.01" required>
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="5" required></textarea>
                <label for="image">Image</label>
                <input type="file" id="image" name="image" accept="image/*">
                <button type="submit" class="btn btn-primary">Save Property</button>
            </form>
        </div>
    </main>
    <footer class="site-footer">
        <div class="container footer-content">
            <p>© 2026 Easy Rent.</p>
        </div>
    </footer>
</body>
</html>
