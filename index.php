<?php


if (!session_id()) session_start();

require_once '../app/init.php';

echo '<pre>';
print_r($_GET);
echo '</pre>';
exit;
