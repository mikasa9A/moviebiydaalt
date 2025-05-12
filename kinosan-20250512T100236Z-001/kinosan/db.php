<?php
// db.php - Establish a database connection using PDO

$host = 'localhost';
$db   = 'kinosan'; // Your database name
$user = 'root';    // Default XAMPP username
$pass = '';        // Default XAMPP password (empty by default)
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Options for secure and error-handled connection
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Use native prepared statements
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    error_log($e->getMessage());
    exit('Database connection failed.');
}
?>
