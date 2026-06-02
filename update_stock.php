// redeploy test
<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once(__DIR__ . "/db.php");

$id = intval($_POST['id']);
$action = $_POST['action'];
$quantity = intval($_POST['quantity']);

$product = $conn->query(
    "SELECT name, stock
     FROM products
     WHERE id = $id"
);

if (!$product || $product->num_rows == 0) {

    echo json_encode([
        "success" => false,
        "message" => "Product not found"
    ]);
    exit;
}

$row = $product->fetch_assoc();

$productName = $row['name'];
$currentStock = intval($row['stock']);

if ($action == "add") {

    $newStock = $currentStock + $quantity;
    $actionType = "ADD";

} else {

    $newStock = $currentStock - $quantity;

    if ($newStock < 0) {
        $newStock = 0;
    }

    $actionType = "SELL";
}

$conn->query(
    "UPDATE products
     SET stock = $newStock
     WHERE id = $id"
);

$conn->query(
    "INSERT INTO stock_history
    (
        product_id,
        product_name,
        action_type,
        quantity
    )
    VALUES
    (
        $id,
        '$productName',
        '$actionType',
        $quantity
    )"
);

echo json_encode([
    "success" => true,
    "old_stock" => $currentStock,
    "new_stock" => $newStock
]);

?>