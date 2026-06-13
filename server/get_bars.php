<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='powder' LIMIT 4");

$stmt->execute();

$powder = $stmt->get_result();

?>
