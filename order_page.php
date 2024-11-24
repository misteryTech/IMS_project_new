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
            <h1>Purchased Orders</h1>
            <button id="menu-toggle">Menu</button>
        </header>
        <div class="content">
            <h2>Meat Orders</h2>
            <table id="dataTable">
                <thead>
                    <tr>
                   
                        <th>Meat Type</th>
                        <th>Part Name</th>
                        <th>Price</th>
                        <!-- <th>Quantity</th> -->
                        <th>Date Ordered</th>
                        <th>Total Price</th>
                    </tr>
                </thead>

                <?php
                    include("connection.php");

                    // SQL query to fetch orders
                    $sql_select = "SELECT O.*, MRB.*
                    
                    
                    FROM orders AS O
                    INNER JOIN meat_registration_db AS  MRB ON MRB.id = O.meat_type_id
                    
                    ";
                    $result = mysqli_query($connection, $sql_select);

                    $grandTotal = 0; // Variable to hold the total price of all orders
                ?>

                <tbody id="user-table">
                <?php
                    // Output data of each row
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $totalPrice = (isset($row["price"]) && isset($row["quantity"])) ? $row["price"] * $row["quantity"] : 0;
                            $grandTotal += $totalPrice; // Accumulate total price for all orders

                            echo "<tr>";
                            
                            echo "<td>" . (isset($row["meat_type"]) ? $row["meat_type"] : 'N/A') . "</td>";
                            echo "<td>" . (isset($row["part_name"]) ? $row["part_name"] : 'N/A') . "</td>";
                            echo "<td>" . (isset($row["price"]) ? number_format($row["price"], 2) : 'N/A') . "</td>";
                            // echo "<td>" . (isset($row["quantity"]) ? $row["quantity"] : 'N/A') . "</td>";
                            echo "<td>" . (isset($row["order_date"]) ? $row["order_date"] : 'N/A') . "</td>";
                            echo "<td>" . number_format($totalPrice, 2) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No orders found</td></tr>";
                    }

                    // Close the database connection
                    mysqli_close($connection);
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
