<?php 
include 'config/koneksi.php'; 
// Estafet Koneksi PDO ke Controller & Model
include_once 'model/TransaksiModel.php';
include_once 'controller/TransaksiController.php';
include_once 'model/ProdukModel.php'; // WAJIB ADA supaya ProdukController bisa kerja
include_once 'controller/ProdukController.php';

// Inisialisasi Objek Controller
$produkCtrl = new ProdukController($pdo);
$transaksiCtrl = new TransaksiController($pdo);

// Menangani logic router
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trendify | PDT Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #a749ff;
            --text-dark: #333;
            --bg-light: #f6f6f6;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            background-color: #fff;
        }

        .navbar {
            background-color: #fff !important;
            padding: 25px 0;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: 1px;
            color: #000 !important;
        }

        .nav-link {
            font-weight: 500;
            font-size: 0.85rem;
            letter-spacing: 1px;
            color: #555 !important;
            margin: 0 15px;
            transition: 0.3s;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary-color) !important;
        }

        .hero {
            background-color: var(--bg-light);
            height: 80vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero h4 {
            color: var(--primary-color);
            text-transform: uppercase;
            font-weight: 500;
            letter-spacing: 3px;
            font-size: 1.1rem;
            margin-bottom: 20px;
        }

        .hero h1 {
            font-size: 4.5rem;
            font-weight: 600;
            line-height: 1.1;
            margin-bottom: 30px;
        }

        .btn-shop {
            background-color: transparent;
            border: 1px solid #333;
            padding: 15px 45px;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 2px;
            color: #333;
            text-decoration: none;
            transition: 0.4s;
            display: inline-block;
        }

        .btn-shop:hover {
            background-color: #333;
            color: #fff;
        }

        .content-wrapper {
            margin-bottom: 100px;
        }

        .page-padding {
            padding-top: 50px;
        }

        .pdt-card {
            border: none;
            background: #fff;
        }

        @media (max-width: 768px) {
            .hero h1 { font-size: 2.5rem; }
            .navbar-nav { text-align: center; padding: 20px 0; }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container text-center">
        <a class="navbar-brand" href="?page=home">TRENDIFY.</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link <?= (!isset($_GET['page']) || $_GET['page'] == 'home') ? 'active' : '' ?>" href="?page=home">BERANDA</a></li>
                <li class="nav-item"><a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'produk') ? 'active' : '' ?>" href="?page=produk">PRODUCT</a></li>
                <li class="nav-item"><a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'keranjang') ? 'active' : '' ?>" href="?page=keranjang">KERANJANG</a></li>
                <li class="nav-item"><a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'riwayat') ? 'active' : '' ?>" href="?page=riwayat">RIWAYAT</a></li>
                <li class="nav-item"><a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'deadlock') ? 'active' : '' ?>" href="?page=deadlock">DEADLOCK</a></li>
            </ul>
        </div>
        <div class="d-none d-lg-block" style="width: 120px;"></div>
    </div>
</nav>

<div class="content-wrapper <?= ($page != 'home') ? 'container page-padding' : '' ?>">
    <div class="pdt-card">
        <?php 
        if($page == 'produk'){
            // Ini akan memanggil ProdukController -> ProdukModel -> CALL select_produk()
            $produkCtrl->tampilProduk();
        }
        elseif($page == 'keranjang'){
            include 'view/keranjang.php';
        }
        elseif($page == 'riwayat'){
            $transaksiCtrl->tampilRiwayat(1);
        }
        elseif($page == 'deadlock'){
            include 'view/deadlock.php';
        }
        else{
            include 'view/home.php';
        }
        ?>
    </div>
</div>

<footer class="py-5 text-center bg-light border-top">
    <p class="text-muted small">© 2026 Trendify. Built for Pemrosesan Data Terdistribusi.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>