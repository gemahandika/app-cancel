<?php

class Home
{
    public function index()
    {
        session_start();
        if (!isset($_SESSION['login'])) {
            header('Location: ' . BASE_URL . '/auth');
            exit;
        }

        require_once '../app/views/templates/header.php';
        require_once '../app/views/home/index.php';
        require_once '../app/views/templates/footer.php';
    }
}
