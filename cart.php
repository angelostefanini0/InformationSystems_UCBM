<?php
session_start();
calculateTotalCart();

if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}



if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];


    $product_array = array(
        'product_id' => $product_id,
        'product_name' => $product_name,
        'product_price' => $product_price,
        'product_image' => $product_image,
        'product_quantity' => $product_quantity,
    );

    
    if (isset($_SESSION['cart'])) {
        $products_array_ids = array_column($_SESSION['cart'], "product_id");

        // Controlla se il prodotto è già nel carrello
        if (!in_array($product_id, $products_array_ids)) {
            $_SESSION['cart'][$product_id] = $product_array;
        } else {
            echo '<script>alert("This product is already in your cart.")</script>';
        }
    } else {
        $_SESSION['cart'][$product_id] = $product_array;
    }
    calculateTotalCart();
} elseif (isset($_POST['remove_product'])) {
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
    calculateTotalCart();
} elseif (isset($_POST['edit_quantity'])) {
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['product_quantity'] = $product_quantity;
    }
    calculateTotalCart();
}

if (!isset($_SESSION['total'])) {
    calculateTotalCart();
}

function calculateTotalCart() {
    $total = 0;
    $total_quantity = 0;
    
    if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    foreach ($_SESSION['cart'] as $key => $product) {
        $price = $product['product_price'] ?? 0;
        $quantity = $product['product_quantity'] ?? 0;
        $total += ($price * $quantity);
        $total_quantity += $quantity;
    }

    $_SESSION['total'] = $total;
    $_SESSION['quantity'] = $total_quantity;
}
?>

<?php include('layouts/header.php');?>

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
                    <img src="assets/imgs/<?php echo htmlspecialchars($value['product_image']); ?>"/>
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
