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
        if (!session_id()) session_start();
        session_unset();
        session_destroy();

        // Hapus cookie PHPSESSID agar benar-benar bersih
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        header('Location: ' . BASEURL . '/auth');
        exit;
    }
}
