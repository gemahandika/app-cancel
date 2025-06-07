<?php

class App
{
    protected $controller = 'Login';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();

        if (isset($url[0]) && file_exists('../app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        echo "Controller: " . $this->controller . "<br>";
        echo "Looking for: " . __DIR__ . '/../controllers/' . $this->controller . '.php' . "<br>";

        if (!file_exists(__DIR__ . '/../controllers/' . $this->controller . '.php')) {
            die('File controller tidak ditemukan!');
        }


        require_once __DIR__ . '/../controllers/' . $this->controller . '.php';

        $this->controller = new $this->controller;

        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}
