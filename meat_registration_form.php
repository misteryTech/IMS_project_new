<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meat Registration Form</title>
    <link rel="stylesheet" href="style.css">
    <!-- Include your CSS and other styling here -->
</head>
<body>
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

    <?php
        // Get meat type and part name from the URL parameters
        $meatType = isset($_GET['meat_type']) ? htmlspecialchars($_GET['meat_type']) : '';
        $partName = isset($_GET['part_name']) ? htmlspecialchars($_GET['part_name']) : '';
    ?>

    <div class="form-container">
        <form action="process/meat_type_reg_r.php" method="POST">
           <a href="http://localhost/ims_project_new/meat_registration_r.php"> <h2>Register Meat Type</h2></a>

            <div class="form-group">
                <label for="meat_type">Meat Type:</label>
                <input type="text" name="meat_type" id="meat_type" value="<?php echo $meatType; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="part_name">Meat Part:</label>
                <input type="text" name="part_name" id="part_name" value="<?php echo $partName; ?>" readonly>
            </div>

            <!-- Additional Fields for Registration -->
            <div class="form-group">
                <label>Price:</label>
                <input type="number" name="price" required>
            </div>

            <div class="form-group">
                <label>Date:</label>
                <input type="date" name="date" required>
            </div>

            <div class="form-group">
                <label>Dispatch Date:</label>
                <input type="date" name="dispatch_date" required>
            </div>

            <div class="form-group">
                <label>Stock :</label>
                <input type="text" name="stock" required>
            </div>

            <div class="form-group">
    <label>Batch Number:</label>
    <input type="number" id="batch-number" name="batch_number" required readonly>
    <button type="button" id="generate-batch" class="btn btn-secondary">Generate Batch Number</button>
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
</body>
</html>


<script>
    function generateRandomBatchNumber() {
    // Generate a random number between 100000 and 999999
    const randomBatchNumber = Math.floor(100000 + Math.random() * 900000);
    document.getElementById('batch-number').value = randomBatchNumber;
}

// Generate a batch number on page load
window.onload = generateRandomBatchNumber;

// Generate a new batch number when the button is clicked
document.getElementById('generate-batch').addEventListener('click', generateRandomBatchNumber);



</script>