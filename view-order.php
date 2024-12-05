<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Transactions</title>
    <link rel="stylesheet" href="style.css">
    <style>
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
        .filter-input,
        .print-button {
            margin-bottom: 15px;
            padding: 10px 15px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .print-button {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        .print-button:hover {
            background-color: #0056b3;
        }
        /* Hide elements during printing */
        @media print {
            .filter-input,
            .print-button,
            #menu-toggle,
            .summary {
                display: none;
            }
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
        <h2>Monthly Summary</h2>
        <div class="header-section">
            <?php
            $currentMonth = date('F'); // Get the current month's full name (e.g., "December")
            echo "<p class='current-month'>Current Month: $currentMonth</p>";
            ?>
        </div>

        
        <?php
        include("connection.php");
        $sql_select = "SELECT * FROM transactions ORDER BY created_at DESC";
        $result = mysqli_query($connection, $sql_select);

        $totals = [];
        $grandTotalItems = 0;
        $grandTotalPayment = 0;

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $monthYear = date('F Y', strtotime($row['created_at']));
                $items = json_decode($row['items'], true);
                $itemsCount = 0;

                if (is_array($items)) {
                    foreach ($items as $item) {
                        $itemsCount += $item['quantity'];
                    }
                }

                if (!isset($totals[$monthYear])) {
                    $totals[$monthYear] = [
                        'totalItems' => 0,
                        'totalPayment' => 0,
                    ];
                }

                $totals[$monthYear]['totalItems'] += $itemsCount;
                $totals[$monthYear]['totalPayment'] += $row['payment'];
                $grandTotalItems += $itemsCount;
                $grandTotalPayment += $row['payment'];
            }
        }
        ?>

        <div>
            <table>
                <thead>
                    <tr>
                        <th>Month</th>
                        <th>Total Items Purchased</th>
                        <th>Total Payment</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($totals as $monthYear => $summary): ?>
                        <tr>
                            <td><?= $monthYear ?></td>
                            <td><?= $summary['totalItems'] ?></td>
                            <td><?= number_format($summary['totalPayment'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <h2>Transaction Records</h2>

        <input type="text" id="filterInput" class="filter-input" placeholder="Search transactions..." onkeyup="filterTable()">
        <button class="print-button" onclick="printTable()">Print Table</button>

        <table id="dataTable">
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Total</th>
                    <th>Payment</th>
                    <th>Change</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($connection, $sql_select);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $transactionId = htmlspecialchars($row['id']);
                        echo "<tr>";
                        echo "<td>{$transactionId}</td>";
                        echo "<td>" . number_format($row['total'], 2) . "</td>";
                        echo "<td>" . number_format($row['payment'], 2) . "</td>";
                        echo "<td>" . number_format($row['amount_change'], 2) . "</td>";
                        echo "<td>" . date('F/h/Y', strtotime($row['created_at'])) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No transactions found.</td></tr>";
                }
                mysqli_close($connection);
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
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
