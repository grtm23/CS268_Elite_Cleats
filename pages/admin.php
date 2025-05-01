<?php
require_once '../includes/functions.php';

$stats    = getDashboardStats($conn);
$products = fetchAllProducts($conn);
$orders   = fetchAllOrders($conn);
$users    = fetchAllUsers($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel – Elite Cleats</title>

  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/navbar.css">
  <link rel="stylesheet" href="../assets/css/footer.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
  <div id="navbar"></div>

  <main class="admin-container">
    <aside class="admin-sidebar">
      <h2>Admin Menu</h2>
      <button onclick="showSection('admin-dashboard')">Dashboard</button>
      <button onclick="showSection('admin-products')">Products</button>
      <button onclick="showSection('admin-orders')">Orders</button>
      <button onclick="showSection('admin-users')">Users</button>
    </aside>

    <section class="admin-content">

      <!-- Dashboard -->
      <div id="admin-dashboard" class="admin-section">
        <h1>Dashboard Overview</h1>
        <div class="admin-cards">
          <div class="admin-card">👤 Users: <?= $stats['users'] ?></div>
          <div class="admin-card">👟 Products: <?= $stats['products'] ?></div>
          <div class="admin-card">📦 Pending Orders: <?= $stats['pending'] ?></div>
          <div class="admin-card">⚠️ Low Stock: <?= $stats['lowStock'] ?> items</div>
        </div>
      </div>

      <!-- Product Management -->
      <div id="admin-products" class="admin-section" style="display:none">
        <h1>Product Management</h1>
        <button class="add-btn" onclick="alert('Not implemented yet')">+ Add Product</button>
        <table class="admin-table">
          <thead>
            <tr>
              <th>Image</th><th>Name</th><th>Price</th><th>Stock</th><th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($products as $p): ?>
              <tr>
                <td style="width:60px">
                  <img src="../<?= htmlspecialchars($p['image_url'] ?: 'assets/img/placeholder.webp'); ?>" alt="thumb" style="width:60px;height:60px;object-fit:contain">
                </td>
                <td><?= htmlspecialchars($p['name']); ?></td>
                <td>€<?= number_format($p['price'], 2); ?></td>
                <td><?= (int)$p['stock']; ?></td>
                <td>
                  <button onclick="alert('Edit product #<?= $p['product_id']; ?>')">Edit</button>
                  <button onclick="alert('Delete product #<?= $p['product_id']; ?>')">Delete</button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <!-- Orders -->
      <div id="admin-orders" class="admin-section" style="display:none">
        <h1>Order History</h1>
        <table class="admin-table">
          <thead>
            <tr>
              <th>ID</th><th>User</th><th>Total</th><th>Status</th><th>Date</th><th>View</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($orders as $o): ?>
              <tr>
                <td>#<?= $o['order_id']; ?></td>
                <td><?= htmlspecialchars($o['email']); ?></td>
                <td>€<?= number_format($o['total_amount'], 2); ?></td>
                <td><?= htmlspecialchars($o['status']); ?></td>
                <td><?= date('Y-m-d H:i', strtotime($o['order_date'])); ?></td>
                <td><button onclick="alert('View order #<?= $o['order_id']; ?>')">👁️</button></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <!-- Users -->
      <div id="admin-users" class="admin-section" style="display:none">
        <h1>User Accounts</h1>
        <table class="admin-table">
          <thead>
            <tr>
              <th>Email</th><th>Role</th><th>Registered</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $u): ?>
              <tr>
                <td><?= htmlspecialchars($u['email']); ?></td>
                <td><?= htmlspecialchars($u['role']); ?></td>
                <td><?= date('Y-m-d', strtotime($u['created_at'])); ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

    </section>
  </main>

  <div id="footer"></div>

  <script src="../assets/js/script.js"></script>
  <script src="../assets/js/admin.js"></script>
</body>
</html>
<?php $conn->close(); ?>
