<?php
// Database configuration
$host = 'localhost';
$dbname = 'elite_cleats_db';
$username = 'root';      // Change if using a different MySQL user
$password = '';          // Change if you set a MySQL password

// Create MySQLi connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("❌ Database connection failed: " . $conn->connect_error);
}

// Optional: Set charset
$conn->set_charset("utf8mb4");
?>
