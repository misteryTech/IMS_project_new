<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chicken Meat Registration</title>
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
            <h2>Register Chicken Meat</h2>


            <div class="form-group">
                <label for="quantity">Meat Type</label>
                <input type="text" id="meat_type" name="meat_type" value="Chicken" readonly>
            </div>


            <div class="form-group">
                <label for="part">Chicken Part:</label>
                <select id="part" name="part">
                    <option value="">-- Select --</option>
                    <option value="breast">Breast</option>
                    <option value="wings">Wings</option>
                    <option value="drumstick">Drumstick</option>
                    <option value="thigh">Thigh</option>
                    <option value="whole">Whole Chicken</option>
                </select>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="received_date">Received Date:</label>
                <input type="date" id="received_date" name="received_date" required>
            </div>

            <div class="form-group">
                <label for="supplier">Supplier:</label>
                <select id="supplier" name="supplier" required>
                    <option value="">-- Select --</option>
                    <?php
                    include("connection.php");
                    $mysqli_query_supplier = mysqli_query($connection, "SELECT * FROM supplier");

                    if (!$mysqli_query_supplier) {
                        die("Query failed: " . mysqli_error($connection));
                    }

                    while ($row = mysqli_fetch_assoc($mysqli_query_supplier)) {
                        echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                    }
                    ?>
                </select>
            </div>


            <button type="submit">Register Chicken Meat</button>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
