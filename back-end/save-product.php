<?php
require 'classes/Database.php';
require 'classes/Product.php';
require 'classes/DVD.php';
require 'classes/Book.php';
require 'classes/Furniture.php';

$data = json_decode(file_get_contents("php://input"), true);
$sku = $data['sku'];
$name = $data['name'];
$price = $data['price'];
$type = $data['type'];

switch ($type) {
    case 'DVD':
        $product = new DVD($sku, $name, $price, $data['size']);
        break;
    case 'Book':
        $product = new Book($sku, $name, $price, $data['weight']);
        break;
    case 'Furniture':
        $product = new Furniture($sku, $name, $price, $data['height'], $data['width'], $data['length']);
        break;
}

$product->save();
?>
