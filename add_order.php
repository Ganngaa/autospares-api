<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once(__DIR__ . '/db.php');

$company_name = $_POST['company_name'];

$total_amount = $_POST['total_amount'];

$paid_amount = $_POST['paid_amount'];

$pending_amount = $_POST['pending_amount'];

$delivery_day = $_POST['delivery_day'];

$notes = $_POST['notes'];

$sql = "INSERT INTO orders
(
company_name,
total_amount,
paid_amount,
pending_amount,
delivery_day,
notes
)

VALUES
(
'$company_name',
'$total_amount',
'$paid_amount',
'$pending_amount',
'$delivery_day',
'$notes'
)";

if($conn->query($sql)){

    echo json_encode([

        "success" => true,

        "order_id" =>
        $conn->insert_id
    ]);

}else{

    echo json_encode([

        "success" => false,

        "error" => $conn->error
    ]);
}

?>