<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){


  $firstname = $_POST["firstname"];
  $lastname = $_POST["lastname"];
  $email = $_POST["email"];
  $username = $_POST["username"];
  $password = $_POST["password"];


  // SQL query to insert data into the database
  $sql = "INSERT INTO user_db (firstname, lastname, email, username, password) VALUES ('$firstname', '$lastname',  '$email', '$username', '$password')";

  if ( $connection->query($sql) === TRUE) {
      echo "New record created successfully";
      header("Location: index.php");

  } else {
      echo "Error: " . $sql . "<br>" .  $connection->error;
  }
};



?>