
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
            <h2>Register Meat</h2>
            <form action="inventory_registration_process.php" method="POST" >

            <label>Meat Id</label>
                                    <select  id="meat_id" name="meat_id" required>
                                        <?php
                                       include("connection.php");

                                              $mysqli_query_supplier =  mysqli_query($connection,"SELECT * FROM products");
                                                          echo "<option>Select Meat</option></option>";
                                                    while ($row = mysqli_fetch_assoc($mysqli_query_supplier)) {

                                                      echo "<option value='" . $row['id'] . "'>Meat Details: " . $row['id'] . ' ' . $row['name']. ' ' .$row['category']. ' - Price: ' .$row['price']. "</option>";
                                                              }
                                       ?>

                                        </select>

             <label>Transaction Type</label>

                                            <select class="form-control" name="transaction_type" >
                                                    <option value="In" selected>In</option>
                                                    <option value="Out">Out</option>

                                            </select>
                                            <label>Quantity (kg.)</label>
                                            <input type="text" name="quantity" class="form-control form-control-user" required>





                                        <label>Transaction Date</label>
                                        <input type="date" name="transaction_date" required>


                <button type="submit">Register</button>

            </form>


        </div>
    </div>


    <script src="script.js"></script>
</body>
</html>
