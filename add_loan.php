<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once(__DIR__ . '/db.php');

$customer_name = $_POST['customer_name'];
$phone = $_POST['phone'];
$total_amount = $_POST['total_amount'];
$paid_amount = $_POST['paid_amount'];
$balance_amount = $_POST['balance_amount'];
$payment_mode = $_POST['payment_mode'];

$sql = "INSERT INTO loans
(
    customer_name,
    phone,
    total_amount,
    paid_amount,
    balance_amount
)
VALUES
(
    '$customer_name',
    '$phone',
    '$total_amount',
    '$paid_amount',
    '$balance_amount'
)";

if ($conn->query($sql) === TRUE) {

    $loan_id = $conn->insert_id;

    if ((float)$paid_amount > 0) {

        $paymentSql = "INSERT INTO loan_payments
        (
            loan_id,
            amount,
            payment_mode
        )
        VALUES
        (
            '$loan_id',
            '$paid_amount',
            '$payment_mode'
        )";

        if (!$conn->query($paymentSql)) {

            echo json_encode([
                "success" => false,
                "payment_error" => $conn->error
            ]);

            exit();
        }
    }

    echo json_encode([
        "success" => true
    ]);

} else {

    echo json_encode([
        "success" => false,
        "error" => $conn->error
    ]);
}

?>