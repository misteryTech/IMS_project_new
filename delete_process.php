<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    // Prepare the statement to prevent SQL injection
    $stmt = $connection->prepare("DELETE FROM meat_registration_db WHERE id = ?");
    
    // Bind the parameter
    $stmt->bind_param("i", $_POST["id"]); // Assuming 'id' is an integer

    // Execute the statement
    if ($stmt->execute()) {
        // Success message
        echo json_encode(["status" => "success", "message" => "Meat record deleted successfully."]);
    } else {
        // Error handling for query failure
        echo json_encode(["status" => "error", "message" => "Error deleting record: " . $stmt->error]);
    }

    // Close the statement
    $stmt->close();
} else {
    // Error handling if the request method or ID is missing
    echo json_encode(["status" => "error", "message" => "Invalid request or missing ID parameter."]);
}

// Close the database connection
$connection->close();
?>