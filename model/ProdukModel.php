<?php
class ProdukModel {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function tampil() {
        $stmt = $this->db->query("CALL select_produk()");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $data;
    }

    public function getRekomendasi() {
        $sql = "SELECT nama, harga FROM produk WHERE harga > 100000
                UNION
                SELECT nama, harga FROM produk WHERE stok < 5";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRekomendasiUnionAll() {
        $sql = "SELECT nama, harga FROM produk WHERE harga > 100000
                UNION ALL
                SELECT nama, harga FROM produk WHERE stok < 5";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function tambah($nama, $harga, $stok, $id_kategori) {
        $stmt = $this->db->prepare("CALL insert_produk(?, ?, ?, ?)");
        $result = $stmt->execute([$nama, $harga, $stok, $id_kategori]);
        $stmt->closeCursor();
        return $result;
    }

    public function ubah($id, $nama, $harga, $stok) {
        $stmt = $this->db->prepare("CALL update_produk(?, ?, ?, ?)");
        $result = $stmt->execute([$id, $nama, $harga, $stok]);
        $stmt->closeCursor();
        return $result;
    }

    public function delete($id) {
        $stmt = $this->db->prepare("CALL delete_produk(?)");
        $result = $stmt->execute([$id]);
        $stmt->closeCursor();
        return $result;
    }

    public function tambahKeKeranjang($id_user, $id_produk) {
        $cek = $this->db->prepare("SELECT * FROM keranjang WHERE id_user = ? AND id_produk = ?");
        $cek->execute([$id_user, $id_produk]);
        $data = $cek->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $update = $this->db->prepare("UPDATE keranjang SET jumlah = jumlah + 1 WHERE id_user = ? AND id_produk = ?");
            return $update->execute([$id_user, $id_produk]);
        } else {
            $insert = $this->db->prepare("INSERT INTO keranjang (id_user, id_produk, jumlah) VALUES (?, ?, 1)");
            return $insert->execute([$id_user, $id_produk]);
        }
    }
}
?>