<?php

class Database
{
    private $dbh, $stmt;

    public function __construct()
    {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
        $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        try {
            $this->dbh = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            $type = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute()
    {
        $this->stmt->execute();
    }

    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
}
