<?php
class Super_admin extends Controller
{
    public function index()
    {
        session_start();
        if ($_SESSION['user']['role'] !== 'super_admin') {
            die('Akses ditolak.');
        }

        $this->view('templates/header');
        echo "<h2>Dashboard Super Admin</h2>";
        $this->view('templates/footer');
    }
}
