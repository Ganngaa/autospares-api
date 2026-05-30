<?php

header("Content-Type: application/json");

include("db.php");

echo json_encode($_POST);