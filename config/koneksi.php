<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "trendify";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    
    // Error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Default fetch mode (biar ga ribet fetch array)
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
?>