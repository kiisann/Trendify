<?php
class ProdukAdminModel {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    // SELECT PRODUK (Stored Procedure)
    public function getAll() {
    $sql = "CALL select_produk()"; 
    $stmt = $this->db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    // INSERT PRODUK (Stored Procedure)
    public function insert($nama, $harga, $gambar, $stok, $id_kategori) {
        $sql = "CALL insert_produk(?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nama, $harga, $gambar, $stok, $id_kategori]);
    }

    // UPDATE PRODUK (Stored Procedure)
    public function update($id, $nama, $harga, $stok, $id_kategori) {
        $sql = "CALL update_produk(?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id, $nama, $harga, $stok, $id_kategori]);
    }

    // DELETE PRODUK (Stored Procedure)
    public function delete($id) {
        $sql = "CALL delete_produk(?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
}