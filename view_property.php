<?php
require_once 'db_connect.php';

$properties = [];
$result = $mysqli->query('SELECT id, property_type, title, location, rent, description, image FROM properties ORDER BY id DESC');
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $properties[] = $row;
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
    <title>Manage Properties - Easy Rent</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="site-header">
        <div class="container header-inner">
            <a href="index.php" class="brand">Easy Rent</a>
            <nav class="navbar">
                <a href="add_property.php">Add Property</a>
                <a href="logout.php">Logout</a>
            </nav>
        </div>
    </header>
    <main class="container properties-page">
        <section class="section">
            <div class="section-heading">
                <h2>Property Management</h2>
                <p>Manage all listed houses and hostels.</p>
            </div>
            <div class="cards-grid">
                <?php if (empty($properties)): ?>
                    <p>No properties have been added yet. <a href="add_property.php">Add a property</a>.</p>
                <?php else: ?>
                    <?php foreach ($properties as $property): ?>
                        <article class="property-card">
                            <?php if ($property['image']): ?>
                                <img src="<?php echo $property['image']; ?>" alt="<?php echo htmlspecialchars($property['title']); ?>">
                            <?php else: ?>
                                <img src="https://via.placeholder.com/420x260?text=No+Image" alt="No image">
                            <?php endif; ?>
                            <div class="card-body">
                                <h3><?php echo htmlspecialchars($property['title']); ?></h3>
                                <p>Type: <?php echo htmlspecialchars($property['property_type']); ?></p>
                                <p>Location: <?php echo htmlspecialchars($property['location']); ?></p>
                                <p>Rent: ₹<?php echo htmlspecialchars(number_format($property['rent'], 2)); ?></p>
                                <p><?php echo htmlspecialchars($property['description']); ?></p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>
    </main>
    <footer class="site-footer">
        <div class="container footer-content">
            <p>© 2026 Easy Rent.</p>
        </div>
    </footer>
</body>
</html>
