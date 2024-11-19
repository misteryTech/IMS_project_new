<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["meat_id"])) {
    $meat_id = $connection->real_escape_string($_POST["meat_id"]);
    $meat_type = $connection->real_escape_string($_POST["meat_type"]);
    $part_name = $connection->real_escape_string($_POST["part_name"]);
    $price = $connection->real_escape_string($_POST["price"]);
    $purchased_date = $connection->real_escape_string($_POST["purchased_date"]);
    $batch_number = $connection->real_escape_string($_POST["batch_number"]);
    $supplier = $connection->real_escape_string($_POST["supplier"]);

    // Update query
    $sql_update = "UPDATE meat_registration_db SET 
                   meat_type = '$meat_type', 
                   part_name = '$part_name', 
                   price = '$price', 
                   date = '$purchased_date', 
                   batch_number = '$batch_number', 
                   supplier = '$supplier' 
                   WHERE id = '$meat_id'";

    if ($connection->query($sql_update) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Record updated successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error updating record: " . $connection->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}

$connection->close();
?>
