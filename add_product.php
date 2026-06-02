<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include 'db.php';

$name = $_POST['name'] ?? '';
$description = $_POST['description'] ?? '';
$price = $_POST['price'] ?? '';
$stock = $_POST['stock'] ?? '';
$position = $_POST['position_location'] ?? '';
$category = $_POST['category'] ?? '';

$imagePath = '';

if (isset($_FILES['image'])) {

    $uploadDir = "uploads/";

    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = time() . "_" . basename($_FILES["image"]["name"]);

    $targetFile = $uploadDir . $fileName;

    if (move_uploaded_file(
        $_FILES["image"]["tmp_name"],
        $targetFile
    )) {
        $imagePath = $targetFile;
    }
}

$sql = "INSERT INTO products(
            name,
            description,
            price,
            stock,
            position_location,
            category,
            image
        ) VALUES (
            '$name',
            '$description',
            '$price',
            '$stock',
            '$position',
            '$category',
            '$imagePath'
        )";

if ($conn->query($sql)) {

    echo json_encode([
        "success" => true,
        "image" => $imagePath
    ]);

} else {

    echo json_encode([
        "success" => false,
        "error" => $conn->error
    ]);
}

$conn->close();

?>