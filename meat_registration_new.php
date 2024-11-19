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
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
        }
        .checkbox-group label {
            font-size: 14px;
            margin-right: 10px;
            display: flex;
            align-items: center;
        }
        .checkbox-group input[type="checkbox"] {
            margin-right: 5px;
        }
        button, .add-part-btn {
            padding: 10px 15px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover, .add-part-btn:hover {
            background-color: #45a049;
        }
        .hidden {
            display: none;
        }
        .add-part-btn {
            margin-top: 10px;
            width: auto;
            font-size: 14px;
        }
        /* Modal styles */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            background-color: rgba(0,0,0,0.4); 
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 30%; 
            border-radius: 8px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover, .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
<?php
    include("sidebar.php");

    // Database connection
    $conn = new mysqli("localhost", "root", "", "ims_db");

    // Check for database connection error
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Function to fetch parts from the database
function fetchParts($conn, $meatType) {
    $sql = "SELECT meat_parts FROM meat_new_db WHERE meat_type = '$meatType'";
    $result = $conn->query($sql);

    // Check if the query was successful
    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    $parts = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $parts[] = $row['meat_parts'];
        }
    }
    return $parts;
}
    $porkParts = fetchParts($conn, 'Pork');
    $beefParts = fetchParts($conn, 'Beef');
    $chickenParts = fetchParts($conn, 'Chicken');
?>
    <div class="main-content">
        <header>
            <h1>Welcome, Admin</h1>
            <button id="menu-toggle">Menu</button>
        </header>
        <div class="content">

            <form action="process/meat_type_reg.php" method="POST" class="form-container">
                <h2>Meat Type Registration</h2>
                <div class="form-group">
                    <label for="meat_type">Select Meat Types:</label>
                    <div class="checkbox-group">
                        <label><input type="checkbox" id="pork" name="meat_types[]" value="Pork" onchange="toggleCheckboxGroup('pork')">Pork</label>
                        <label><input type="checkbox" id="beef" name="meat_types[]" value="Beef" onchange="toggleCheckboxGroup('beef')">Beef</label>
                        <label><input type="checkbox" id="chicken" name="meat_types[]" value="Chicken" onchange="toggleCheckboxGroup('chicken')">Chicken</label>
                    </div>
                </div>

                <!-- Checkboxes for Pork -->
                <div class="form-group hidden" id="pork-options">
                    <label>Select Pork Parts:</label>
                    <div class="checkbox-group" id="pork-parts-list">
                        <?php foreach ($porkParts as $part): ?>
                            <label><input type="checkbox" name="pork_parts[]" value="<?= $part ?>"><?= $part ?></label>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="add-part-btn" onclick="openModal('Pork')">Add Part</button>
                </div>

                <!-- Checkboxes for Beef -->
                <div class="form-group hidden" id="beef-options">
                    <label>Select Beef Parts:</label>
                    <div class="checkbox-group" id="beef-parts-list">
                        <?php foreach ($beefParts as $part): ?>
                            <label><input type="checkbox" name="beef_parts[]" value="<?= $part ?>"><?= $part ?></label>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="add-part-btn" onclick="openModal('Beef')">Add Part</button>
                </div>

                <!-- Checkboxes for Chicken -->
                <div class="form-group hidden" id="chicken-options">
                    <label>Select Chicken Parts:</label>
                    <div class="checkbox-group" id="chicken-parts-list">
                        <?php foreach ($chickenParts as $part): ?>
                            <label><input type="checkbox" name="chicken_parts[]" value="<?= $part ?>"><?= $part ?></label>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="add-part-btn" onclick="openModal('Chicken')">Add Part</button>
                </div>

                <div class="form-group">
                    <label>Price: </label>
                    <input type="number" name="price">
                </div>


                <div class="form-group">
                    <label>Date: </label>
                    <input type="date" name="date">
                </div>


                <div class="form-group">
                    <label>Dispatch Date: </label>
                    <input type="date" name="dispatch_date">
                </div>

                

                <div class="form-group">
                    <label>Batch Number: </label>
                    <input type="number" name="batch_number">
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




                <button type="submit">Register Type</button>
            </form>
        </div>
    </div>

    <!-- Modal for adding parts -->
    <div id="addPartModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3>Add New Part</h3>
            <form action="process/add_part.php" method="POST">
                <input type="hidden" id="meatType" name="meat_type" value="">
                <label for="newPartName">Part Name:</label>
                <input type="text" id="newPartName" name="part_name" required>
                <button type="submit">Add Part</button>
            </form>
        </div>
    </div>

    <script>
        function toggleCheckboxGroup(meatType) {
            const checkbox = document.getElementById(meatType);
            const checkboxGroup = document.getElementById(`${meatType}-options`);
            
            if (checkbox.checked) {
                checkboxGroup.classList.remove('hidden');
            } else {
                checkboxGroup.classList.add('hidden');
            }
        }

        function openModal(meatType) {
            document.getElementById('meatType').value = meatType;
            document.getElementById('addPartModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('addPartModal').style.display = 'none';
        }
    </script>
</body>
</html>
