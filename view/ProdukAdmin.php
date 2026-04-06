<?php
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    echo "Akses ditolak!";
    exit;
}
?>

<div class="container mt-4">
    <h3 class="mb-4 fw-bold text-uppercase" style="letter-spacing: 2px;">Manajemen Produk</h3>
    <p class="text-muted mb-4">
        Halaman admin untuk mengelola data produk menggunakan JOIN dan stored procedure.
    </p>

    <?php if (isset($_GET['status'])): ?>
        <?php if ($_GET['status'] == 'success'): ?>
            <div class="alert alert-success">Produk berhasil ditambahkan.</div>
        <?php elseif ($_GET['status'] == 'updated'): ?>
            <div class="alert alert-primary">Produk berhasil diperbarui.</div>
        <?php elseif ($_GET['status'] == 'deleted'): ?>
            <div class="alert alert-danger">Produk berhasil dihapus.</div>
        <?php elseif ($_GET['status'] == 'error'): ?>
            <div class="alert alert-warning">Terjadi kesalahan saat memproses data.</div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="row">
        <!-- FORM TAMBAH PRODUK -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Tambah Produk</h5>

                    <form method="POST" action="?page=produk-admin">
                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="number" name="harga" class="form-control" required>
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

                        <button type="submit" name="simpan" class="btn btn-dark w-100">
                            Tambah Produk
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- TABEL PRODUK -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Daftar Produk</h5>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr style="font-size: 0.85rem;">
                                    <th>ID</th>
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
                                            <td><?= $row['id_produk']; ?></td>
                                            <td><?= $row['nama']; ?></td>
                                            <td><?= $row['nama_kategori']; ?></td>
                                            <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                                            <td><?= $row['stok']; ?></td>
                                            <td class="text-center">
                                                <button 
                                                    class="btn btn-sm btn-warning" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editModal<?= $row['id_produk']; ?>">
                                                    Edit
                                                </button>
                                                <a 
                                                    href="?page=produk-admin&id=<?= $row['id_produk']; ?>" 
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                                    Hapus
                                                </a>
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
                                                                <input type="text" name="nama" class="form-control" value="<?= $row['nama']; ?>" required>
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