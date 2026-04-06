<style>
    :root {
        --trendify-black: #222222;
        --trendify-gray: #888888;
        --trendify-purple: #c187db;
        --trendify-soft-bg: #F9FAFB;
        --trendify-success-bg: #ECFDF5;
        --trendify-success-text: #059669;
        --trendify-pending-bg: #FFFBEB;
        --trendify-pending-text: #D97706;
    }

    .history-container {
        font-family: 'Inter', sans-serif;
        padding-bottom: 100px;
    }

    .history-title {
        font-size: 1.5rem;
        font-weight: 800;
        letter-spacing: 1px;
        color: var(--trendify-black);
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .history-subtitle {
        color: var(--trendify-gray);
        font-size: 0.95rem;
        margin-bottom: 40px;
    }

    .table-trendify {
        border-collapse: separate;
        border-spacing: 0 12px; 
    }

    .table-trendify thead th {
        border: none;
        color: var(--trendify-black);
        font-weight: 700;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        padding: 15px 20px;
        background-color: var(--trendify-soft-bg);
    }

    .table-trendify tbody tr {
        background-color: #ffffff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.02);
        transition: 0.3s;
    }

    .table-trendify tbody tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        border-left: 4px solid var(--trendify-purple);
    }

    .table-trendify td {
        padding: 25px 20px;
        border: none;
        font-size: 0.9rem;
        color: var(--trendify-black);
    }

    .td-date {
        color: var(--trendify-gray) !important;
        font-weight: 500;
    }

    .td-product {
        font-weight: 700;
    }

    .td-price {
        font-weight: 700;
        color: var(--trendify-purple);
    }

    .badge-trendify {
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
    }

    .status-selesai {
        background-color: var(--trendify-success-bg);
        color: var(--trendify-success-text);
    }

    .status-pending {
        background-color: var(--trendify-pending-bg);
        color: var(--trendify-pending-text);
    }

    .empty-history {
        padding: 80px 0;
        text-align: center;
        color: var(--trendify-gray);
    }

    .btn-reorder {
        background: var(--trendify-black);
        color: #fff;
        border: none;
        padding: 10px 20px;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        transition: 0.3s;
    }

    .btn-reorder:hover {
        background: var(--trendify-purple);
        color: #fff;
    }
</style>

<div class="container history-container mt-5">
    <div class="row">
        <div class="col-12">
            <h3 class="history-title">Riwayat Belanja</h3>
            <p class="history-subtitle">Pantau status pesanan dan daftar transaksi Trendify kamu di sini.</p>

            <div class="table-responsive">
                <table class="table table-trendify align-middle">
                    <thead>
                        <tr>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Produk</th>
                            <th scope="col" class="text-center">Jumlah</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col" class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($riwayat)): ?>
                            <?php foreach ($riwayat as $row): ?>
                                <tr>
                                    <td class="td-date">
                                        <?= date('d M Y', strtotime($row['tanggal'])) ?>
                                    </td>
                                    <td class="td-product">
                                        <?= $row['nama_produk'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $row['jumlah'] ?>
                                    </td>
                                    <td class="td-price">
                                        Rp <?= number_format($row['total'], 0, ',', '.') ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if (strtolower($row['status']) == 'selesai'): ?>
                                            <span class="badge-trendify status-selesai">Selesai</span>
                                        <?php else: ?>
                                            <span class="badge-trendify status-pending">Pending</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">
                                    <div class="empty-history">
                                        <p>Belum ada riwayat transaksi.</p>
                                        <a href="?page=produk" class="btn btn-reorder px-4 mt-2">Mulai Belanja</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>