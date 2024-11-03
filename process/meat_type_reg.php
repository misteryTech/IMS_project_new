<?php
// Database connection
include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $meatTypes = $_POST['meat_types'] ?? [];
    $price = $_POST['price'];
    $date = $_POST['date'];
    $dispatchDate = $_POST['dispatch_date'];
    $batchNumber = $_POST['batch_number'];
    $supplier = $_POST['supplier'];

    // Prepare the insert query for each selected meat type and part
    foreach ($meatTypes as $meatType) {
        $parts = $_POST[strtolower($meatType) . '_parts'] ?? [];

        foreach ($parts as $part) {
            $partName = mysqli_real_escape_string($connection, $part);
            $query = "INSERT INTO meat_registration_db (meat_type, part_name, price, date, dispatch_date, batch_number, supplier)
                      VALUES ('$meatType', '$partName', '$price', '$date', '$dispatchDate', '$batchNumber', '$supplier')";

            // Execute the query
            if (mysqli_query($connection, $query)) {
                echo "<script>
                alert('New part added successfully!');
                window.location.href = '../meat_registration_new.php';
              </script>";
            } else {
                echo "Error: " . mysqli_error($connection);
            }
        }
    }
}
?>
