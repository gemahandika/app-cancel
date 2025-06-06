<?php

class User extends Database
{
    public function getUserByUsername($username)
    {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
