<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check for POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect data from POST
    $items = json_encode($_POST['items']); // Ensure it's a JSON string
    $total = $_POST['total'];
    $payment = $_POST['payment'];
    $change = $_POST['change'];

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'ims_db');

    // Check connection
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO transactions (items, total, payment, amount_change) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        die('Error preparing statement: ' . $conn->error); // Debugging connection issue
    }

    // Bind parameters
    $stmt->bind_param("sddd", $items, $total, $payment, $change);

    // Execute and check if successful
    if ($stmt->execute()) {
        echo 'Transaction saved successfully.';
    } else {
        // Log error if it fails
        echo 'Error saving transaction: ' . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo 'Invalid request method.';
}
