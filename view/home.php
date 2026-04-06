<header class="hero">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-1 hero-content">
                <h4>Smart Choice</h4>
                <h1>Trendify <br> Fashion 2026</h1>
                <p class="text-muted mb-4">Discover the best distributed fashion management system.</p>
                <a href="?page=produk" class="btn btn-shop">SHOP NOW</a>
            </div>
        </div>
    </div>
</header>

<?php if ($_SESSION['user']['role'] == 'admin'): ?>

<div class="container mt-5">
    <h3 class="fw-bold mb-4">Admin Dashboard</h3>

    <div class="row">

        <!-- PRODUK -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 p-4 text-center">
                <h6>Total Produk</h6>
                <h2><?= $totalProduk ?? 0 ?></h2>
            </div>
        </div>

        <!-- USER -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 p-4 text-center">
                <h6>Total User</h6>
                <h2><?= $totalUser ?? 0 ?></h2>
            </div>
        </div>

        <!-- TRANSAKSI -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 p-4 text-center">
                <h6>Total Transaksi</h6>
                <h2><?= $totalTransaksi ?? 0 ?></h2>
            </div>
        </div>

    </div>
</div>

<?php endif; ?>