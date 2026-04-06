<?php
include_once 'model/DashboardAdminModel.php';


class DashboardAdminController {
    private $model;

    public function __construct($pdo) {
        $this->model = new DashboardAdminModel($pdo);
    }

    public function index() {
        $totalProduk = $this->model->totalProduk();
        $totalUser = $this->model->totalUser();
        $totalTransaksi = $this->model->totalTransaksi();

        include 'view/DashboardAdmin.php';
    }

}