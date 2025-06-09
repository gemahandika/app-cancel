<?php
require_once '../app/core/Flasher.php';
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


    public function tambah()
    {
        // Ambil langsung dari session
        $_POST['user_id'] = $_SESSION['username']; // karena yang disimpan adalah $_SESSION['username']
        $_POST['name'] = $_SESSION['name']; // sesuaikan jika ada

        $result = $this->model('Resi_models')->tambahDataResi($_POST);

        if ($result === 'duplicate') {
            Flasher::setFlash('Opppss!!', 'Resi sudah pernah ditambahkan', 'error');
            header('Location: ' . BASE_URL . '/home');
            exit;
        }

        if ($result > 0) {
            Flasher::setFlash('Resi Berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASE_URL . '/home');
            exit;
        } else {
            Flasher::setFlash('Resi Gagal', 'ditambahkan', 'error');
            header('Location: ' . BASE_URL . '/home');
            exit;
        }
    }
}
