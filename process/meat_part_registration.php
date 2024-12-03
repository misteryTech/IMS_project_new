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

    // Check if part_name is an array
    if (isset($_POST['part_name']) && is_array($_POST['part_name'])) {
        $part_names = $_POST['part_name']; // Array of part names

        foreach ($part_names as $part_name) {
            $part_name = $conn->real_escape_string($part_name); // Sanitize each part name

            // Insert each part name into the database
            $sql = "INSERT INTO meat_parts (meat_type_id, part_name) VALUES ('$meat_type_id', '$part_name')";

            if (!$conn->query($sql)) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        echo "All parts have been registered successfully.";
    } else {
        echo "Error: No parts provided.";
    }
}

// Close connection and redirect back to the main page
$conn->close();
header("Location: ../meat_registration_r.php"); // Adjust this path as needed
exit();
?>
