<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $meat_id = $_POST["meat_new_id"];
    $category = $_POST["category"];
    $parts = $_POST["parts"];
    $price = $_POST["price"];
    $purchased_date = $_POST["purchased_date"];
    $supplier = $_POST["supplier"];





    $sql_update = "UPDATE meat_db SET
    meat_type='$category',
    meat_parts='$parts',
    meat_price='$price',
    purchased_date='$purchased_date',
    supplier_id='$supplier'
    WHERE id='$meat_id'";


    if ($connection->query($sql_update) === TRUE) {
        // Redirect to a page where the data is displayed
        header("Location: meat_view.php");
        exit;
    } else {
        echo "Error updating record: " . $connection->error;
    }
}
?>
