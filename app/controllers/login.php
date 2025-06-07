<?php

class login extends Controller
{
    public function index()
    {
        $this->view('login/index');
    }

    public function auth()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->model('User_model')->getUserByUsername($username);

        if ($user && MD5($password, $user['password'])) {
            session_start();
            $_SESSION['user'] = $user;
            header('Location: ' . BASEURL . '/login/dashboard');
        } else {
            echo "Login gagal!";
        }
    }

    public function dashboard()
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASEURL . '/login');
            exit;
        }
        $this->view('login/dashboard');
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: ' . BASEURL . '/login');
    }
}
