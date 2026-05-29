<?php

header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json");

include 'db.php';

$loan_id = $_GET['loan_id'];

$sql = "

SELECT * FROM loan_payments

WHERE loan_id = '$loan_id'

ORDER BY id DESC
";

$result = $conn->query($sql);

$data = array();

while($row = $result->fetch_assoc()){

    $data[] = $row;
}

echo json_encode($data);

?>