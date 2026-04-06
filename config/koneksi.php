<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "trendify";

try {
    // Kita buat objek PDO baru
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    
    // Set error mode ke exception supaya kalau ada typo di SQL langsung ketahuan
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Opsional: Untuk mysqli tetap ada jika file lama butuh (tapi di MVC pakai $pdo)
    $conn = mysqli_connect($host, $user, $pass, $db); 

} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
?>