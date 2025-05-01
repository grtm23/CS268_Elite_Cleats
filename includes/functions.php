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

?>

