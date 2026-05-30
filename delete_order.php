<?php

header("Content-Type: application/json");

include("db.php");

$id = $_POST['id'];

// Delete order items first
$conn->query(
    "DELETE FROM order_items WHERE order_id='$id'"
);

// Delete order
$sql = "DELETE FROM orders WHERE id='$id'";

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