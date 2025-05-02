<?php
require_once '../includes/functions.php';
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error'=>'not_logged_in']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if ($data['action'] === 'upsert') {
    upsertCartItem($conn, $_SESSION['user_id'], $data['item']);
    echo json_encode(['ok'=>1]);
} elseif ($data['action'] === 'delete') {
    deleteCartItem($conn, $_SESSION['user_id'], $data['product_id'], $data['size']);
    echo json_encode(['ok'=>1]);
} else {
    http_response_code(400);
    echo json_encode(['error'=>'bad_action']);
}
?>
