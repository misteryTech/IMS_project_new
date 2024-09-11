<?php
                        include("connection.php");

                        if ($_SERVER["REQUEST_METHOD"] == "POST"){

                        $inventory_id = $_POST["id"];

                        $sql_select = "SELECT * FROM inventory_trans WHERE id = '$inventory_id'";
                        $result = $connection->query($sql_select);

                        if ($result->num_rows == 1) {
                            $row = $result->fetch_assoc();

                            $product_id = $row["productid"];
                            $transaction_type = $row["transaction_type"];
                            $quantity = $row["quantity"];
                            $transaction_date = $row["transaction_date"];

                        } else {
                            echo "User not found";
                            exit;
                        }



                        }
                        ?>



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

                                              $mysqli_query_supplier =  mysqli_query($connection,"SELECT * FROM meat_db WHERE id=$product_id ");

                                                    while ($row = mysqli_fetch_assoc($mysqli_query_supplier)) {

                                                      echo "<option value='" . $row['id'] . "'>Meat Details: " . $row['id'] . ' ' . $row['meat_type']. ' ' .$row['meat_parts']. ' - Price: ' .$row['meat_price']. "</option>";
                                                              }
                                       ?>

                                        </select>



                <label for="email">Transaction Type:</label>
                <select  id="trans" name="trans" required>
                                        <?php
                                       include("connection.php");

                                              $mysqli_query_supplier =  mysqli_query($connection,"SELECT * FROM inventory_trans WHERE id= $product_id ");
                                              ?>
                                                 <option value="<?php echo $transaction_type; ?>" selected><?php echo $transaction_type; ?></option>

                                              <?php
                                                    while ($row = mysqli_fetch_assoc($mysqli_query_supplier)) {


                                                      echo "<option value='" . $row['transaction_type'] . "'>" . $row['transaction_type'] . "</option>";
                                                              }
                                                                   ?>



                                        </select>





                                            <label>Quantity (kg.)</label>
                                            <input type="text" name="quantity" value="<?php echo $quantity; ?>" class="form-control form-control-user" required>


                                        <label>Transaction Date</label>
                                        <input type="date" name="transaction_date" value="<?php echo $transaction_date; ?>" required>


                <button type="submit">Register</button>

            </form>


        </div>
    </div>


    <script src="script.js"></script>
</body>
</html>
