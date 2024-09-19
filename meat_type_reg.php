<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('connection.php');  // Your DB connection file

    // Get the form data
    $meatname = $_POST['meatname'];
    $meat_types = isset($_POST['meat_types']) ? $_POST['meat_types'] : [];  // Array of selected checkboxes

    if (!empty($meat_types)) {
        // Loop through each selected meat type and insert them
        foreach ($meat_types as $meat_type) {
            // Build the SQL query
            $query = "INSERT INTO type_meat_db (parts, type) VALUES ('$meatname', '$meat_type')";

            // Execute the query
            if ($connection->query($query) === TRUE) {
                // Successful registration for each meat type
            } else {
                echo "<script>alert('Error: " . $connection->error . "');</script>";
            }
        }

        // Redirect back to the form page after all insertions are done
        echo "<script>alert('Registration successful!'); window.location.href = 'meat_registration2.php';</script>";

    } else {
        // Alert if no meat type was selected
        echo "<script>alert('Please select at least one meat type.'); window.history.back();</script>";
    }

    // Close the connection
    $connection->close();
}
?>
