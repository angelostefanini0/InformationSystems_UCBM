<?php
session_start();

if (empty($_SESSION['cart'])) {
    header('Location: index.php');
    exit();
}


if (isset($_SESSION['logged_in'])) {
    $user_name = $_SESSION['user_name'] ?? '';
    $user_email = $_SESSION['user_email'] ?? '';
}
?>

<?php include('layouts/header.php');?>

<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Secure checkout</h2>
        <hr class="mx-auto">
    </div>

    <div class="mx-auto container">
        <form id="checkout-form" action="server/place_order.php" method="POST">
            <p class="text-center" style="color:red">
                <?php if (isset($_GET['message'])) {
                    echo $_GET['message']; ?>
                    <a class="btn btn-primary" href="login.php">Login</a>
                <?php } ?>
            </p>

            <div class="form-group checkout-small-element">
                <label>Full name</label>
                <input type="text" class="form-control" id="checkout-name" name="name"
                    placeholder="<?php echo isset($_SESSION['logged_in']) && !empty($user_name) ? htmlspecialchars($user_name) : 'Full name'; ?>"
                    value="<?php echo isset($_SESSION['logged_in']) && !empty($user_name) ? htmlspecialchars($user_name) : ''; ?>" required/>
            </div>

            <div class="form-group checkout-small-element">
                <label>Email</label>
                <input type="text" class="form-control" id="checkout-email" name="email"
                    placeholder="<?php echo isset($_SESSION['logged_in']) && !empty($user_email) ? htmlspecialchars($user_email) : 'Email'; ?>"
                    value="<?php echo isset($_SESSION['logged_in']) && !empty($user_email) ? htmlspecialchars($user_email) : ''; ?>" required/>
            </div>


            <div class="form-group checkout-small-element">
                <label>Phone</label>
                <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="Phone number" required/>
            </div>

            <div class="form-group checkout-small-element">
                <label>City</label>
                <input type="text" class="form-control" id="checkout-city" name="city" placeholder="City" required/>
            </div>

            <div class="form-group checkout-large-element">
                <label>Address</label>
                <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Shipping address" required/>
            </div>

            <div class="form-group checkout-btn-container">
                <p>Total: €<?php echo $_SESSION['total']; ?></p>
                <input type="submit" class="btn" id="checkout-btn" name="place_order" value="Place order"/>
            </div>
        </form>
    </div>
</section>

<?php include('layouts/footer.php');?>
