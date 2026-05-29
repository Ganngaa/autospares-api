<?php

header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json");

include 'db.php';

$id = $_POST['id'];

$name = $_POST['name'];

$description =
$_POST['description'];

$price = $_POST['price'];

$position =
$_POST['position_location'];

$category =
$_POST['category'];

$image = $_POST['image'];

$sql = "

UPDATE products SET

name='$name',

description='$description',

price='$price',

position_location='$position',

category='$category',

image='$image'

WHERE id='$id'
";

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