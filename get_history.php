<?php

header("Content-Type: application/json");

require_once "config.php";

// Number of records
$limit = isset($_GET["limit"]) ? intval($_GET["limit"]) : 100;

// Safety limit
if ($limit < 1) {
    $limit = 100;
}

if ($limit > 500) {
    $limit = 500;
}

// Get historical energy data
$sql = "
    SELECT
        id,
        voltage,
        current,
        power,
        energy,
        created_at
    FROM energy_data
    ORDER BY id DESC
    LIMIT ?
";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode([
        "success" => false,
        "message" => "Database query failed"
    ]);
    exit;
}

$stmt->bind_param("i", $limit);

$stmt->execute();

$result = $stmt->get_result();

$data = [];

while ($row = $result->fetch_assoc()) {

    $data[] = [
        "id" => (int)$row["id"],
        "voltage" => (float)$row["voltage"],
        "current" => (float)$row["current"],
        "power" => (float)$row["power"],
        "energy" => (float)$row["energy"],
        "timestamp" => $row["created_at"]
    ];
}

echo json_encode([
    "success" => true,
    "count" => count($data),
    "data" => $data
]);

$stmt->close();
$conn->close();

?>