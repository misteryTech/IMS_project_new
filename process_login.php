<?php
include("connection.php");


if ($_SERVER["REQUEST_METHOD"] == "POST")
{


$email = $_POST["email"];
$password = $_POST["password"];


$email = mysqli_real_escape_string( $connection, $email);
$password = mysqli_real_escape_string( $connection, $password);


$sql = "SELECT * FROM user_db WHERE email='$email' AND password='$password'";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    echo "<script>alert('Login Successful');</script>";

    // Redirect to a dashboard or another page after successful login
     header("Location: dashboard.php");
} else {
    echo "<script>alert('Invalid email or password');</script>";
    header("Location: index.php");
}

}


?>