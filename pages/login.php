<?php
require_once '../includes/functions.php';
session_start();

$errors = [];
$redirect = $_GET['redirect'] ?? 'products.php';

/* ---------- Handle POST ---------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $pass  = $_POST['password'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !$pass) {
        $errors[] = 'Invalid email or password';
    } else {
        // Fetch user
        $stmt = $conn->prepare("SELECT user_id, password_hash, role FROM Users WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows && ($row = $res->fetch_assoc())) {
            if (password_verify($pass, $row['password_hash'])) {
                // Success
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['role']    = $row['role'];

                // JS flag for cart sync
                echo "<script>
                        sessionStorage.setItem('loggedIn','true');
                        sessionStorage.setItem('userId','{$row['user_id']}');
                        window.location = '$redirect';
                      </script>";
                exit;
            }
        }
        $errors[] = 'Email or password incorrect';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login – Elite Cleats</title>

  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/navbar.css">
  <link rel="stylesheet" href="../assets/css/footer.css">
  <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>

  <div id="navbar"></div>

  <div class="modal-background">
    <div class="login-box">
      <h2>Do you have an account with us?</h2>

      <?php if ($errors): ?>
        <div style="color:red;margin-bottom:10px;">
          <?= implode('<br>', array_map('htmlspecialchars', $errors)); ?>
        </div>
      <?php endif; ?>

      <form method="POST" class="login-form" novalidate>
        <label for="email">Email address</label>
        <input type="email" id="email" name="email" placeholder="you@example.com" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>

        <button type="submit" class="login-btn">Log In</button>
      </form>

      <div class="login-actions">
        <a href="forgot-password.php">Forgot your password?</a>
        <a href="user-registration.php">Sign up</a>
      </div>
    </div>
  </div>

  <div id="footer"></div>

  <script src="../assets/js/script.js"></script>
</body>
</html>
<?php $conn->close(); ?>

