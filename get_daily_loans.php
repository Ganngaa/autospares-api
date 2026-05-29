<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once(__DIR__ . "/db.php");

$date = $_GET['date'] ?? '';

$sql = "
SELECT *
FROM loans
WHERE DATE(created_at)='$date'
ORDER BY created_at DESC
";

$result = $conn->query($sql);

$data = [];

while($row = $result->fetch_assoc()){
    $data[] = $row;
}

echo json_encode($data);