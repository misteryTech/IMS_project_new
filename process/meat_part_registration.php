<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "ims_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $meat_type_id = $conn->real_escape_string($_POST['meat_type_id']); // Sanitizing input
    $part_name = $conn->real_escape_string($_POST['part_name']); // Sanitizing input

    // Insert new meat part with reference to meat type
    $sql = "INSERT INTO meat_parts (meat_type_id, part_name) VALUES ('$meat_type_id', '$part_name')";

    if ($conn->query($sql) === TRUE) {
        echo "New meat part registered successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection and redirect back to the main page
$conn->close();
header("Location: ../meat_registration_r.php"); // Adjust this path as needed
exit();
?>
