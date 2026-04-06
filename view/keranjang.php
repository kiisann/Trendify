<h3 class="mb-4 fw-bold text-uppercase" style="letter-spacing: 2px;">Keranjang</h3>

<?php if (isset($_GET['status']) && $_GET['status'] == 'ditambahkan'): ?>
    <div class="alert alert-success">Produk berhasil ditambahkan ke keranjang.</div>
<?php elseif (isset($_GET['status']) && $_GET['status'] == 'dihapus'): ?>
    <div class="alert alert-warning">Produk berhasil dihapus dari keranjang.</div>
<?php elseif (isset($_GET['status']) && $_GET['status'] == 'berhasil'): ?>
    <div class="alert alert-success">Transaksi berhasil. Data pesanan disimpan.</div>
<?php elseif (isset($_GET['status']) && $_GET['status'] == 'gagal'): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($_GET['msg'] ?? 'Transaksi gagal. ROLLBACK dilakukan.') ?></div>
<?php endif; ?>

<?php if (!empty($keranjang)): ?>
    <?php $grandTotal = 0; ?>

    <form method="POST" action="?page=checkout" id="form-checkout">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>
                            <input type="checkbox" id="checkAll">
                            <label for="checkAll" class="ms-1">Pilih Semua</label>
                        </th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($keranjang as $item): ?>
                        <?php $grandTotal += $item['subtotal']; ?>
                        <tr>
                            <td>
                                <input 
                                    type="checkbox"
                                    name="pilih_item[]"
                                    value="<?= $item['id_keranjang']; ?>"
                                    class="item-checkbox"
                                >
                            </td>
                            <td><?= htmlspecialchars($item['nama']); ?></td>
                            <td>Rp <?= number_format($item['harga'], 0, ',', '.'); ?></td>
                            <td><?= $item['jumlah']; ?></td>
                            <td>Rp <?= number_format($item['subtotal'], 0, ',', '.'); ?></td>
                            <td>
                                <a href="?page=hapus-keranjang&id=<?= $item['id_keranjang']; ?>"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Hapus item ini dari keranjang?')">
                                   Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <h5 class="mt-3">Total Semua Item: Rp <?= number_format($grandTotal, 0, ',', '.'); ?></h5>

        <button type="submit" class="btn btn-success mt-3">
            Checkout
        </button>
    </form>
<?php else: ?>
    <div class="alert alert-secondary">Keranjang masih kosong.</div>
<?php endif; ?>

<script>
const checkAll = document.getElementById('checkAll');
const itemCheckboxes = document.querySelectorAll('.item-checkbox');
const formCheckout = document.getElementById('form-checkout');

if (checkAll) {
    checkAll.addEventListener('change', function () {
        itemCheckboxes.forEach(cb => {
            cb.checked = this.checked;
        });
    });
}

itemCheckboxes.forEach(cb => {
    cb.addEventListener('change', function () {
        const totalItems = itemCheckboxes.length;
        const checkedItems = document.querySelectorAll('.item-checkbox:checked').length;

        if (checkAll) {
            checkAll.checked = totalItems === checkedItems;
        }
    });
});

if (formCheckout) {
    formCheckout.addEventListener('submit', function (e) {
        const checkedItems = document.querySelectorAll('.item-checkbox:checked').length;

        if (checkedItems === 0) {
            e.preventDefault();
            alert('Pilih minimal satu produk untuk checkout.');
        }
    });
}
</script>