<?php

class Dashboard extends Controller
{
    public function index()
    {
        session_start();
        var_dump($_SESSION); // cek apakah session terbaca
        exit;
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASEURL . '/login');
            exit;
        }

        $this->view('dashboard/index');
    }
}
