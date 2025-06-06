<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (!session_id()) session_start();

require_once 'app/init.php';

echo '<pre>';
print_r($_GET);
echo '</pre>';
exit;
