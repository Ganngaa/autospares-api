<?php

$host = "sql12.freesqldatabase.com";

$user = "sql12828733";

$password = "nJcxdhpSjF";

$database = "sql12828733";

$conn = new mysqli(

    $host,
    $user,
    $password,
    $database
);

if ($conn->connect_error) {

    die(

        "Connection failed: " .

        $conn->connect_error
    );
}

?>