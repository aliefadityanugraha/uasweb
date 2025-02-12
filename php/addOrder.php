<?php

require_once '../models/OrderRuwet.php';

session_start();

if (!isset($_SESSION['user']['id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'User not authenticated.'
    ]);
    exit;
}

$orderData = $_POST;

if (!isset($orderData['items']) || !isset($orderData['total'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Order items and total are required.'
    ]);
    exit;
}

$orderItems = json_encode($orderData['items']);
$orderTotal = $orderData['total'];
$userId = $_SESSION['user']['id'];

require_once '../models/OrderRuwet.php';
$ModelOrder = new Order();
$inserted = $ModelOrder->insert(json_decode($orderItems), $orderTotal, $userId);

if ($inserted) {
    echo json_encode([
        'success' => true,
        'message' => 'Order successfully added.'
    ]);

    header('location: /uasweb?page=order');
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to add order.'
    ]);
}