<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('connection.php');  // Your DB connection file

    // Get the form data
    $meatname = $_POST['meatname'];
    $meat_types = isset($_POST['meat_types']) ? $_POST['meat_types'] : [];  // Array of selected meat types

    if (!empty($meat_types)) {
        // Loop through each selected meat type
        foreach ($meat_types as $meat_type) {
            // Initialize parts array based on the selected meat type
            $parts = [];

            if ($meat_type == 'Pork' && isset($_POST['pork_parts'])) {
                $parts = $_POST['pork_parts'];  // Get selected pork parts
            } elseif ($meat_type == 'Beef' && isset($_POST['beef_parts'])) {
                $parts = $_POST['beef_parts'];  // Get selected beef parts
            } elseif ($meat_type == 'Chicken' && isset($_POST['chicken_parts'])) {
                $parts = $_POST['chicken_parts'];  // Get selected chicken parts
            }

            // Insert each part for the selected meat type into the database
            foreach ($parts as $part) {
                // SQL query to insert meat type and part
                $query = "INSERT INTO type_meat_db (meat_type, meat_part, meatname) VALUES ('$meat_type', '$part', '$meatname')";

                // Execute the query
                if ($connection->query($query) === TRUE) {
                    // Successful insertion
                } else {
                    echo "<script>alert('Error: " . $connection->error . "');</script>";
                }
            }
        }

        // Redirect back to the form page after all insertions are done
        echo "<script>alert('Registration successful!'); window.location.href = 'meat_registration2.php';</script>";

    } else {
        // Alert if no meat type was selected
        echo "<script>alert('Please select at least one meat type and part.'); window.history.back();</script>";
    }

    // Close the connection
    $connection->close();
}
?>
