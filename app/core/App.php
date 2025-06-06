
<?php
class App
{
    protected $controller = 'Home'; // Default controller
    protected $method = 'index'; // Default method
    protected $params = [];

    public function __construct()
    {
        // Parse URL
        $url = $this->parseURL();
        var_dump($url); // Debugging: Lihat apakah URL terurai dengan benar
        exit; // Debugging exit point

        // Cek apakah controller ada di direktori app/controllers
        if (isset($url[0]) && file_exists('app/controllers/' . ucfirst($url[0]) . '.php')) {
            $this->controller = ucfirst($url[0]); // Controller yang sesuai
            unset($url[0]); // Hapus controller dari URL
        }

        // Include controller
        require_once 'app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Cek apakah method ada di controller
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1]; // Method yang sesuai
            unset($url[1]); // Hapus method dari URL
        }

        // Param yang akan diteruskan ke method
        $this->params = $url ? array_values($url) : [];

        // Panggil method dengan params yang sesuai
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // Fungsi untuk memparse URL
    public function parseURL()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}
