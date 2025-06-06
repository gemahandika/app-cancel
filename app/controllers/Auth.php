<?php

class Auth extends Controller
{

    public function index()
    {
        if (isset($_SESSION['user'])) {
            header('Location: ' . BASEURL . '/user');
            exit;
        }
        $this->view('auth/login');
    }

    public function login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->model('User_model')->getUserByUsername($username);

        if ($user && md5($password) === $user['password']) {
            if ($user['status'] === 'nonaktif') {
                Flasher::setLoginFlash('Akun dinonaktifkan', 'danger');
                header('Location: ' . BASEURL . '/auth');
                exit;
            }

            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role'],
                'name' => $user['name']
            ];

            Flasher::setLoginFlash('Login berhasil sebagai ' . $user['role'], 'success');
            header('Location: ' . BASEURL . '/home');
            exit;
        } else {
            Flasher::setLoginFlash('Username atau password salah.', 'danger');
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }
    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();

        echo "Logout berhasil"; // Untuk memastikan method dipanggil
        header('Location: ' . BASEURL . '/auth');
        exit;
    }
}
