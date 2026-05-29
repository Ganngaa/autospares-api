<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once(__DIR__ . '/db.php');

$order_id =
$_GET['order_id'];

$sql = "

SELECT * FROM order_items

WHERE order_id='$order_id'
";

$result =
$conn->query($sql);

$data = [];

while($row =
$result->fetch_assoc()){

    $data[] = $row;
}

echo json_encode($data);

?>