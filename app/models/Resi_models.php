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

    public function tambahDataResi($data)
    {

        // Cek apakah resi sudah ada
        $this->db->query('SELECT no_resi FROM ' . $this->table . ' WHERE no_resi = :no_resi AND status = :status');
        $this->db->bind('no_resi', $data['no_resi']);
        $this->db->bind(':status', 'OPEN');
        $this->db->execute();

        if ($this->db->rowCount() > 0) {
            // Username sudah ada
            return 'duplicate';
        }
        $query = "INSERT INTO tb_resi (no_resi, keterangan, status, tgl_req, user_id, nama_agen)
              VALUES (:no_resi, :keterangan, :status, :tgl_req, :user_id, :name)";

        $this->db->query($query);
        $this->db->bind('no_resi', $data['no_resi']);
        $this->db->bind('keterangan', $data['keterangan']);
        $this->db->bind('status', 'OPEN'); // tetap
        $this->db->bind('tgl_req', date('Y-m-d H:i:s')); // otomatis waktu sekarang
        $this->db->bind('user_id', $data['user_id']);
        $this->db->bind('name', $data['name']);

        $this->db->execute();

        return $this->db->rowCount();
    }
}
