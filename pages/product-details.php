<?php
require_once '../includes/functions.php';

/* --- Validate ID parameter --- */
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$product = getProductById($conn, $id);

if (!$product) {
    header('Location: products.php');
    exit;
}

$images   = getProductImages($conn, $id);
$mainImg  = $images[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($product['name']); ?> – Elite Cleats</title>

  <!-- Global & shared -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/navbar.css">
  <link rel="stylesheet" href="../assets/css/footer.css">
  <link rel="stylesheet" href="../assets/css/product-details.css">
</head>
<body>

  <!-- Navbar -->
  <div id="navbar"></div>

  <!-- Main layout -->
  <main class="product-detail-container">

    <!-- Image gallery -->
    <div class="image-gallery">
      <img id="mainImage"
           src="../<?= htmlspecialchars($mainImg); ?>"
           alt="Main product view"
           class="main-image">
      <div class="thumbnail-row">
        <?php foreach ($images as $src): ?>
          <img src="../<?= htmlspecialchars($src); ?>"
               alt="thumbnail"
               onclick="switchImage(this)">
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Product info -->
    <div class="product-info">
      <h1><?= htmlspecialchars($product['name']); ?></h1>
      <p class="price"><?= number_format($product['price'], 2); ?> €</p>

      <label for="size">Size:</label>
      <select id="size">
        <!-- Static list for now -->
        <option value="8 UK">8 UK – 42 EU</option>
        <option value="9 UK">9 UK – 43 EU</option>
        <option value="10 UK">10 UK – 44 EU</option>
      </select>

      <label for="quantity">Quantity:</label>
      <div class="quantity-controls">
        <button onclick="changeQuantity(-1)">–</button>
        <span id="quantity">1</span>
        <button onclick="changeQuantity(1)">+</button>
      </div>

      <button class="add-to-cart-btn" onclick="handleAddToCart()">Add to Cart</button>
    </div>
  </main>

  <!-- Description -->
  <section class="product-description">
    <h2>Product Description</h2>
    <p><?= nl2br(htmlspecialchars($product['description'] ?: 'No description available.')); ?></p>
  </section>

  <!-- Cart side-panel -->
  <div id="cart-panel" class="cart-panel hidden">
    <div class="cart-header">
      <h3><a href="cart.php">Item added to the cart →</a></h3>
      <button class="close-btn" onclick="closeCartPanel()">×</button>
    </div>

    <div class="cart-item">
      <img id="cart-thumb" src="" alt="Product thumbnail">
      <div class="cart-item-info">
        <p class="cart-product-name" id="cart-name">Product Name</p>
        <p class="cart-subinfo"><span id="cart-size">Size: —</span> | <span>No customization</span></p>
        <p class="cart-product-price"><span id="cart-price">— €</span></p>
      </div>
      <button class="remove-item-btn" title="Remove">🗑️</button>
    </div>

    <div class="suggested">
      <h4>Suggested Items</h4>
      <div class="suggested-items">Coming soon...</div>
    </div>

    <a href="cart.php" class="view-cart-btn">View Cart</a>
  </div>

  <!-- Footer -->
  <div id="footer"></div>

  <!-- Shared + page scripts -->
  <script src="../assets/js/script.js"></script>

  <!-- Pass PHP product data to JS -->
  <script>
    const productData = <?= json_encode([
      'id'    => $product['product_id'],
      'name'  => $product['name'],
      'price' => number_format($product['price'], 2),
      'img'   => $mainImg
    ], JSON_HEX_TAG); ?>;
  </script>

  <script src="../assets/js/product-details.js"></script>
</body>
</html>
<?php $conn->close(); ?>




