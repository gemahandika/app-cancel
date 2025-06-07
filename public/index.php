<?php
ini_set('session.save_path', '/tmp');
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => 'resicancel.jnemedan.com',
    'secure' => false, // ubah ke true jika HTTPS aktif
    'httponly' => true,
]);
session_start();



require_once '../config/config.php';
require_once '../app/core/App.php';
require_once '../app/core/Controller.php';
require_once '../app/core/Database.php';

$app = new App();
