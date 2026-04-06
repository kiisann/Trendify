<?php
class TransaksiModel {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function getRiwayatByUser($id_user) {
        // Penerapan Materi PDT JOIN 3 TABEL
        $sql = "SELECT p.tanggal, pr.nama as nama_produk, dp.jumlah, pr.harga, p.status 
                FROM pesanan p
                JOIN detail_pesanan dp ON p.id_pesanan = dp.id_pesanan
                JOIN produk pr ON dp.id_produk = pr.id_produk
                WHERE p.id_user = :id_user
                ORDER BY p.tanggal DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id_user' => $id_user]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}