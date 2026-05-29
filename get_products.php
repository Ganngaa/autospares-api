<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include 'db.php';

$result = $conn->query(
    "SELECT * FROM products"
);

$products = [];

while($row = $result->fetch_assoc()){

    $products[] = $row;
}

echo json_encode($products);

?>