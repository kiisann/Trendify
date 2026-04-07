<?php
include_once 'model/TransaksiModel.php';

class TransaksiController {
    private $model;

    public function __construct($pdo) {
        $this->model = new TransaksiModel($pdo);
    }

    public function tampilRiwayat() {
        if (!isset($_SESSION['user'])) {
            header("Location: ?page=login");
            exit;
        }

        $id_user = $_SESSION['user']['id'];
        $riwayat = $this->model->getRiwayatByUser($id_user);
        include 'view/riwayat.php';
    }

    public function tampilKeranjang() {
        if (!isset($_SESSION['user'])) {
            header("Location: ?page=login");
            exit;
        }

        $id_user = $_SESSION['user']['id'];
        $keranjang = $this->model->getKeranjangByUser($id_user);
        include 'view/keranjang.php';
    }

    public function hapusItemKeranjang() {
        if (!isset($_SESSION['user'])) {
            header("Location: ?page=login");
            exit;
        }

        if (!isset($_GET['id'])) {
            header("Location: ?page=keranjang");
            exit;
        }

        $id_user = $_SESSION['user']['id'];
        $id_keranjang = $_GET['id'];

        $this->model->hapusKeranjangItem($id_keranjang, $id_user);

        header("Location: ?page=keranjang&status=dihapus");
        exit;
    }

    public function tampilPayment() {
        if (!isset($_SESSION['user'])) {
            header("Location: ?page=login");
            exit;
        }

        $selectedIds = $_POST['pilih_item'] ?? [];

        if (empty($selectedIds)) {
            header("Location: ?page=keranjang&status=gagal&msg=" . urlencode("Pilih minimal satu produk untuk checkout."));
            exit;
        }

        $id_user = $_SESSION['user']['id'];
        $_SESSION['checkout_items'] = array_map('intval', $selectedIds);

        $items = $this->model->getSelectedKeranjangItems($id_user, $_SESSION['checkout_items']);
        $userData = $this->model->getUserById($id_user);

        if (empty($items) || !$userData) {
            header("Location: ?page=keranjang&status=gagal&msg=" . urlencode("Data tidak ditemukan."));
            exit;
        }

        $grandTotal = 0;
        foreach ($items as $item) {
            $grandTotal += $item['subtotal'];
        }

        include 'view/checkout.php';
    }

    public function ubahQty() {
        if (!isset($_SESSION['user'])) {
            header("Location: ?page=login");
            exit;
        }

        $id_user = $_SESSION['user']['id'];
        $id_keranjang = $_GET['id'] ?? 0;
        $aksi = $_GET['aksi'] ?? ''; 

        $this->model->updateQtyKeranjang($id_keranjang, $id_user, $aksi);
        header("Location: ?page=keranjang");
        exit;
    }

    public function prosesBayar() {
        if (!isset($_SESSION['user'])) {
            header("Location: ?page=login");
            exit;
        }

        $selectedIds = $_SESSION['checkout_items'] ?? [];
        if (empty($selectedIds)) {
            header("Location: ?page=keranjang&status=gagal&msg=" . urlencode("Tidak ada item checkout."));
            exit;
        }

        $id_user = $_SESSION['user']['id'];
        $metode = $_POST['metode_pembayaran'] ?? 'Transfer Bank';
        $deadlockMode = isset($_POST['deadlock_mode']) ? 1 : 0;

        $result = $this->model->prosesCheckoutTerpilih($id_user, $selectedIds);
        unset($_SESSION['checkout_items']);

        if ($deadlockMode == 1) {
            header("Location: ?page=deadlock-result&metode=" . urlencode($metode));
            exit;
        }

        if ($result['status']) {
            header("Location: ?page=checkout-selesai&metode=" . urlencode($metode));
        } else {
            header("Location: ?page=keranjang&status=gagal&msg=" . urlencode($result['message']));
        }
        exit;
    }

    public function tampilDeadlockResult() {
        if (!isset($_SESSION['user'])) {
            header("Location: ?page=login");
            exit;
        }
        $metode = $_GET['metode'] ?? 'Transfer Bank';
        include 'view/deadlock.php';
    }

    public function tampilSelesai() {
        if (!isset($_SESSION['user'])) {
            header("Location: ?page=login");
            exit;
        }
        $metode = $_GET['metode'] ?? 'Transfer Bank';
        include 'view/CheckoutSelesai.php';
    }

    public function tampilTracking() {
        if (!isset($_SESSION['user'])) {
            header("Location: ?page=login");
            exit;
        }

        $id_user = $_SESSION['user']['id'];
        // Pastikan variabel ini konsisten
        $id_cari = $_GET['id'] ?? '';

        $riwayat = $this->model->getRiwayatByUser($id_user);

        $data_detail = null;
        if (!empty($riwayat)) {
            foreach ($riwayat as $r) {
                // SESUAIKAN: Gunakan 'id_pesanan' sesuai View di database kamu
                // Gunakan variabel $id_cari yang sudah didefinisikan di atas
                if ($r['id_pesanan'] == $id_cari) {
                    $data_detail = $r;
                    break;
                }
            }
        }

        include 'view/tracking.php';
    }
}
?>