<?php
ini_set('session.save_path', '/tmp');
session_start();

require_once 'app/init.php';

$app = new App;
