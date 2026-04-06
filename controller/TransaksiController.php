<?php
include_once 'model/TransaksiModel.php';

class TransaksiController {
    private $model;

    public function __construct($pdo) {
        $this->model = new TransaksiModel($pdo);
    }

    public function tampilRiwayat() {
        if (!isset($_SESSION['user'])) {
            header("Location: ?page=login");
            exit;
        }

        $id_user = $_SESSION['user']['id'];

        $riwayat = $this->model->getRiwayatByUser($id_user);
        include 'view/riwayat.php';
    }
}