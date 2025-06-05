<?php

class User extends Controller
{

    public function __construct()
    {
        echo '<pre>';
        print_r($_SESSION);
        echo '</pre>';
        exit;
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
