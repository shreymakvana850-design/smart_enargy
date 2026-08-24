<?php

header("Content-Type: application/json");

require_once "config.php";

// Get last 50 readings
$sql = "
    SELECT
        voltage,
        current,
        power,
        energy,
        created_at
    FROM energy_data
    ORDER BY id DESC
    LIMIT 50
";

$result = $conn->query($sql);

if (!$result) {

    echo json_encode([
        "success" => false,
        "message" => "Database query failed"
    ]);

    exit;
}

$labels = [];
$power = [];
$energy = [];
$voltage = [];
$current = [];

// Store data
while ($row = $result->fetch_assoc()) {

    $labels[] = $row["created_at"];

    $power[] = (float)$row["power"];

    $energy[] = (float)$row["energy"];

    $voltage[] = (float)$row["voltage"];

    $current[] = (float)$row["current"];
}

// Reverse so oldest → newest
$labels = array_reverse($labels);
$power = array_reverse($power);
$energy = array_reverse($energy);
$voltage = array_reverse($voltage);
$current = array_reverse($current);

echo json_encode([
    "success" => true,

    "labels" => $labels,

    "power" => $power,

    "energy" => $energy,

    "voltage" => $voltage,

    "current" => $current
]);

$conn->close();

?>