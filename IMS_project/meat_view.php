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
        <h2>Registered Meat</h2>
        <table id="dataTable">
            <thead>
                <tr>
                    <th>Meat ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Expiry Date</th>
                    <th>Batch Number</th>
                    <th>Received Date</th>
                    <th>Supplier</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="user-table">
                <?php
                include("connection.php");

                // Retrieve data from the database
                $sql_select = "SELECT * FROM meat";
                $result = $connection->query($sql_select);

                if ($result === false) {
                    // Query failed, handle the error
                    echo "<tr><td colspan='9'>Error: " . $connection->error . "</td></tr>";
                } else {
                    // Check if there are any rows in the result set
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["type"] . "</td>";
                            echo "<td>" . $row["price"] . "</td>";
                            echo "<td>" . $row["expiry_date"] . "</td>";
                            echo "<td>" . $row["batch_number"] . "</td>";
                            echo "<td>" . $row["received_date"] . "</td>";
                            echo "<td>" . $row["supplier"] . "</td>";
                            echo "<td>";
                            echo "<form action='meat_page_edit.php' method='post'>";
                            echo "<input type='hidden' name='id' value='" . $row["id"] . "' />";
                            echo "<button type='submit' class='btn btn-edit btn-success'>Edit</button>";
                            echo "</form>";
                            echo "<form action='delete_process.php' method='post'>";
                            echo "<input type='hidden' name='id' value='" . $row["id"] . "' />";
                            echo "<button type='submit' name='delete' class='btn btn-delete btn-danger'>Delete</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        // No rows found
                        echo "<tr><td colspan='9'>0 results</td></tr>";
                    }
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
