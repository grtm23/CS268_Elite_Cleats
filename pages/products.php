<?php
require_once '../includes/functions.php';

// --- read sort from query string ---
$sort = $_GET['sort'] ?? 'default';
$sortSafe = htmlspecialchars($sort, ENT_QUOTES, 'UTF-8');

// Fetch products + first two images each
$products = fetchProducts($conn, $sort);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products – Elite Cleats</title>

  <!-- Global & shared styles -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/navbar.css">
  <link rel="stylesheet" href="../assets/css/footer.css">

  <!-- Page-specific -->
  <link rel="stylesheet" href="../assets/css/product.css">
</head>
<body>

  <div id="navbar"></div>

  <main class="products-page">
    <section class="product-header">
      <h1>Football Cleats</h1>

      <div class="sort-menu">
        <label for="sort-options">Order by:</label>
        <select id="sort-options">
          <option value="default"           <?= $sortSafe==='default'           ? 'selected' : '' ?>>Default</option>
          <option value="price-low-high"    <?= $sortSafe==='price-low-high'    ? 'selected' : '' ?>>Price: Low to High</option>
          <option value="price-high-low"    <?= $sortSafe==='price-high-low'    ? 'selected' : '' ?>>Price: High to Low</option>
          <option value="name-a-z"          <?= $sortSafe==='name-a-z'          ? 'selected' : '' ?>>Name: A–Z</option>
          <option value="name-z-a"          <?= $sortSafe==='name-z-a'          ? 'selected' : '' ?>>Name: Z–A</option>
        </select>
      </div>
    </section>

    <section class="product-grid">
      <?php foreach ($products as $prod): 
              $img1 = htmlspecialchars($prod['images'][0]);
              $img2 = htmlspecialchars($prod['images'][1]);
              $name = htmlspecialchars($prod['name']);
              $price= number_format($prod['price'], 2);
              $id   = (int)$prod['product_id'];
      ?>
      <a href="product-details.php?id=<?= $id ?>" class="product-link">
        <div class="product-card">
          <div class="product-image">
            <img class="primary-img"   src="../<?= $img1 ?>" alt="<?= $name ?>">
            <img class="secondary-img" src="../<?= $img2 ?>" alt="<?= $name ?> side">
          </div>
          <h3><?= $name ?></h3>
          <p class="price"><?= $price ?> €</p>
        </div>
      </a>
      <?php endforeach; ?>
    </section>
  </main>

  <div id="footer"></div>

  <script src="../assets/js/script.js"></script>
  <script>
    // On change, reload page with ?sort=value
    document.getElementById('sort-options')
      .addEventListener('change', e => {
        const val = e.target.value;
        window.location = 'products.php?sort=' + encodeURIComponent(val);
      });
  </script>
</body>
</html>
<?php $conn->close(); ?>
