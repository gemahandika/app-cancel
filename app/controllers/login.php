<?php

class Login extends Controller
{
    public function index()
    {
        session_start();
        if (isset($_SESSION['user'])) {
            header('Location: ' . BASEURL . '/dashboard');
            exit;
        }

        $this->view('login/index');
    }

    public function auth()
    {
        session_start();
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->model('User_model')->getUserByUsername($username);

        if ($user && md5($password) === $user['password']) {
            $_SESSION['user'] = $user;
            header('Location: ' . BASEURL . '/dashboard');
            exit;
        } else {
            echo "Login gagal!";
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: ' . BASEURL . '/login');
        exit;
    }
}
