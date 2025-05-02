<?php
require_once '../includes/functions.php';
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error'=>'not_logged_in']);
    exit;
}

$items = getCartItems($conn, $_SESSION['user_id']);
echo json_encode($items);
?>
