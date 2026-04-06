<div class="container fade-in">
    <h3 class="mb-4 fw-bold text-uppercase" style="letter-spacing: 2px;">Riwayat</h3>
    <p class="text-muted mb-5">Daftar transaksi yang telah kamu lakukan di Trendify.</p>

    <div class="table-responsive">
        <table class="table table-hover border-0">
            <thead class="table-light">
                <tr style="font-size: 0.8rem; letter-spacing: 1px;">
                    <th class="py-3">TANGGAL</th>
                    <th class="py-3">PRODUK</th>
                    <th class="py-3 text-center">JUMLAH</th>
                    <th class="py-3">TOTAL HARGA</th>
                    <th class="py-3 text-center">STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($riwayat)): ?>
                    <?php foreach ($riwayat as $row): ?>
                        <tr class="align-middle" style="font-size: 0.9rem;">
                            <td class="py-4 text-muted"><?= date('d M Y', strtotime($row['tanggal'])) ?></td>
                            <td class="py-4 fw-medium"><?= $row['nama_produk'] ?></td>
                            <td class="py-4 text-center"><?= $row['jumlah'] ?></td>
                            <td class="py-4">Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
                            <td class="py-4 text-center">
                                <?php if ($row['status'] == 'selesai'): ?>
                                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">Selesai</span>
                                <?php else: ?>
                                    <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill">Pending</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">Belum ada riwayat transaksi.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>