<?php
include_once 'model/ProdukModel.php';

class ProdukController {
    private $model;

    public function __construct($pdo) {
        $this->model = new ProdukModel($pdo);
    }

    public function tampilProduk() {
        $data_produk = $this->model->tampil();
        $data_union = $this->model->getRekomendasi();

        include 'view/produk.php';
    }

    public function prosesTambah() {
        if (isset($_POST['simpan'])) {
            $nama = $_POST['nama'];
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];
            $id_kategori = $_POST['id_kategori'];

            if ($this->model->tambah($nama, $harga, $stok, $id_kategori)) {
                header("Location: ?page=produk&status=success");
                exit();
            }
        }
    }

    public function prosesHapus($id) {
        if ($this->model->hapus($id)) {
            header("Location: ?page=produk&status=deleted");
            exit();
        }
    }

    public function tambahKeKeranjang() {
        if (!isset($_SESSION['user'])) {
            header("Location: ?page=login");
            exit;
        }

        if (!isset($_POST['id_produk'])) {
            header("Location: ?page=produk");
            exit;
        }

        $id_user = $_SESSION['user']['id'];
        $id_produk = $_POST['id_produk'];

        $this->model->tambahKeKeranjang($id_user, $id_produk);

        header("Location: ?page=keranjang&status=ditambahkan");
        exit;
    }
}
?>