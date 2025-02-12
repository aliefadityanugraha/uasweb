<?php

require_once '../config/Database.php';

class Order {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAll() {
        $result = $this->db->query("SELECT * FROM orders");

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        return [];
    }

    public function getByOrderId($orderId) {
        $query = $this->db->prepare("SELECT * FROM orders WHERE order_ID = ?");

        if ($query) {
            $query->bind_param("i", $orderId);
            $query->execute();
            $result = $query->get_result();
            return $result->fetch_assoc();
        }

        return null;
    }

    public function insert($orderItems, $orderTotal, $userId) {
        $query = $this->db->prepare("INSERT INTO orders (order_items, order_total, user_ID) VALUES (?, ?, ?)");

        if ($query) {
            $query->bind_param("sdi", $orderItems, $orderTotal, $userId);
            return $query->execute();
        }

        return false;
    }

    public function update($orderId, $orderItems, $orderTotal, $userId = null) {
        $query = $this->db->prepare("UPDATE orders SET order_items = ?, order_total = ?, user_ID = ? WHERE order_ID = ?");

        if ($query) {
            $query->bind_param("sdii", $orderItems, $orderTotal, $userId, $orderId);
            return $query->execute();
        }

        return false;
    }

    // Delete an order by ID
    public function delete($orderId) {
        $query = $this->db->prepare("DELETE FROM orders WHERE order_ID = ?");

        if ($query) {
            $query->bind_param("i", $orderId);
            return $query->execute();
        }

        return false;
    }
}
