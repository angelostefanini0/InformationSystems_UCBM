<?php

require_once __DIR__ . '/connection.php';

if (!is_logged_in()) {
    redirect('../checkout.php?message=' . urlencode('Please login or register to place an order.'));
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['place_order'])) {
    redirect('../checkout.php');
}

if (empty($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    redirect('../cart.php');
}

$phone = trim($_POST['phone'] ?? '');
$city = trim($_POST['city'] ?? '');
$address = trim($_POST['address'] ?? '');
$userId = (int) $_SESSION['user_id'];
$orderStatus = 'on hold';
$orderDate = date('Y-m-d H:i:s');

if ($phone === '' || $city === '' || $address === '') {
    redirect('../checkout.php?message=' . urlencode('Please complete all shipping fields.'));
}

mysqli_begin_transaction($conn);

try {
    $productStatement = $conn->prepare(
        'SELECT product_price FROM products WHERE product_id = ?'
    );
    $databasePrices = [];

    foreach (array_keys($_SESSION['cart']) as $productId) {
        $productId = (int) $productId;
        $productStatement->bind_param('i', $productId);
        $productStatement->execute();
        $product = $productStatement->get_result()->fetch_assoc();

        if ($product) {
            $databasePrices[$productId] = (float) $product['product_price'];
        }
    }

    $orderCost = 0.0;
    foreach ($_SESSION['cart'] as $productId => $product) {
        $productId = (int) $productId;
        if (!isset($databasePrices[$productId])) {
            throw new RuntimeException('A product in the cart is no longer available.');
        }

        $quantity = max(1, (int) ($product['product_quantity'] ?? 1));
        $orderCost += $databasePrices[$productId] * $quantity;
    }

    $orderStatement = $conn->prepare(
        'INSERT INTO orders
            (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date)
         VALUES (?, ?, ?, ?, ?, ?, ?)'
    );
    $orderStatement->bind_param(
        'dsissss',
        $orderCost,
        $orderStatus,
        $userId,
        $phone,
        $city,
        $address,
        $orderDate
    );
    $orderStatement->execute();
    $orderId = $orderStatement->insert_id;

    $itemStatement = $conn->prepare(
        'INSERT INTO order_items (order_id, product_id, product_quantity) VALUES (?, ?, ?)'
    );

    foreach ($_SESSION['cart'] as $productId => $product) {
        $productId = (int) $productId;
        $quantity = max(1, (int) ($product['product_quantity'] ?? 1));
        $itemStatement->bind_param('iii', $orderId, $productId, $quantity);
        $itemStatement->execute();
    }

    mysqli_commit($conn);

    $_SESSION['order_id'] = $orderId;
    $_SESSION['order_status'] = $orderStatus;
    $_SESSION['order_total_price'] = $orderCost;
    $_SESSION['total'] = $orderCost;

    redirect('../payment.php?order_status=' . urlencode('Order placed successfully.'));
} catch (Throwable $exception) {
    mysqli_rollback($conn);
    redirect('../checkout.php?message=' . urlencode('The order could not be created. Please try again.'));
}
