<?php
class DashboardAdminModel {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    // Penerapan Built-in Function
    public function totalProduk() {
        return $this->db->query("SELECT COUNT(*) FROM produk")->fetchColumn();
    }

    public function totalUser() {
        return $this->db->query("SELECT COUNT(*) FROM user")->fetchColumn();
    }

    public function totalTransaksi() {
        return $this->db->query("SELECT COUNT(*) FROM pesanan")->fetchColumn();
    }
}