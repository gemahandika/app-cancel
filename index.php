<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// ini_set('session.cookie_domain', 'resicancel.jnemedan.com');
ini_set('session.cookie_secure', '1');  // Hanya menggunakan HTTPS untuk cookie

if (!session_id()) session_start();

require_once 'app/init.php';

$app = new App;
