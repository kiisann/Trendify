<?php
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    echo "Akses ditolak!";
    exit;
}
?>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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
        --success-bg: #ECFDF3;
        --success-text: #027A48;
        --info-bg: #EEF4FF;
        --info-text: #3538CD;
        --danger-bg: #FEF3F2;
        --danger-text: #D92D20;
        --warning-bg: #FFFAEB;
        --warning-text: #B54708;
        --shadow-soft: 0 10px 30px rgba(17, 17, 17, 0.05);
        --shadow-card: 0 12px 28px rgba(139, 92, 246, 0.05);
    }

    body {
        background: var(--bg);
        font-family: 'Inter', sans-serif;
        color: var(--text);
    }

    .product-shell {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 26px;
        padding: 24px;
        box-shadow: var(--shadow-soft);
    }

    .product-hero {
        background:
            radial-gradient(circle at 5% 10%, #edddf3 0%, rgba(255,255,255,0) 30%),
            radial-gradient(circle at 80% 80%, #bb90d2 0%, rgba(255,255,255,0) 40%),
            radial-gradient(circle at 90% 40%, #e7e6ee 0%, rgba(255,255,255,0) 40%);
        border-radius: 28px;
        padding: 38px 42px;
        margin-bottom: 26px;
        overflow: hidden;
    }

   .product-title {
    font-size: 3.8rem;
    font-weight: 900;
    letter-spacing: -2px;
    line-height: 1.1;
    margin-bottom: 10px;

    background: linear-gradient(135deg, #111111, #6B7280);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;

    text-shadow: 0 4px 20px rgba(0,0,0,0.05);
}
    .product-desc {
        font-size: 1.05rem;
        color: #7C4D9E;
        margin: 0;
        font-weight: 500;
        max-width: 780px;
        line-height: 1.7;
    }

    .alert {
        border: 1px solid transparent;
        border-radius: 16px;
        padding: 14px 16px;
        font-weight: 500;
    }

    .alert-success {
        background: var(--success-bg);
        color: var(--success-text);
        border-color: #ABEFC6;
    }

    .alert-primary {
        background: var(--info-bg);
        color: var(--info-text);
        border-color: #C7D7FE;
    }

    .alert-danger {
        background: var(--danger-bg);
        color: var(--danger-text);
        border-color: #FECDCA;
    }

    .alert-warning {
        background: var(--warning-bg);
        color: var(--warning-text);
        border-color: #FEDF89;
    }

    .panel-card {
        background: linear-gradient(180deg, #FFFFFF 0%, #FCFBFF 100%);
        border: 1px solid var(--border-soft);
        border-radius: 24px;
        box-shadow: var(--shadow-card);
        height: 100%;
    }

    .panel-card .card-body {
        padding: 28px;
    }

    .mini-title {
        font-size: 1.85rem;
        font-weight: 800;
        letter-spacing: -1px;
        color: var(--text);
        margin-bottom: 22px;
    }

    .form-label {
        font-weight: 500;
        font-size: 0.98rem;
        color: #374151;
        margin-bottom: 10px;
    }

    .form-control,
    .form-select {
        border: 1px solid #DDD6FE;
        border-radius: 18px;
        padding: 15px 18px;
        font-size: 1rem;
        color: var(--text);
        background: #FFFFFF;
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.7);
        transition: all 0.25s ease;
    }

    .form-control::placeholder,
    .form-select {
        color: #9CA3AF;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px var(--primary-soft);
        background: #fff;
    }

    .btn-primary-soft {
        background: linear-gradient(135deg, #8B5CF6, #A78BFA);
        border: none;
        color: #fff;
        border-radius: 18px;
        padding: 15px 20px;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.25s ease;
        box-shadow: 0 10px 22px rgba(139, 92, 246, 0.20);
    }

    .btn-primary-soft:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 28px rgba(139, 92, 246, 0.24);
        color: #fff;
    }

    .table-wrap {
        border: 1px solid #ECE7F5;
        border-radius: 20px;
        overflow: hidden;
        background: #fff;
    }

    .table {
        margin-bottom: 0;
    }

    .table thead th {
        background: #F3EFFB;
        color: #1F2937;
        font-size: 0.98rem;
        font-weight: 700;
        border-bottom: 1px solid var(--border);
        padding: 18px 16px;
        white-space: nowrap;
    }

    .table tbody td {
        padding: 18px 16px;
        color: #1F2937;
        vertical-align: middle;
        border-color: #EEF0F3;
        font-size: 0.98rem;
    }

    .table tbody tr:hover {
        background: #FCFBFF;
    }

    .table tbody td strong {
        font-weight: 700;
        font-size: 0.98rem;
        color: #1F2937;
    }

    .badge-soft {
        display: inline-block;
        background: #F4F0FB;
        color: #8B5CF6;
        border: 1px solid #E7DDFC;
        border-radius: 999px;
        padding: 8px 16px;
        font-size: 0.9rem;
        font-weight: 700;
        line-height: 1.5;
        min-width: 150px;
        text-align: center;
    }

    .action-group {
        display: flex;
        flex-direction: column;
        gap: 10px;
        align-items: center;
    }

    .btn-edit {
        background: #FACC15;
        color: #111111;
        border: none;
        border-radius: 14px;
        padding: 10px 18px;
        font-weight: 700;
        min-width: 94px;
        box-shadow: 0 6px 14px rgba(250, 204, 21, 0.22);
        transition: all 0.2s ease;
    }

    .btn-edit:hover {
        transform: translateY(-1px);
        background: #FBBF24;
        color: #111111;
    }

    .btn-delete {
        background: #F24848;
        color: #fff;
        border: none;
        border-radius: 14px;
        padding: 10px 18px;
        font-weight: 700;
        min-width: 94px;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        box-shadow: 0 6px 14px rgba(242, 72, 72, 0.20);
        transition: all 0.2s ease;
    }

    .btn-delete:hover {
        transform: translateY(-1px);
        background: #DE3F3F;
        color: #fff;
    }

    .modal-content {
        border: 1px solid var(--border);
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(17, 17, 17, 0.08);
        overflow: hidden;
    }

    .modal-header {
        background: var(--primary-soft);
        border-bottom: 1px solid var(--border);
        padding: 18px 22px;
    }

    .modal-title {
        font-weight: 700;
        color: var(--text);
    }

    .modal-body {
        padding: 22px;
    }

    .modal-footer {
        border-top: 1px solid var(--border);
        padding: 18px 22px;
    }

    .btn-secondary {
        border-radius: 14px;
        padding: 10px 16px;
        font-weight: 600;
    }

    .btn-primary {
        background: linear-gradient(135deg, #8B5CF6, #A78BFA);
        border: none;
        border-radius: 14px;
        padding: 10px 16px;
        font-weight: 700;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #7C3AED, #8B5CF6);
    }

    @media (max-width: 991px) {
        .product-title {
            font-size: 2.2rem;
        }
    }

    @media (max-width: 768px) {
        .product-shell {
            padding: 16px;
            border-radius: 18px;
        }

        .product-hero {
            padding: 24px;
        }

        .product-title {
            font-size: 1.8rem;
        }

        .mini-title {
            font-size: 1.5rem;
        }

        .panel-card .card-body {
            padding: 20px;
        }

        .action-group {
            gap: 8px;
        }
    }
</style>

<div class="container mt-4">
    <div class="product-shell">

        <div class="product-hero">
            <h3 class="product-title">Manajemen Produk</h3>
            <p class="product-desc">Kelola produk Anda dengan mudah. Tambah, edit, atau hapus produk sesuai kebutuhan untuk menjaga toko Anda tetap segar dan menarik bagi pelanggan.</p>
        </div>

        <?php if (isset($_GET['status'])): ?>
            <?php if ($_GET['status'] == 'success'): ?>
                <div class="alert alert-success mb-4">Produk berhasil ditambahkan.</div>
            <?php elseif ($_GET['status'] == 'updated'): ?>
                <div class="alert alert-primary mb-4">Produk berhasil diperbarui.</div>
            <?php elseif ($_GET['status'] == 'deleted'): ?>
                <div class="alert alert-danger mb-4">Produk berhasil dihapus.</div>
            <?php elseif ($_GET['status'] == 'error'): ?>
                <div class="alert alert-warning mb-4">Terjadi kesalahan saat memproses data.</div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="row g-4">
            <!-- FORM TAMBAH PRODUK -->
            <div class="col-lg-4 mb-4">
                <div class="panel-card">
                    <div class="card-body">
                        <h5 class="mini-title">Tambah Produk</h5>

                        <form method="POST" action="?page=produk-admin" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Nama Produk</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Harga</label>
                                <input type="number" name="harga" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Gambar Produk</label>
                                <input type="file" name="gambar" class="form-control" accept="image/*" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Stok</label>
                                <input type="number" name="stok" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">ID Kategori</label>
                                <select name="id_kategori" class="form-select" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="1">Pria - Pakaian</option>
                                    <option value="2">Pria - Sepatu</option>
                                    <option value="3">Pria - Aksesoris</option>
                                    <option value="4">Wanita - Pakaian</option>
                                    <option value="5">Wanita - Sepatu</option>
                                    <option value="6">Wanita - Aksesoris</option>
                                </select>
                            </div>

                            <button type="submit" name="simpan" class="btn btn-primary-soft w-100">
                                Tambah Produk
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- TABEL PRODUK -->
            <div class="col-lg-8">
                <div class="panel-card">
                    <div class="card-body">
                        <h5 class="mini-title">Daftar Produk</h5>

                        <div class="table-responsive table-wrap">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($data_produk)): ?>
                                        <?php foreach ($data_produk as $row): ?>
                                            <tr>
                                                <td>
                                                    <?php if (!empty($row['gambar'])): ?>
                                                        <img src="assets/img/<?= htmlspecialchars($row['gambar']); ?>" width="60" height="60" style="object-fit:cover; border-radius:8px;">
                                                    <?php else: ?>
                                                        <span class="text-muted">Tidak ada</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><strong><?= $row['nama_produk']; ?></strong></td>
                                                <td><span class="badge-soft"><?= $row['kategori']; ?></span></td>
                                                <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                                                <td><?= $row['stok']; ?></td>
                                                <td class="text-center">
                                                    <div class="action-group">
                                                        <button 
                                                            class="btn btn-sm btn-edit" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#editModal<?= $row['id_produk']; ?>">
                                                            Edit
                                                        </button>
                                                        <a 
                                                            href="?page=produk-admin&id=<?= $row['id_produk']; ?>" 
                                                            class="btn-delete btn btn-sm"
                                                            onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                                            Hapus
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- MODAL EDIT -->
                                            <div class="modal fade" id="editModal<?= $row['id_produk']; ?>" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Produk</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <form method="POST" action="?page=produk-admin">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id_produk" value="<?= $row['id_produk']; ?>">

                                                                <div class="mb-3">
                                                                    <label class="form-label">Nama Produk</label>
                                                                    <input type="text" name="nama" class="form-control" value="<?= $row['nama_produk']; ?>" required>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Harga</label>
                                                                    <input type="number" name="harga" class="form-control" value="<?= $row['harga']; ?>" required>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Stok</label>
                                                                    <input type="number" name="stok" class="form-control" value="<?= $row['stok']; ?>" required>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">ID Kategori</label>
                                                                    <select name="id_kategori" class="form-select" required>
                                                                        <option value="1" <?= ($row['id_kategori'] == 1) ? 'selected' : ''; ?>>Pria - Pakaian</option>
                                                                        <option value="2" <?= ($row['id_kategori'] == 2) ? 'selected' : ''; ?>>Pria - Sepatu</option>
                                                                        <option value="3" <?= ($row['id_kategori'] == 3) ? 'selected' : ''; ?>>Pria - Aksesoris</option>
                                                                        <option value="4" <?= ($row['id_kategori'] == 4) ? 'selected' : ''; ?>>Wanita - Pakaian</option>
                                                                        <option value="5" <?= ($row['id_kategori'] == 5) ? 'selected' : ''; ?>>Wanita - Sepatu</option>
                                                                        <option value="6" <?= ($row['id_kategori'] == 6) ? 'selected' : ''; ?>>Wanita - Aksesoris</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">
                                                Belum ada data produk.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>