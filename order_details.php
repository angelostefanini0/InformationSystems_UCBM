<?php
session_start();
include('server/connection.php');


if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['order_id']) || empty($_GET['order_id'])) {
    echo "<script>alert('Nessun ordine selezionato!'); window.location.href='orders.php';</script>";
    exit;
}

$order_id = intval($_GET['order_id']);
$user_id = $_SESSION['user_id'];

// Ottieni i dettagli dell'ordine
$stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ? AND user_id = ?");
$stmt->bind_param("ii", $order_id, $user_id);
$stmt->execute();
$order_details = $stmt->get_result()->fetch_assoc();

if (!$order_details) {
    echo "<script>alert('Ordine non trovato!'); window.location.href='orders.php';</script>";
    exit;
}

// Query per ottenere i prodotti dell'ordine e il totale
$stmt = $conn->prepare("
    SELECT 
        oi.product_id,
        oi.product_quantity,
        p.product_name,
        p.product_image,
        p.product_price,
        (oi.product_quantity * p.product_price) AS subtotal
    FROM order_items oi
    JOIN products p ON oi.product_id = p.product_id
    WHERE oi.order_id = ?
");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order_items = $stmt->get_result();

// Calcola il totale direttamente dalla query
$order_total_price = 0;
$order_items_array = [];
while ($row = $order_items->fetch_assoc()) {
    $order_total_price += $row['subtotal'];
    $order_items_array[] = $row;
}
?>

<?php include('layouts/header.php'); ?>

<section class="container my-5 py-5">
    <div class="container">
        <h2 class="text-center">Order #<?php echo htmlspecialchars($order_details['order_id']); ?></h2>
        <hr>

        
        <div class="order-summary mb-4 p-4 border rounded shadow-sm">
            <p><strong>Order date:</strong> <?php echo htmlspecialchars($order_details['order_date']); ?></p>
            <p><strong>Order total:</strong> €<?php echo number_format($order_total_price, 2); ?></p>
            <p><strong>Order status:</strong> 
                <span class="badge bg-<?php echo ($order_details['order_status'] == 'Completed') ? 'success' : 'warning'; ?>">
                    <?php echo htmlspecialchars($order_details['order_status']); ?>
                </span>
            </p>
        </div>

       
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($order_items_array as $item) { ?>
                        <tr>
                            <td class="d-flex align-items-center justify-content-center">
                                <img src="assets/imgs/<?php echo product_image_path($item['product_image']); ?>" width="80" height="80" class="me-3 rounded">
                                <p class="mb-0"><?php echo htmlspecialchars($item['product_name']); ?></p>
                            </td>
                            <td><?php echo htmlspecialchars($item['product_quantity']); ?></td>
                            <td>€<?php echo number_format($item['product_price'], 2); ?></td>
                            <td class="fw-bold">€<?php echo number_format($item['subtotal'], 2); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        
        <?php if ($order_details['order_status'] == "on hold") { ?>
            <div class="text-center mt-4">
                <form action="payment.php" method="POST">
                    <input type="hidden" name="order_status" value="<?php echo htmlspecialchars($order_details['order_status']); ?>">
                    <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order_id); ?>">
                    <input type="hidden" name="order_total_price" value="<?php echo htmlspecialchars($order_total_price); ?>">
                    <button type="submit" name="order_pay_btn" class="btn btn-orange">Pay now</button>
                </form>
            </div>
        <?php } ?>

        
        <div class="text-center mt-4">
            <a href="account.php#orders" class="btn btn-secondary">Back to orders</a>
        </div>
    </div>
</section>

<?php include('layouts/footer.php'); ?>
