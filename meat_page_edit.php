<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $meat_id = $_POST["id"];

    $sql_select = "SELECT * FROM meat_db WHERE id = '$meat_id'";
    $result = $connection->query($sql_select);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        $meat_new_id = $row["id"];
        $type = $row["meat_type"];
        $parts = $row["meat_parts"];
        $price = $row["meat_price"];
        $purchased_date = $row["purchased_date"];
        $supplier_id = $row["supplier_id"];
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
        input, select {
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
include ("sidebar.php");
?>
    <div class="main-content">
        <header>
            <h1>Welcome, Admin</h1>
            <button id="menu-toggle">Menu</button>
        </header>
        <div class="content">
            <h2>Edit Meat Registration</h2>
            <form action="meat_edit_price.php" method="POST" class="form-container">
                <div class="form-group">
                    <input type="hidden" id="meat_new_id" name="meat_new_id" value="<?php echo htmlspecialchars($meat_new_id); ?>" required>
                </div>

                <div class="form-group">
                    <label for="name">Category:</label>
                    <input type="text" id="category" name="category" value="<?php echo htmlspecialchars($type); ?>" readonly>
                </div>

                <div class="form-group">
                <label for="name">Parts:</label>
                    <input type="text" id="parts" name="parts" value="<?php echo htmlspecialchars($parts); ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($price); ?>" required>
                </div>

                <div class="form-group">
                    <label for="received_date">Purchased Date:</label>
                    <input type="date" id="purchased_date" name="purchased_date" value="<?php echo htmlspecialchars($purchased_date); ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="supplier">Supplier:</label>
                    <select id="supplier" name="supplier" readonly>
                        <option value="<?php echo htmlspecialchars($supplier_id); ?>" selected><?php echo htmlspecialchars($supplier_id); ?></option>
                    </select>
                </div>

                <input type="hidden" name="supplier" value="<?php echo htmlspecialchars($supplier_id); ?>">

                <button type="submit" class="btn btn-edit btn-success">Edit</button>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>