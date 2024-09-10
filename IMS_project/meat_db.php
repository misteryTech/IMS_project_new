<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $purchased_location = $_POST['purchased_location'];
    $purchased_date = $_POST['purchased_date'];
    $type = $_POST['Type'];
    $parts = $_POST['Parts'];
    $price = $_POST['Price'];
    $supplier = $_POST['supplier'];
    $meat_disposed = $_POST['meat_disposed'];

    $sql = "INSERT INTO meat_db (purchased_location, purchased_date, meat_type, meat_parts, meat_price, supplier_id, meat_disposed)
            VALUES ('$purchased_location', '$purchased_date', '$type', '$parts', '$price', '$supplier','$meat_disposed')";

    if (mysqli_query($connection, $sql)) {
        echo "New record created successfully";
        header("Location: meat_registration.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }

    mysqli_close($connection);
}
?>
