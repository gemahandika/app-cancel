<?php

class Dashboard extends Controller
{
    public function index()
    {
        session_start();

        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASEURL . '/login');
            exit;
        }

        $this->view('dashboard/index');
    }
}
