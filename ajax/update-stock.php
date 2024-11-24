<?php

header('Content-Type: application/json');
include("connection.php");

if (!isset($_POST['batch_number']) || !isset($_POST['new_stock'])) {
    echo json_encode(["error" => "Batch number and new stock are required."]);
    exit;
}

$batch_number = htmlspecialchars($_POST['batch_number'], ENT_QUOTES, 'UTF-8');
$new_stock = (int) $_POST['new_stock'];

$sql = "UPDATE meat_registration_db SET stock = ? WHERE batch_number = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("is", $new_stock, $batch_number);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Stock updated successfully."]);
} else {
    echo json_encode(["error" => "Failed to update stock."]);
}

$stmt->close();
$connection->close();
