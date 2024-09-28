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
    include ("sidebar.php");
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
                   
                    </tr>
                </thead>

                <?php
                    include("connection.php");

                    // SQL query to join supplier with meat_db details
                    $sql_select = "
                        SELECT o.meat_type_id, o.quantity, o.order_date ,s.id, s.meat_type, s.meat_parts, s.meat_price
                        FROM orders o
                        INNER JOIN meat_db s 
                        ON o.meat_type_id = s.id";
                    
                    $result = $connection->query($sql_select);
                ?>

                <tbody id="user-table">
                <?php
                    // Output data of each row
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["meat_type"] . "</td>";
                            echo "<td>" . $row["meat_parts"] . "</td>";
                            echo "<td>" . $row["meat_price"] . "</td>";
                            echo "<td>" . $row["quantity"] . "</td>";
                            echo "<td>" . $row["order_date"] . "</td>";
            
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>0 results</td></tr>";
                    }
                    $connection->close();
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
