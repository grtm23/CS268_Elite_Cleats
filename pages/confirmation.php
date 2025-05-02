<?php
require_once '../includes/functions.php';
session_start();

/* ---------- Guard checks ---------- */
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$userId   = $_SESSION['user_id'];
$orderId  = (int)($_GET['order_id'] ?? 0);
if (!$orderId) {
    echo "Order not found.";
    exit;
}

/* ---------- Fetch order + items ---------- */
$headerStmt = $conn->prepare("
    SELECT total_amount, shipping_address, order_date
    FROM Orders
    WHERE order_id = ? AND user_id = ?
");
$headerStmt->bind_param('ii', $orderId, $userId);
$headerStmt->execute();
$orderHeader = $headerStmt->get_result()->fetch_assoc();

if (!$orderHeader) {
    echo "Order not found.";
    exit;
}

$itemStmt = $conn->prepare("
    SELECT oi.product_id, oi.quantity, oi.size, oi.price_at_purchase,
           p.name,
           (SELECT image_url FROM Product_Images WHERE product_id = p.product_id LIMIT 1) AS image
    FROM Order_Items oi
    JOIN Products p ON p.product_id = oi.product_id
    WHERE oi.order_id = ?
");
$itemStmt->bind_param('i', $orderId);
$itemStmt->execute();
$items = $itemStmt->get_result()->fetch_all(MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order #<?= $orderId; ?> Confirmation – Elite Cleats</title>

  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/navbar.css">
  <link rel="stylesheet" href="../assets/css/footer.css">
  <link rel="stylesheet" href="../assets/css/confirmation.css">
</head>
<body>
  <div id="navbar"></div>

  <main class="confirmation-container">
    <div class="confirmation-box">
      <h1>✅ Thank you for your order!</h1>
      <p>Order <strong>#<?= $orderId; ?></strong> placed on
         <?= date('F j, Y, g:i a', strtotime($orderHeader['order_date'])); ?>.</p>
      <p>You’ll receive a confirmation email shortly.</p>

      <h2>Order Summary</h2>
      <div id="confirmation-items">
        <?php foreach ($items as $it): ?>
          <div class="confirmation-item">
            <img src="../<?= htmlspecialchars($it['image']); ?>" alt="<?= htmlspecialchars($it['name']); ?>">
            <div class="confirmation-item-details">
              <p><strong><?= htmlspecialchars($it['name']); ?></strong></p>
              <p>Size: <?= htmlspecialchars($it['size']); ?></p>
              <p>Quantity: <?= $it['quantity']; ?></p>
              <p>Subtotal: <?= number_format($it['price_at_purchase'] * $it['quantity'], 2); ?> €</p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="confirmation-total">
        <strong>Total:</strong>
        <span><?= number_format($orderHeader['total_amount'], 2); ?> €</span>
      </div>

      <a href="products.php" class="shop-more-btn">Continue Shopping</a>
    </div>
  </main>

  <div id="footer"></div>

  <script src="../assets/js/script.js"></script>
  <script>
    /* Clear any leftover guest cart just in case */
    localStorage.removeItem('cart');
  </script>
</body>
</html>
<?php $conn->close(); ?>

