<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "ims_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    // Delete the meat part
    $sql = "DELETE FROM meat_parts WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Delete successfully!');
        window.location.href = '../meat_registration_r.php';
      </script>";
    } else {
        echo "Error deleting meat part: " . $conn->error;
    }
}

$conn->close();
header("Location: ../meat_registration_r.php");
exit();
?>
