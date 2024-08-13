<?php
try {
    $dsn = 'mysql:host=localhost;dbname=mywebsite'; // Replace 'mywebsite' with your database name
    $username = 'root'; // Default XAMPP username
    $password = ''; // Default XAMPP password (empty)

    // Create a PDO instance
    $pdo = new PDO($dsn, $username, $password);

    // Set default fetch mode to associative array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
?>
