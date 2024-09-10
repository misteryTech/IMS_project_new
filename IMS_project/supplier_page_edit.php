<?php
                        include("connection.php");

                        if ($_SERVER["REQUEST_METHOD"] == "POST"){

                        $supplier_id = $_POST["id"];

                        $sql_select = "SELECT * FROM supplier WHERE supplier_id = '$supplier_id'";
                        $result = $connection->query($sql_select);

                        if ($result->num_rows == 1) {
                            $row = $result->fetch_assoc();

                            $supplier_id = $row["supplier_id"];
                            $name = $row["shopname"];
                            $supplier_name = $row["supplier_name"];
                            $supplier_contact = $row["supplier_contact"];
                            $location = $row["location"];

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
    <style>
        .form-container {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-size: 14px;
            margin-bottom: 5px;
            display: block;
        }
        input {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px 15px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<?php include("sidebar.php"); ?>

<div class="main-content">
    <header>
        <h1>Welcome, Admin</h1>
        <button id="menu-toggle">Menu</button>
    </header>
    <div class="content">
        <h2>Edit Supplier</h2>
        <form action="supplier_edit_process.php" method="POST" class="form-container">

            <div class="form-group">
                <input type="hidden" name="supplier_id" value="<?php echo htmlspecialchars($supplier_id); ?>" required>
            </div>

            <div class="form-group">
                <label for="name">Shop Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            </div>


            <div class="form-group">
                <label for="name">Supplier Name:</label>
                <input type="text" id="name" name="supplier_name" value="<?php echo htmlspecialchars($supplier_name); ?>" required>
            </div>


            <div class="form-group">
                <label for="name">Supplier Contact:</label>
                <input type="text" id="name" name="supplier_contact" value="<?php echo htmlspecialchars($supplier_contact); ?>" required>
            </div>


            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($location); ?>" placeholder="Location" required>
            </div>

            <button type="submit">Update Supplier</button>
        </form>
    </div>
</div>

<script src="script.js"></script>
</body>
</html>
