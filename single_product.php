<?php
include('server/connection.php');

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Dati prodotto
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();

    // Immagini secondarie (dalla tabella product_images)
    $stmt_images = $conn->prepare("SELECT * FROM product_images WHERE product_id = ? ORDER BY image_id ASC");
    $stmt_images->bind_param("i", $product_id);
    $stmt_images->execute();
    $images = $stmt_images->get_result();

    $image_list = [];
    while ($img = $images->fetch_assoc()) {
        $image_list[] = $img;
    }

} else {
    header('location: index.php');
    exit();
}
?>

<?php include('layouts/header.php'); ?>

<section class="container single-product my-5 pt-50">
    <div class="row mt-5">
        <div class="col-lg-5 col-md-6 col-sm-12">

            
            <img 
                class="img-fluid w-100 pb-1" 
                src="assets/imgs/<?php echo product_image_path($product['product_image']); ?>" 
                id="mainImg"
                alt="Immagine principale di <?php echo htmlspecialchars($product['product_name']); ?>"
            />

           
            <div class="small-img-group">

                
                <div class="small-img-col">
                    <img 
                        src="assets/imgs/<?php echo product_image_path($product['product_image']); ?>" 
                        width="100%" 
                        class="small-img" 
                        alt="Immagine 1 di <?php echo htmlspecialchars($product['product_name']); ?>"
                    />
                </div>

                
                <?php foreach ($image_list as $img) { ?>
                    <div class="small-img-col">
                        <img 
                            src="assets/imgs/<?php echo product_image_path($img['image_path']); ?>" 
                            width="100%" 
                            class="small-img" 
                            alt="<?php echo $img['alt_text']; ?>"
                        />
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-12">
            <h6><?php echo $product['product_category']; ?></h6>
            <h3 class="py-4"><?php echo $product['product_name']; ?></h3>
            <h2><?php echo $product['product_price']; ?>€</h2>
            <?php if ($product['vegan'] == 1): ?>
                <div style="color: #28a745; font-weight: bold; font-size: 1.1rem; margin-bottom: 10px;">
                    🌱 Vegan Friendly
                </div>
            <?php endif; ?>

            <form method="POST" action="cart.php">
                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>"/>
                <input type="hidden" name="product_image" value="<?php echo $product['product_image']; ?>"/>
                <input type="hidden" name="product_name" value="<?php echo $product['product_name']; ?>"/>
                <input type="hidden" name="product_price" value="<?php echo $product['product_price']; ?>"/>
                <input type="number" name="product_quantity" value="1"/>
                <button class="buy-btn" type="submit" name="add_to_cart">Add to cart</button>
            </form>

            <h4 class="mt-5 mb-5">Product details</h4>
            <span><?php echo $product['product_description']; ?></span>
        </div>
    </div>
</section>

<section id="related-products" class="my-3 pb-5">
    <div class="container text-center mt-1 py-3">
            <h3>You may also like</h3>
        <hr>
    </div>

    <div class="row mx-auto container-fluid">
        <?php include('server/get_featured_products.php'); ?>

        <?php while ($row = $featured_products->fetch_assoc()) { ?>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12 mb-4">
                <img class="img-fluid mb-3" src="assets/imgs/<?php echo product_image_path($row['product_image']); ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>"/>
                <div class="start">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="p.name"><?php echo $row['product_name']; ?></h5>
                <h4 class="p.price"><?php echo $row['product_price']; ?> €</h4>
                <a href="single_product.php?product_id=<?php echo $row['product_id']; ?>">
                    <button class="buy-btn">View product</button>
                </a>
            </div>
        <?php } ?>
    </div>
</section>

<script>
    var mainImg = document.getElementById("mainImg");
    var smallImg = document.getElementsByClassName("small-img");

    for (let i = 0; i < smallImg.length; i++) {
        smallImg[i].onclick = function () {
            mainImg.src = smallImg[i].src;
        }
    }
</script>

<?php include('layouts/footer.php');?>

