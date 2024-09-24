<?php
include('connection.php'); // Your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $meat_type = $_POST['meat_type'];
    $batch_number = $_POST['batch_number'];
    $received_date = $_POST['received_date'];
    $supplier = $_POST['supplier'];
    $meat_names = isset($_POST['meat_names']) ? $_POST['meat_names'] : [];
    $meat_parts = isset($_POST['meat_parts']) ? $_POST['meat_parts'] : [];

    // Insert order into the orders table
    $insert_order = "INSERT INTO orders (meat_type_id, batch_number, received_date, supplier) VALUES (?, ?, ?, ?)";
    $stmt = $connection->prepare($insert_order);
    $stmt->bind_param('iiss', $meat_type, $batch_number, $received_date, $supplier);
    $stmt->execute();
    $order_id = $stmt->insert_id; // Get the last inserted order ID
    $stmt->close();


    echo "Order has been successfully processed!";
} else {
    echo "Invalid request.";
}
?>
