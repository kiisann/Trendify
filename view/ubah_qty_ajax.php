<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'config/koneksi.php';

if (isset($_POST['ajax'])) {
    header('Content-Type: application/json');
    ob_clean();

    $id = (int)$_POST['id'];
    $aksi = $_POST['aksi'];

    $query = mysqli_query($koneksi, "
        SELECT k.*, p.harga 
        FROM keranjang k
        JOIN produk p ON p.id_produk = k.id_produk
        WHERE id_keranjang = '$id'
    ");

    if (!$query || mysqli_num_rows($query) == 0) {
        echo json_encode(['success' => false]);
        exit;
    }

    $item = mysqli_fetch_assoc($query);
    $qty = (int)$item['jumlah'];

    if ($aksi == 'tambah') $qty++;
    if ($aksi == 'kurang') $qty--;

    if ($qty <= 0) {
        mysqli_query($koneksi, "DELETE FROM keranjang WHERE id_keranjang='$id'");
        echo json_encode(['success'=>true,'deleted'=>true]);
        exit;
    }

    mysqli_query($koneksi, "
        UPDATE keranjang SET jumlah='$qty' WHERE id_keranjang='$id'
    ");

    $subtotal = $qty * $item['harga'];

    echo json_encode([
        'success' => true,
        'qty' => $qty,
        'subtotal' => $subtotal,
        'subtotal_format' => 'Rp ' . number_format($subtotal,0,',','.')
    ]);
    exit;
}
?>

<div class="cart-page">
    <h3>KERANJANG BELANJA</h3>

    <?php foreach ($keranjang as $item): ?>
    <div class="cart-item-card" id="item-<?= $item['id_keranjang']; ?>">

        <img src="assets/img/<?= $item['gambar'] ?: 'default.jpg'; ?>" width="80">

        <b><?= $item['nama']; ?></b>

        <div>
            <button class="btn-qty" data-id="<?= $item['id_keranjang']; ?>" data-aksi="kurang">-</button>

            <span id="qty-<?= $item['id_keranjang']; ?>">
                <?= $item['jumlah']; ?>
            </span>

            <button class="btn-qty" data-id="<?= $item['id_keranjang']; ?>" data-aksi="tambah">+</button>
        </div>

        <div id="subtotal-<?= $item['id_keranjang']; ?>">
            Rp <?= number_format($item['subtotal'],0,',','.'); ?>
        </div>

    </div>
    <?php endforeach; ?>
</div>

<script>
async function updateQty(id, aksi, btn){

    const card = document.getElementById('item-'+id);
    const qtyEl = document.getElementById('qty-'+id);
    const subEl = document.getElementById('subtotal-'+id);

    card.style.opacity = 0.6;

  const fd = new FormData();
fd.append('ajax', '1');
fd.append('id', id);
fd.append('aksi', aksi);

const res = await fetch(window.location.href, {
    method: 'POST',
    body: fd
});

const data = await res.json();
    const data = await res.json();

    if(!data.success){
        alert('Gagal update');
        return;
    }

    if(data.deleted){
        card.remove();
        return;
    }

    qtyEl.innerText = data.qty;
    subEl.innerText = data.subtotal_format;

    card.style.opacity = 1;
}

document.addEventListener('click',function(e){
    const btn = e.target.closest('.btn-qty');
    if(!btn) return;

    updateQty(btn.dataset.id, btn.dataset.aksi, btn);
});
</script>