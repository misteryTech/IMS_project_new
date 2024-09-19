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
        input[type="text"] {
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
            <form action="meat_type_reg.php" method="POST" class="form-container">
                <h2>Meat Type Registration</h2>
                <div class="form-group">
                    <label for="shopname">Meat Type</label>
                    <input type="text" id="meatname" name="meatname" placeholder="Add Meat Type" required>
                </div>
                <div class="form-group">
                    <label for="meat_type">Select Meat Types:</label>
                    <div class="checkbox-group">
                        <label><input type="checkbox" name="meat_types[]" value="Pork">Pork</label>
                        <label><input type="checkbox" name="meat_types[]" value="Beef">Beef</label>
                        <label><input type="checkbox" name="meat_types[]" value="Chicken">Chicken</label>
                    </div>
                </div>
                <button type="submit">Register Type</button>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
