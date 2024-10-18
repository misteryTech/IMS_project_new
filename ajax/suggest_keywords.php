<?php
include ("connection.php");

$search_query = $_GET['q'] ?? '';

$sql = "SELECT DISTINCT part_name FROM meat_registration_db WHERE part_name LIKE ? LIMIT 5";
$stmt = $connection->prepare($sql);
$search_term = "%" . $search_query . "%";
$stmt->bind_param("s", $search_term);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div onclick='selectSuggestion(\"" . htmlspecialchars($row['part_name']) . "\")'>{$row['part_name']}</div>";
    }
} else {
    // Show message when no results found
    echo "<div>No registered meat found</div>";
}

$stmt->close();
$connection->close();
?>
