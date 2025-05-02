<?php
require_once '../includes/functions.php';
session_start();

/* --------------- Guard clauses --------------- */
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?redirect=checkout.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: checkout.php');
    exit;
}

$userId = $_SESSION['user_id'];

/* --------------- Fetch cart --------------- */
$cartItems = getCartItems($conn, $userId);
if (!$cartItems) {
    echo "Your cart is empty.";
    exit;
}

/* --------------- Collect form data --------------- */
$address = trim($_POST['address'] ?? '') . ', ' .
           trim($_POST['city'] ?? '') . ', ' .
           trim($_POST['zip'] ?? '');

$shippingCost = 15.00;
$subtotal     = 0.0;
foreach ($cartItems as $it) {
    $subtotal += $it['price'] * $it['quantity'];
}
$totalAmount = $subtotal + $shippingCost;

/* --------------- Create order --------------- */
try {
    $conn->begin_transaction();

    // Insert into Orders
    $stmt = $conn->prepare("
        INSERT INTO Orders (user_id, total_amount, shipping_address, status)
        VALUES (?,?,?, 'pending')
    ");
    $stmt->bind_param('ids', $userId, $totalAmount, $address);
    if (!$stmt->execute()) throw new Exception("Order insert failed");

    $orderId = $conn->insert_id;

    // Insert each item
    $itemStmt = $conn->prepare("
        INSERT INTO Order_Items (order_id, product_id, quantity, size, price_at_purchase)
        VALUES (?,?,?,?,?)
    ");

    foreach ($cartItems as $item) {
        $itemStmt->bind_param(
            'iiisd',
            $orderId,
            $item['product_id'],
            $item['quantity'],
            $item['size'],
            $item['price']
        );
        if (!$itemStmt->execute()) throw new Exception("Order item insert failed");
    }

    // Clear cart
    $clear = $conn->prepare("DELETE FROM Cart WHERE user_id = ?");
    $clear->bind_param('i', $userId);
    $clear->execute();

    $conn->commit();
    header("Location: confirmation.php?order_id=$orderId");
    exit;

} catch (Exception $e) {
    $conn->rollback();
    echo "Sorry, we couldn't process your order. Please try again.";
    // For debugging, uncomment:
    // echo "<pre>" . $e->getMessage() . "</pre>";
    exit;
}
?>
