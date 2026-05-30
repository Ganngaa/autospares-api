<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

header("Content-Type: application/json");

include("db.php");

$item_id = $_POST['item_id'];
$product_name = $_POST['product_name'];
$qty = intval($_POST['qty']);

$result1 = $conn->query("
UPDATE order_items
SET received_qty = received_qty + $qty
WHERE id='$item_id'
");

$result2 = $conn->query("
UPDATE products
SET stock = stock + $qty
WHERE name='$product_name'
");

echo json_encode([
    "success" => true,
    "order_items_updated" => $result1,
    "products_updated" => $result2,
    "mysql_error" => $conn->error
]);