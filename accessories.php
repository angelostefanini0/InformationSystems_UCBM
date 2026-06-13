<?php
include('server/connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category = 'accessories'");
$stmt->execute();
$products = $stmt->get_result();
?>

<?php include('layouts/header.php');?>


<section id="featured" class="py-4 pb-5">
    <div class="container text-center mt-4 py-5">
        <span class="section-eyebrow">TRAIN BETTER</span>
        <h3>Performance accessories</h3>
        <hr>
        <p>Reliable essentials designed for every training session.</p>
    </div>

    <div class="row mx-auto container-fluid">
        <?php while($row = $products->fetch_assoc()){ ?>
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assets/imgs/<?php echo product_image_path($row['product_image']); ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>"/>
            <div class="start">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h5><?php echo $row['product_name']; ?></h5>
            <h4>€<?php echo $row['product_price']; ?></h4>
            <a class="buy-btn" href="single_product.php?product_id=<?php echo $row['product_id']; ?>">View product</a>
        </div>
        <?php } ?>
    </div>
</section>

<?php include('layouts/footer.php'); ?>
