<?php
require_once 'includes/functions.php';

// fetch 3 random featured cleats
$featured = fetchRandomProducts($conn, 3);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Elite Cleats – Home</title>

  <!-- Global Styles -->
  <link rel="stylesheet" href="assets/css/style.css" />
  <!-- Shared Components -->
  <link rel="stylesheet" href="assets/css/navbar.css" />
  <link rel="stylesheet" href="assets/css/footer.css" />
  <!-- Page-Specific Styles -->
  <link rel="stylesheet" href="assets/css/home.css" />
</head>
<body>

  <div id="navbar"></div>

  <main class="home-container">
    <!-- Hero Section -->
    <section class="hero">
      <div class="hero-overlay">
        <div class="hero-content">
          <h1>Welcome to Elite Cleats</h1>
          <p>Your destination for top-tier soccer cleats built for performance.</p>
          <a href="pages/products.php" class="shop-btn">Shop Now</a>
        </div>
      </div>
    </section>

    <!-- Featured Cleats -->
    <section class="featured">
      <h2>Featured Cleats</h2>
      <div class="featured-grid">
        <?php foreach ($featured as $prod): ?>
          <a class="featured-card" href="pages/product-details.php?id=<?= (int)$prod['product_id']; ?>">
            <img src="<?= htmlspecialchars($prod['image_url']); ?>" alt="<?= htmlspecialchars($prod['name']); ?>">
            <h3><?= htmlspecialchars($prod['name']); ?></h3>
            <p>€<?= number_format($prod['price'], 2); ?></p>
          </a>
        <?php endforeach; ?>
      </div>
    </section>
  </main>

  <div id="footer"></div>

  <script src="assets/js/script.js"></script>
</body>
</html>
<?php $conn->close(); ?>


