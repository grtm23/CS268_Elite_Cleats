<?php
require_once __DIR__ . '/connection.php';

/**
 * Sanitises and maps sort option to an SQL ORDER BY clause.
 */
function getSortClause(string $sort): string
{
    switch ($sort) {
        case 'price-low-high':
            return 'price ASC';
        case 'price-high-low':
            return 'price DESC';
        case 'name-a-z':
            return 'name ASC';
        case 'name-z-a':
            return 'name DESC';
        default:
            return 'created_at DESC';   // newest first
    }
}

/**
 * Returns all products with their first two images.
 * @return array<int,array<string,mixed>>
 */
function fetchProducts(mysqli $conn, string $sort = 'default'): array
{
    $orderBy = getSortClause($sort);

    // Main product query
    $sql = "
        SELECT p.product_id, p.name, p.price
        FROM Products p
        ORDER BY $orderBy
        LIMIT 100      -- safety limit; you said only ~10 products
    ";
    $result = $conn->query($sql);

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $row['images'] = fetchFirstTwoImages($conn, $row['product_id']);
        $products[]    = $row;
    }
    return $products;
}

/**
 * Returns up to two image URLs for one product.
 * If only one exists, returns it twice so hover still works.
 * @return array{0:string,1:string}
 */
function fetchFirstTwoImages(mysqli $conn, int $productId): array
{
    $stmt = $conn->prepare("
        SELECT image_url
        FROM Product_Images
        WHERE product_id = ?
        ORDER BY image_id ASC
        LIMIT 2
    ");
    $stmt->bind_param('i', $productId);
    $stmt->execute();
    $res = $stmt->get_result();

    $urls = [];
    while ($img = $res->fetch_assoc()) {
        $urls[] = $img['image_url'];
    }
    // Ensure we always have 2 urls (duplicate if only one)
    if (count($urls) === 1) $urls[1] = $urls[0];
    if (count($urls) === 0) $urls = ['assets/img/placeholder.webp','assets/img/placeholder.webp'];

    return $urls;
}


/* 
 * Fetch N random products with their first image
 */
function fetchRandomProducts(mysqli $conn, int $limit = 3): array
{
    $stmt = $conn->prepare("
        SELECT p.product_id, p.name, p.price,
               (SELECT image_url
                FROM Product_Images pi
                WHERE pi.product_id = p.product_id
                ORDER BY pi.image_id ASC
                LIMIT 1) AS image_url
        FROM Products p
        ORDER BY RAND()
        LIMIT ?
    ");
    $stmt->bind_param('i', $limit);
    $stmt->execute();
    $res = $stmt->get_result();

    $products = [];
    while ($row = $res->fetch_assoc()) {
        if (!$row['image_url']) {
            $row['image_url'] = 'assets/img/placeholder.webp';
        }
        $products[] = $row;
    }
    return $products;
}
/* 
 * Return one product row by id  (name, price, description)
 */
function getProductById(mysqli $conn, int $id): ?array
{
    $stmt = $conn->prepare("
        SELECT product_id, name, description, price
        FROM Products
        WHERE product_id = ?
        LIMIT 1
    ");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $res = $stmt->get_result();
    return $res->num_rows ? $res->fetch_assoc() : null;
}

/* 
 * Return ALL images (ordered) for a product
 */
function getProductImages(mysqli $conn, int $id): array
{
    $stmt = $conn->prepare("
        SELECT image_url
        FROM Product_Images
        WHERE product_id = ?
        ORDER BY image_id ASC
    ");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $imgs = [];
    while ($row = $res->fetch_assoc()) {
        $imgs[] = $row['image_url'];
    }
    // fallback placeholder
    if (!$imgs) $imgs[] = 'assets/img/placeholder.webp';
    return $imgs;
}
/* 
 * Dashboard counts  (users, products, pending orders, low stock)
 */
function getDashboardStats(mysqli $conn): array
{
    // Users
    $totalUsers = $conn->query("SELECT COUNT(*) AS c FROM Users")->fetch_assoc()['c'];

    // Products
    $totalProducts = $conn->query("SELECT COUNT(*) AS c FROM Products")->fetch_assoc()['c'];

    // Pending orders
    $pendingOrders = $conn->query("SELECT COUNT(*) AS c FROM Orders WHERE status='pending'")->fetch_assoc()['c'];

    // Low-stock items (<=3 units)
    $lowStock = $conn->query("SELECT COUNT(*) AS c FROM Products WHERE stock<=3")->fetch_assoc()['c'];

    return [
        'users'    => $totalUsers,
        'products' => $totalProducts,
        'pending'  => $pendingOrders,
        'lowStock' => $lowStock
    ];
}

/* 
 * Full product list (+ first image) for admin table
 */
function fetchAllProducts(mysqli $conn): array
{
    $sql = "
      SELECT p.product_id, p.name, p.price, p.stock,
             (SELECT image_url
              FROM Product_Images pi
              WHERE pi.product_id = p.product_id
              ORDER BY pi.image_id ASC
              LIMIT 1) AS image_url
      FROM Products p
      ORDER BY p.product_id DESC";
    return $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
}

/*
 * All orders with user email
 */
function fetchAllOrders(mysqli $conn): array
{
    $sql = "
      SELECT o.order_id, u.email, o.total_amount, o.status, o.order_date
      FROM Orders o
      JOIN Users u ON u.user_id = o.user_id
      ORDER BY o.order_date DESC";
    return $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
}

/* 
 * All users list
 */
function fetchAllUsers(mysqli $conn): array
{
    $sql = "
      SELECT email, role, created_at
      FROM Users
      ORDER BY created_at DESC";
    return $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
}

/*
 * Insert user and return new user_id (or false on duplicate)
 */
function createUser(mysqli $conn, array $data)
{
    // Check duplicate email
    $check = $conn->prepare("SELECT 1 FROM Users WHERE email = ?");
    $check->bind_param('s', $data['email']);
    $check->execute();
    if ($check->get_result()->num_rows) return false; // email exists

    $stmt = $conn->prepare("
        INSERT INTO Users (first_name, last_name, email, phone_number, address, password_hash)
        VALUES (?,?,?,?,?,?)
    ");
    $stmt->bind_param(
        'ssssss',
        $data['first_name'],
        $data['last_name'],
        $data['email'],
        $data['phone'],
        $data['address'],
        password_hash($data['password'], PASSWORD_DEFAULT)
    );
    return $stmt->execute() ? $conn->insert_id : false;
}

/* 
 * Return all cart rows for a user_id
 */
function getCartItems(mysqli $conn, int $uid): array
{
    $sql = "
      SELECT c.cart_id, c.product_id, c.quantity, c.size,
             p.name, p.price,
             (SELECT image_url FROM Product_Images WHERE product_id = p.product_id LIMIT 1) AS image
      FROM Cart c
      JOIN Products p ON p.product_id = c.product_id
      WHERE c.user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $uid);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

/* Insert / update one cart item */
function upsertCartItem(mysqli $conn, int $uid, array $item)
{
    $stmt = $conn->prepare("
      INSERT INTO Cart (user_id, product_id, quantity, size)
      VALUES (?,?,?,?)
      ON DUPLICATE KEY UPDATE quantity = VALUES(quantity)
    ");
    $stmt->bind_param('iiis', $uid, $item['product_id'], $item['quantity'], $item['size']);
    return $stmt->execute();
}

/* Delete one cart item */
function deleteCartItem(mysqli $conn, int $uid, int $pid, string $size)
{
    $stmt = $conn->prepare("DELETE FROM Cart WHERE user_id=? AND product_id=? AND size=?");
    $stmt->bind_param('iis', $uid, $pid, $size);
    return $stmt->execute();
}
/* fetch user info for checkout autofill  */
function getUserInfo(mysqli $conn, int $uid): ?array {
    $stmt = $conn->prepare("SELECT first_name, last_name, email, address FROM Users WHERE user_id=?");
    $stmt->bind_param('i', $uid);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

/* compute cart total for a user  */
function cartTotals(mysqli $conn, int $uid): array {
    $items = getCartItems($conn, $uid);
    $sum = 0;
    foreach ($items as $it) $sum += $it['price'] * $it['quantity'];
    return ['items'=>$items, 'subtotal'=>$sum];
}

?>

