<?php
// File: addProduct.php

header("Access-Control-Allow-Origin: *"); // Allow all domains to access this file (CORS)
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");

// Include your database connection file
include 'db.php';

// Get the incoming POST data
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['sku']) && isset($data['name']) && isset($data['price']) && isset($data['productType'])) {
    $sku = $data['sku'];
    $name = $data['name'];
    $price = $data['price'];
    $productType = $data['productType'];

    // Example for adding data to the database, depending on product type
    if ($productType == 'DVD') {
        $size = $data['size'];
        $query = "INSERT INTO products (sku, name, price, type, attribute) VALUES ('$sku', '$name', '$price', 'DVD', '$size')";
    } elseif ($productType == 'Book') {
        $weight = $data['weight'];
        $query = "INSERT INTO products (sku, name, price, type, attribute) VALUES ('$sku', '$name', '$price', 'Book', '$weight')";
    } elseif ($productType == 'Furniture') {
        $height = $data['height'];
        $width = $data['width'];
        $length = $data['length'];
        $dimensions = "$height x $width x $length";
        $query = "INSERT INTO products (sku, name, price, type, attribute) VALUES ('$sku', '$name', '$price', 'Furniture', '$dimensions')";
    }

    // Execute the query
    if (mysqli_query($conn, $query)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to save product"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid data"]);
}
?>
