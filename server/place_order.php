<?php 
session_start();
include('connection.php');

if(!isset($_SESSION['logged_in'])){
    header('location:../checkout.php?message=Please login/register to place an order');
    exit; 
}

if(isset($_POST['place_order'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $order_cost = isset($_SESSION['total']) ? $_SESSION['total'] : 0;
    $order_status = "on hold"; 
    $user_id = $_SESSION['user_id'];
    $order_date = date('Y-m-d H:i:s');

    // Preparazione della query
    $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date) 
    VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    // Bind dei parametri
    $stmt->bind_param('isiisss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);

    // Esegui la query
    if($stmt->execute()) {
        $order_id = $stmt->insert_id;
        
    } else {
        echo "Errore nell'inserimento dell'ordine: " . $stmt->error;
    }
    // 2. Get products from cart (from session)
    foreach($_SESSION['cart'] as $key => $value) {

    $product = $_SESSION['cart'][$key]; // []
    $product_id = $product['product_id'];
    $product_name = $product['product_name'];
    $product_image = $product['product_image'];
    $product_price = $product['product_price'];
    $product_quantity = $product['product_quantity'];

    $stmt1 = $conn->prepare("INSERT INTO order_items
        (order_id, product_id, product_quantity) 
        VALUES (?, ?, ?)");

    $stmt1->bind_param('iii', $order_id, $product_id,  $product_quantity);

    $stmt1->execute();
}

}
//remove from cart 
//unset($_SESSION['cart']);

$_SESSION['order_id'] = $order_id;

header('location: ../payment.php?order_status=order placed successfully')


?>
