<?php

require_once './models/Order.php';

class OrderController {
    private $ModelOrder;

    public function __construct() {
        $this->ModelOrder = new Order();
    }

    public function addOrder($orderData) {

        if (!isset($orderData['order_items']) || !isset($orderData['order_total'])) {
            return [
                'success' => false,
                'message' => 'Order items and total are required.'
            ];
        }

        $orderItems = json_encode($orderData['order_items']);
        $orderTotal = $orderData['order_total'];
        $userId = $_SESSION['user']['id'];

        $inserted = $this->ModelOrder->insert($orderItems, $orderTotal, $userId);

        if ($inserted) {
            return [
                'success' => true,
                'message' => 'Order successfully added.'
            ];
        }

        return [
            'success' => false,
            'message' => 'Failed to add order.'
        ];
    }

    public function getMyOrder() {

        $userId = $_SESSION['user']['id'];
        
        $myorder = $this->ModelOrder->getByUserId($userId);

        return require_once './views/order.php';
    }

    public function getAllOrderView() {
        $orders = $this->ModelOrder->getAll();

        return require_once './views/dashboard/order.php';
    }

    public function aprovalStatus($data) {
        $status = $data['status'];
        $orderId = $data['order_id'];

        $result = $this->ModelOrder->updateAprovalStatus((int)$orderId, $status);

        return header('location: /uasweb/?page=dashboard-order');

    }
}
