<?php

require_once './config/Database.php';

class Product {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAll() {
        $result = $this->db->query("SELECT * FROM products");

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        return [];
    }

    public function getByProductId($productId) {
        $query = $this->db->prepare("SELECT * FROM products WHERE product_ID = ?");

        if ($query) {
            $query->bind_param("i", $productId);
            $query->execute();
            $result = $query->get_result();
            return $result->fetch_assoc();
        }

        return null;
    }

    public function insert($productName, $description, $price, $stock, $category, $image_URL) {
        

        $query = $this->db->prepare("INSERT INTO products (product_name, description, price, stock, category, image_URL) VALUES (?, ?, ?, ?, ?, ?)");

        if ($query) {
            $query->bind_param("ssdiss", $productName, $description, $price, $stock, $category, $image_URL);
            return $query->execute();
        }

        return false;
    }

    public function update($productId, $productName, $description, $price, $stock, $category, $image_URL) {

        $query = $this->db->prepare("UPDATE products SET product_name = ?, description = ?, price = ?, stock = ?, category = ?, image_URL = ? WHERE product_id = ?");
    
        if ($query) {
            $query->bind_param("ssdissi", $productName, $description, $price, $stock, $category, $image_URL, $productId);
            return $query->execute();
        }
    
        return false;
    }

    public function delete($productId) {

        $query = $this->db->prepare("DELETE FROM products WHERE product_id = ?");
    
        if ($query) {
            $query->bind_param("i", $productId);
            return $query->execute();
        }
    
        return false;
    }
}