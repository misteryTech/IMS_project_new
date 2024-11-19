<?php
// Include the database connection file
include('connection.php'); // Ensure this is the correct path

// Check if the connection was successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get POST data
$orderData = json_decode($_POST['orderData'], true);
$totalAmount = $_POST['totalAmount'];
$amountReceived = $_POST['amountReceived'];

// Prepare the query to insert order data
foreach ($orderData['items'] as $item) {
    $meatType = $item['meat_type'];
    $partName = $item['part_name'];
    $quantity = $item['quantity'];
    $price = $item['price'];
    $totalPrice = $price * $quantity;

    // Query to insert into the 'orders' table
    $query = "INSERT INTO orders (meat_type, part_name, quantity, price, total_price)
              VALUES ('$meatType', '$partName', '$quantity', '$price', '$totalPrice')";

    if (mysqli_query($connection, $query)) {
        // If the query is successful, continue
        continue;
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connection);
        exit();
    }
}

// You can add more logic to save totalAmount and amountReceived if needed
echo "Order placed successfully!";
?>
