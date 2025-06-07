<?php

define('BASE_URL', 'https://appcancel.jnemedan.com');


// Database (opsional jika ingin koneksi database)
define('DB_HOST', 'localhost');
define('DB_USER', 'jnee6778_mesit');
define('DB_PASS', 'Jnemes2017');
define('DB_NAME', 'jnee6778_db_cancel');

// Autoloader sederhana
spl_autoload_register(function ($class) {
    if (file_exists('../app/models/' . $class . '.php')) {
        require_once '../app/models/' . $class . '.php';
    }
});
