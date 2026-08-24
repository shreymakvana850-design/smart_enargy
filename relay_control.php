<?php

header("Content-Type: application/json");

require_once "config.php";

$device = "ESP32_01";
$relay  = isset($_POST["relay"]) ? trim($_POST["relay"]) : "";
$state  = isset($_POST["state"]) ? strtoupper(trim($_POST["state"])) : "";

if ($relay === "" || ($state !== "ON" && $state !== "OFF")) {

    echo json_encode([
        "success" => false,
        "message" => "Invalid relay or state"
    ]);

    exit;
}

// Create relay_commands table if it doesn't exist
$createTable = "
CREATE TABLE IF NOT EXISTS relay_commands (
    id INT AUTO_INCREMENT PRIMARY KEY,
    device_id VARCHAR(50) NOT NULL,
    relay_name VARCHAR(50) NOT NULL,
    relay_state VARCHAR(10) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)
";

$conn->query($createTable);

// Save command
$stmt = $conn->prepare("
    INSERT INTO relay_commands
    (device_id, relay_name, relay_state)
    VALUES (?, ?, ?)
");

$stmt->bind_param(
    "sss",
    $device,
    $relay,
    $state
);

if ($stmt->execute()) {

    echo json_encode([
        "success" => true,
        "message" => "Relay command saved",
        "relay" => $relay,
        "state" => $state
    ]);

} else {

    echo json_encode([
        "success" => false,
        "message" => "Failed to save relay command"
    ]);
}

$stmt->close();
$conn->close();

?>