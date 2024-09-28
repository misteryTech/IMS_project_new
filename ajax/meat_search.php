<?php
include("connection.php");

$search_query = htmlspecialchars($_GET['search_query'] ?? '', ENT_QUOTES, 'UTF-8');

// Prepare the SQL query to search for meat parts
$sql = "SELECT * FROM meat_db WHERE meat_parts LIKE ?";
$stmt = $connection->prepare($sql);
$search_term = "%" . $search_query . "%";
$stmt->bind_param("s", $search_term);
$stmt->execute();
$result = $stmt->get_result();

// Insert order logic (only if form is submitted)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_meat_id'])) {
    $meat_id = $_POST['order_meat_id'];
    $quantity = $_POST['quantity'];
    
    // Assuming you have an `orders` table with columns (id, meat_id, quantity, order_date)
    $insert_sql = "INSERT INTO orders (meat_type_id, quantity, order_date) VALUES (?, ?, NOW())";
    $insert_stmt = $connection->prepare($insert_sql);
    $insert_stmt->bind_param("ii", $meat_id, $quantity);
    $insert_stmt->execute();
    $insert_stmt->close();
    
    echo "<div style='text-align:center;color:green;'>Order placed successfully!</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meat Search</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .form-container {
            margin: 20px auto;
            text-align: center;
        }
        .form-container input {
            padding: 10px;
            width: 70%;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-container button {
            padding: 10px 15px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            margin-left: 10px;
        }
        .btn {
            padding: 10px;
            color: black;
            background-color: red;
            font-style: none;
        }
    </style>
</head>
<body>

<div class="form-container">
    <form action="meat_search.php" method="GET">
        <input type="text" name="search_query" placeholder="Search for meat parts..." value="<?= $search_query ?>">
        <button type="submit">Search</button>
        <a href="../search_meat.php" class="btn btn-primary">Back</a>
    </form>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Meat Type</th>
            <th>Meat Parts</th>
            <th>Price</th>
            <th>Purchased Date</th>
            <th>Order</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['meat_type']}</td>
                        <td>{$row['meat_parts']}</td>
                        <td>{$row['meat_price']}</td>
                        <td>{$row['purchased_date']}</td>
                        <td>
                            <form method='POST' action=''>
                                <input type='hidden' name='order_meat_id' value='{$row['id']}'>
                                <input type='number' name='quantity' value='1' min='1' required>
                                <button type='submit'>Order</button>
                            </form>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No results found</td></tr>";
        }

        // Close the prepared statement and the database connection
        $stmt->close();
        $connection->close();
        ?>
    </tbody>
</table>

</body>
</html>
