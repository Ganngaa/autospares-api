<?php

header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json");

include 'db.php';

$name = $_POST['name'];

$description =
$_POST['description'];

$price = $_POST['price'];

$stock = $_POST['stock'];

$position =
$_POST['position_location'];

$category =
$_POST['category'];

$image = $_POST['image'];

$sql = "

INSERT INTO products(

    name,
    description,
    price,
    stock,
    position_location,
    category,
    image

) VALUES(

    '$name',
    '$description',
    '$price',
    '$stock',
    '$position',
    '$category',
    '$image'
)
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