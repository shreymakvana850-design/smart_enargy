<?php



$host = "sql200.infinityfree.com";

$dbname = "if0_42455676_smart_energy";

$username = "if0_42455676";

$password = "sh123rey456A";


$conn = new mysqli(
    $host,
    $username,
    $password,
    $dbname
);

// Check connection
if ($conn->connect_error) {

    http_response_code(500);

    die("Database connection failed.");

}

// UTF-8 support
$conn->set_charset("utf8mb4");

?>