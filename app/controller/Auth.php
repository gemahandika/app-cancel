<?php

require_once '../app/core/Flasher.php';
require_once '../app/models/User_models.php';

class Auth
{
    public function index()
    {
        if (isset($_SESSION['login'])) {
            header('Location: ' . BASE_URL . '/home');
            exit;
        }
        require_once '../app/views/auth/index.php';
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
            Flasher::setLoginFlash('Login berhasil sebagai ' . $user['role'], 'success');
            header('Location: ' . BASE_URL . '/home');
            exit;
        } else {
            Flasher::setLoginFlash('Username atau password salah.', 'danger');
            header('Location: ' . BASE_URL . '/auth');
            exit;
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: ' . BASE_URL . '/auth');
        exit;
    }
}
