<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Transactions</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 60%;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow-x: auto;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        .filter-input {
            margin-bottom: 15px;
            padding: 8px;
            width: 100%;
            max-width: 300px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .print-button {
            margin-bottom: 15px;
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .print-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php include("sidebar.php"); ?>

<div class="main-content">
    <header>
        <h1>Transactions</h1>
        <button id="menu-toggle">Menu</button>
    </header>
    <div class="content">
        <h2>Transaction Records</h2>


        <?php
        include("connection.php");
        $sql_select = "SELECT * FROM transactions ORDER BY created_at DESC";
        $result = mysqli_query($connection, $sql_select);

        $totalItems = 0;
        $totalPayment = 0;

        // Calculate total items and payment
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $items = json_decode($row['items'], true);
                if (is_array($items)) {
                    foreach ($items as $item) {
                        $totalItems += $item['quantity'];
                    }
                }
                $totalPayment += $row['payment'];
            }
        }
        ?>

<div class="summary">
            <h3>Total Items Purchased: <?= $totalItems ?></h3>
            <h3>Total Payment: <?= number_format($totalPayment, 2) ?></h3>
        </div>

        <input type="text" id="filterInput" class="filter-input" placeholder="Search transactions..." onkeyup="filterTable()">
        <button class="print-button" onclick="printTable()">Print Table</button>
        <table id="dataTable">
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Payment</th>
                    <th>Change</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("connection.php");
                $sql_select = "SELECT * FROM transactions ORDER BY created_at DESC";
                $result = mysqli_query($connection, $sql_select);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $transactionId = htmlspecialchars($row['id']);
                        $items = json_decode($row['items'], true); // Decode JSON items to an array
                        $itemsHtml = '';

                        if (is_array($items) && count($items) > 0) {
                            $itemsHtml .= '<table>';
                            $itemsHtml .= '<thead>
                                <tr>
                                    <th>Meat Type</th>
                                    <th>Part Name</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Quantity</th>
                                    <th>Cost</th>
                                </tr>
                            </thead><tbody>';
                            foreach ($items as $item) {
                                $itemsHtml .= '<tr>';
                                $itemsHtml .= '<td>' . htmlspecialchars($item['meat_type']) . '</td>';
                                $itemsHtml .= '<td>' . htmlspecialchars($item['part_name']) . '</td>';
                                $itemsHtml .= '<td>' . number_format($item['price'], 2) . '</td>';
                                $itemsHtml .= '<td>' . htmlspecialchars($item['stock']) . '</td>';
                                $itemsHtml .= '<td>' . htmlspecialchars($item['quantity']) . '</td>';
                                $itemsHtml .= '<td>' . number_format($item['cost'], 2) . '</td>';
                                $itemsHtml .= '</tr>';
                            }
                            $itemsHtml .= '</tbody></table>';
                        } else {
                            $itemsHtml = '<p>No items available</p>';
                        }

                        echo "<tr>";
                        echo "<td>{$transactionId}</td>";
                        echo "<td>
                            <button class='view-items-btn' data-transaction-id='{$transactionId}'>View Items</button>
                            <div id='modal-{$transactionId}' class='modal'>
                                <div class='modal-content'>
                                    <span class='close' data-transaction-id='{$transactionId}'>&times;</span>
                                    <h3>Order Items</h3>
                                    <div>{$itemsHtml}</div>
                                </div>
                            </div>
                        </td>";
                        echo "<td>" . number_format($row['total'], 2) . "</td>";
                        echo "<td>" . number_format($row['payment'], 2) . "</td>";
                        echo "<td>" . number_format($row['amount_change'], 2) . "</td>";
                        echo "<td>" .  date ( $row ['created_at']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No transactions found.</td></tr>";
                }
                mysqli_close($connection);
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    // Modal functionality
    document.addEventListener('DOMContentLoaded', function () {
        const viewButtons = document.querySelectorAll('.view-items-btn');
        const closeButtons = document.querySelectorAll('.close');

        viewButtons.forEach(button => {
            button.addEventListener('click', function () {
                const transactionId = this.getAttribute('data-transaction-id');
                const modal = document.getElementById(`modal-${transactionId}`);
                modal.style.display = 'block';
            });
        });

        closeButtons.forEach(button => {
            button.addEventListener('click', function () {
                const transactionId = this.getAttribute('data-transaction-id');
                const modal = document.getElementById(`modal-${transactionId}`);
                modal.style.display = 'none';
            });
        });

        window.addEventListener('click', function (event) {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });
    });

    // Filter table rows based on input
    function filterTable() {
        const input = document.getElementById('filterInput');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('dataTable');
        const rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let match = false;

            for (let j = 0; j < cells.length; j++) {
                if (cells[j].innerText.toLowerCase().includes(filter)) {
                    match = true;
                    break;
                }
            }
            rows[i].style.display = match ? '' : 'none';
        }
    }

    // Print the table
    function printTable() {
        const originalContents = document.body.innerHTML;
        const printContents = document.querySelector('.content').innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }
</script>
</body>
</html>
