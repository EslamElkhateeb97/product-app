<?php
require 'classes/Database.php';

$db = Database::getInstance();
$query = "SELECT * FROM products";
$result = $db->query($query);

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

header('Content-Type: application/json');
echo json_encode($products);
?>
