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
<?php
    include("sidebar.php");
?>
    <div class="main-content">
        <header>
            <h1>Welcome, Admin</h1>
            <button id="menu-toggle">Menu</button>
        </header>
        <div class="content">

            <form action="supplier_registration.php" method="POST" class="form-container">
            <h2>Register Supplier</h2>
                <div class="form-group">
                    <label for="name">Supplier Shop Name:</label>
                    <input type="text" id="shopname" name="shopname" placeholder="Add Supplier Shop Name" required>
                </div>

                <div class="form-group">
                    <label for="name">Supplier Name:</label>
                    <input type="text" id="supplier_name" name="supplier_name" placeholder="Add Supplier Name" required>
                </div>


                <div class="form-group">
                    <label for="name">Supplier Contact:</label>
                    <input type="text" id="supplier_contact" name="supplier_contact" placeholder="Add Supplier Contact" required>
                </div>




                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location" placeholder="Location" required>
                </div>

                <button type="submit">Register Supplier</button>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
