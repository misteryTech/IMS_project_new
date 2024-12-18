<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Meat Registration</title>
    <style>
       /* Basic Reset */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        /* Sidebar */
        .sidebar { width: 250px; height: 100vh; background-color: #2c3e50; color: white; position: fixed; top: 0; left: 0; padding: 20px; }
        .sidebar h2 { margin-bottom: 20px; }
        .sidebar ul { list-style-type: none; }
        .sidebar ul li { margin-bottom: 15px; }
        .sidebar ul li a { color: white; text-decoration: none; font-size: 16px; display: block; padding: 8px; transition: background 0.3s; }
        .sidebar ul li a:hover { background-color: #34495e; border-radius: 5px; }
        /* Main Content */
        .main-content { margin-left: 270px; padding: 40px; background-color: #ecf0f1; min-height: 100vh; }
        .main-content header h1 { margin-bottom: 30px; color: #2c3e50; }
        .form-flex { display: flex; gap: 20px; }
        .form-container { flex: 1; padding: 20px; border: 1px solid #ccc; border-radius: 8px; background-color: #f9f9f9; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); }
        .form-group { margin-bottom: 15px; }
        label { font-size: 14px; margin-bottom: 5px; display: block; }
        input[type="text"], select { width: 100%; padding: 8px; font-size: 14px; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 10px 15px; font-size: 16px; border: none; border-radius: 4px; cursor: pointer; width: 100%; margin-top: 10px; }
        button.add-part { background-color: #007bff; color: white; }
        button.add-part:hover { background-color: #0056b3; }
        button.remove-part { background-color: #dc3545; color: white; }
        button.remove-part:hover { background-color: #a71d2a; }
        button[type="submit"] { background-color: #4CAF50; color: white; }
        button[type="submit"]:hover { background-color: #45a049; }
        .meat-list { margin-top: 20px; }
        .meat-list h3 { font-size: 16px; margin-bottom: 10px; }
        .meat-item { font-size: 14px; padding: 5px; background-color: #ffffff; border-bottom: 1px solid #ccc; display: flex; justify-content: space-between; align-items: center; }
     
    </style>
</head>
<body>

<?php
include("sidebar.php");

// Database connection
$conn = new mysqli("localhost", "root", "", "ims_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch registered meat types and parts
$registeredMeatTypes = $conn->query("SELECT * FROM meat_types");
if (!$registeredMeatTypes) {
    echo "Error: " . $conn->error;
}

$registeredMeatParts = $conn->query("SELECT meat_parts.id, meat_parts.part_name, meat_types.meat_type 
                                      FROM meat_parts 
                                      JOIN meat_types ON meat_parts.meat_type_id = meat_types.id");
if (!$registeredMeatParts) {
    echo "Error: " . $conn->error;
}
?>

<div class="main-content">
    <header>
        <h1>Meat Registration</h1>
    </header>

    <div class="form-flex">
        <!-- Meat Type Registration Form -->
        <div class="form-container">
            <h2>Meat Type Registration</h2>
            <form action="process/meat_type_r.php" method="POST">
                <div class="form-group">
                    <label for="meat_type">Meat Type:</label>
                    <input type="text" id="meat_type" name="meat_type" required>
                </div>
                <button type="submit">Register Meat Type</button>
            </form>
            <div class="meat-list">
                <h3>Registered Meat Types:</h3>
                <?php
                if ($registeredMeatTypes && $registeredMeatTypes->num_rows > 0) {
                    while ($row = $registeredMeatTypes->fetch_assoc()) {
                        echo "<div class='meat-item'>" . htmlspecialchars($row['meat_type']) . 
                             " <a href='process/delete_meat_type.php?id=" . htmlspecialchars($row['id']) . "'>Delete</a></div>";
                    }
                } else {
                    echo "<div class='meat-item'>No meat types registered yet.</div>";
                }
                ?>
            </div>
        </div>

        <div class="form-container">
            <h2>Meat Part Registration</h2>
            <form action="process/meat_part_registration.php" method="POST">
                <div class="form-group">
                    <label for="meat_type_id">Select Meat Type:</label>
                    <select id="meat_type_id" name="meat_type_id" required>
                        <option value="">-- Select Meat Type --</option>
                        <?php
                        $meatTypesResult = $conn->query("SELECT * FROM meat_types");
                        while ($meatTypesResult && $row = $meatTypesResult->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['meat_type']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div id="parts-container">
                    <div class="form-group part-item">
                        <label for="part_name_1">Part Name:</label>
                        <input type="text" id="part_name_1" name="part_name[]" required>
                        <button type="button" class="remove-part" style="display:none;">Remove</button>
                    </div>
                </div>
                <button type="button" class="add-part" id="add-part">Add Part</button>
                <button type="submit">Register Meat Parts</button>
            </form>

             <div class="meat-list">
                <h3>Registered Meat Parts:</h3>
                <?php
                if ($registeredMeatParts && $registeredMeatParts->num_rows > 0) {
                    while ($row = $registeredMeatParts->fetch_assoc()) {
                        echo "<div class='meat-item'>" . htmlspecialchars($row['meat_type']) . " - " . htmlspecialchars($row['part_name']) . 
                             " <a href='process/delete_meat_part.php?id=" . htmlspecialchars($row['id']) . "'>Delete</a> | " .
                             "<a href='meat_registration_form.php?meat_type=" . urlencode($row['meat_type']) . "&part_name=" . urlencode($row['part_name']) . "'>Register Details</a></div>";
                    }
                } else {
                    echo "<div class='meat-item'>No meat parts registered yet.</div>";
                }
                ?>
            </div>
        </div>
    </div>


</div>

<?php $conn->close(); ?>

</body>
</html>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const partsContainer = document.getElementById('parts-container');
        const addPartButton = document.getElementById('add-part');
        let partIndex = 1;

        addPartButton.addEventListener('click', function() {
            partIndex++;
            const partItem = document.createElement('div');
            partItem.classList.add('form-group', 'part-item');
            partItem.innerHTML = `
                <label for="part_name_${partIndex}">Part Name:</label>
                <input type="text" id="part_name_${partIndex}" name="part_name[]" required>
                <button type="button" class="remove-part">Remove</button>
            `;
            partsContainer.appendChild(partItem);

            const removeButtons = document.querySelectorAll('.remove-part');
            removeButtons.forEach(button => button.style.display = 'inline');
        });

        partsContainer.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-part')) {
                const partItem = e.target.parentElement;
                partsContainer.removeChild(partItem);
            }
        });
    });


</script>