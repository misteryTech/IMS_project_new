<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $supplier_id = $_POST["supplier_id"];
    $name = $_POST["name"];
    $location = $_POST["location"];
    $supplier_name = $_POST["supplier_name"];
    $supplier_contact = $_POST["supplier_contact"];


    $sql_update = "UPDATE supplier SET
                    shopname='$name',
                    location='$location',
                    supplier_name='$supplier_name',
                    supplier_contact='$supplier_contact'


                    WHERE supplier_id='$supplier_id'";

    if ($connection->query($sql_update) === TRUE) {
        // Redirect to a page where the data is displayed
        header("Location: supplier_view.php");
        exit;
    } else {
        echo "Error updating record: " . $connection->error;
    }
}
?>
