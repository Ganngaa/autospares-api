<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once(__DIR__ . '/db.php');

$id = $_POST['id'];

$received_qty = $_POST['received_qty'];

$sql = "

UPDATE order_items

SET received_qty='$received_qty'

WHERE id='$id'
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