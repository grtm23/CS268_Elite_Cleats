<?php
$passwords = [
    'admin123',
    'test123',
    'test456'
];

foreach ($passwords as $plain) {
    $hash = password_hash($plain, PASSWORD_DEFAULT);
    echo "Password: $plain<br>";
    echo "Hash: $hash<br><br>";
}
?>
