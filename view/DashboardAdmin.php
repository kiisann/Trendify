<?php
if ($_SESSION['user']['role'] != 'admin') {
    echo "Akses ditolak!";
    exit;
}
?>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --primary-purple: #8B5CF6;
        --dark-text: #111111;
        --border-color: #E5E7EB;
        --surface: #FFFFFF;
        --surface-soft: #F9FAFB;
        --highlight: #F5F3FF;
        --muted-text: #6B7280;
        --muted-light: #9CA3AF;
        --shadow-soft: 0 10px 40px rgba(17, 17, 17, 0.06);
        --shadow-card: 0 8px 24px rgba(17, 17, 17, 0.04);
    }

    body {
        background: var(--surface-soft);
        font-family: 'Inter', sans-serif;
        color: var(--dark-text);
    }

    .dashboard-shell {
        background: var(--surface);
        border: 1px solid var(--border-color);
        border-radius: 24px;
        padding: 24px;
        box-shadow: var(--shadow-soft);
    }

    .hero-panel {
        background:
            radial-gradient(circle at 5% 10%, #edddf3 0%, rgba(255,255,255,0) 30%),
            radial-gradient(circle at 80% 80%, #bb90d2 0%, rgba(255,255,255,0) 40%),
            radial-gradient(circle at 90% 40%, #e7e6ee 0%, rgba(255,255,255,0) 40%);
        border-radius: 24px;
        padding: 40px;
        margin-bottom: 28px;
        overflow: hidden;
    }

    .hero-badge {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 36px;
    }

    .hero-logo {
        width: 56px;
        height: 56px;
        border-radius: 18px;
        background: #F6F6F6;
        color: var(--primary-purple);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.7rem;
        font-weight: 800;
        box-shadow: 0 5px 15px rgba(139, 92, 246, 0.18);
    }

   .hero-brand h3 {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 700;
    color: #111111;
}

.hero-brand p {
    margin: 0;
    font-size: 0.9rem;
    color: #6B7280;
}

    .hero-title {
        font-size: 4.5rem;
        line-height: 0.95;
        letter-spacing: -2px;
        font-weight: 800;
        color: var(--dark-text);
        margin: 0 0 22px;
    }

    .hero-subtitle {
        font-size: 1rem;
        color: #824a9c;
        font-weight: 500;
        margin: 0;
    }

    .stat-card {
        background: var(--surface);
        border: 1px solid var(--border-color);
        border-radius: 24px;
        padding: 34px 24px;
        text-align: center;
        height: 100%;
        box-shadow: var(--shadow-card);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        border-color: #D8B4FE;
        box-shadow: 0 12px 28px rgba(139, 92, 246, 0.10);
        background: #FCFBFF;
    }

    .stat-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        border-radius: 22px;
        background: linear-gradient(145deg, #EDE9FE, #DDD6FE);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        color: var(--primary-purple);
        box-shadow:
            inset 0 1px 0 rgba(255,255,255,0.8),
            0 8px 20px rgba(139, 92, 246, 0.12);
    }

    .stat-label {
        font-size: 1rem;
        font-weight: 500;
        color: #4B5563;
        margin-bottom: 12px;
    }

    .stat-value {
        font-size: 3.3rem;
        line-height: 1;
        font-weight: 800;
        color: var(--dark-text);
        letter-spacing: -1px;
        margin-bottom: 14px;
    }

    .stat-desc {
        font-size: 0.95rem;
        color: #8A8FA3;
        margin: 0;
    }

    @media (max-width: 992px) {
        .hero-title {
            font-size: 3.2rem;
        }
    }

    @media (max-width: 768px) {
        .dashboard-shell {
            padding: 16px;
            border-radius: 18px;
        }

        .hero-panel {
            padding: 24px;
        }

        .hero-title {
            font-size: 2.6rem;
        }

        .stat-value {
            font-size: 2.6rem;
        }
    }
</style>

<div class="container py-4">
    <div class="dashboard-shell">

        <div class="hero-panel">
            <div class="hero-badge">
                <div class="hero-logo">T.</div>
                <div class="hero-brand">
                    <h3>Smart Choice</h3>
                    <p>Trendify Fashion 2026</p>
                </div>
            </div>

            <h1 class="hero-title">Welcome<br>Back!</h1>
            <p class="hero-subtitle">Trendify Admin Dashboard</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon">📦</div>
                    <div class="stat-label">Total Produk</div>
                    <div class="stat-value"><?= $totalProduk ?></div>
                    <p class="stat-desc">Produk tersedia di sistem</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon">👤</div>
                    <div class="stat-label">Total User</div>
                    <div class="stat-value"><?= $totalUser ?></div>
                    <p class="stat-desc">User terdaftar</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon">💳</div>
                    <div class="stat-label">Total Transaksi</div>
                    <div class="stat-value"><?= $totalTransaksi ?></div>
                    <p class="stat-desc">Transaksi berhasil</p>
                </div>
            </div>
        </div>

    </div>
</div>