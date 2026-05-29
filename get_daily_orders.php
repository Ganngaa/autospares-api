<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once(__DIR__ . "/db.php");

$date = $_GET['date'] ?? '';

$sql = "
SELECT *
FROM orders
WHERE DATE(order_date)='$date'
ORDER BY order_date DESC
";

$result = $conn->query($sql);

$data = [];

while($row = $result->fetch_assoc()){
    $data[] = $row;
}

echo json_encode($data);