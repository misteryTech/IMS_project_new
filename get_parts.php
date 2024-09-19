<?php
include('connection.php');  // Include your DB connection

if (isset($_POST['meat_type'])) {
    $meat_type = $_POST['meat_type'];

    // Prepare SQL query to get parts based on selected meat type
    $query = "SELECT DISTINCT parts FROM type_meat_db WHERE type = '$meat_type'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $parts = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $parts[] = $row['parts'];  // Fetch part
        }

        // Return parts as a JSON response
        echo json_encode($parts);
    } else {
        echo json_encode([]);  // Return empty array if no parts found
    }
}
?>
