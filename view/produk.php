<div class="product-page fade-in">
    <div class="mb-5">
        <h3 class="fw-bold text-uppercase mb-1" style="letter-spacing: 3px; color: #222;">Trendify Collection</h3>
        <p class="text-muted small">Elevate your style with Trendify's finest selection.</p>
    </div>

    <div class="row g-4">
    <?php
    if (!empty($data_produk)) {
        foreach ($data_produk as $row) {
            $nama_file = !empty($row['gambar']) ? $row['gambar'] : '';
            $path_gambar = "assets/img/" . $nama_file;
    ?>
        <div class="col-6 col-md-4 col-lg-3">
            <div class="product-card">
                <div class="product-img-wrapper">
                    <?php if (!empty($nama_file) && file_exists($path_gambar)): ?>
                        <img src="<?= $path_gambar; ?>" class="product-img" alt="<?= htmlspecialchars($row['nama_produk']); ?>">
                    <?php else: ?>
                        <div class="img-placeholder">
                            <i class="bi bi-image text-muted opacity-50" style="font-size: 2rem;"></i>
                            <span class="d-block mt-2" style="font-size: 0.6rem; font-weight: 800;">NO IMAGE</span>
                        </div>
                    <?php endif; ?>
                    
                    <div class="stock-badge <?= $row['stok'] > 0 ? 'bg-dark' : 'bg-danger'; ?>">
                        <?= $row['stok'] > 0 ? 'STOK: ' . $row['stok'] : 'SOLD OUT'; ?>
                    </div>
                </div>

                <div class="product-info-box">
                    <span class="category-tag"><?= htmlspecialchars($row['kategori'] ?? 'Fashion'); ?></span>
                    
                    <h6 class="product-name text-truncate" title="<?= htmlspecialchars($row['nama_produk']); ?>">
                        <?= htmlspecialchars($row['nama_produk'] ?? 'Tanpa Nama'); ?>
                    </h6>
                    
                    <p class="product-price">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></p>

                    <form method="post" action="?page=tambah-keranjang">
                        <input type="hidden" name="id_produk" value="<?= $row['id_produk']; ?>">
                        <button type="submit" class="btn-add-to-cart" <?= $row['stok'] <= 0 ? 'disabled' : ''; ?>>
                            <?= $row['stok'] > 0 ? 'Add to Cart' : 'Out of Stock'; ?>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    <?php
        }
    } else {
        echo '<div class="col-12 text-center py-5"><p class="text-muted small">Produk tidak ditemukan.</p></div>';
    }
    ?>
    </div>

    <div class="mt-5 pt-5 border-top">
        <h5 class="fw-bold text-uppercase mb-4" style="letter-spacing: 2px; font-size: 1.1rem;">Recommended For You</h5>
        <div class="row g-3">
        <?php
        if (!empty($data_union)) {
            foreach ($data_union as $row) {
        ?>
            <div class="col-md-4">
                <div class="recommend-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-bold mb-0" style="font-size: 0.9rem;"><?= htmlspecialchars($row['nama']); ?></h6>
                            <small class="text-purple fw-bold">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></small>
                        </div>
                        <span class="badge bg-purple-soft text-purple" style="font-size: 0.6rem;">NEW</span>
                    </div>
                </div>
            </div>
        <?php
            }
        }
        ?>
        </div>
    </div>

    <div class="mt-5 mb-5">
        </div>
    </div>
</div>

<style>
    .product-card {
        background: #fff;
        border: 1px solid #eee;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.08);
        border-color: #c187db;
    }

    .product-img-wrapper {
        position: relative;
        width: 100%;
        height: 280px;
        background: #f9fafb;
        overflow: hidden;
    }

    .product-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .product-card:hover .product-img {
        transform: scale(1.08);
    }

    .img-placeholder {
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: #f3f4f6;
    }

    .stock-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        padding: 4px 12px;
        border-radius: 6px;
        font-size: 0.65rem;
        font-weight: 800;
        color: #fff;
    }

    .product-info-box {
        padding: 20px;
        text-align: center;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .category-tag {
        font-size: 0.65rem;
        font-weight: 700;
        color: #c187db;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .product-name {
        font-weight: 700;
        margin: 8px 0;
        color: #222;
        font-size: 0.95rem;
    }

    .product-price {
        font-weight: 800;
        color: #111;
        font-size: 1.05rem;
        margin-bottom: 15px;
    }

    .btn-add-to-cart {
        width: 100%;
        background: #222;
        color: #fff;
        border: none;
        padding: 12px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.8rem;
        transition: 0.3s;
    }

    .btn-add-to-cart:hover:not(:disabled) {
        background: #c187db;
    }

    .btn-add-to-cart:disabled {
        background: #ddd;
        cursor: not-allowed;
    }

    .recommend-card {
        background: #fff;
        border: 1px solid #eee;
        border-radius: 12px;
        padding: 15px;
        transition: 0.3s;
    }
    .recommend-card:hover { border-color: #c187db; background: #f9fafb; }
    .border-dashed { border-style: dashed; }
    .bg-purple-soft { background: #f3ebf7; }
    .text-purple { color: #c187db; }

    .fade-in { animation: fadeIn 0.6s ease-out; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

    @media (max-width: 768px) {
        .product-img-wrapper { height: 200px; }
    }
</style>