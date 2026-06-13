<?php

function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function redirect($location)
{
    header('Location: ' . $location);
    exit;
}

function product_image_path($image)
{
    $image = basename(trim((string) $image));
    $imageDirectory = __DIR__ . '/../assets/imgs/';

    if ($image !== '' && is_file($imageDirectory . $image)) {
        return $image;
    }

    foreach (['webp', 'avif', 'jpg', 'jpeg', 'png'] as $extension) {
        $candidate = $image . '.' . $extension;
        if ($image !== '' && is_file($imageDirectory . $candidate)) {
            return $candidate;
        }
    }

    return 'void.png';
}

function format_price($amount)
{
    return '&euro;' . number_format((float) $amount, 2, ',', '.');
}

function cart_recalculate()
{
    $cart = isset($_SESSION['cart']) && is_array($_SESSION['cart'])
        ? $_SESSION['cart']
        : [];
    $total = 0.0;
    $quantity = 0;

    foreach ($cart as $product) {
        $productPrice = max(0, (float) ($product['product_price'] ?? 0));
        $productQuantity = max(0, (int) ($product['product_quantity'] ?? 0));
        $total += $productPrice * $productQuantity;
        $quantity += $productQuantity;
    }

    $_SESSION['cart'] = $cart;
    $_SESSION['total'] = $total;
    $_SESSION['quantity'] = $quantity;
}

function is_logged_in()
{
    return !empty($_SESSION['logged_in']) && !empty($_SESSION['user_id']);
}
