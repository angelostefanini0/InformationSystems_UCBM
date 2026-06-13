<?php

require_once __DIR__ . '/../includes/bootstrap.php';

$database = require __DIR__ . '/../config/database.php';
$conn = mysqli_connect(
    $database['host'],
    $database['user'],
    $database['password'],
    $database['name'],
    $database['port']
);

if (!$conn) {
    http_response_code(500);
    exit('Database connection failed.');
}

mysqli_set_charset($conn, 'utf8mb4');
