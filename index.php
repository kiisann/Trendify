<?php 
session_start();    

include 'config/koneksi.php'; 
// Estafet Koneksi PDO ke Controller & Model
include_once 'model/TransaksiModel.php';
include_once 'controller/TransaksiController.php';
include_once 'model/ProdukModel.php';
include_once 'controller/ProdukController.php';
include_once 'model/LoginModel.php';
include_once 'controller/LoginController.php';
include_once 'model/DashboardAdminModel.php';
include_once 'controller/DashboardAdminController.php';
include_once 'model/ProdukAdminModel.php';
include_once 'controller/ProdukAdminController.php';

// Inisialisasi Objek Controller
$loginCtrl = new LoginController($pdo);
$produkCtrl = new ProdukController($pdo);
$transaksiCtrl = new TransaksiController($pdo);
$dashboardCtrl = new DashboardAdminController($pdo);
$produkAdminCtrl = new ProdukAdminController($pdo);

// Menangani logic router
// $page = isset($_GET['page']) ? $_GET['page'] : 'home';
$page = $_GET['page'] ?? 'login';

// HANDLE LOGIN
if ($page == 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $loginCtrl->login();
    exit;
}
    
// HANDLE LOGOUT
if ($page == 'logout') {
    $loginCtrl->logout();
    exit;
}

// HANDLE TAMBAH
if ($page == 'produk-admin' && isset($_POST['simpan'])) {
    $produkAdminCtrl->tambah();
}

// HANDLE UPDATE
if ($page == 'produk-admin' && isset($_POST['update'])) {
    $produkAdminCtrl->update();
}

// HANDLE DELETE
if ($page == 'produk-admin' && isset($_GET['id'])) {
    $produkAdminCtrl->delete();
}

//KERANJANG
if ($page == 'tambah-keranjang' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $produkCtrl->tambahKeKeranjang();
    exit;
}

if ($page == 'hapus-keranjang' && isset($_GET['id'])) {
    $transaksiCtrl->hapusItemKeranjang();
    exit;
}

if ($page == 'ubah_qty' && isset($_GET['id']) && isset($_GET['aksi'])) {
    $transaksiCtrl->ubahQty();
    exit;
}

if ($page == 'checkout' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $transaksiCtrl->tampilPayment();
    exit;
}

if ($page == 'proses-bayar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $transaksiCtrl->prosesBayar();
    exit;
}

// PROTEKSI HALAMAN
$public_pages = ['login'];

if (!isset($_SESSION['user']) && !in_array($page, $public_pages)) {
    header("Location: ?page=login");
    exit;
}

// REDIRECT
if (isset($_SESSION['user']) && $page == 'login') {
    header("Location: ?page=home");
    exit;
}

$totalProduk = null;
$totalUser = null;
$totalTransaksi = null;

if ($page == 'home' && $_SESSION['user']['role'] == 'admin') {
    include_once 'model/DashboardAdminModel.php';

    $dash = new DashboardAdminModel($pdo);

    $totalProduk = $dash->totalProduk();
    $totalUser = $dash->totalUser();
    $totalTransaksi = $dash->totalTransaksi();
}
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

<?php if ($page != 'login'): ?>
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container text-center">
        <a class="navbar-brand" href="?page=home">TRENDIFY.</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
            <?php if ($_SESSION['user']['role'] == 'admin'): ?>
                <!-- ADMIN -->
                <li class="nav-item"><a class="nav-link <?= ($page == 'dashboard') ? 'active' : '' ?>" href="?page=dashboard">DASHBOARD</a></li>
                <li class="nav-item"><a class="nav-link <?= ($page == 'produk-admin') ? 'active' : '' ?>" href="?page=produk-admin">PRODUK</a></li>
            <?php else: ?>
                <!-- USER -->
                <li class="nav-item"><a class="nav-link <?= ($page == 'home') ? 'active' : '' ?>" href="?page=home">BERANDA</a></li>
                <li class="nav-item"><a class="nav-link <?= ($page == 'produk') ? 'active' : '' ?>" href="?page=produk">PRODUCT</a></li>
                <li class="nav-item"><a class="nav-link <?= ($page == 'keranjang') ? 'active' : '' ?>" href="?page=keranjang">KERANJANG</a></li>
                <li class="nav-item"><a class="nav-link <?= ($page == 'riwayat') ? 'active' : '' ?>" href="?page=riwayat">RIWAYAT</a></li>
            <?php endif; ?>
            </ul>
        </div>
        <div class="d-none d-lg-block" style="width: 150px;">
            <?php if (isset($_SESSION['user'])): ?>
                <small>
                    <?= $_SESSION['user']['nama']; ?> 
                    (<?= $_SESSION['user']['role']; ?>)
                </small><br>
                <a href="?page=logout" class="text-danger small">Logout</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<?php endif; ?>

<?php if ($page == 'login'): ?>
    <div class="content-wrapper" style="margin-bottom:0;">
        <?php include 'view/login.php'; ?>
    </div>
<?php else: ?>
    <div class="content-wrapper <?= ($page != 'home') ? 'container page-padding' : '' ?>">
        <div class="pdt-card">
            <?php 
            if($page == 'logout'){
                $loginCtrl->logout();
            }
            elseif($page == 'dashboard'){
                $dashboardCtrl->index();
            }
            elseif($page == 'produk-admin'){
                $produkAdminCtrl->index();
            }
            elseif($page == 'produk'){
                $produkCtrl->tampilProduk();
            }
            elseif($page == 'keranjang'){
                $transaksiCtrl->tampilKeranjang();
            }
            elseif($page == 'riwayat'){
                $transaksiCtrl->tampilRiwayat();
            }
            elseif($page == 'checkout-selesai'){
                $transaksiCtrl->tampilSelesai();
            }
            elseif($page == 'deadlock-result'){
                $transaksiCtrl->tampilDeadlockResult();
            }
            else{
                include 'view/home.php';
            }
            ?>
        </div>
    </div>
<?php endif; ?>

<?php if ($page != 'login'): ?>
<footer class="py-5 text-center bg-light border-top">
    <p class="text-muted small">© 2026 Trendify. Built for Pemrosesan Data Terdistribusi.</p>
</footer>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>