<?php

// Pastikan model di-include agar class ProdukModel bisa terbaca
include_once 'model/ProdukModel.php';

class ProdukController {
    private $model;

    public function __construct($pdo) {
        $this->model = new ProdukModel($pdo);
    }

    // --- FUNGSI UTAMA UNTUK MENAMPILKAN HALALMAN ---
    public function tampilProduk() {
        // Memanggil fungsi tampil() yang ada di Model (yang isinya CALL select_produk)
        $data_produk = $this->model->tampil();
        
        // Memanggil fungsi getRekomendasi() untuk bagian UNION
        $data_union = $this->model->getRekomendasi();
        
        // Melempar data ke View
        include 'view/produk.php';
    }

    // --- FUNGSI UNTUK PROSES TAMBAH ---
    public function prosesTambah() {
        if (isset($_POST['simpan'])) {
            $nama = $_POST['nama'];
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];
            $id_kategori = $_POST['id_kategori'];

            if ($this->model->tambah($nama, $harga, $stok, $id_kategori)) {
                header("Location: ?page=produk&status=success");
                exit(); // Selalu gunakan exit setelah header location
            }
        }
    }

    // --- FUNGSI UNTUK PROSES HAPUS ---
    public function prosesHapus($id) {
        if ($this->model->hapus($id)) {
            header("Location: ?page=produk&status=deleted");
            exit();
        }
    }
}