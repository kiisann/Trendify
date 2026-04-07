<?php
class TransaksiModel {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function getUserById($id_user) {
        $stmt = $this->db->prepare("
            SELECT id_user, nama, email, alamat
            FROM user
            WHERE id_user = ?
        ");
        $stmt->execute([$id_user]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // VIEW TRANSAKSI USER
    public function getRiwayatByUser($id_user) {
        $sql = "
            SELECT *
            FROM view_transaksi
            WHERE id_user = :id_user
            ORDER BY tanggal DESC, id_pesanan DESC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id_user' => $id_user]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getKeranjangByUser($id_user) {
        $sql = "SELECT 
                    k.id_keranjang,
                    k.id_produk,
                    p.nama,
                    p.harga,
                    p.stok,
                    p.gambar,
                    k.jumlah,
                    hitung_total(k.jumlah, p.harga) AS subtotal 
                FROM keranjang k
                INNER JOIN produk p ON k.id_produk = p.id_produk
                WHERE k.id_user = :id_user
                ORDER BY k.id_keranjang DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id_user' => $id_user]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function hapusKeranjangItem($id_keranjang, $id_user) {
        $stmt = $this->db->prepare("
            DELETE FROM keranjang
            WHERE id_keranjang = ? AND id_user = ?
        ");
        return $stmt->execute([$id_keranjang, $id_user]);
    }

    public function updateQtyKeranjang($id_keranjang, $id_user, $aksi) {
        $stmt = $this->db->prepare("SELECT jumlah FROM keranjang WHERE id_keranjang = ? AND id_user = ?");
        $stmt->execute([$id_keranjang, $id_user]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) return false;

        $jumlahBaru = $data['jumlah'];
        if ($aksi == 'tambah') {
            $jumlahBaru++; 
        } elseif ($aksi == 'kurang' && $data['jumlah'] > 1) {
            $jumlahBaru--;
        }

        $update = $this->db->prepare("UPDATE keranjang SET jumlah = ? WHERE id_keranjang = ?");
        return $update->execute([$jumlahBaru, $id_keranjang]);
    }

    public function getSelectedKeranjangItems($id_user, $selectedIds) {
        if (empty($selectedIds)) return [];

        $selectedIds = array_map('intval', $selectedIds);
        $placeholders = implode(',', array_fill(0, count($selectedIds), '?'));

        $sql = "
            SELECT 
                k.id_keranjang,
                k.id_produk,
                p.nama,
                p.harga,
                p.stok,
                p.gambar,
                k.jumlah,
                hitung_total(k.jumlah, p.harga) AS subtotal
            FROM keranjang k
            JOIN produk p ON k.id_produk = p.id_produk
            WHERE k.id_user = ?
            AND k.id_keranjang IN ($placeholders)
            ORDER BY k.id_keranjang DESC
        ";

        $params = array_merge([$id_user], $selectedIds);
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function prosesCheckoutTerpilih($id_user, $selectedIds) {
        if (empty($selectedIds)) {
            return ['status' => false, 'message' => 'Pilih minimal satu item untuk checkout'];
        }

        try {
            $this->db->beginTransaction();

            $selectedIds = array_map('intval', $selectedIds);
            $placeholders = implode(',', array_fill(0, count($selectedIds), '?'));

            $sql = "
                SELECT k.id_keranjang, k.id_produk, k.jumlah, p.nama, p.harga, p.stok
                FROM keranjang k
                JOIN produk p ON k.id_produk = p.id_produk
                WHERE k.id_user = ? AND k.id_keranjang IN ($placeholders)
            ";

            $params = array_merge([$id_user], $selectedIds);
            $stmtItems = $this->db->prepare($sql);
            $stmtItems->execute($params);
            $items = $stmtItems->fetchAll(PDO::FETCH_ASSOC);

            if (empty($items)) throw new Exception("Item keranjang tidak ditemukan");
    
            $stmtPesanan = $this->db->prepare("
                INSERT INTO pesanan (id_user, tanggal, status)
                VALUES (?, CURDATE(), 'dikemas')
            ");
            $stmtPesanan->execute([$id_user]);
            $id_pesanan = $this->db->lastInsertId();

            $stmtDetail = $this->db->prepare("
                INSERT INTO detail_pesanan (id_pesanan, id_produk, jumlah)
                VALUES (?, ?, ?)
            ");

            $stmtUpdateStok = $this->db->prepare("
                UPDATE produk SET stok = stok - ? WHERE id_produk = ?
            ");

            foreach ($items as $item) {
                if ($item['stok'] < $item['jumlah']) {
                    throw new Exception("Stok produk '{$item['nama']}' tidak cukup.");
                }

                $stmtDetail->execute([$id_pesanan, $item['id_produk'], $item['jumlah']]);
                $stmtUpdateStok->execute([$item['jumlah'], $item['id_produk']]);
            }

            $selectedKeranjangIds = array_column($items, 'id_keranjang');
            $deletePlaceholders = implode(',', array_fill(0, count($selectedKeranjangIds), '?'));
            $sqlDelete = "DELETE FROM keranjang WHERE id_user = ? AND id_keranjang IN ($deletePlaceholders)";
            
            $stmtDelete = $this->db->prepare($sqlDelete);
            $stmtDelete->execute(array_merge([$id_user], $selectedKeranjangIds));

            $this->db->commit();
            return ['status' => true, 'message' => 'Transaksi berhasil'];

        } catch (Exception $e) {
            if ($this->db->inTransaction()) $this->db->rollBack();
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }
}