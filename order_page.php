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
        .checkbox-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px; /* Space between checkboxes */
        }
        .checkbox-container label {
            display: flex;
            align-items: center;
            margin: 0;
        }
        .checkbox-item {
            display: inline-block;
            margin-right: 15px;
            font-size: 14px;
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
        <form action="process_order_meat.php" method="POST" class="form-container">
            <h2>Order Meat</h2>

            <!-- Meat Type Dropdown -->
            <div class="form-group">
                <label for="meat_type">Meat Type:</label>
                <select id="meat_type" name="meat_type" required>
                    <option value="">-- Select --</option>
                    <?php
                    include("connection.php");
                    $mysqli_query_meat = mysqli_query($connection, "SELECT * FROM type_meat_db");

                    if (!$mysqli_query_meat) {
                        die("Query failed: " . mysqli_error($connection));
                    }

                    while ($row = mysqli_fetch_assoc($mysqli_query_meat)) {
                        echo "<option value='" . $row['id'] . "'>" . $row['meat_type'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Meat Name Checkboxes -->
            <div class="form-group">
                <label for="meat_name">Meat Name:</label>
                <div id="meat_names_container" class="checkbox-container">
                    <!-- Dynamic checkboxes will be inserted here -->
                </div>
            </div>

            <!-- Meat Part Checkboxes -->
            <div class="form-group">
                <label for="meat_part">Meat Part:</label>
                <div id="meat_parts_container" class="checkbox-container">
                    <!-- Dynamic checkboxes will be inserted here -->
                </div>
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
                    <option value="">-- Select --</option>
                    <?php
                    $mysqli_query_supplier = mysqli_query($connection, "SELECT * FROM supplier");

                    if (!$mysqli_query_supplier) {
                        die("Query failed: " . mysqli_error($connection));
                    }

                    while ($row = mysqli_fetch_assoc($mysqli_query_supplier)) {
                        echo "<option value='" . $row['supplier_id'] . "'>" . $row['shopname'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit">Register</button>
        </form>
    </div>
</div>

<!-- jQuery (For AJAX) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // When meat type is changed
        $('#meat_type').change(function() {
            var meatTypeId = $(this).val();

            if (meatTypeId) {
                // Fetch Meat Names based on Meat Type
                $.ajax({
                    url: 'get_meat_names.php', // PHP file to fetch meat names
                    type: 'POST',
                    data: { meat_type_id: meatTypeId },
                    success: function(response) {
                        $('#meat_names_container').html(response); // Populate meat names checkboxes
                    }
                });

                // Fetch Meat Parts based on Meat Type
                $.ajax({
                    url: 'get_meat_parts.php', // PHP file to fetch meat parts
                    type: 'POST',
                    data: { meat_type_id: meatTypeId },
                    success: function(response) {
                        $('#meat_parts_container').html(response); // Populate meat parts checkboxes
                    }
                });
            } else {
                // Clear the containers if no meat type is selected
                $('#meat_names_container').html('');
                $('#meat_parts_container').html('');
            }
        });
    });
</script>
</body>
</html>
