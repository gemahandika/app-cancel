<?php

define('BASE_URL', 'http://localhost/app-cancel/public'); // ganti sesuai XAMPP kamu

// Database (opsional jika ingin koneksi database)
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'db_cancel');

// Autoloader sederhana
spl_autoload_register(function ($class) {
    if (file_exists('../app/models/' . $class . '.php')) {
        require_once '../app/models/' . $class . '.php';
    }
});
