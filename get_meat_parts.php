<?php
include("connection.php");

if (isset($_POST['meat_type_id'])) {
    $meat_type_id = $_POST['meat_type_id'];

    $query = "SELECT * FROM type_meat_db WHERE id = $meat_type_id";
    $result = mysqli_query($connection, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<label><input type="checkbox" name="meat_part[]" value="' . $row['meat_part'] . '"> ' . $row['meat_part'] . '</label><br>';
        }
    } else {
        echo "Error fetching meat parts.";
    }
}
?>