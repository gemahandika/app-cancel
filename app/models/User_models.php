<?php

class User_models
{
    private $db;
    private $table = 'tb_user';

    public function __construct()
    {
        require_once '../app/config/config.php';
        $this->db = new Database();
    }

    public function getUserByUsername($username)
    {
        $this->db->query("SELECT * FROM {$this->table} WHERE username = :username AND status = 'aktif'");
        $this->db->bind(':username', $username);
        return $this->db->single();
    }

    public function getAllUsers()
    {
        $this->db->query("SELECT * FROM {$this->table}");
        return $this->db->resultSet();
    }

    public function tambahDataUser($data)
    {
        // Cek apakah username sudah ada
        $this->db->query("SELECT username FROM {$this->table} WHERE username = :username");
        $this->db->bind('username', $data['username']);
        $this->db->execute();

        if ($this->db->rowCount() > 0) {
            // Username sudah ada
            return 'duplicate';
        }
        $query = "INSERT INTO {$this->table} (username, password, role, name, cust_id, status)
              VALUES (:username, :password, :role, :name, :cust_id, :status)";

        $this->db->query($query);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', md5($data['password']));
        $this->db->bind('role', $data['role']); // tetap
        $this->db->bind('name', $data['name']); // otomatis waktu sekarang
        $this->db->bind('cust_id', $data['cust_id']);
        $this->db->bind('status', 'aktif');

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateDataUser($data)
    {
        $query = "UPDATE {$this->table}
              SET username = :username,
                  role = :role,
                  name = :name,
                  cust_id = :cust_id,
                  status = :status
               WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('username', $data['username']);
        $this->db->bind('role', $data['role']);
        $this->db->bind('name', $data['name']);
        $this->db->bind('cust_id', $data['cust_id']);
        $this->db->bind('status', $data['status']);
        $this->db->bind('id', $data['id']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateStatus($id, $status)
    {
        $this->db->query("UPDATE {$this->table} SET status = :status WHERE id = :id");
        $this->db->bind('status', $status);
        $this->db->bind('id', $id);
        return $this->db->execute();
    }
}
