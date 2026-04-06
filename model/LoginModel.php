<?php
class LoginModel {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function login($email, $password) {
        $sql = "SELECT * FROM user 
                WHERE email = :email 
                AND password = :password";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'email' => $email,
            'password' => $password
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}