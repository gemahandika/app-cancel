<?php
require_once 'app/controller/AuthController.php';

class App
{
    public function __construct()
    {
        $url = $_GET['url'] ?? 'login';

        switch ($url) {
            case 'login':
                $auth = new AuthController();
                $auth->login();
                break;
            case 'logout':
                $auth = new AuthController();
                $auth->logout();
                break;
            case 'dashboard':
                if (!isset($_SESSION['user'])) {
                    header("Location: /login");
                    exit;
                }
                include 'app/view/dashboard/index.php';
                break;
            default:
                echo "404 - Halaman tidak ditemukan";
        }
    }
}
