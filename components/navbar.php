<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$loggedIn = isset($_SESSION['user_id']);
$isAdmin  = $loggedIn && $_SESSION['role'] === 'admin';
?>
<nav class="navbar">
  <div class="navbar-container">
    <a href="../index.php" class="logo">Elite Cleats</a>

    <ul class="nav-links">
      <li><a href="../index.php">Home</a></li>
      <li><a href="../pages/products.php">Cleats</a></li>
      <li><a href="../pages/about.html">About Us</a></li>
      <li><a href="../pages/contact.html">Contact</a></li>

      <?php if ($isAdmin): ?>
        <li><a href="../pages/admin.php">Admin</a></li>
      <?php endif; ?>

      <?php if ($loggedIn): ?>
        <li><a href="../pages/logout.php">Logout</a></li>
      <?php else: ?>
        <li><a href="../pages/login.php">Login</a></li>
      <?php endif; ?>

      <li><a href="../pages/cart.php">Cart</a></li>
    </ul>
  </div>
</nav>

  