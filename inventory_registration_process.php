<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){



  $meat_id = $_POST["meat_id"];
  $transaction_type = $_POST["transaction_type"];
  $quantity = $_POST["quantity"];
  $transaction_date = $_POST["transaction_date"];




  // SQL query to insert data into the database
  $sql = "INSERT INTO inventory_trans(productid,transaction_type,quantity,transaction_date) VALUES
  ('$meat_id', '$transaction_type', '$quantity', '$transaction_date')";

  if ( $connection->query($sql) === TRUE) {
     echo "<script>alert('Registered Successfully')</script>";
    echo "<script>window.location.href='inventory_registration.php'</script>";
  } else {
      echo "Error: " . $sql . "<br>" .  $connection->error;
  }
};



?>