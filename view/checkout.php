<div class="checkout-page">
    <div class="checkout-header d-flex justify-content-between align-items-center flex-wrap mb-4">
        <div>
            <h2 class="checkout-title">Checkout</h2>
            <p class="checkout-subtitle">Konfirmasi pesanan, alamat pengiriman, dan metode pembayaran.</p>
        </div>
        <div class="checkout-badge mt-2 mt-md-0">
            Secure Payment
        </div>
    </div>

    <div class="row g-4">
        <!-- LEFT CONTENT -->
        <div class="col-lg-8">
            <div class="checkout-card">
                <div class="checkout-card-header">
                    <h5 class="mb-0">Ringkasan Pesanan</h5>
                </div>

                <div class="checkout-card-body p-0">
                    <div class="checkout-table-head">
                        <div class="row fw-semibold small text-muted">
                            <div class="col-5">Produk</div>
                            <div class="col-2 text-center">Qty</div>
                            <div class="col-2 text-end">Harga</div>
                            <div class="col-3 text-end">Subtotal</div>
                        </div>
                    </div>

                    <?php foreach ($items as $item): ?>
                        <div class="checkout-item-row">
                            <div class="row align-items-center">
                                <div class="col-5">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="product-icon-box">
                                            🛍️
                                        </div>
                                        <div>
                                            <div class="fw-semibold"><?= htmlspecialchars($item['nama']); ?></div>
                                            <div class="small text-muted">Trendify Product</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-2 text-center">
                                    <span class="qty-badge"><?= $item['jumlah']; ?></span>
                                </div>

                                <div class="col-2 text-end text-muted">
                                    Rp <?= number_format($item['harga'], 0, ',', '.'); ?>
                                </div>

                                <div class="col-3 text-end fw-bold">
                                    Rp <?= number_format($item['subtotal'], 0, ',', '.'); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div class="checkout-total-box">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal Pesanan</span>
                            <span class="fw-medium">Rp <?= number_format($grandTotal, 0, ',', '.'); ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Biaya Layanan</span>
                            <span class="fw-medium">Rp 0</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Ongkir</span>
                            <span class="fw-medium">Rp 0</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold fs-5">Total Bayar</span>
                            <span class="checkout-total-price">
                                Rp <?= number_format($grandTotal, 0, ',', '.'); ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT CONTENT -->
        <div class="col-lg-4">
            <div class="checkout-card mb-4">
                <div class="checkout-card-body">
                    <div class="section-heading">
                        <div class="section-icon shipping-icon">📍</div>
                        <div>
                            <h5 class="mb-0 fw-bold">Informasi Pengiriman</h5>
                            <small class="text-muted">Alamat terbaru dari akun kamu</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label checkout-label">Nama Penerima</label>
                        <input type="text" class="form-control checkout-input" value="<?= htmlspecialchars($userData['nama']); ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label checkout-label">Email</label>
                        <input type="text" class="form-control checkout-input" value="<?= htmlspecialchars($userData['email']); ?>" readonly>
                    </div>

                    <div class="mb-0">
                        <label class="form-label checkout-label">Alamat</label>
                        <textarea class="form-control checkout-input" rows="4" readonly><?= htmlspecialchars($userData['alamat'] ?? 'Alamat belum tersedia'); ?></textarea>
                    </div>
                </div>
            </div>

            <div class="checkout-card">
                <div class="checkout-card-body">
                    <div class="section-heading">
                        <div class="section-icon payment-icon">💳</div>
                        <div>
                            <h5 class="mb-0 fw-bold">Metode Pembayaran</h5>
                            <small class="text-muted">Pilih metode pembayaran yang tersedia</small>
                        </div>
                    </div>

                    <form method="POST" action="?page=proses-bayar">
                        <label class="payment-card">
                            <input class="form-check-input mt-1" type="radio" name="metode_pembayaran" value="Transfer Bank" checked>
                            <div>
                                <div class="fw-semibold">Transfer Bank</div>
                                <div class="small text-muted">BCA / BNI / BRI / Mandiri</div>
                            </div>
                        </label>

                        <label class="payment-card">
                            <input class="form-check-input mt-1" type="radio" name="metode_pembayaran" value="E-Wallet">
                            <div>
                                <div class="fw-semibold">E-Wallet</div>
                                <div class="small text-muted">OVO / DANA / GoPay / ShopeePay</div>
                            </div>
                        </label>

                        <label class="payment-card mb-4">
                            <input class="form-check-input mt-1" type="radio" name="metode_pembayaran" value="Cash on Delivery">
                            <div>
                                <div class="fw-semibold">Cash on Delivery</div>
                                <div class="small text-muted">Bayar saat barang diterima</div>
                            </div>
                        </label>

                        <div class="payment-summary-box">
                            <div class="small text-muted mb-1">Pembayaran aman</div>
                            <div class="fw-semibold">
                                Total tagihan: Rp <?= number_format($grandTotal, 0, ',', '.'); ?>
                            </div>
                        </div>

                        <button type="submit" class="btn checkout-pay-btn w-100">
                            Bayar Sekarang
                        </button>

                        <a href="?page=keranjang" class="btn checkout-back-btn w-100 mt-3">
                            Kembali ke Keranjang
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.checkout-page {
    padding: 10px 0 30px;
}

