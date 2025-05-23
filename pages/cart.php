<?php if (session_status()===PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Cart – Elite Cleats</title>

    <!-- Global Styles -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Shared Components -->
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/footer.css">

    <!-- Page-Specific Styles -->
    <link rel="stylesheet" href="../assets/css/cart.css">
</head>
<body>
    <div id="navbar"></div>

    <main class="cart-container">
        <!-- Left Side: Cart Items -->
        <section class="cart-left">
            <h1>My Basket</h1>
            <div id="cart-items"></div>

            <h2 class="suggested-title">You might be interested in</h2>
            <div class="suggested-placeholder">Coming soon...</div>
        </section>

        <!-- Right Side: Summary -->
        <aside class="cart-summary">
        <h2>Overview</h2>
        <div class="summary-line">
            <span>Total product price:</span>
            <span id="summary-products">— €</span>
        </div>
        <div class="summary-line">
            <span>Shipping:</span>
            <span id="summary-shipping">15 €</span>
        </div>
        <div class="summary-line total">
            <span>Total:</span>
            <span id="summary-total">— €</span>
        </div>
        <a href="checkout.php" class="pay-btn">Pay now</a>
        </aside>
    </main>

    <div id="footer"></div>

    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/cart.js"></script>
</body>
</html>
