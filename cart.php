<?php
require_once __DIR__ . '/includes/bootstrap.php';
cart_recalculate();

if (isset($_POST['add_to_cart'])) {
    $product_id = max(0, (int) ($_POST['product_id'] ?? 0));
    $product_name = trim($_POST['product_name'] ?? '');
    $product_price = max(0, (float) ($_POST['product_price'] ?? 0));
    $product_image = basename($_POST['product_image'] ?? '');
    $product_quantity = max(1, (int) ($_POST['product_quantity'] ?? 1));


    $product_array = array(
        'product_id' => $product_id,
        'product_name' => $product_name,
        'product_price' => $product_price,
        'product_image' => $product_image,
        'product_quantity' => $product_quantity,
    );

    
    if ($product_id && $product_name !== '') {
        $products_array_ids = array_map('intval', array_column($_SESSION['cart'], "product_id"));

        // Controlla se il prodotto è già nel carrello
        if (!in_array($product_id, $products_array_ids, true)) {
            $_SESSION['cart'][$product_id] = $product_array;
        } else {
            echo '<script>alert("This product is already in your cart.")</script>';
        }
    }
    cart_recalculate();
} elseif (isset($_POST['remove_product'])) {
    $product_id = (int) ($_POST['product_id'] ?? 0);
    unset($_SESSION['cart'][$product_id]);
    cart_recalculate();
} elseif (isset($_POST['edit_quantity'])) {
    $product_id = (int) ($_POST['product_id'] ?? 0);
    $product_quantity = max(1, (int) ($_POST['product_quantity'] ?? 1));
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['product_quantity'] = $product_quantity;
    }
    cart_recalculate();
}
?>

<?php
$pageTitle = 'Cart | Brook';
include('layouts/header.php');
?>

<section class="cart container my-5 py-5">
    <div class="container mt-3">
        <h2 class="font-weight-bold">Your cart</h2>
        <hr>
    </div>

    <?php if (!empty($_SESSION['cart'])) { ?>
    <table class="mt-5 pt-5">
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
        
        <?php foreach ($_SESSION['cart'] as $value) { ?>
        <tr>
            <td>
                <div class="product-info">
                    <img src="assets/imgs/<?php echo e(product_image_path($value['product_image'])); ?>" alt="<?php echo e($value['product_name']); ?>"/>
                    <div>
                        <p><?php echo htmlspecialchars($value['product_name']); ?></p>
                        <small><span>€</span><?php echo htmlspecialchars($value['product_price']); ?></small>
                        <br>
                        <form method="POST" action="cart.php" >
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($value['product_id']); ?>"/>
                            <button class="remove-btn" type="submit" name="remove_product">Remove</button>
                        </form>
                    </div>
                </div>
            </td>
            <td>
                <form method="POST" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($value['product_id']); ?>" />
                    <button type="submit" class="edit-btn" name="edit_quantity">Update</button>
                    <input type="number" name="product_quantity" value="<?php echo htmlspecialchars($value['product_quantity']); ?>" />
                </form>
            </td>
            <td>
                <span>€</span>
                <span class="product-price"><?php echo htmlspecialchars($value['product_quantity'] * $value['product_price']); ?></span>
            </td>
        </tr>
        <?php } ?>
    </table>

    <div class="cart-total">
        <table>
            <tr>
                <td>Total</td>
                <td>€<?php echo $_SESSION['total']; ?></td>
            </tr>
        </table>
    </div>

    <div class="checkout-container">
        <form method="POST" action="checkout.php">
            <input type="submit" class="btn checkout-btn" value="Checkout" name="checkout">
        </form>
    </div>
    <?php } else { ?>
        <div class="empty-state"><i class="fa-solid fa-bag-shopping"></i><h3>Your cart is empty</h3><p>Discover nutrition and accessories designed for your goals.</p><a class="buy-btn" href="shop.php">Start shopping</a></div>
    <?php } ?>
</section>

<?php include('layouts/footer.php'); ?>
