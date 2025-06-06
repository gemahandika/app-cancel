
<?php
class Auth_models
{
    private $db;

    public function __construct()
    {
        //    require_once __DIR__ . '/../core/Database.php';
        $this->db = new Database;
    }

    public function checkLogin($username, $password)
    {
        $this->db->query("SELECT * FROM tb_user WHERE username = :username AND password = :password");
        $this->db->bind(':username', $username);
        $this->db->bind(':password', md5($password)); // <- md5 hash
        return $this->db->single();
    }
}