.checkout-title {
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 6px;
    color: #111827;
}

.checkout-subtitle {
    color: #6b7280;
    margin-bottom: 0;
}

.checkout-badge {
    background: rgba(167, 73, 255, 0.10);
    color: #a749ff;
    border: 1px solid rgba(167, 73, 255, 0.15);
    padding: 10px 18px;
    border-radius: 999px;
    font-size: 0.85rem;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.checkout-card {
    background: #fff;
    border: none;
    border-radius: 20px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
    overflow: hidden;
}

.checkout-card-header {
    padding: 20px 24px;
    background: linear-gradient(135deg, #111827, #374151);
    color: #fff;
}

.checkout-card-body {
    padding: 24px;
}

.checkout-table-head {
    padding: 18px 24px;
    background: #fafafa;
    border-bottom: 1px solid #f0f0f0;
}

.checkout-item-row {
    padding: 22px 24px;
    border-bottom: 1px solid #f3f4f6;
}

.product-icon-box {
    width: 58px;
    height: 58px;
    border-radius: 16px;
    background: #f5f5f7;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
}

.qty-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 42px;
    height: 34px;
    border-radius: 999px;
    background: #f3f4f6;
    color: #111827;
    font-weight: 600;
}

.checkout-total-box {
    padding: 24px;
    background: #fcfcfc;
}

.checkout-total-price {
    font-size: 1.6rem;
    font-weight: 700;
    color: #16a34a;
}

.section-heading {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.section-icon {
    width: 46px;
    height: 46px;
    border-radius: 50%;
    margin-right: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
}

.shipping-icon {
    background: #ede9fe;
    color: #7c3aed;
}

.payment-icon {
    background: #dcfce7;
    color: #16a34a;
}

.checkout-label {
    font-size: 0.8rem;
    font-weight: 600;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.checkout-input {
    border-radius: 14px;
    border: 1px solid #e5e7eb;
    padding: 12px 14px;
    background: #fff;
}

.checkout-input:focus {
    box-shadow: 0 0 0 0.2rem rgba(167, 73, 255, 0.15);
    border-color: #c084fc;
}

.payment-card {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 16px 18px;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    margin-bottom: 14px;
    cursor: pointer;
    transition: all 0.2s ease;
    background: #fff;
}

.payment-card:hover {
    border-color: rgba(167, 73, 255, 0.35);
    background: #faf5ff;
}

.payment-summary-box {
    background: #f9fafb;
    border-radius: 16px;
    padding: 16px 18px;
    margin-bottom: 18px;
    border: 1px solid #f3f4f6;
}

.checkout-pay-btn {
    background: linear-gradient(135deg, #16a34a, #15803d);
    color: #fff;
    border: none;
    padding: 14px 18px;
    border-radius: 16px;
    font-weight: 600;
    transition: 0.2s ease;
}

.checkout-pay-btn:hover {
    background: linear-gradient(135deg, #15803d, #166534);
    color: #fff;
    transform: translateY(-1px);
}

.checkout-back-btn {
    background: #fff;
    border: 1px solid #e5e7eb;
    color: #374151;
    padding: 14px 18px;
    border-radius: 16px;
    font-weight: 600;
    transition: 0.2s ease;
}

.checkout-back-btn:hover {
    background: #f9fafb;
    color: #111827;
}

@media (max-width: 768px) {
    .checkout-title {
        font-size: 1.6rem;
    }

    .checkout-card-body,
    .checkout-card-header,
    .checkout-item-row,
    .checkout-table-head,
    .checkout-total-box {
        padding-left: 18px;
        padding-right: 18px;
    }

    .product-icon-box {
        width: 48px;
        height: 48px;
        font-size: 1rem;
    }

    .checkout-total-price {
        font-size: 1.3rem;
    }
}
</style>