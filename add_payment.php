<?php

header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json");

include 'db.php';

$loan_id =
$_POST['loan_id'];

$amount =
$_POST['amount'];

$payment_mode =
$_POST['payment_mode'];

$insertSql = "

INSERT INTO loan_payments(

loan_id,
amount,
payment_mode

)

VALUES(

'$loan_id',
'$amount',
'$payment_mode'

)
";

if($conn->query($insertSql)){

    $loanResult = $conn->query(

        "SELECT * FROM loans
         WHERE id='$loan_id'"
    );

    $loan = $loanResult->fetch_assoc();

    $newPaid =
        $loan['paid_amount']
        + $amount;

    $newBalance =
        $loan['total_amount']
        - $newPaid;

    $updateSql = "

    UPDATE loans SET

    paid_amount='$newPaid',

    balance_amount='$newBalance'

    WHERE id='$loan_id'
    ";

    $conn->query($updateSql);

    echo json_encode([
        "success" => true
    ]);

}else{

    echo json_encode([
        "success" => false
    ]);
}

?>