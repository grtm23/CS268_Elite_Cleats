<?php
require_once '../includes/functions.php';
session_start();

/* ---- ensure logged in ---- */
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?redirect=checkout.php');
    exit;
}

$uid      = $_SESSION['user_id'];
$userInfo = getUserInfo($conn, $uid);
$cart     = cartTotals($conn, $uid);
$shipping = 15;
$total    = $cart['subtotal'] + $shipping;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout – Elite Cleats</title>

  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/navbar.css">
  <link rel="stylesheet" href="../assets/css/footer.css">
  <link rel="stylesheet" href="../assets/css/checkout.css">
</head>
<body>
  <div id="navbar"></div>

  <main class="checkout-container">
    <!-- Shipping & Payment form -->
    <section class="checkout-left">
      <h1>Shipping &amp; Payment</h1>

      <form id="checkout-form" method="POST" action="place-order.php">
        <h2>Customer Information</h2>
        <label>Full Name:</label>
        <input type="text" name="fullName"
               value="<?= htmlspecialchars($userInfo['first_name'].' '.$userInfo['last_name']); ?>" required>

        <label>Email:</label>
        <input type="email" name="email"
               value="<?= htmlspecialchars($userInfo['email']); ?>" required>

        <h2>Shipping Address</h2>
        <label>Street Address:</label>
        <input type="text" name="address"
               value="<?= htmlspecialchars($userInfo['address']); ?>" required>

        <label>City:</label>
        <input type="text" name="city" required>

        <label>ZIP Code:</label>
        <input type="text" name="zip" required>

        <h2>Payment Method</h2>
        <label><input type="radio" name="payment" value="card" checked> Credit/Debit Card</label>
        <label><input type="radio" name="payment" value="paypal"> PayPal</label>
      </form>
    </section>

    <!-- Order summary -->
    <aside class="checkout-summary">
      <h2>Order Summary</h2>
      <div class="summary-line">
        <span>Total product price:</span>
        <span><?= number_format($cart['subtotal'],2); ?> €</span>
      </div>
      <div class="summary-line">
        <span>Shipping:</span>
        <span><?= number_format($shipping,2); ?> €</span>
      </div>
      <div class="summary-line total">
        <span>Total:</span>
        <span><?= number_format($total,2); ?> €</span>
      </div>
      <button type="submit" class="confirm-btn" form="checkout-form">
        Confirm and Pay
      </button>
    </aside>
  </main>

  <div id="footer"></div>
  <script src="../assets/js/script.js"></script>
  <script src="../assets/js/checkout.js"></script>
</body>
</html>
<?php $conn->close(); ?>

