<?php
require_once __DIR__ . '/includes/functions.php';

/* Grab three random cleats (name, price, id, first image) */
$featured = fetchRandomProducts($conn, 3);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Elite Cleats – Home</title>

  <!-- Global / shared styles -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/navbar.css">
  <link rel="stylesheet" href="assets/css/footer.css">

  <!-- Home-page specific – contains product-card sizing too -->
  <link rel="stylesheet" href="assets/css/home.css">
</head>
<body>

  <!-- navbar / footer loaded by script.js -->
  <div id="navbar"></div>

  <main class="home-container">

    <!-- Hero --------------------------------------------------------- -->
    <section class="hero">
      <div class="hero-overlay">
        <div class="hero-content">
          <h1>Welcome to Elite Cleats</h1>
          <p>Your destination for top-tier soccer cleats built for performance.</p>
          <a href="pages/products.php" class="shop-btn">Shop Now</a>
        </div>
      </div>
    </section>

    <!-- Featured cleats --------------------------------------------- -->
    <section class="featured">
      <h2>Featured Cleats</h2>

      <div class="featured-grid">

        <?php foreach ($featured as $p): 
              /* pull TWO images (for hover) */
              $imgs  = fetchFirstTwoImages($conn, (int)$p['product_id']);
              $img1  = htmlspecialchars($imgs[0]);
              $img2  = htmlspecialchars($imgs[1]);
              $name  = htmlspecialchars($p['name']);
              $price = number_format($p['price'], 2);
              $id    = (int)$p['product_id'];          ?>
          
          <a href="pages/product-details.php?id=<?= $id ?>" class="product-link">
            <div class="product-card">
              <div class="product-image">
                <img class="primary-img"   src="<?= $img1 ?>" alt="<?= $name ?>">
                <img class="secondary-img" src="<?= $img2 ?>" alt="<?= $name ?> side">
              </div>
              <h3><?= $name ?></h3>
              <p class="price">€<?= $price ?></p>
            </div>
          </a>

        <?php endforeach; ?>

      </div> <!-- /.featured-grid -->
    </section>

  </main>

  <div id="footer"></div>

  <!-- loads navbar / footer into the page -->
  <script src="assets/js/script.js"></script>
</body>
</html>
<?php $conn->close(); ?>


