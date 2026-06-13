<?php

require_once __DIR__ . '/connection.php';

if (!is_logged_in()) {
    redirect('../login.php');
}

$transactionId = trim($_GET['transaction_id'] ?? '');
$orderId = (int) ($_GET['order_id'] ?? 0);
$userId = (int) $_SESSION['user_id'];

if ($transactionId === '' || $orderId <= 0) {
    redirect('../account.php?error=' . urlencode('Invalid payment response.'));
}

mysqli_begin_transaction($conn);

try {
    $orderStatus = 'paid';
    $orderStatement = $conn->prepare(
        "UPDATE orders
         SET order_status = ?
         WHERE order_id = ? AND user_id = ? AND order_status = 'on hold'"
    );
    $orderStatement->bind_param('sii', $orderStatus, $orderId, $userId);
    $orderStatement->execute();

    if ($orderStatement->affected_rows !== 1) {
        throw new RuntimeException('Order not found or already paid.');
    }

    $paymentDate = date('Y-m-d H:i:s');
    $paymentStatement = $conn->prepare(
        'INSERT INTO payments (order_id, user_id, transaction_id, date_payment)
         VALUES (?, ?, ?, ?)'
    );
    $paymentStatement->bind_param('iiss', $orderId, $userId, $transactionId, $paymentDate);
    $paymentStatement->execute();

    mysqli_commit($conn);

    unset(
        $_SESSION['cart'],
        $_SESSION['quantity'],
        $_SESSION['total'],
        $_SESSION['order_id'],
        $_SESSION['order_status'],
        $_SESSION['order_total_price']
    );

    redirect('../account.php?payment_message=' . urlencode('Payment completed successfully.'));
} catch (Throwable $exception) {
    mysqli_rollback($conn);
    redirect('../account.php?error=' . urlencode('The payment could not be completed.'));
}
