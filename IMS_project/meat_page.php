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
        select, input {
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
<?php
    include("sidebar.php");
?>
    <div class="main-content">
        <header>
            <h1>Welcome, Admin</h1>
            <button id="menu-toggle">Menu</button>
        </header>
        <div class="content">

            <form action="process_reg_meat.php" method="POST" class="form-container">
            <h2>Register Meat</h2>
            <div class="form-group">
                    <label for="name">Meat name:</label>
                    <select id="name" name="name">
                        <option value="">-- Select--</option>
                        <option value="belly">Belly</option>
                        <option value="ribs">Ribs</option>
                        <option value="skin">Skin</option>
                        <option value="ham">Ham</option>
                        <option value="head">Head</option>
                        <option value="whole">Whole</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="type">Type:</label>
                    <select id="type" name="type" required>
                        <option value="">-- Select--</option>
                        <option value="beef">Cow</option>
                        <option value="pork">Pig</option>
                        <option value="chicken">Chicken</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" required>
                </div>

                <div class="form-group">
                    <label for="expiry_date">Expiry Date:</label>
                    <input type="date" id="expiry_date" name="expiry_date" required>
                </div>

                <div class="form-group">
                    <label for="batch_number">Batch Number:</label>
                    <input type="number" id="batch_number" name="batch_number" required>
                </div>

                <div class="form-group">
                    <label for="received_date">Received Date:</label>
                    <input type="date" id="received_date" name="received_date" required>
                </div>

                <div class="form-group">
                    <label for="supplier">Supplier:</label>
                    <select id="supplier" name="supplier" required>
                        <?php
                            include("connection.php");
                            $mysqli_query_supplier = mysqli_query($connection,"SELECT * FROM supplier");
                            echo "<option>Select Supplier</option>";
                            while ($row = mysqli_fetch_assoc($mysqli_query_supplier)) {
                                echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                            }
                        ?>
                    </select>
                </div>

                <button type="submit">Register</button>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
