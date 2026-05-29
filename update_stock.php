<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$conn = new mysqli(
    "localhost",
    "root",
    "",
    "autospares"
);

$id = $_POST['id'];

$action = $_POST['action'];

$quantity = intval($_POST['quantity']);

$product =
$conn->query(
    "SELECT stock FROM products WHERE id=$id"
);

$row = $product->fetch_assoc();

$currentStock = intval($row['stock']);

if($action == "add"){

    $newStock =
        $currentStock + $quantity;
}
else{

    $newStock =
        $currentStock - $quantity;

    if($newStock < 0){
        $newStock = 0;
    }
}

$conn->query(
    "UPDATE products
     SET stock=$newStock
     WHERE id=$id"
);

echo json_encode([
    "success" => true
]);

?>