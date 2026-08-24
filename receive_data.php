<?php

header("Content-Type: application/json");

require_once "config.php";

// Get data from ESP32
$voltage = isset($_POST["voltage"]) ? floatval($_POST["voltage"]) : null;
$current = isset($_POST["current"]) ? floatval($_POST["current"]) : null;
$power   = isset($_POST["power"])   ? floatval($_POST["power"])   : null;
$energy  = isset($_POST["energy"])  ? floatval($_POST["energy"])  : null;

// Validate data
if (
    $voltage === null ||
    $current === null ||
    $power === null ||
    $energy === null
) {
    echo json_encode([
        "success" => false,
        "message" => "Missing sensor data"
    ]);
    exit;
}

// Insert data into MySQL
$sql = "
    INSERT INTO energy_data
    (voltage, current, power, energy)
    VALUES (?, ?, ?, ?)
";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode([
        "success" => false,
        "message" => "SQL prepare failed"
    ]);
    exit;
}

$stmt->bind_param(
    "dddd",
    $voltage,
    $current,
    $power,
    $energy
);

// Execute
if ($stmt->execute()) {

    echo json_encode([
        "success" => true,
        "message" => "Energy data received successfully",
        "data" => [
            "voltage" => $voltage,
            "current" => $current,
            "power" => $power,
            "energy" => $energy
        ]
    ]);

} else {

    echo json_encode([
        "success" => false,
        "message" => "Database insert failed"
    ]);
}

$stmt->close();
$conn->close();

?>