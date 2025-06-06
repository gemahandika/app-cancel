<?php

class User extends Controller
{

    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
        // Cek role, hanya superadmin dan admin yang boleh akses
        $role = $_SESSION['user']['role'];
        if ($role !== 'superadmin' && $role !== 'admin') {
            header('Location: ' . BASEURL . '/home'); // Ganti '/unauthorized' dengan halaman yang sesuai
            exit;
        }
    }

    public function index()
    {
        $data['judul'] = 'User';
        $userRole = $_SESSION['user']['role'];
        $userId = $_SESSION['user']['username'];
        $data['userRole'] = $userRole; // <-- Tambahkan baris ini
        $data['user'] = $this->model('User_model')->getAllUsers();
        $this->view('templates/header', $data);
        $this->view('user/index', $data);
        $this->view('templates/footer');
    }

    public function tambahUser()
    {
        $result = $this->model('User_model')->tambahDataUser($_POST);

        if ($result === 'duplicate') {
            Flasher::setFlash('Opppss!!', 'User Sudah Ada', 'error');
            header('Location: ' . BASEURL . '/user');
            exit;
        }

        if ($result > 0) {
            Flasher::setFlash('User', 'Berhasil ditambahkan', 'success');
            header('Location: ' . BASEURL . '/user');
            exit;
        } else {
            Flasher::setFlash('User', 'Gagal ditambahkan', 'error');
            header('Location: ' . BASEURL . '/user');
            exit;
        }
    }

    public function editUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $_POST['edit-id'],
                'username' => $_POST['edit-username'],
                'role' => $_POST['edit-role'],
                'name' => $_POST['edit-name'],
                'cust_id' => $_POST['edit-custid'],
                'status' => $_POST['edit-status']
            ];

            $result = $this->model('User_model')->updateDataUser($data);
            if ($result !== false) {
                Flasher::setFlash('User Berhasil', 'diUpdate', 'success');
                header('Location: ' . BASEURL . '/user');
                exit;
            } else {
                Flasher::setFlash('Gagal', 'diUpdate', 'error');
                header('Location: ' . BASEURL . '/user');
                exit;
            }
        }
    }
}
