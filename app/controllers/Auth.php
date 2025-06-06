<?php
class Auth extends Controller
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $model = $this->model('Auth_models');
            $user = $model->checkLogin($username, $password);

            if ($user) {
                session_start();
                $_SESSION['user'] = $user;
                header('Location: ' . BASEURL . '/home/index');
                exit;
            } else {
                $error = "Login gagal!";
            }
        }

        $this->view('Auth/login');
    }
}
