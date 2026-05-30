<?php

header("Content-Type: application/json");

include("db.php");

$id = $_POST['id'];

$sql = "DELETE FROM products WHERE id='$id'";

if($conn->query($sql)){
    echo json_encode(["success"=>true]);
}else{
    echo json_encode(["success"=>false]);
}