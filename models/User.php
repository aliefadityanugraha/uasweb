<?php

require_once './config/Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAll() {
        $result = $this->db->query("SELECT * FROM users");

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        return [];
    }

    public function getByEmail($email) {
        $query = $this->db->prepare("SELECT * FROM users WHERE email = ?");

        if ($query) {
            $query->bind_param("s", $email);
            $query->execute();
            $result = $query->get_result();
            return $result->fetch_assoc();
        }

        return null;
    }

    public function insert($email, $password) {

        $username = "";
        $role = "user";

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $query = $this->db->prepare("INSERT INTO users (email, password, username, role) VALUES (?, ?, ?, ?)");

        if ($query) {
            $query->bind_param("ssss", $email, $hashedPassword, $username, $role);
            return $query->execute();
        }

        return false;
    }

    public function update($email, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        
        $query = $this->db->prepare("UPDATE users SET password = ? WHERE email = ?");

        if ($query) {
            $query->bind_param("ss", $hashedPassword, $email);
            return $query->execute();
        }

        return false;
    }

    public function delete($email) {
        $query = $this->db->prepare("DELETE FROM users WHERE email = ?");

        if ($query) {
            $query->bind_param("s", $email);
            return $query->execute();
        }

        return false;
    }
}