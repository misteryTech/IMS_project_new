<?php
include ("connection.php");

$search_query = $_GET['q'] ?? '';

$sql = "SELECT DISTINCT meat_parts FROM meat_db WHERE meat_parts LIKE ? LIMIT 5";
$stmt = $connection->prepare($sql);
$search_term = "%" . $search_query . "%";
$stmt->bind_param("s", $search_term);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div onclick='selectSuggestion(\"" . htmlspecialchars($row['meat_parts']) . "\")'>{$row['meat_parts']}</div>";
    }
} else {
    // Show message when no results found
    echo "<div>No registered meat found</div>";
}

$stmt->close();
$connection->close();
?>
