<h3 class="mb-4 fw-bold text-uppercase" style="letter-spacing: 2px;">Product</h3>

<div class="row">
<?php
if (!empty($data_produk)) {
    foreach ($data_produk as $row) {
?>
    <div class="col-md-3">
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-body text-center">
                <h6 class="fw-bold"><?= $row['nama_produk']; ?></h6>
                <p class="text-muted small mb-1">Kategori: <?= $row['kategori']; ?></p>
                <p class="text-muted small mb-3">Stok: <?= $row['stok']; ?></p>
                <p style="color: var(--primary-color); font-weight: 600;">
                    Rp <?= number_format($row['harga'], 0, ',', '.'); ?>
                </p>

                <form method="post" action="?page=tambah-keranjang">
                    <input type="hidden" name="id_produk" value="<?= $row['id_produk']; ?>">
                    <button class="btn btn-dark btn-sm rounded-0 w-100">Tambah ke Keranjang</button>
                </form>
            </div>
        </div>
    </div>
<?php
    }
}
?>
</div>

<hr class="my-5">

<h3 class="fw-bold text-uppercase mb-2" style="letter-spacing: 2px;">Rekomendasi Produk</h3>

<div class="row">
<?php
if (!empty($data_union)) {
    foreach ($data_union as $row) {
?>
    <div class="col-md-4">
        <div class="card p-3 mb-3 shadow-sm border-0 text-center">
            <h6 class="fw-bold"><?= $row['nama']; ?></h6>
            <p class="text-muted small mb-0">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></p>
        </div>
    </div>
<?php
    }
}
?>
</div>

<hr class="my-5">
</div>