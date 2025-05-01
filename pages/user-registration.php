<?php
require_once '../includes/functions.php';
session_start();

$errors = [];
$success = false;

/* ---------- Handle POST ---------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitise inputs
    $first  = trim($_POST['first_name'] ?? '');
    $last   = trim($_POST['last_name']  ?? '');
    $email  = trim($_POST['email']      ?? '');
    $phone  = trim($_POST['phone']      ?? '');
    $addr   = trim($_POST['address']    ?? '');
    $pass   = $_POST['password']        ?? '';
    $cpass  = $_POST['confirm_pass']    ?? '';

    // Basic server-side validation
    if (!$first)         $errors[] = 'First name required';
    if (!$last)          $errors[] = 'Last name required';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email required';
    if ($pass !== $cpass) $errors[] = 'Passwords do not match';
    if (strlen($pass) < 6) $errors[] = 'Password must be at least 6 chars';

    if (!$errors) {
        $newId = createUser($conn, [
            'first_name' => $first,
            'last_name'  => $last,
            'email'      => $email,
            'phone'      => $phone,
            'address'    => $addr,
            'password'   => $pass
        ]);

        if ($newId) {
            // Auto-login user
            $_SESSION['user_id'] = $newId;
            $_SESSION['role']    = 'customer';
            $success = true;
            header('Location: products.php');  // redirect after success
            exit;
        } else {
            $errors[] = 'Email already in use';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Registration – Elite Cleats</title>

  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/navbar.css">
  <link rel="stylesheet" href="../assets/css/footer.css">
  <link rel="stylesheet" href="../assets/css/user-reg.css">
</head>
<body>
  <div id="navbar"></div>

  <main id="user-reg-page">
    <h1>Create Account</h1>
    <p>Already have an account? <a href="login.php" style="color:#c00;">Sign in!</a></p>

    <?php if ($errors): ?>
      <div style="color:red;margin-bottom:15px;">
        <?= implode('<br>', array_map('htmlspecialchars', $errors)); ?>
      </div>
    <?php endif; ?>

    <form id="signUpForm" method="POST" novalidate>
      <div class="sidebox">
        <div class="sideitem">
          <label>First Name</label>
          <input type="text" name="first_name" value="<?= htmlspecialchars($_POST['first_name']??''); ?>">
        </div>
        <div class="sideitem">
          <label>Last Name</label>
          <input type="text" name="last_name" value="<?= htmlspecialchars($_POST['last_name']??''); ?>">
        </div>
      </div>

      <div class="downbox">
        <div class="downitem">
          <label>Address</label>
          <input type="text" name="address" value="<?= htmlspecialchars($_POST['address']??''); ?>">
        </div>
      </div>

      <div class="sidebox">
        <div class="sideitem">
          <label>Email</label>
          <input type="email" name="email" value="<?= htmlspecialchars($_POST['email']??''); ?>">
        </div>
        <div class="sideitem">
          <label>Phone Number</label>
          <input type="tel" name="phone" value="<?= htmlspecialchars($_POST['phone']??''); ?>">
        </div>
      </div>

      <div class="sidebox">
        <div class="sideitem">
          <label>Password</label>
          <input type="password" name="password">
        </div>
        <div class="sideitem">
          <label>Confirm Password</label>
          <input type="password" name="confirm_pass">
        </div>
      </div>

      <button class="submit_button" type="submit">Submit</button>
    </form>
  </main>

  <div id="footer"></div>
  <script src="../assets/js/script.js"></script>
  <script src="../assets/js/user-registration.js"></script>
</body>
</html>
<?php $conn->close(); ?>
