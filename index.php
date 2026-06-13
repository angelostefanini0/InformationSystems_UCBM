<?php include('layouts/header.php');?>

      <section id="home">
        <div class="container hero-content">
            <h5>NEW SEASON ESSENTIALS</h5>
            <h1><span>Better fuel for stronger performance.</span></h1>
            <p>Premium nutrition and training essentials designed to support your health, recovery and everyday performance.</p>
            <a href="#featured"><button>Shop the collection</button></a>
        </div>
      </section>

      <section id="brand" class="container">
        <div class="row">
            <div class="brand-item col-lg-3 col-6"><img src="assets/imgs/brand1.jpg" alt="Protein Premium Quality"/></div>
            <div class="brand-item col-lg-3 col-6"><img src="assets/imgs/brand2.jpg" alt="Nutrend"/></div>
            <div class="brand-item col-lg-3 col-6"><img src="assets/imgs/brande3.jpg" alt="Prozis"/></div>
            <div class="brand-item col-lg-3 col-6"><img src="assets/imgs/brand4.jpg" alt="Under Armour"/></div>
        </div>
      </section>
    

      <section id="new" class="w-100">
        <div class="row p-0 m-0">

            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class= "img-fluid" src="assets/imgs/1.png"/>
                <div class="details">
                    <h2>Protein Snacks</h2>
                    <a href="shop.php"><button>Explore nutrition</button></a>
                </div>
            </div>

            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class= "img-fluid" src="assets/imgs/ff.jpg"/>
                <div class="details">
                    <h2>Training Accessories</h2>
                    <a href="accessories.php"><button>Explore accessories</button></a>
                </div>
            </div>

            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class= "img-fluid" src="assets/imgs/3.webp"/>
                <div class="details">
                    <h2>Performance Supplements</h2>
                    <a href="shop.php"><button>Discover more</button></a>
                </div>
            </div>

        </div>
      </section>

    <section id="featured" class="my-2 pb-5">
        <div class="container text-center mt-1 py-5">
            <h3>Featured products</h3>
            <hr>
            <p>Our community's current favourites</p>
        </div>
        <div class="row mx-auto container-fluid">
            <?php include('server/get_featured_products.php'); ?>

            <?php while($row = $featured_products->fetch_assoc()){ ?>

            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assets/imgs/<?php echo product_image_path($row['product_image']); ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>"/>
            <div class="start">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h5 class="p.name"><?php echo $row['product_name'] ?> </h5>
            <h4 class="p.price"><?php echo $row['product_price'] ?> €</h4>
            <a class="buy-btn" href="<?php echo "single_product.php?product_id=".$row['product_id']; ?>">View product</a>
        </div>
        <?php }?>

    </div>
      </section>

      <section id="powder" class="my-3 pb-5">
        <div class="container text-center mt-2 py-5">
            <h3>Premium protein, made simple</h3>
            <hr>
            <p>Thoughtfully selected for recovery and wellbeing</p>
        </div>
        <div class="row mx-auto container-fluid">
            <?php include('server/get_bars.php'); ?>

            <?php while($row = $powder->fetch_assoc()){ ?>

            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assets/imgs/<?php echo product_image_path($row['product_image']); ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>"/>
            <div class="start">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h5 class="p.name"><?php echo $row['product_name'] ?> </h5>
            <h4 class="p.price"><?php echo $row['product_price'] ?> €</h4>
            <a class="buy-btn" href="<?php echo "single_product.php?product_id=".$row['product_id']; ?>">View product</a>
        </div>
        <?php }?>

    </div>
      </section>


 <?php include('layouts/footer.php');?>
