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
            <h1>Registered Supplier</h1>
            <button id="menu-toggle">Menu</button>
        </header>
        <div class="content">
            <h2>Registered Supplier</h2>
            <table  id="dataTable">
                <thead>
                    <tr>
                                           
                                            <th>Supplier Shop Name</th>
                                            <th>Supplier Name</th>
                                            <th>Supplier Contact</th>
                                            <th>Locations</th>
                                            <th>Action</th>

                    </tr>
                </thead>

                <?php
                                            include("connection.php");
                                            // Retrieve data from the database
                                            $sql_select = "SELECT * FROM supplier";
                                            $result = $connection->query($sql_select);

                                        ?>


                <tbody id="user-table">

                <?php
                                                        // Output data of each row
                                                        if ($result->num_rows > 0) {
                                                            while($row = $result->fetch_assoc()) {
                                                                echo "<tr>";
                                                               ;
                                                                echo "<td>" . $row["shopname"]. "</td>";
                                                                echo "<td>" . $row["supplier_shop_name"]. "</td>";
                                                                echo "<td>" . $row["supplier_contact"]. "</td>";
                                                                echo "<td>" . $row["location"]. "</td>";

                                                                echo "<td>";

                                                                echo "<form action='supplier_page_edit.php' method='post'>";
                                                                echo "<input type='hidden' name='id' value='" . $row["supplier_id"] . "' />";
                                                                echo "<button type='submit' class='btn btn-edit btn-success'>Edit</button>";
                                                                echo "</form>";

                                                                echo "<form action='supplier_delete.php' method='post'>";
                                                                echo "<input type='hidden' name='id' value='" . $row["supplier_id"] . "' />";
                                                                echo "<button type='submit' name='delete' class='btn btn-delete btn-danger'>Delete</button>";
                                                                echo "</form>";

                                                                echo "</td>";
                                                                echo "</tr>";

                                                            }
                                                        } else {
                                                            echo "<tr><td colspan='4'>0 results</td></tr>";
                                                        }
                                                        $connection->close();
                                                        ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- User Details Modal -->
    <div id="user-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>User Details</h2>
            <p><strong>Username:</strong> <span id="modal-username"></span></p>
            <p><strong>Email:</strong> <span id="modal-email"></span></p>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
