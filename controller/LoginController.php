<?php
include_once 'model/LoginModel.php';

class LoginController {
    private $model;

    public function __construct($pdo) {
        $this->model = new LoginModel($pdo);
    }

    public function login() {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->model->login($email, $password);

        if ($user) {
            $_SESSION['user'] = [
                'id' => $user['id_user'],
                'nama' => $user['nama'],
                'role' => $user['role'],
                'alamat' => $user['alamat']
            ];

            if ($user['role'] == 'admin') {
                header("Location: ?page=dashboard");
            } else {
                header("Location: ?page=home");
            }
            exit();
        } else {
            header("Location: ?page=login&error=1");
            exit();
        }
    }

    public function logout() {
        session_destroy();
        header("Location: ?page=login");
        exit();
    }
}