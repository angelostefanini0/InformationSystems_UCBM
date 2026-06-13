<?php
include('server/connection.php');

if(isset($_POST['search'])){

    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : 100; // Default a 100 se non impostato

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price<=?");
    $stmt->bind_param("si", $category, $price); 

    $stmt->execute();
    $products = $stmt->get_result();
} else {
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_category NOT LIKE '%accessori%' ");
    $stmt->execute();
    $products = $stmt->get_result();
}

?>

<?php include('layouts/header.php');?>
    <section id="featured" class="py-4 pb-5">
        <div class="container text-center mt-4 py-5">
            <span class="section-eyebrow">SHOP ALL</span>
            <h3>Nutrition, made for progress</h3>
            <hr>
            <p id="openFilterPopup">Filter products <i class="fa-solid fa-sliders ms-2"></i></p>
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

    <div id="filterPopup" class="filter-popup">
        <div class="filter-popup-content">
            <span id="closeFilterPopup" class="close-btn">&times;</span>
            <h6 class="fw-bold mb-3">Filter products</h6>
            <form action="shop.php" method="POST">
                <p class="fw-bold small mb-1">Category</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="category" id="Bar" value="Bar">
                    <label class="form-check-label small" for="Bar">Protein bars</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="category" id="Powder" value="Powder">
                    <label class="form-check-label small" for="Powder">Protein powder</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="category" id="Energy" value="Energy">
                    <label class="form-check-label small" for="Energy">Energy Drinks</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="category" id="Vitamin" value="Vitamin">
                    <label class="form-check-label small" for="Vitamin">Vitamins</label>
                </div>

                <p class="fw-bold small mt-3 mb-1">Maximum price</p>
                    <input type="range" name="price" value="100" class="form-range" min="1" max="100" id="priceRange">
                    <div class="d-flex justify-content-between small">
                        <span>1</span>
                        <span id="priceValue">100</span>
                    </div>

                <button type="submit" name="search" class="btn btn-primary w-100 mt-3">Apply filters</button>
            </form>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const openPopup = document.getElementById("openFilterPopup");
            const closePopup = document.getElementById("closeFilterPopup");
            const filterPopup = document.getElementById("filterPopup");

           
            filterPopup.style.display = "none";

            
            openPopup.addEventListener("click", function () {
                filterPopup.style.display = "flex";
            });

            
            closePopup.addEventListener("click", function () {
                filterPopup.style.display = "none";
            });

        
            window.addEventListener("click", function (event) {
                if (event.target === filterPopup) {
                    filterPopup.style.display = "none";
                }
            });
        });
    </script>

            <script>
            const priceRange = document.getElementById('priceRange');
            const priceValue = document.getElementById('priceValue');

            priceRange.addEventListener('input', function () {
                priceValue.textContent = priceRange.value;
            });
        </script>

<?php include('layouts/footer.php');?>
