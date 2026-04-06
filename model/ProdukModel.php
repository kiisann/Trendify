<?php
class ProdukModel {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    // 1. Ambil Data (Penting!)
    public function tampil() {
        $sql = "CALL select_produk()";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Menerapkan UNION
    public function getRekomendasi() {
        $sql = "SELECT nama, harga FROM produk WHERE harga > 100000
                UNION
                SELECT nama, harga FROM produk WHERE stok < 5";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 2. Tambah Data
    public function tambah($nama, $harga, $stok, $id_kategori) {
        $sql = "CALL insert_produk(?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nama, $harga, $stok, $id_kategori]);
    }

    // 3. Update Data
    public function ubah($id, $nama, $harga, $stok) {
        $sql = "CALL update_produk(?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id, $nama, $harga, $stok]);
    }

    // 4. Hapus Data
    public function hapus($id) {
        $sql = "CALL delete_produk(?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
}