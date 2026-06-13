<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category NOT LIKE '%accessori%' ORDER BY RAND() LIMIT 4");

$stmt->execute();

$featured_products = $stmt->get_result();

?>
