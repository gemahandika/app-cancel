<?php

require_once '../app/models/User_models.php';

class Auth
{
    public function index()
    {
        if (isset($_SESSION['login'])) {
            header('Location: ' . BASE_URL . '/home');
            exit;
        }
        require_once '../app/views/templates/header.php';
        require_once '../app/views/auth/index.php';
        require_once '../app/views/templates/footer.php';
    }

    public function login()
    {
        session_start();
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $model = new User_models();
        $user = $model->getUserByUsername($username);

        if ($user && md5($password) === $user['password']) {
            $_SESSION['login'] = true;
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['name'] = $user['name'];

            header('Location: ' . BASE_URL . '/home');
            exit;
        } else {
            $_SESSION['error'] = 'Username atau password salah';
            header('Location: ' . BASE_URL . '/auth');
            exit;
        }
    }
}
