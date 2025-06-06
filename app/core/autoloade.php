<?php

// core/Autoloader.php
class Autoloader
{
    public static function register()
    {
        spl_autoload_register(function ($class) {
            // Jika kelas berada di dalam folder 'core'
            if (file_exists(__DIR__ . '/' . $class . '.php')) {
                require_once __DIR__ . '/' . $class . '.php';
            }
            // Jika kelas berada di dalam folder 'app'
            elseif (file_exists(__DIR__ . '/../app/' . $class . '.php')) {
                require_once __DIR__ . '/../app/' . $class . '.php';
            }
            // Atau tambahkan lebih banyak kondisi berdasarkan struktur folder Anda
        });
    }
}
