<?php
ini_set('session.cookie_domain', '.jnemedan.com');
if (!session_id()) session_start();

require_once 'core/App.php';
require_once 'core/Controller.php';
require_once 'core/Database.php';
require_once 'core/Flasher.php';
require_once __DIR__ . '/../vendor/autoload.php';

require_once 'config/config.php';
