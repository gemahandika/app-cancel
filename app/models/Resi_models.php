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
}
