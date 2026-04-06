<?php
include_once 'model/ProdukAdminModel.php';

class ProdukAdminController {
    private $model;

    public function __construct($pdo) {
        $this->model = new ProdukAdminModel($pdo);
    }

    public function index() {
        if ($_SESSION['user']['role'] != 'admin') {
            header("Location: ?page=home");
            exit;
        }
        $data_produk = $this->model->getAll();

        include 'view/ProdukAdmin.php';
    }

    // TAMBAH PRODUK
    public function tambah() {
        if (isset($_POST['simpan'])) {
            $nama = $_POST['nama'];
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];
            $id_kategori = $_POST['id_kategori'];

            $gambar = null;

            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
                $namaFile = $_FILES['gambar']['name'];
                $tmpFile = $_FILES['gambar']['tmp_name'];

                $ext = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'webp'];

                if (!in_array($ext, $allowed)) {
                    header("Location: ?page=produk-admin&status=error");
                    exit;
                }

                $gambarBaru = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $namaFile);
                $tujuan = 'assets/img/' . $gambarBaru;

                if (move_uploaded_file($tmpFile, $tujuan)) {
                    $gambar = $gambarBaru;
                } else {
                    header("Location: ?page=produk-admin&status=error");
                    exit;
                }
            }

            if ($this->model->insert($nama, $harga, $gambar, $stok, $id_kategori)) {
                header("Location: ?page=produk-admin&status=success");
                exit;
            } else {
                header("Location: ?page=produk-admin&status=error");
                exit;
            }
        }
    }

    // UPDATE PRODUK
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

    // HAPUS PRODUK
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