<div class="cart-page fade-in">
    <h3 class="cart-title-main">Keranjang Belanja</h3>

    <?php if (isset($_GET['status'])): ?>
        <div class="alert-custom <?= in_array($_GET['status'], ['ditambahkan', 'berhasil']) ? 'alert-success-soft' : 'alert-warning-soft'; ?> mb-4">
            <?php 
                if ($_GET['status'] == 'ditambahkan') echo "Produk berhasil ditambahkan.";
                elseif ($_GET['status'] == 'dihapus') echo "Produk dihapus dari keranjang.";
                elseif ($_GET['status'] == 'berhasil') echo "Transaksi berhasil diproses.";
                elseif ($_GET['status'] == 'gagal') echo htmlspecialchars($_GET['msg'] ?? 'Transaksi gagal.');
            ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($keranjang)): ?>
        <form method="POST" action="?page=checkout" id="form-checkout">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="cart-items-wrapper">
                        <div class="select-all-box">
                            <div class="form-check custom-check">
                                <input class="form-check-input" type="checkbox" id="checkAll">
                                <label class="form-check-label fw-bold ms-2" for="checkAll">Pilih Semua Produk</label>
                            </div>
                        </div>

                        <?php foreach ($keranjang as $item): ?>
                            <div class="cart-item-card" id="item-<?= $item['id_keranjang']; ?>">
                                <div class="d-flex align-items-center">
                                    <div class="form-check custom-check me-3">
                                        <input class="form-check-input item-checkbox"
                                               type="checkbox"
                                               name="pilih_item[]"
                                               value="<?= $item['id_keranjang']; ?>"
                                               data-subtotal="<?= $item['subtotal']; ?>">
                                    </div>
                                    
                                    <div class="item-img-box">
                                        <img src="assets/img/<?= !empty($item['gambar']) ? htmlspecialchars($item['gambar']) : 'default.jpg'; ?>" alt="produk">
                                    </div>

                                    <div class="item-info-flex flex-grow-1 ms-3">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h6 class="product-name"><?= htmlspecialchars($item['nama']); ?></h6>
                                            </div>
                                            <a href="?page=hapus-keranjang&id=<?= $item['id_keranjang']; ?>"
                                               class="btn-remove-item"
                                               onclick="return confirm('Hapus item ini?')">
                                               <i class="bi bi-trash"></i>
                                            </a>
                                        </div>
                                        
                                        <div class="d-flex justify-content-between align-items-end mt-2">
                                            <div class="d-flex align-items-center gap-3 qty-box">
                                                <button type="button"
                                                        class="qty-action-btn"
                                                        data-id="<?= $item['id_keranjang']; ?>"
                                                        data-aksi="kurang">−</button>
                                                
                                                <span class="fw-bold h5 mb-0 item-jumlah" id="qty-<?= $item['id_keranjang']; ?>">
                                                    <?= $item['jumlah']; ?>
                                                </span>
                                                
                                                <button type="button"
                                                        class="qty-action-btn qty-plus"
                                                        data-id="<?= $item['id_keranjang']; ?>"
                                                        data-aksi="tambah">+</button>
                                            </div>

                                            <div class="subtotal-item" id="subtotal-<?= $item['id_keranjang']; ?>">
                                                Rp <?= number_format($item['subtotal'], 0, ',', '.'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="summary-card sticky-top" style="top: 100px; z-index: 10;">
                        <h5 class="fw-bold mb-4">Ringkasan Belanja</h5>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Total Harga</span>
                            <span class="fw-bold" id="display-total-harga">Rp 0</span>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="text-muted">Biaya Admin</span>
                            <span class="text-success fw-bold">Gratis</span>
                        </div>
                        
                        <hr>
                        
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="fw-bold">Total Tagihan</span>
                            <span class="total-amount" id="display-total-tagihan">Rp 0</span>
                        </div>

                        <button type="submit" class="btn-checkout-main">
                            Checkout Sekarang
                        </button>
                        
                        <a href="?page=produk" class="btn-continue-shopping mt-3">
                            Lanjut Belanja
                        </a>
                    </div>
                </div>
            </div>
        </form>
    <?php else: ?>
        <div class="empty-cart text-center py-5">
            <div class="empty-icon">🛒</div>
            <h4 class="fw-bold mt-3">Keranjangmu Kosong</h4>
            <p class="text-muted">Yuk, cari produk favoritmu dan mulai belanja!</p>
            <a href="?page=produk" class="btn-checkout-main px-5 mt-3" style="display:inline-block; width:auto;">Mulai Belanja</a>
        </div>
    <?php endif; ?>
</div>

<style>
    :root {
        --t-purple: #c187db;
        --t-dark: #222222;
        --t-gray: #f3f4f6;
        --t-text-muted: #888;
    }

    .cart-page { padding-bottom: 50px; }
    .cart-title-main { font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 30px; }

    .alert-custom { padding: 15px 20px; border-radius: 12px; font-weight: 500; font-size: 0.9rem; }
    .alert-success-soft { background: #f0fdf4; color: #16a34a; border: 1px solid #dcfce7; }
    .alert-warning-soft { background: #fffbeb; color: #d97706; border: 1px solid #fef3c7; }

    .cart-items-wrapper { display: flex; flex-direction: column; gap: 15px; }
    .select-all-box { background: #fff; padding: 15px 20px; border-radius: 12px; border: 1px solid #eee; }
    
    .cart-item-card {
        background: #fff;
        padding: 20px;
        border-radius: 16px;
        border: 1px solid #eee;
        transition: 0.2s ease;
    }

    .cart-item-card:hover { 
        border-color: var(--t-purple); 
        box-shadow: 0 5px 15px rgba(0,0,0,0.02); 
    }

    .cart-item-card.updating {
        opacity: .7;
        pointer-events: none;
    }

    .item-img-box { 
        width: 80px; 
        height: 80px; 
        background: var(--t-gray); 
        border-radius: 12px; 
        overflow: hidden; 
        flex-shrink: 0; 
    }

    .item-img-box img { 
        width: 100%; 
        height: 100%; 
        object-fit: cover; 
        display: block;
    }

    .product-name { 
        font-weight: 700; 
        margin-bottom: 4px; 
        color: var(--t-dark); 
    }

    .product-price {
        font-size: 0.9rem;
        color: var(--t-text-muted);
        margin-bottom: 0;
    }

    .subtotal-item { 
        font-weight: 800; 
        color: var(--t-dark); 
        font-size: 1.05rem; 
    }
    
    .btn-remove-item { 
        color: #ef4444; 
        font-size: 1.2rem; 
        transition: 0.2s; 
        padding: 5px; 
    }

    .btn-remove-item:hover { 
        transform: scale(1.1); 
        color: #dc2626; 
    }

    .summary-card {
        background: #fff;
        padding: 30px;
        border-radius: 24px;
        border: 1px solid #eee;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }

    .total-amount { 
        font-size: 1.4rem; 
        font-weight: 800; 
        color: var(--t-purple); 
    }

    .btn-checkout-main {
        width: 100%;
        background: var(--t-dark);
        color: #fff;
        border: none;
        padding: 16px;
        border-radius: 14px;
        font-weight: 700;
        transition: 0.3s;
    }

    .btn-checkout-main:hover { 
        background: #000; 
        transform: translateY(-2px); 
        box-shadow: 0 5px 15px rgba(0,0,0,0.1); 
    }

    .btn-continue-shopping {
        display: block;
        width: 100%;
        text-align: center;
        text-decoration: none;
        color: var(--t-text-muted);
        font-size: 0.9rem;
        font-weight: 600;
    }

    .btn-continue-shopping:hover { 
        color: var(--t-purple); 
    }

    .custom-check .form-check-input:checked { 
        background-color: var(--t-purple); 
        border-color: var(--t-purple); 
    }

    .empty-icon { 
        font-size: 4rem; 
        margin-bottom: 10px; 
    }

    .fade-in { 
        animation: fadeIn 0.5s ease; 
    }

    .qty-action-btn {
        width: 38px;
        height: 38px;
        border: none;
        border-radius: 10px;
        background: #f3f4f6;
        color: #222;
        font-size: 1.4rem;
        font-weight: 700;
        line-height: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: 0.18s ease;
    }

    .qty-plus {
        background: #ead5f7;
    }

    .qty-action-btn:hover {
        background: var(--t-purple);
        color: #fff;
        transform: translateY(-1px);
    }

    .qty-box .item-jumlah {
        min-width: 22px;
        text-align: center;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<script>
    const checkAll = document.getElementById('checkAll');
    const formCheckout = document.getElementById('form-checkout');
    const displayTotalHarga = document.getElementById('display-total-harga');
    const displayTotalTagihan = document.getElementById('display-total-tagihan');

    function formatRupiah(total) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(total).replace('Rp', 'Rp ');
    }

    function getItemCheckboxes() {
        return document.querySelectorAll('.item-checkbox');
    }

    function hitungUlangTotal() {
        let total = 0;

        getItemCheckboxes().forEach(cb => {
            if (cb.checked) {
                total += parseInt(cb.dataset.subtotal || 0);
            }
        });

        const formatted = formatRupiah(total);

        if (displayTotalHarga) displayTotalHarga.textContent = formatted;
        if (displayTotalTagihan) displayTotalTagihan.textContent = formatted;
    }

    function handleCheckboxChange() {
        const itemCheckboxes = getItemCheckboxes();
        const totalItems = itemCheckboxes.length;
        const checkedItems = document.querySelectorAll('.item-checkbox:checked').length;

        if (checkAll) {
            checkAll.checked = totalItems > 0 && totalItems === checkedItems;
        }

        hitungUlangTotal();
    }

    function bindCheckboxEvents() {
        getItemCheckboxes().forEach(cb => {
            cb.onchange = handleCheckboxChange;
        });
    }

    if (checkAll) {
        checkAll.addEventListener('change', function () {
            getItemCheckboxes().forEach(cb => cb.checked = this.checked);
            handleCheckboxChange();
        });
    }

    if (formCheckout) {
        formCheckout.addEventListener('submit', function (e) {
            const checkedItems = document.querySelectorAll('.item-checkbox:checked').length;

            if (checkedItems === 0) {
                e.preventDefault();
                alert('Pilih minimal satu produk untuk checkout.');
            }
        });
    }

    async function updateQty(id, aksi) {
        const card = document.getElementById('item-' + id);
        const qtyEl = document.getElementById('qty-' + id);
        const subtotalEl = document.getElementById('subtotal-' + id);
        const checkbox = card ? card.querySelector('.item-checkbox') : null;

        if (!card || !qtyEl || !subtotalEl) return;

        card.classList.add('updating');

        try {
            const fd = new FormData();
            fd.append('ajax', '1');
            fd.append('id', id);
            fd.append('aksi', aksi);

            const res = await fetch(window.location.href, {
                method: 'POST',
                body: fd
            });

            const text = await res.text();

            let data;
            try {
                data = JSON.parse(text);
            } catch (e) {
                alert(text);
                return;
            }

            if (!data.success) {
                alert(data.message || 'Gagal update');
                return;
            }

            if (data.deleted) {
                card.remove();

                if (document.querySelectorAll('.cart-item-card').length === 0) {
                    location.reload();
                    return;
                }

                bindCheckboxEvents();
                handleCheckboxChange();
                return;
            }

            qtyEl.textContent = data.qty;
            subtotalEl.textContent = data.subtotal_format;

            if (checkbox) {
                checkbox.dataset.subtotal = data.subtotal;
            }

            handleCheckboxChange();
        } catch (err) {
            alert('AJAX gagal');
        } finally {
            card.classList.remove('updating');
        }
    }

    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.qty-action-btn');
        if (!btn) return;

        e.preventDefault();
        updateQty(btn.dataset.id, btn.dataset.aksi);
    });

    bindCheckboxEvents();
    hitungUlangTotal();
    handleCheckboxChange();
</script>