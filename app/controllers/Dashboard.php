<?php

class Dashboard extends Controller
{
    public function index()
    {

        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASEURL . '/Login');
            exit;
        }

        $this->view('Dashboard/index');
    }
}
