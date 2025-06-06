<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Home extends Controller

{
    // public function __construct()
    // {
    //     if (!isset($_SESSION['user'])) {
    //         header('Location: ' . BASEURL . '/auth');
    //         exit;
    //     }
    // }

    public function index()
    {
        $data['judul'] = 'Home';
        $userRole = $_SESSION['user']['role'];
        $username = $_SESSION['user']['username'];
        $data['userRole'] = $userRole; // <-- Tambahkan baris ini
        if ($userRole == 'agen') {
            $data['open'] = $this->model('Report_model')->getReportByUserId($username);
        } else {
            $data['open'] = $this->model('Report_model')->getReportByOpen();
        }
        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        $_POST['user_id'] = $_SESSION['user']['username'];
        $_POST['name'] = $_SESSION['user']['name'];
        // Simpan hasil pemanggilan model ke variabel
        $result = $this->model('Report_model')->tambahDataResi($_POST);

        // Cek jika hasilnya 'duplicate'
        if ($result === 'duplicate') {
            Flasher::setFlash('Opppss!!', 'Resi sudah pernah ditambahkan', 'error');
            header('Location: ' . BASEURL . '/home');
            exit;
        }

        // Cek jika berhasil insert (misal return 1)
        if ($result > 0) {
            Flasher::setFlash('Resi Berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/home');
            exit;
        } else {
            Flasher::setFlash('Resi Gagal', 'ditambahkan', 'error');
            header('Location: ' . BASEURL . '/home');
            exit;
        }
    }
    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id_resi' => $_POST['id_resi'],
                'no_resi' => $_POST['no_resi'],
                'keterangan' => $_POST['keterangan']
            ];

            if ($this->model('Report_model')->updateDataResi($data) > 0) {
                Flasher::setFlash('Resi Berhasil', 'diUpdate', 'success');
                header('Location: ' . BASEURL . '/home'); // sesuaikan route-nya
                exit;
            } else {
                Flasher::setFlash('Gagal', 'diUpdate', 'error');
                header('Location: ' . BASEURL . '/home');
                exit;
            }
        }
    }


    public function kirimEmail()
    {


        $report = $this->model('Report_model')->getReportByOpen();

        $isiEmail = "Dear Team IT Helpdesk:\n";
        $isiEmail .= "Mohon Bantuannya Untuk Mencancel Resi Berikut Ini : \n\n";
        foreach ($report as $item) {
            $isiEmail .= "{$item['no_resi']}\n";
        }
        $isiEmail .= "\n";
        $isiEmail .= "Dikarenakan Petugas Salah Entry \n\n";
        $isiEmail .= "Terima Kasih \n";
        $isiEmail .= "Gemasyah Handika\n";
        $isiEmail .= "IT JNE MEDAN\n";
        $mail = new PHPMailer(true);

        try {
            // Server SMTP Outlook atau Office365
            $mail->isSMTP();
            $mail->Host = 'smtp.office365.com';
            $mail->SMTPAuth = true;
            $mail->Username = EMAIL_USER;  // dari config_email.php
            $mail->Password = EMAIL_PASS;  // dari config_email.php
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('mes.it2@jne.co.id', 'IT JNE MES');
            $mail->addAddress('mes.it@jne.co.id', 'Helpdesk'); // Ganti tujuan

            $mail->Subject = 'Cancel Resi Orion Hybrid';
            $mail->Body    = $isiEmail;

            $mail->send();

            // ✅ Tambahkan baris ini untuk update status resi
            $this->model('Report_model')->ubahStatusOpenMenjadiDone();

            Flasher::setFlash('Resi Berhasil', 'DiEmail ke Helpdesk', 'success');
            header('Location: ' . BASEURL . '/home');
        } catch (Exception $e) {
            Flasher::setFlash('Gagal', 'DiEmail ke Helpdesk', 'danger');
            header('Location: ' . BASEURL . '/home');
            exit;
        }
    }
}
