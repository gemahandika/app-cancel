<?php

require_once 'app/model/User.php';

class AuthController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->userModel->getUserByUsername($username);

            if ($user) {
                if ($user['status'] !== 'aktif') {
                    $error = "Akun Anda nonaktif.";
                } elseif ($user['password'] !== $password) { // sebaiknya pakai hash
                    $error = "Password salah.";
                } else {
                    $_SESSION['user'] = [
                        'username' => $user['username'],
                        'name' => $user['name'],
                        'nik' => $user['nik'],
                        'role' => $user['role'],
                        'status' => $user['status']
                    ];
                    header("Location: /dashboard");
                    exit;
                }
            } else {
                $error = "User tidak ditemukan.";
            }

            include 'app/view/auth/login.php';
        } else {
            include 'app/view/auth/login.php';
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location: /login");
    }
}
