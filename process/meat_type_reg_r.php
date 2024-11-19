<?php
// Database connection
include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $meatType = $_POST['meat_type'];
    $partName = $_POST['part_name'];
    $price = $_POST['price'];
    $date = $_POST['date'];
    $dispatchDate = $_POST['dispatch_date'];
    $batchNumber = $_POST['batch_number'];
    $supplier = $_POST['supplier'];
    $stock = $_POST['stock'];

    // Prepare the insert query with a prepared statement
    $stmt = $connection->prepare("INSERT INTO meat_registration_db (meat_type, part_name, price, date, dispatch_date, batch_number, supplier, stock) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt === false) {
        die("Failed to prepare statement: " . htmlspecialchars($connection->error));
    }

    // Bind the parameters
    $stmt->bind_param("ssississ", $meatType, $partName, $price, $date, $dispatchDate, $batchNumber, $supplier, $stock);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>
                alert('New meat type registered successfully!');
                window.location.href = '../meat_registration_new.php';
              </script>";
    } else {
        echo "Error: " . htmlspecialchars($stmt->error);
    }

    // Close the statement and connection
    $stmt->close();
    $connection->close();
}
?>
