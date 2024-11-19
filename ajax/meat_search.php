<?php

header('Content-Type: application/json');
echo json_encode($response);



include("../connection.php");

$search_query = htmlspecialchars($_GET['search_query'] ?? '', ENT_QUOTES, 'UTF-8');

// Prepare the SQL query to search for meat parts
$sql = "SELECT * FROM meat_registration_db WHERE part_name LIKE ?";
$stmt = $connection->prepare($sql);
$search_term = "%" . $search_query . "%";
$stmt->bind_param("s", $search_term);
$stmt->execute();
$result = $stmt->get_result();

// Insert order logic (only if form is submitted)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_meat_id'])) {
    $meat_id = $_POST['order_meat_id'];
    $quantity = $_POST['quantity'];
    
    // Assuming you have an `orders` table with columns (id, meat_type_id, quantity, order_date)
    $insert_sql = "INSERT INTO orders (meat_type_id, quantity, order_date) VALUES (?, ?, NOW())";
    $insert_stmt = $connection->prepare($insert_sql);
    $insert_stmt->bind_param("ii", $meat_id, $quantity);
    $insert_stmt->execute();
    $insert_stmt->close();


    echo "<script>
    alert('You have Succesfully Order!');
    window.location.href = '../order_page.php';
  </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meat Search</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .form-container {
            margin: 20px 0;
            text-align: center;
            width: 100%;
            max-width: 600px;
        }

        .form-container input {
            padding: 10px;
            width: 70%;
            max-width: 300px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .form-container button {
            padding: 10px 15px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .btn {
            padding: 10px;
            color: white;
            background-color: red;
            text-decoration: none;
            border-radius: 4px;
            margin-left: 10px;
        }

        table {
            width: 100%;
            max-width: 800px;
            border-collapse: collapse;
            margin: 20px auto;
            font-size: 16px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

<div class="form-container">
    <form action="meat_search.php" method="GET">
        <input type="text" name="search_query" placeholder="Search for meat parts..." value="<?= $search_query ?>">
        <button type="submit">Search</button>
        <a href="../search_meat.php" class="btn">Back</a>
    </form>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Meat Type</th>
            <th>Meat Parts</th>
            <th>Price</th>
            <th>Supplier</th>
            <th>Purchased Date</th>
            <th>Order</th>
        </tr>
    </thead>
    <tbody>
        <?php
       if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['meat_type']}</td>
                    <td>{$row['part_name']}</td>
                    <td>{$row['price']}</td>
                    <td>{$row['supplier']}</td>
                    <td>{$row['dispatch_date']}</td>
                    <td>
                        <button class='btn btn-primary' data-toggle='modal' data-target='#purchaseModal' 
                        data-id='{$row['id']}' data-name='{$row['part_name']}' data-price='{$row['price']}'>Purchase</button>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No results found</td></tr>";
    }


        // Close the prepared statement and the database connection
        $stmt->close();
        $connection->close();
        ?>
    </tbody>
</table>

<!-- Purchase Modal -->
<div class="modal fade" id="purchaseModal" tabindex="-1" role="dialog" aria-labelledby="purchaseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="">
                <div class="modal-header">
                    <h5 class="modal-title" id="purchaseModalLabel">Purchase Meat Part</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="modal-order-meat-id" name="order_meat_id">
                    <div class="form-group">
                        <label for="modal-meat-name">Meat Part</label>
                        <input type="text" class="form-control" id="modal-meat-name" readonly>
                    </div>
                    <div class="form-group">
                        <label for="modal-quantity">Quantity</label>
                        <input type="number" class="form-control" id="modal-quantity" name="quantity" value="1" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="modal-price">Price</label>
                        <input type="text" class="form-control" id="modal-price" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Confirm Purchase</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Handle passing data to the modal
    $('#purchaseModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var meatId = button.data('id');
        var meatName = button.data('name');
        var price = button.data('price');

        // Update the modal's content with data attributes
        var modal = $(this);
        modal.find('#modal-order-meat-id').val(meatId);
        modal.find('#modal-meat-name').val(meatName);
        modal.find('#modal-price').val(price);
    });
</script>