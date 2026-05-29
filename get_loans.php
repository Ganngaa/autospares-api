<?php

header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json");

include 'db.php';

$sql = "SELECT * FROM loans ORDER BY id DESC";

$result = $conn->query($sql);

$data = array();

while($row = $result->fetch_assoc()){

    $data[] = $row;
}

echo json_encode($data);

?>