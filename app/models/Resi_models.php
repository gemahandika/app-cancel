<?php

class Resi_models
{

    private $table = 'tb_resi';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getReportByOpen()
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE status = :status ORDER BY id_resi DESC');
        $this->db->bind(':status', 'OPEN');
        return $this->db->resultSet();
    }

    public function getReportByUserId($userId)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE status = :status AND user_id = :user_id ORDER BY id_resi DESC');
        $this->db->bind(':status', 'OPEN');
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }
}
