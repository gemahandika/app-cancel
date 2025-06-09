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
        $userRole = $_SESSION['role'];
        $username = $_SESSION['username'];
        $name = $_SESSION['name'];

        $data['userRole'] = $userRole;
        $data['username'] = $username;
        $data['name'] = $name;

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
