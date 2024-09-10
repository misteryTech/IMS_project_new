<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $meat_id = $_POST["meat_new_id"];
    $name = $_POST["name"]; 
    $price = $_POST["price"];
    $expiry_date = $_POST["expiry_date"];
    $received_date = $_POST["received_date"];
    $supplier = $_POST["supplier"];
    $type = isset($_POST["type"]) ? 
    $_POST["type"] : null;
    $batch_number = isset($_POST["batch_number"]) ? 
    $_POST["batch_number"] : null;



    $sql_update = "UPDATE meat SET
    name='$name',
    type='$type',
    price='$price',
    expiry_date='$expiry_date',
    batch_number='$batch_number',
    received_date='$received_date',
    supplier='$supplier'
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
