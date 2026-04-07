<div class="checkout-success-page fade-in">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-10">
                <div class="success-card-main">
                    
                    <div class="success-icon-container">
                        <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="40" cy="40" r="40" fill="#F0FDF4"/>
                            <path d="M56 28L34 50L24 40" stroke="#16A34A" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>

                    <div class="text-center">
                        <h2 class="success-title">Payment Successful</h2>
                        <p class="success-subtitle">Pesanan kamu sudah kami terima dan sedang diproses oleh sistem.</p>
                    </div>

                    <div class="detail-outer-box">
                        <div class="detail-line">
                            <span class="label">Metode Pembayaran</span>
                            <span class="value">Transfer Bank</span>
                        </div>
                        <div class="detail-line">
                            <span class="label">Status Transaksi</span>
                            <span class="value-status">SUCCESS</span>
                        </div>
                    </div>

                    <div class="button-stack">
                        <a href="?page=tracking&id=<?= $_GET['id'] ?? ''; ?>" class="btn-trendify-primary" style="background: #c187db;">Lacak Pesanan Sekarang</a>
                        
                        <a href="?page=riwayat" class="btn-trendify-primary">Lihat Riwayat Belanja</a>
                        <a href="?page=produk" class="btn-trendify-secondary">Lanjut Belanja</a>
                    </div>

                    <div class="text-center mt-4">
                        <a href="?page=home" class="btn-link-home">Kembali ke Beranda</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root { --t-purple: #c187db; --t-dark: #222222; --t-border: #f0f0f0; }
    .checkout-success-page { padding: 80px 0; background-color: #fcfcfc; min-height: 90vh; }
    .success-card-main { background: #ffffff; border-radius: 24px; padding: 50px 40px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.03); border: 1px solid var(--t-border); }
    .success-icon-container { display: flex; justify-content: center; margin-bottom: 25px; }
    .success-title { font-weight: 800; color: var(--t-dark); margin-bottom: 8px; letter-spacing: -0.5px; }
    .success-subtitle { color: #777; font-size: 0.95rem; margin-bottom: 35px; }
    .detail-outer-box { background: #ffffff; border: 1px solid var(--t-border); border-radius: 16px; padding: 25px; margin-bottom: 35px; }
    .detail-line { display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 0.9rem; }
    .detail-line .label { color: #999; }
    .detail-line .value { font-weight: 700; color: var(--t-dark); }
    .value-status { color: #16a34a; font-weight: 800; font-size: 0.85rem; }
    .button-stack { display: flex; flex-direction: column; gap: 12px; }
    .btn-trendify-primary { background: var(--t-dark); color: #fff; padding: 16px; border-radius: 14px; font-weight: 700; text-decoration: none; text-align: center; transition: 0.3s; }
    .btn-trendify-secondary { background: #fff; color: var(--t-dark); padding: 16px; border-radius: 14px; font-weight: 700; border: 1px solid #ddd; text-decoration: none; text-align: center; transition: 0.3s; }
    .btn-trendify-primary:hover { opacity: 0.9; color: #fff; }
    .btn-link-home { color: var(--t-purple); text-decoration: none; font-weight: 600; font-size: 0.9rem; }
    .fade-in { animation: fadeInData 0.8s ease; }
    @keyframes fadeInData { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
</style>