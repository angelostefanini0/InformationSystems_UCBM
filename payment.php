<?php
session_start();

if (isset($_POST['order_pay_btn'])) {
    $order_status = $_POST['order_status'] ?? '';
    $order_total_price = isset($_POST['order_total_price']) ? number_format((float) $_POST['order_total_price'], 2, '.', '') : 0;
    $order_id = $_POST['order_id'] ?? 0;

    $_SESSION['order_status'] = $order_status;
    $_SESSION['order_total_price'] = $order_total_price;
    $_SESSION['order_id'] = $order_id;
    $_SESSION['total'] = $order_total_price;
}

$order_status = $_SESSION['order_status'] ?? '';
$order_total_price = $_SESSION['order_total_price'] ?? '0.00';
$order_id = $_SESSION['order_id'] ?? 0;
$total = $_SESSION['total'] ?? '0.00';
$final_amount = $total;
?>

<?php include('layouts/header.php'); ?>

<section class="payment-page">
    <div class="container">
        <div class="payment-heading">
            <span class="section-eyebrow">SECURE CHECKOUT</span>
            <h1>Complete your payment</h1>
            <p>Your order is reserved. Choose your preferred payment method below.</p>
        </div>

        <?php if ($order_status === 'on hold' || $final_amount > 0) { ?>
            <div class="payment-layout">
                <aside class="payment-summary">
                    <div class="payment-summary-icon"><i class="fa-solid fa-bag-shopping"></i></div>
                    <span class="payment-label">Order summary</span>
                    <h2><?php echo $order_id ? 'Order #' . htmlspecialchars($order_id) : 'Your Brook order'; ?></h2>

                    <div class="payment-total">
                        <span>Total due</span>
                        <strong>&euro;<?php echo number_format((float) $final_amount, 2); ?></strong>
                    </div>

                    <ul class="payment-benefits">
                        <li><i class="fa-solid fa-shield-halved"></i><span><strong>Protected payment</strong>Your details are securely processed.</span></li>
                        <li><i class="fa-solid fa-lock"></i><span><strong>Encrypted checkout</strong>Your payment information stays private.</span></li>
                        <li><i class="fa-solid fa-circle-check"></i><span><strong>Instant confirmation</strong>Your order updates after payment.</span></li>
                    </ul>
                </aside>

                <div class="payment-panel">
                    <div class="payment-panel-header">
                        <div>
                            <span class="payment-label">Payment method</span>
                            <h2>Pay securely</h2>
                        </div>
                        <span class="payment-lock"><i class="fa-solid fa-lock"></i></span>
                    </div>

                    <form action="process_payment.php" method="POST">
                        <input type="hidden" name="amount" value="<?php echo htmlspecialchars($final_amount); ?>">
                        <input type="hidden" id="order_id_js" value="<?php echo htmlspecialchars($order_id); ?>">
                        <div class="payment-container">
                            <div id="paypal-button-container"></div>
                            <p id="result-message" aria-live="polite"></p>
                        </div>
                    </form>

                    <div class="payment-assurance">
                        <i class="fa-solid fa-shield"></i>
                        <span>Secure payment powered by PayPal</span>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="empty-state">
                <i class="fa-solid fa-receipt"></i>
                <h3>No pending payment</h3>
                <p>You currently have no order waiting for payment.</p>
                <a class="buy-btn" href="shop.php">Continue shopping</a>
            </div>
        <?php } ?>
    </div>
</section>

<script
    src="https://www.paypal.com/sdk/js?client-id=ASgrzJrKqpHVYk9HyOdNnZJOS3KhHHK1XP7AZo3pWxQPB3vrkRmfFyp5lIz_8tHJWdM82oQs7AtMWJhp"
    data-sdk-integration-source="developer-studio">
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    var orderIdField = document.getElementById("order_id_js");
    if (!orderIdField || typeof paypal === "undefined") return;

    var amount = "<?php echo $final_amount; ?>";
    var orderId = orderIdField.value;

    paypal.Buttons({
        style: {
            shape: "rect",
            layout: "vertical",
            color: "gold",
            label: "paypal",
            height: 48
        },
        createOrder: function (data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: { value: amount }
                }]
            });
        },
        onApprove: function (data, actions) {
            return actions.order.capture().then(function (orderData) {
                document.getElementById("result-message").innerHTML =
                    '<span class="payment-success"><i class="fa-solid fa-circle-check"></i> Payment successful. Redirecting...</span>';
                window.location.href = "server/complete_payment.php?transaction_id=" +
                    encodeURIComponent(orderData.id) + "&order_id=" + encodeURIComponent(orderId);
            });
        },
        onError: function (err) {
            console.error("Error processing payment:", err);
            document.getElementById("result-message").innerHTML =
                '<span class="payment-error"><i class="fa-solid fa-circle-exclamation"></i> Payment could not be processed. Please try again.</span>';
        }
    }).render("#paypal-button-container");
});
</script>

<?php include('layouts/footer.php'); ?>
