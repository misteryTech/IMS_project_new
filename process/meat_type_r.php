<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "ims_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $meat_type = $conn->real_escape_string($_POST['meat_type']); // Sanitizing input

    // Insert new meat type into the database
    $sql = "INSERT INTO meat_types (meat_type) VALUES ('$meat_type')";

    if ($conn->query($sql) === TRUE) {
        echo "New meat type registered successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection and redirect back to the main page
$conn->close();
header("Location: ../meat_registration_r.php"); // Adjust this path as needed
exit();
?>
