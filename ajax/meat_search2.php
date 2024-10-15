<?php
include("../connection.php");

$search_query = isset($_GET['search_query']) ? $connection->real_escape_string($_GET['search_query']) : '';

$sql_select = "SELECT * FROM meat_db WHERE meat_type LIKE '%$search_query%' OR meat_parts LIKE '%$search_query%'";
$result = $connection->query($sql_select);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["meat_type"] . "</td>";
        echo "<td>" . $row["meat_parts"] . "</td>";
        echo "<td>" . $row["meat_price"] . "</td>";
        echo "<td>" . $row["purchased_date"] . "</td>";
        echo "<td>" . $row["meat_disposed"] . "</td>";
        echo "<td>" . $row["supplier_id"] . "</td>";
        echo "<td>";
        echo "<form action='meat_page_edit.php' method='post' style='display:inline-block;'>";
        echo "<input type='hidden' name='id' value='" . $row["id"] . "' />";
        echo "<button type='submit' class='btn btn-edit btn-success'>Edit</button>";
        echo "</form>";
        echo "<form action='delete_process.php' method='post' style='display:inline-block;'>";
        echo "<input type='hidden' name='id' value='" . $row["id"] . "' />";
        echo "<button type='submit' name='delete' class='btn btn-delete btn-danger'>Delete</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8'>No results found</td></tr>";
}

$connection->close();
?>
