<?php

include("db.php");

$id = $_POST['id'];

$conn->query(
  "DELETE FROM order_items WHERE order_id='$id'"
);

$conn->query(
  "DELETE FROM orders WHERE id='$id'"
);

echo json_encode([
  "success"=>true
]);