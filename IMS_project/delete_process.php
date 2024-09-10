<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){



$meat_id = $_POST["id"];

 // SQL query to delete user from the database
 $sql_delete = "DELETE FROM meat WHERE id='$meat_id'";
 if ($connection->query($sql_delete) === TRUE) {
     echo "meat deleted successfully";
     // Redirect to the same page to refresh the user list
   // Redirect to a page where the data is displayed
   header("Location: meat_view.php");
   exit;

 } else {
     echo "Error deleting record: " . $connection->error;
 }
}
?>