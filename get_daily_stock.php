<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once(__DIR__ . "/db.php");

$date = $_GET['date'] ?? '';

$result = $conn->query(
    "SELECT
        product_name,
        SUM(quantity) as quantity
     FROM stock_history
     WHERE DATE(created_at)='$date'
     AND action_type='SELL'
     GROUP BY product_name
     ORDER BY quantity DESC"
);

$result = $conn->query($sql);

$data = [];

while($row = $result->fetch_assoc()){
    $data[] = $row;
}

echo json_encode($data);