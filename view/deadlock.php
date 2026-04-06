<div class="deadlock-page">
    <div class="deadlock-card text-center">
        <div class="deadlock-icon">⚠️</div>
        <h2 class="deadlock-title">Deadlock Simulation</h2>
        <p class="deadlock-subtitle">
            Simulasi konflik dua user sedang dijalankan.
        </p>

        <div id="deadlockStep1" class="deadlock-alert success-alert">
            User 1 telah berhasil memesan.
        </div>

        <div id="deadlockStep2" class="deadlock-alert danger-alert" style="display:none;">
            User 2 gagal memesan karena deadlock. Sistem melakukan rollback pada proses kedua.
        </div>

        <div id="deadlockFinal" class="deadlock-final-box" style="display:none;">
            <h5 class="fw-bold mb-2">Simulasi Selesai</h5>
            <p class="mb-2 text-muted">
                Pada simulasi ini, dua proses mengakses resource yang sama.
                User 1 berhasil menyelesaikan transaksi, sedangkan User 2 dibatalkan untuk mencegah konflik.
            </p>
            <p class="mb-0">
                <strong>Penanganan:</strong> rollback pada proses kedua.
            </p>

            <div class="mt-4 d-flex justify-content-center gap-2 flex-wrap">
                <a href="?page=keranjang" class="btn deadlock-btn-light">Kembali ke Keranjang</a>
            </div>
        </div>
    </div>
</div>

<style>
.deadlock-page {
    min-height: 70vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 30px 0;
}

.deadlock-card {
    width: 100%;
    max-width: 760px;
    background: #fff;
    border-radius: 24px;
    padding: 40px 30px;
    box-shadow: 0 12px 35px rgba(0,0,0,0.06);
}

.deadlock-icon {
    font-size: 3.5rem;
    margin-bottom: 10px;
}

.deadlock-title {
    font-weight: 800;
    margin-bottom: 8px;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.deadlock-subtitle {
    color: #6b7280;
    margin-bottom: 30px;
}

.deadlock-alert {
    border-radius: 16px;
    padding: 18px 20px;
    font-weight: 700;
    margin-bottom: 16px;
    animation: fadeSlide 0.4s ease;
}

.success-alert {
    background: #ecfdf5;
    color: #059669;
    border: 1px solid #bbf7d0;
}

.danger-alert {
    background: #fef2f2;
    color: #dc2626;
    border: 1px solid #fecaca;
}

.deadlock-final-box {
    margin-top: 20px;
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    border-radius: 18px;
    padding: 24px;
    animation: fadeSlide 0.4s ease;
}

.deadlock-btn-dark {
    background: #111827;
    color: #fff;
    border-radius: 14px;
    padding: 12px 18px;
    font-weight: 700;
}

.deadlock-btn-dark:hover {
    background: #000;
    color: #fff;
}

.deadlock-btn-light {
    background: #fff;
    border: 1px solid #d1d5db;
    color: #374151;
    border-radius: 14px;
    padding: 12px 18px;
    font-weight: 700;
}

.deadlock-btn-light:hover {
    background: #f9fafb;
    color: #111827;
}

@keyframes fadeSlide {
    from {
        opacity: 0;
        transform: translateY(8px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<script>
setTimeout(() => {
    const s1 = document.getElementById('deadlockStep1');
    const s2 = document.getElementById('deadlockStep2');

    if (s1) s1.style.display = 'none';
    if (s2) s2.style.display = 'block';
}, 2200);

setTimeout(() => {
    const s2 = document.getElementById('deadlockStep2');
    const finalBox = document.getElementById('deadlockFinal');

    if (s2) s2.style.display = 'none';
    if (finalBox) finalBox.style.display = 'block';
}, 4800);
</script>