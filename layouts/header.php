<?php

require_once __DIR__ . '/../includes/bootstrap.php';

$currentPage = basename($_SERVER['PHP_SELF']);
$pageTitle = $pageTitle ?? 'Brook Nutrition & Performance';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($pageTitle); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css"/>
    <style>@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');   </style>
    
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light py-3 fixed-top">
        <div class="container">
          <a class="navbar-brand" href="index.php" aria-label="Brook - Home">
            <img src="assets/imgs/logo1.jpg" id="logo" alt="Brook">
            <span class="brand-copy">
              <strong>BROOK</strong>
              <small>Nutrition & Performance</small>
            </span>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link <?php echo $currentPage === 'index.php' ? 'active' : ''; ?>" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo in_array($currentPage, ['shop.php', 'single_product.php'], true) ? 'active' : ''; ?>" href="shop.php">Nutrition</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo $currentPage === 'accessories.php' ? 'active' : ''; ?>" href="accessories.php">Accessories</a>
              </li>
              <li class="nav-item" >
                <a class="nav-link <?php echo $currentPage === 'contact.php' ? 'active' : ''; ?>" href="contact.php">Contact</a>
              </li>

              <li class="nav-item nav-actions d-flex align-items-center">
                <a class="nav-link <?php echo $currentPage === 'cart.php' ? 'active' : ''; ?>" href="cart.php" aria-label="Shopping cart" title="Shopping cart">
                    <i class="fa-solid fa-bag-shopping"></i> <?php if(isset($_SESSION['quantity']) && $_SESSION['quantity'] != 0){?>
                      <span class="cart-quantity"> <?php echo $_SESSION['quantity']; ?> </span>
                      <?php }?>
                </a>
                <a class="nav-link <?php echo in_array($currentPage, ['account.php', 'login.php', 'register.php'], true) ? 'active' : ''; ?>" href="account.php" aria-label="Your account" title="Your account">
                    <i class="fa-solid fa-user"></i>
                </a>
            </li>

            </ul>
          </div>
        </div>
      </nav> 
