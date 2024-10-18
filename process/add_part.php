<?php
// Database connection details


// Create connection
$conn = new mysqli("localhost", "root", "", "ims_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $meatType = $conn->real_escape_string($_POST['meat_type']);
    $partName = $conn->real_escape_string($_POST['part_name']);

    // Insert new part into the database
    $sql = "INSERT INTO meat_new_db (meat_type, meat_parts) VALUES ('$meatType', '$partName')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('New part added successfully!');
                window.location.href = '../meat_registration_new.php';
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
