<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input fields
    if (!empty($_POST["shopname"]) && !empty($_POST["supplier_name"]) && !empty($_POST["supplier_contact"]) && !empty($_POST["location"])) {

        $shopname = $_POST["shopname"];
        $supplier_name = $_POST["supplier_name"];
        $supplier_contact = $_POST["supplier_contact"];
        $location = $_POST["location"];

        // Prepare and bind the SQL statement
        $stmt = $connection->prepare("INSERT INTO supplier (shopname, supplier_name, supplier_contact, location) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $shopname, $supplier_name, $supplier_contact, $location);

        if ($stmt->execute()) {
            echo "New record created successfully";
            header("Location: supplier_page.php");
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "All fields are required.";
    }
}
$connection->close();
?>
