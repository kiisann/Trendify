<?php
include_once 'model/TransaksiModel.php';

class TransaksiController {
    private $model;

    public function __construct($pdo) {
        $this->model = new TransaksiModel($pdo);
    }

    public function tampilRiwayat($id_user) {
        $riwayat = $this->model->getRiwayatByUser($id_user);
        include 'view/riwayat.php'; // Data $riwayat akan otomatis terbaca di file ini
    }
}