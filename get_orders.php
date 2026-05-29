<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once(__DIR__ . '/db.php');

$sql = "SELECT * FROM orders
ORDER BY id DESC";

$result = $conn->query($sql);

$data = array();

while($row = $result->fetch_assoc()){

    $data[] = $row;
}

echo json_encode($data);

?>