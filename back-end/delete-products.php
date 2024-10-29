<?php
// Connect to the database
$pdo = new PDO('mysql:host=localhost;dbname=productdb', 'root', '');

// Get the list of SKUs to delete from the POST request
$data = json_decode(file_get_contents('php://input'), true);
$skus = $data['skus'];

if (!empty($skus)) {
    $placeholders = implode(',', array_fill(0, count($skus), '?'));
    $stmt = $pdo->prepare("DELETE FROM products WHERE sku IN ($placeholders)");
    $stmt->execute($skus);
}

echo json_encode(['success' => true]);
