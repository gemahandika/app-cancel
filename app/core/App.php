<?php
class App
{
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        // Parsing URL
        $url = $this->parseURL();
        var_dump($url);  // Debug: cek hasil parsing
        exit;

        // Menentukan controller
        if (isset($url[0]) && file_exists('app/controllers/' . ucfirst($url[0]) . '.php')) {
            $this->controller = ucfirst($url[0]); // Mengambil controller dari URL
            unset($url[0]);  // Menghapus controller dari URL setelah diproses
        }

        // Memanggil file controller
        require_once 'app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Menentukan method
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1]; // Mengambil method dari URL
            unset($url[1]);  // Menghapus method dari URL setelah diproses
        }

        // Mengambil parameter (sisa URL setelah controller dan method)
        $this->params = $url ? array_values($url) : [];

        // Memanggil method pada controller dengan parameter
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL()
    {
        if (isset($_GET['url'])) {
            // Memecah URL berdasarkan '/' dan membersihkan karakter yang tidak perlu
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}
