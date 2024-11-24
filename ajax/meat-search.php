<?php

header('Content-Type: application/json');

include("connection.php");

// Validate batch number
if (!isset($_GET['batch_number']) || trim($_GET['batch_number']) === '') {
    echo json_encode(["error" => "Batch number is required."]);
    exit;
}

$batch_number = htmlspecialchars($_GET['batch_number'], ENT_QUOTES, 'UTF-8');

// Search for batch details
$sql = "SELECT * FROM meat_registration_db WHERE batch_number = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("s", $batch_number);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    echo json_encode($data);
} else {
    echo json_encode(["error" => "No results found for the given batch number."]);
}

$stmt->close();
$connection->close();
