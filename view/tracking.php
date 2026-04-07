<?php

$status_aktif = strtolower($data_detail['status'] ?? 'pending');
?>

<div class="container py-5 fade-in">
    <div class="d-flex align-items-center mb-4">
        <a href="?page=riwayat" class="text-dark me-3 text-decoration-none">
            <i class="bi bi-arrow-left fs-4"></i>
        </a>
        <div>
            <h4 class="fw-bold mb-0">Status Pengiriman</h4>
            <p class="text-muted small mb-0">Lacak lokasi paket pesananmu</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="bg-light p-3 border-bottom d-flex justify-content-between align-items-center">
            <span class="text-muted small fw-bold text-uppercase" style="letter-spacing: 1px;">Order ID</span>
            <span class="fw-bold" style="color: #c187db;">#TRD-<?= htmlspecialchars($_GET['id'] ?? '000'); ?></span>
        </div>

        <div class="card-body p-4 p-md-5">
            <div class="tracking-stepper-vertical">
                
                <div class="t-item active">
                    <div class="t-dot"></div>
                    <div class="t-content">
                        <h6 class="fw-bold mb-1">Pesanan Berhasil Dibuat</h6>
                        <p class="text-muted small mb-0">Pesanan telah diterima oleh sistem Trendify.</p>
                    </div>
                </div>

                <?php $is_dikemas = in_array($status_aktif, ['dikemas', 'perjalanan', 'dalam perjalanan', 'selesai']); ?>
                <div class="t-item <?= $is_dikemas ? 'active' : '' ?>">
                    <div class="t-dot"></div>
                    <div class="t-content">
                        <h6 class="fw-bold mb-1">Sedang Dikemas</h6>
                        <p class="text-muted small mb-0">Penjual sedang menyiapkan barangmu.</p>
                    </div>
                </div>

                <?php $is_perjalanan = (strpos($status_aktif, 'perjalanan') !== false || $status_aktif == 'selesai'); ?>
                <div class="t-item <?= $is_perjalanan ? 'active' : '' ?>">
                    <div class="t-dot"></div>
                    <div class="t-content">
                        <h6 class="fw-bold mb-1">Dalam Perjalanan</h6>
                        <p class="text-muted small mb-0">Paket sedang dalam perjalanan menuju lokasimu.</p>
                    </div>
                </div>

                <div class="t-item <?= ($status_aktif == 'selesai') ? 'active' : '' ?>">
                    <div class="t-dot"></div>
                    <div class="t-content">
                        <h6 class="fw-bold mb-1">Pesanan Selesai</h6>
                        <p class="text-muted small mb-0">Paket telah diterima. Terima kasih!</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .tracking-stepper-vertical { position: relative; padding-left: 35px; }
    .tracking-stepper-vertical::before {
        content: ''; position: absolute; left: 14px; top: 5px; bottom: 5px;
        width: 2px; background: #f0f0f0;
    }
    .t-item { position: relative; padding-bottom: 40px; }
    .t-item:last-child { padding-bottom: 0; }
    .t-dot {
        position: absolute; left: -26px; top: 5px;
        width: 14px; height: 14px; background: #e0e0e0;
        border-radius: 50%; border: 3px solid #fff; z-index: 2;
        transition: 0.3s;
    }
    .t-item.active .t-dot { 
        background: #c187db; 
        box-shadow: 0 0 0 5px rgba(193, 135, 219, 0.15); 
    }
    .t-item.active .t-content h6 { color: #222; }
    .t-content h6 { color: #adb5bd; transition: 0.3s; }
    .t-content p { line-height: 1.5; font-size: 0.85rem; color: #888; }
    .fade-in { animation: fadeIn 0.5s ease-in-out; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
</style>