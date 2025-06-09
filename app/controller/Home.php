<?php

class Home extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['login'])) {
            header('Location: ' . BASE_URL . '/auth');
            exit;
        }

        $data['judul'] = 'Home';
        $userRole = $_SESSION['role'];     // ✅ PERBAIKI INI
        $username = $_SESSION['username']; // ✅ PERBAIKI INI
        $data['userRole'] = $userRole;

        if ($userRole == 'agen') {
            $data['open'] = $this->model('Resi_models')->getReportByUserId($username);
        } else {
            $data['open'] = $this->model('Resi_models')->getReportByOpen();
        }

        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
}
