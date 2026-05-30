<?php

header("Content-Type: application/json");

include("db.php");

$id = $_POST['id'];

$conn->query(
    "DELETE FROM loan_payments WHERE loan_id='$id'"
);

$conn->query(
    "DELETE FROM loan_items WHERE loan_id='$id'"
);

$sql = "DELETE FROM loans WHERE id='$id'";

if($conn->query($sql)){

    echo json_encode([
        "success" => true
    ]);

}else{

    echo json_encode([
        "success" => false
    ]);
}
?>