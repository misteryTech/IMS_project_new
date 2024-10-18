<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
    include("sidebar.php");
?>
    <div class="main-content">
        <header>
            <h1>Welcome, Admin</h1>
            <button id="menu-toggle">Menu</button>
        </header>
        <div class="content">
            <h2>Meat Orders</h2>
            <table id="dataTable">
                <thead>
                    <tr>
                        <th>Meat ID</th>
                        <th>Meat Name</th>
                        <th>Meat Parts</th>
                        <th>Meat Price</th>               
                        <th>Quantity</th>
                        <th>Date Order</th>
                        <th>Total Price</th>
                    </tr>
                </thead>

                <?php
                    include("connection.php");

                    // SQL query to join supplier with meat_db details
                    $sql_select = "
                        SELECT o.*, MRB.*
                        FROM orders o
                        INNER JOIN meat_registration_db MRB ON MRB.id = o.meat_type_id";
                    
                    $result = $connection->query($sql_select);

                    $grandTotal = 0; // Variable to hold the total price of all orders
                ?>

                <tbody id="user-table">
                <?php
                    // Output data of each row
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $totalPrice = $row["price"] * $row["quantity"];
                            $grandTotal += $totalPrice; // Accumulate total price for all orders

                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["meat_type"] . "</td>";
                            echo "<td>" . $row["part_name"] . "</td>";
                            echo "<td>" . number_format($row["price"], 2) . "</td>";
                            echo "<td>" . $row["quantity"] . "</td>";
                            echo "<td>" . $row["order_date"] . "</td>";
                            echo "<td>" . number_format($totalPrice, 2) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>0 results</td></tr>";
                    }
                    $connection->close();
                ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6" style="text-align: right; font-weight: bold;">Grand Total:</td>
                        <td style="font-weight: bold;"><?php echo number_format($grandTotal, 2); ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
