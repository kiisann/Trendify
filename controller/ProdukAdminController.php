<?php
include_once 'model/ProdukAdminModel.php';

class ProdukAdminController {
    private $model;

    public function __construct($pdo) {
        $this->model = new ProdukAdminModel($pdo);
    }

    // 🔥 HALAMAN UTAMA ADMIN PRODUK
    public function index() {

        // 🔒 PROTEKSI ROLE
        if ($_SESSION['user']['role'] != 'admin') {
            header("Location: ?page=home");
            exit;
        }

        // AMBIL DATA PRODUK
        $data_produk = $this->model->getAll();

        include 'view/ProdukAdmin.php';
    }

    // 🔥 TAMBAH PRODUK
    public function tambah() {
        if (isset($_POST['simpan'])) {

            $nama = $_POST['nama'];
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];
            $id_kategori = $_POST['id_kategori'];

            if ($this->model->insert($nama, $harga, $stok, $id_kategori)) {
                header("Location: ?page=produk-admin&status=success");
                exit;
            }
        }
    }

    // 🔥 UPDATE PRODUK
    public function update() {
        if (isset($_POST['update'])) {

            $id = $_POST['id_produk'];
            $nama = $_POST['nama'];
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];
            $id_kategori = $_POST['id_kategori'];

            if ($this->model->update($id, $nama, $harga, $stok, $id_kategori)) {
                header("Location: ?page=produk-admin&status=updated");
                exit;
            }
        }
    }

    // 🔥 HAPUS PRODUK
    public function delete() {
        if (isset($_GET['id'])) {

            $id = $_GET['id'];

            if ($this->model->delete($id)) {
                header("Location: ?page=produk-admin&status=deleted");
                exit;
            }
        }
    }
}