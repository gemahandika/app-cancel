<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (!session_id()) session_start();


// index.php atau bootstrap.php
require_once 'app/core/Autoloader.php';

// Registrasikan autoload
Autoloader::register();

// Lanjutkan dengan inisialisasi aplikasi
$app = new App();
