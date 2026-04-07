<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

<div class="checkout-page">
    <div class="checkout-shell">
        <div class="checkout-hero">
            <div class="checkout-hero-text">
                <h2 class="checkout-title">Checkout</h2>
                <p class="checkout-subtitle">
                    Konfirmasi pesanan, alamat pengiriman, dan metode pembayaran.
                </p>
            </div>
            <div class="checkout-badge">
                Secure Payment
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="checkout-card">
                    <div class="checkout-card-header">
                        <h5 class="mb-0">Ringkasan Pesanan</h5>
                    </div>

                    <div class="checkout-card-body p-0">
                        <div class="order-head d-none d-md-grid">
                            <div>Produk</div>
                            <div class="text-center">Qty</div>
                            <div class="text-end">Harga</div>
                            <div class="text-end">Subtotal</div>
                        </div>

                        <?php foreach ($items as $item): ?>
                            <div class="order-row">
                                <div class="order-grid">
                                    <!-- Produk -->
                                    <div class="product-col">
                                        <div class="product-box">
                                            <div class="product-thumb-box">
                                                🛍️
                                            </div>
                                            <div class="product-info">
                                                <div class="product-name">
                                                    <?= htmlspecialchars($item['nama']); ?>
                                                </div>
                                                <div class="product-meta">
                                                    Trendify Product
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Jumlah -->
                                    <div class="qty-col text-md-center">
                                        <div class="mobile-label d-md-none">Qty</div>
                                        <span class="qty-pill"><?= $item['jumlah']; ?></span>
                                    </div>

                                    <!-- Harga -->
                                    <div class="price-col text-md-end">
                                        <div class="mobile-label d-md-none">Harga</div>
                                        <div class="price-text">
                                            Rp <?= number_format($item['harga'], 0, ',', '.'); ?>
                                        </div>
                                    </div>

                                    <!-- Subtotal -->
                                    <div class="subtotal-col text-md-end">
                                        <div class="mobile-label d-md-none">Subtotal</div>
                                        <div class="subtotal-text">
                                            Rp <?= number_format($item['subtotal'], 0, ',', '.'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <!-- Summary -->
                        <div class="summary-box">
                            <div class="summary-line">
                                <span>Subtotal Pesanan</span>
                                <strong>Rp <?= number_format($grandTotal, 0, ',', '.'); ?></strong>
                            </div>

                            <div class="summary-line">
                                <span>Biaya Layanan</span>
                                <strong>Rp 0</strong>
                            </div>

                            <div class="summary-line">
                                <span>Ongkir</span>
                                <strong>Rp 0</strong>
                            </div>

                            <div class="summary-divider"></div>

                            <div class="summary-total">
                                <span>Total Bayar</span>
                                <span class="summary-total-price">
                                    Rp <?= number_format($grandTotal, 0, ',', '.'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="checkout-card mb-4">
                    <div class="checkout-card-body">
                        <div class="section-head">
                            <div class="section-icon">📍</div>
                            <div>
                                <h5 class="section-title">Informasi Pengiriman</h5>
                                <p class="section-subtitle">Alamat terbaru dari akun kamu</p>
                            </div>
                        </div>

                        <div class="field-group">
                            <label class="checkout-label">Nama Penerima</label>
                            <input
                                type="text"
                                class="form-control checkout-input"
                                value="<?= htmlspecialchars($userData['nama']); ?>"
                                readonly
                            >
                        </div>

                        <div class="field-group">
                            <label class="checkout-label">Email</label>
                            <input
                                type="text"
                                class="form-control checkout-input"
                                value="<?= htmlspecialchars($userData['email']); ?>"
                                readonly
                            >
                        </div>

                        <div class="field-group mb-0">
                            <label class="checkout-label">Alamat</label>
                            <textarea
                                class="form-control checkout-input checkout-textarea"
                                rows="4"
                                readonly
                            ><?= htmlspecialchars($userData['alamat'] ?? 'Alamat belum tersedia'); ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- Payment -->
                <div class="checkout-card">
                    <div class="checkout-card-body">
                        <div class="section-head">
                            <div class="section-icon">💳</div>
                            <div>
                                <h5 class="section-title">Metode Pembayaran</h5>
                                <p class="section-subtitle">Pilih metode pembayaran yang tersedia</p>
                            </div>
                        </div>

                        <form method="POST" action="?page=proses-bayar">
                            <label class="payment-option">
                                <input type="radio" name="metode_pembayaran" value="Transfer Bank" checked>
                                <div class="payment-text">
                                    <div class="payment-title">Transfer Bank</div>
                                    <div class="payment-desc">BCA / BNI / BRI / Mandiri</div>
                                </div>
                            </label>

                            <label class="payment-option">
                                <input type="radio" name="metode_pembayaran" value="E-Wallet">
                                <div class="payment-text">
                                    <div class="payment-title">E-Wallet</div>
                                    <div class="payment-desc">OVO / DANA / GoPay / ShopeePay</div>
                                </div>
                            </label>

                            <label class="payment-option mb-4">
                                <input type="radio" name="metode_pembayaran" value="Cash on Delivery">
                                <div class="payment-text">
                                    <div class="payment-title">Cash on Delivery</div>
                                    <div class="payment-desc">Bayar saat barang diterima</div>
                                </div>
                            </label>

                            <div class="deadlock-switch-box mb-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="fw-semibold">Deadlock Simulation</div>
                                        <div class="small text-muted">
                                            ON: simulasi konflik 2 user. OFF: checkout normal.
                                        </div>
                                    </div>

                                    <label class="switch-deadlock">
                                        <input type="checkbox" name="deadlock_mode" value="1" id="deadlockToggle">
                                        <span class="slider-deadlock"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="payment-summary">
                                <div class="payment-summary-label">Pembayaran aman</div>
                                <div class="payment-summary-total">
                                    Total tagihan: Rp <?= number_format($grandTotal, 0, ',', '.'); ?>
                                </div>
                            </div>

                            <div class="checkout-actions">
                                <button type="submit" class="btn checkout-pay-btn">
                                    Bayar Sekarang
                                </button>

                                <a href="?page=keranjang" class="btn checkout-back-btn">
                                    Kembali ke Keranjang
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --primary: #8B5CF6;
    --primary-2: #A78BFA;
    --primary-soft: #F5F3FF;
    --primary-soft-2: #EDE9FE;
    --border: #E5E7EB;
    --border-soft: #E9E2F7;
    --bg: #F9FAFB;
    --white: #FFFFFF;
    --text: #111111;
    --muted: #6B7280;
    --muted-light: #9CA3AF;
    --shadow-soft: 0 10px 30px rgba(17, 17, 17, 0.05);
    --shadow-card: 0 14px 32px rgba(139, 92, 246, 0.06);
}

body {
    background: var(--bg);
    font-family: 'Inter', sans-serif;
    color: var(--text);
}

.checkout-page {
    padding: 14px 0 34px;
}

.checkout-shell {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 28px;
    padding: 26px;
    box-shadow: var(--shadow-soft);
}

.checkout-hero {
    background:
        radial-gradient(circle at 5% 10%, #edddf3 0%, rgba(255,255,255,0) 30%),
        radial-gradient(circle at 80% 80%, #bb90d2 0%, rgba(255,255,255,0) 40%),
        radial-gradient(circle at 90% 40%, #e7e6ee 0%, rgba(255,255,255,0) 40%);
    border-radius: 30px;
    padding: 40px 44px;
    margin-bottom: 28px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 18px;
    flex-wrap: wrap;
}

.checkout-title {
    font-size: 3.9rem;
    font-weight: 900;
    letter-spacing: -2px;
    line-height: 1.05;
    margin-bottom: 12px;
    background: linear-gradient(135deg, #111111, #6B7280);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 0 4px 20px rgba(0,0,0,0.05);
}

.checkout-subtitle {
    font-size: 1.02rem;
    color: #7C4D9E;
    margin: 0;
    font-weight: 500;
    line-height: 1.8;
    max-width: 620px;
}

.checkout-badge {
    background: #F4F0FB;
    color: var(--primary);
    border: 1px solid #E7DDFC;
    padding: 12px 18px;
    border-radius: 999px;
    font-size: 0.88rem;
    font-weight: 700;
    letter-spacing: 0.2px;
    box-shadow: 0 8px 18px rgba(139, 92, 246, 0.06);
}

.checkout-card {
    background: linear-gradient(180deg, #FFFFFF 0%, #FCFBFF 100%);
    border: 1px solid var(--border-soft);
    border-radius: 26px;
    box-shadow: var(--shadow-card);
    overflow: hidden;
    height: 100%;
}

.checkout-card-header {
    padding: 22px 26px;
    background: #F3EFFB;
    color: #111111;
    border-bottom: 1px solid var(--border);
}

.checkout-card-header h5 {
    font-weight: 800;
    font-size: 1.22rem;
    margin: 0;
    letter-spacing: -0.3px;
}

.checkout-card-body {
    padding: 26px;
}

.order-head {
    display: grid;
    grid-template-columns: 1.8fr 0.6fr 0.8fr 0.9fr;
    gap: 18px;
    align-items: center;
    padding: 18px 26px;
    background: #FAF8FE;
    border-bottom: 1px solid #F0EBFA;
    color: #6B7280;
    font-size: 0.94rem;
    font-weight: 700;
}

.order-row {
    padding: 22px 26px;
    border-bottom: 1px solid #F1EDF8;
    transition: background 0.2s ease;
}

.order-row:hover {
    background: #FDFCFF;
}

.order-grid {
    display: grid;
    grid-template-columns: 1.8fr 0.6fr 0.8fr 0.9fr;
    gap: 18px;
    align-items: center;
}

.product-box {
    display: flex;
    align-items: center;
    gap: 16px;
}

.product-thumb-box {
    width: 66px;
    height: 66px;
    border-radius: 22px;
    background: linear-gradient(145deg, #EDE9FE, #DDD6FE);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.35rem;
    color: var(--primary);
    flex-shrink: 0;
    box-shadow:
        inset 0 1px 0 rgba(255,255,255,0.85),
        0 10px 20px rgba(139, 92, 246, 0.12);
}

.product-info {
    min-width: 0;
}

.product-name {
    font-size: 1.05rem;
    font-weight: 700;
    color: #111111;
    line-height: 1.4;
    margin-bottom: 5px;
    letter-spacing: -0.2px;
}

.product-meta {
    font-size: 0.9rem;
    color: #8A8FA3;
}

.qty-pill {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 46px;
    height: 38px;
    border-radius: 999px;
    background: #F4F0FB;
    color: var(--primary);
    font-weight: 800;
    border: 1px solid #E7DDFC;
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.7);
}

.price-text {
    font-size: 0.98rem;
    font-weight: 600;
    color: #6B7280;
}

.subtotal-text {
    font-size: 1rem;
    font-weight: 800;
    color: #111111;
}

.mobile-label {
    font-size: 0.78rem;
    color: #9CA3AF;
    margin-bottom: 6px;
    text-transform: uppercase;
    font-weight: 700;
    letter-spacing: 0.45px;
}

.summary-box {
    padding: 26px 28px 30px;
    background: #FCFBFF;
}

.summary-line {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    margin-bottom: 13px;
}

.summary-line span:first-child {
    font-size: 1rem;
    color: #6B7280;
}

.summary-line strong {
    font-size: 1rem;
    font-weight: 700;
    color: #111111;
}

.summary-divider {
    height: 1px;
    background: #E5E7EB;
    margin: 18px 0;
}

.summary-total {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
}

.summary-total span:first-child {
    font-size: 1.28rem;
    font-weight: 800;
    color: #111111;
    letter-spacing: -0.3px;
}

.summary-total-price {
    font-size: 2.15rem;
    font-weight: 900;
    color: var(--primary);
    letter-spacing: -1px;
}

.section-head {
    display: flex;
    align-items: center;
    margin-bottom: 24px;
}

.section-icon {
    width: 54px;
    height: 54px;
    border-radius: 18px;
    margin-right: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.18rem;
    background: linear-gradient(145deg, #EDE9FE, #DDD6FE);
    color: var(--primary);
    box-shadow:
        inset 0 1px 0 rgba(255,255,255,0.8),
        0 8px 20px rgba(139, 92, 246, 0.12);
}

.section-title {
    font-size: 1.12rem;
    font-weight: 800;
    color: #111111;
    margin: 0 0 5px;
    letter-spacing: -0.2px;
}

.section-subtitle {
    color: #8A8FA3;
    margin: 0;
    font-size: 0.93rem;
    line-height: 1.6;
}

.field-group {
    margin-bottom: 18px;
}

.checkout-label {
    font-size: 0.82rem;
    font-weight: 700;
    color: #6B7280;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 10px;
    display: block;
}

.checkout-input {
    border-radius: 18px;
    border: 1px solid #DDD6FE;
    padding: 15px 16px;
    background: #fff;
    color: #111111;
    font-weight: 500;
    resize: none;
    min-height: 56px;
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.6);
}

.checkout-input:focus {
    box-shadow: 0 0 0 4px var(--primary-soft);
    border-color: var(--primary);
}

.checkout-textarea {
    min-height: 124px;
    line-height: 1.7;
}

.payment-option {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    padding: 18px 18px;
    border: 1px solid #E7DDFC;
    border-radius: 20px;
    margin-bottom: 14px;
    cursor: pointer;
    transition: all 0.22s ease;
    background: #fff;
}

.payment-option:hover {
    border-color: #C4B5FD;
    background: #FCFBFF;
    box-shadow: 0 8px 18px rgba(139, 92, 246, 0.06);
}

.payment-option input[type="radio"] {
    accent-color: var(--primary);
    transform: scale(1.06);
    margin-top: 4px;
}

.payment-text {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.payment-title {
    font-weight: 700;
    color: #111111;
    font-size: 1.03rem;
}

.payment-desc {
    font-size: 0.93rem;
    color: #8A8FA3;
    line-height: 1.6;
}

.payment-summary {
    background: #F9F7FD;
    border-radius: 20px;
    padding: 18px 18px;
    margin-bottom: 20px;
    border: 1px solid #ECE7F5;
}

.payment-summary-label {
    font-size: 0.88rem;
    color: #8A8FA3;
    margin-bottom: 7px;
}

.payment-summary-total {
    font-weight: 800;
    color: #111111;
    font-size: 1.08rem;
}

.checkout-actions {
    display: flex;
    gap: 14px;
    flex-wrap: wrap;
}

.checkout-pay-btn {
    background: linear-gradient(135deg, #8B5CF6, #A78BFA) !important;
    color: #fff !important;
    border: none !important;
    padding: 15px 24px !important;
    border-radius: 20px !important;
    font-weight: 800 !important;
    transition: 0.22s ease;
    box-shadow: 0 14px 28px rgba(139, 92, 246, 0.22);
    min-width: 220px;
    letter-spacing: -0.2px;
}

.checkout-pay-btn:hover {
    background: linear-gradient(135deg, #7C3AED, #8B5CF6) !important;
    color: #fff !important;
    transform: translateY(-2px);
}

.checkout-back-btn {
    background: #fff !important;
    border: 1px solid #E5E7EB !important;
    color: #374151 !important;
    padding: 15px 24px !important;
    border-radius: 20px !important;
    font-weight: 700 !important;
    transition: 0.22s ease;
    min-width: 220px;
    letter-spacing: -0.2px;
}

.checkout-back-btn:hover {
    background: #F9FAFB !important;
    color: #111827 !important;
}

.deadlock-switch-box {
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    padding: 16px 18px;
    background: #fff7ed;
}

.switch-deadlock {
    position: relative;
    display: inline-block;
    width: 56px;
    height: 30px;
}

.switch-deadlock input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider-deadlock {
    position: absolute;
    cursor: pointer;
    inset: 0;
    background-color: #d1d5db;
    transition: .3s;
    border-radius: 999px;
}

.slider-deadlock:before {
    position: absolute;
    content: "";
    height: 22px;
    width: 22px;
    left: 4px;
    top: 4px;
    background-color: white;
    transition: .3s;
    border-radius: 50%;
}

.switch-deadlock input:checked + .slider-deadlock {
    background-color: #ef4444;
}

.switch-deadlock input:checked + .slider-deadlock:before {
    transform: translateX(26px);
}

@media (max-width: 991px) {
    .checkout-title {
        font-size: 2.9rem;
    }
}

@media (max-width: 767px) {
    .checkout-shell {
        padding: 16px;
        border-radius: 18px;
    }

    .checkout-hero {
        padding: 24px;
        border-radius: 22px;
    }

    .checkout-title {
        font-size: 2.2rem;
    }

    .checkout-card-body,
    .checkout-card-header,
    .order-row,
    .summary-box {
        padding-left: 18px;
        padding-right: 18px;
    }

    .order-head {
        display: none !important;
    }

    .order-grid {
        grid-template-columns: 1fr;
        gap: 14px;
    }

    .qty-col,
    .price-col,
    .subtotal-col {
        padding-left: 82px;
    }

    .product-thumb-box {
        width: 56px;
        height: 56px;
        border-radius: 18px;
    }

    .summary-total-price {
        font-size: 1.65rem;
    }

    .checkout-actions {
        flex-direction: column;
    }

    .checkout-pay-btn,
    .checkout-back-btn {
        width: 100%;
        min-width: unset;
    }
}
</style>