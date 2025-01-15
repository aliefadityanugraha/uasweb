<?php

require_once '../config/Database.php';

class Student {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAll() {
        $sql = "SELECT * FROM datasiswa";
        return $this->db->query($sql);
    }

    public function add($data) {
        $nama = htmlspecialchars($this->db->escape($data["nama"]));
        $email = htmlspecialchars($this->db->escape($data["email"]));
        $nourut = htmlspecialchars($this->db->escape($data["nourut"]));

        $sql = "INSERT INTO datasiswa (id, nama, email, nourut) VALUES (NULL, '$nama', '$email', '$nourut')";
        return $this->db->execute($sql);
    }

    public function delete($id) {
        $sql = "DELETE FROM datasiswa WHERE id = $id";
        return $this->db->execute($sql);
    }

    public function update($data) {
        $id = htmlspecialchars($this->db->escape($data["id"]));
        $nama = htmlspecialchars($this->db->escape($data["nama"]));
        $email = htmlspecialchars($this->db->escape($data["email"]));
        $nourut = htmlspecialchars($this->db->escape($data["nourut"]));

        $sql = "UPDATE datasiswa SET 
                nama = '$nama', 
                email = '$email', 
                nourut = '$nourut'
                WHERE id = $id";
        return $this->db->execute($sql);
    }

    public function search($keyword) {
        $keyword = $this->db->escape($keyword);
        $sql = "SELECT * FROM datasiswa
                WHERE nama LIKE '%$keyword%' OR
                      email LIKE '%$keyword%' OR
                      nourut LIKE '%$keyword%'";
        return $this->db->query($sql);
    }
}
