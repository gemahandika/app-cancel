<?php

class Auth extends Controller
{

    public function index()
    {
        if (isset($_SESSION['user'])) {
            header('Location: ' . BASEURL . '/home');
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
            // Tambahkan ini untuk debug
            file_put_contents('session_debug.log', print_r($_SESSION, true));
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
        session_unset();  // Menghapus semua variabel session
        session_destroy(); // Menghancurkan session
        header('Location: ' . BASEURL . '/auth');
        exit;
    }
}
