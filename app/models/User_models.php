<?php

class User_models
{
    private $conn;

    public function __construct()
    {
        require_once '../app/config/config.php';
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }

    public function getUserByUsername($username)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tb_user WHERE username = ? AND status = 'aktif'");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
