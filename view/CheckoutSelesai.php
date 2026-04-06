<div class="checkout-success-page">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="success-card">
                <div class="success-hero">
                    <div class="success-icon-wrap">
                        <div class="success-icon">✓</div>
                    </div>
                    <h1 class="success-title">Pembayaran Berhasil</h1>
                    <p class="success-subtitle">
                        Pesanan kamu sudah berhasil diproses dan tersimpan ke database.
                    </p>
                </div>

                <div class="success-body">
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="info-box">
                                <div class="info-box-icon purple-box">🧾</div>
                                <div class="info-box-label">Status Pesanan</div>
                                <div class="info-box-value">Selesai</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="info-box">
                                <div class="info-box-icon green-box">💳</div>
                                <div class="info-box-label">Metode Pembayaran</div>
                                <div class="info-box-value"><?= htmlspecialchars($metode); ?></div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="info-box">
                                <div class="info-box-icon dark-box">🔒</div>
                                <div class="info-box-label">Status Database</div>
                                <div class="info-box-value text-success">COMMIT Berhasil</div>
                            </div>
                        </div>
                    </div>

                    <div class="success-message-box">
                        <h5 class="fw-bold mb-2">Transaksi Selesai</h5>
                        <p class="mb-0 text-muted">
                            Sistem telah menyimpan data pesanan ke tabel <strong>pesanan</strong>,
                            detail produk ke tabel <strong>detail_pesanan</strong>, memperbarui stok
                            produk, lalu menyelesaikan proses menggunakan <strong>COMMIT</strong>.
                        </p>
                    </div>

                    <div class="next-step-box">
                        <h6 class="fw-bold mb-3">Apa yang terjadi selanjutnya?</h6>
                        <ul class="next-step-list">
                            <li>Pesanan kamu sudah masuk ke halaman riwayat transaksi.</li>
                            <li>Item yang sudah dibayar telah otomatis dihapus dari keranjang.</li>
                            <li>Stok produk telah diperbarui sesuai jumlah pembelian.</li>
                        </ul>
                    </div>

                    <div class="action-buttons">
                        <a href="?page=riwayat" class="btn success-btn-dark">
                            Lihat Riwayat
                        </a>
                        <a href="?page=produk" class="btn success-btn-primary">
                            Belanja Lagi
                        </a>
                        <a href="?page=home" class="btn success-btn-light">
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.checkout-success-page {
    padding: 20px 0 40px;
}

.success-card {
    background: #fff;
    border: none;
    border-radius: 24px;
    box-shadow: 0 10px 35px rgba(0, 0, 0, 0.06);
    overflow: hidden;
}

.success-hero {
    background: linear-gradient(135deg, #111827, #374151);
    color: #fff;
    text-align: center;
    padding: 50px 30px 42px;
}

.success-icon-wrap {
    display: flex;
    justify-content: center;
    margin-bottom: 18px;
}

.success-icon {
    width: 82px;
    height: 82px;
    border-radius: 50%;
    background: linear-gradient(135deg, #16a34a, #15803d);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    font-weight: 700;
    box-shadow: 0 10px 25px rgba(22, 163, 74, 0.35);
}

.success-title {
    font-size: 2.3rem;
    font-weight: 700;
    margin-bottom: 10px;
    letter-spacing: 0.5px;
}

.success-subtitle {
    margin-bottom: 0;
    color: rgba(255, 255, 255, 0.82);
    font-size: 1rem;
}

.success-body {
    padding: 34px 34px 38px;
}

.info-box {
    background: #fff;
    border: 1px solid #eef0f3;
    border-radius: 20px;
    padding: 22px 20px;
    text-align: center;
    height: 100%;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.03);
}

.info-box-icon {
    width: 52px;
    height: 52px;
    margin: 0 auto 12px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.purple-box {
    background: #ede9fe;
    color: #7c3aed;
}

.green-box {
    background: #dcfce7;
    color: #16a34a;
}

.dark-box {
    background: #f3f4f6;
    color: #111827;
}

.info-box-label {
    font-size: 0.82rem;
    color: #6b7280;
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    font-weight: 600;
}

.info-box-value {
    font-size: 1rem;
    font-weight: 700;
    color: #111827;
    word-break: break-word;
}

.success-message-box {
    background: #faf5ff;
    border: 1px solid rgba(167, 73, 255, 0.12);
    border-radius: 20px;
    padding: 22px 24px;
    margin-bottom: 22px;
}

.success-message-box h5 {
    color: #7c3aed;
}

.next-step-box {
    background: #f9fafb;
    border: 1px solid #eef0f3;
    border-radius: 20px;
    padding: 22px 24px;
    margin-bottom: 28px;
}

.next-step-list {
    margin: 0;
    padding-left: 18px;
    color: #6b7280;
}

.next-step-list li {
    margin-bottom: 8px;
}

.next-step-list li:last-child {
    margin-bottom: 0;
}

.action-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    justify-content: center;
}

.success-btn-dark,
.success-btn-primary,
.success-btn-light {
    padding: 13px 22px;
    border-radius: 16px;
    font-weight: 600;
    min-width: 170px;
    transition: all 0.2s ease;
}

.success-btn-dark {
    background: #111827;
    color: #fff;
    border: none;
}

.success-btn-dark:hover {
    background: #1f2937;
    color: #fff;
}

.success-btn-primary {
    background: #a749ff;
    color: #fff;
    border: none;
}

.success-btn-primary:hover {
    background: #9333ea;
    color: #fff;
}

.success-btn-light {
    background: #fff;
    border: 1px solid #e5e7eb;
    color: #374151;
}

.success-btn-light:hover {
    background: #f9fafb;
    color: #111827;
}

@media (max-width: 768px) {
    .success-hero {
        padding: 40px 20px 34px;
    }

    .success-title {
        font-size: 1.75rem;
    }

    .success-body {
        padding: 24px 18px 28px;
    }

    .success-btn-dark,
    .success-btn-primary,
    .success-btn-light {
        width: 100%;
    }
}
</style>