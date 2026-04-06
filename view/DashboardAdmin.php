<?php
if ($_SESSION['user']['role'] != 'admin') {
    echo "Akses ditolak!";
    exit;
}
?>

<div class="container mt-4">
    <h3 class="mb-4 fw-bold">Admin Dashboard</h3>

    <div class="row">

        <div class="col-md-4">
            <div class="card shadow-sm p-4 text-center">
                <h6>Total Produk</h6>
                <h2><?= $totalProduk ?></h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-4 text-center">
                <h6>Total User</h6>
                <h2><?= $totalUser ?></h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-4 text-center">
                <h6>Total Transaksi</h6>
                <h2><?= $totalTransaksi ?></h2>
            </div>
        </div>

    </div>
</div>