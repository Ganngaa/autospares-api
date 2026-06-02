<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include 'db.php';
require 'cloudinary_config.php';

use Cloudinary\Api\Upload\UploadApi;

$name = $_POST['name'] ?? '';
$description = $_POST['description'] ?? '';
$price = $_POST['price'] ?? '';
$stock = $_POST['stock'] ?? '';
$position = $_POST['position_location'] ?? '';
$category = $_POST['category'] ?? '';

$imageUrl = '';

try {

    if (isset($_FILES['image'])) {

        $upload = (new UploadApi())->upload(
            $_FILES['image']['tmp_name']
        );

        $imageUrl = $upload['secure_url'];
    }

    $stmt = $conn->prepare(
        "INSERT INTO products
        (
            name,
            description,
            price,
            stock,
            position_location,
            category,
            image
        )
        VALUES (?, ?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "ssdisss",
        $name,
        $description,
        $price,
        $stock,
        $position,
        $category,
        $imageUrl
    );

    if ($stmt->execute()) {

        echo json_encode([
            "success" => true,
            "image" => $imageUrl
        ]);

    } else {

        echo json_encode([
            "success" => false,
            "message" => $stmt->error
        ]);
    }

} catch (Exception $e) {

    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}

$conn->close();

?>