<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once(__DIR__ . '/db.php');

$order_id =
$_POST['order_id'];

$product_name =
$_POST['product_name'];

$ordered_qty =
$_POST['ordered_qty'];

$price =
$_POST['price'];

$sql = "

INSERT INTO order_items
(
order_id,
product_name,
ordered_qty,
price
)

VALUES
(
'$order_id',
'$product_name',
'$ordered_qty',
'$price'
)
";

if($conn->query($sql)){

    echo json_encode([
        "success" => true
    ]);

}else{

    echo json_encode([

        "success" => false,

        "error" => $conn->error
    ]);
}

?>