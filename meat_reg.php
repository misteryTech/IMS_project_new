<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beef Meat Registration</title>
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
                <label for="meat_type">Meat Type:</label>
                <select id="meat_type" name="meat_type" required>
    <option value="">-- Select --</option>
    <?php
    include("connection.php");

    // Select distinct types to avoid duplicates
    $mysqli_query_supplier = mysqli_query($connection, "SELECT DISTINCT type FROM type_meat_db ORDER BY type ASC");

    if (!$mysqli_query_supplier) {
        die("Query failed: " . mysqli_error($connection));
    }

    while ($row = mysqli_fetch_assoc($mysqli_query_supplier)) {
        echo "<option value='" . $row['type'] . "'>" . $row['type'] . "</option>";
    }
    ?>
</select>

            </div>



            <div class="form-group">
    <label for="part">Part:</label>
    <select id="part" name="part">
        <option value="">-- Select Part --</option>
        <!-- This will be populated via AJAX -->
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
                <label for="received_date">Meat Disposed:</label>
                <input type="date" id="meat_disposed" name="meat_disposed" required>
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
                        echo "<option value='" . $row['shopname'] . "'>" . $row['shopname'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit">Register Beef Meat</button>
            </form>
        </div>
    </div>
    <script src="script.js"></script>

    <script>
        // Listen for changes in the meat_type dropdown
document.getElementById('meat_type').addEventListener('change', function() {
    var meatType = this.value;
    var partDropdown = document.getElementById('part');

    // Clear the existing options in the part dropdown
    partDropdown.innerHTML = '<option value="">-- Select Part --</option>';

    if (meatType) {
        // Send an AJAX request to fetch parts for the selected meat type
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'get_parts.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if (this.status === 200) {
                var parts = JSON.parse(this.responseText);

                // Populate the parts dropdown with the returned data
                parts.forEach(function(part) {
                    var option = document.createElement('option');
                    option.value = part.toLowerCase();
                    option.textContent = part;
                    partDropdown.appendChild(option);
                });
            }
        };

        // Send the selected meat type to the server
        xhr.send('meat_type=' + meatType);
    }
});


    </script>
</body>
</html>
