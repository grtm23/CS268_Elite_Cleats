<?php
require_once '../includes/functions.php';
session_start();

$submitted = false;
$email     = '';

/* ---------- Handle POST ---------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    if ($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $submitted = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Forgot Password – Elite Cleats</title>

  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/navbar.css">
  <link rel="stylesheet" href="../assets/css/footer.css">
  <link rel="stylesheet" href="../assets/css/forgot-password.css">
</head>
<body>

  <div id="navbar"></div>

  <main class="forgot-password-container">
    <div class="forgot-password-box">

      <?php if ($submitted): ?>
        <h1>Check your email</h1>
        <p>
          If an account with <strong><?= htmlspecialchars($email); ?></strong> exists,
          a password-reset link has been sent.  
          Please check your inbox (and spam folder) for further instructions.
        </p>
        <a href="login.php" class="back-to-login">← Back to login</a>

      <?php else: ?>
        <h1>Forgot your password?</h1>
        <p>Enter your email and we’ll send you a link to reset it.</p>

        <form method="POST" class="reset-form" novalidate>
          <label for="email">Email address:</label>
          <input type="email" id="email" name="email"
                 placeholder="you@example.com" required>
          <button type="submit" class="reset-btn">Reset Password</button>
        </form>

        <a href="login.php" class="back-to-login">← Back to login</a>
      <?php endif; ?>

    </div>
  </main>

  <div id="footer"></div>
  <script src="../assets/js/script.js"></script>
</body>
</html>
<?php $conn->close(); ?>

