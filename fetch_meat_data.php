

<?php
include("connection.php");

$sql_select = "SELECT * FROM meat_registration_db";
$result = $connection->query($sql_select);

$data = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $row['action'] = '
            <div class="action-buttons">
                <form>
                    <button type="button" class="btn btn-edit btn-success btn-sm" 
                        onclick="openEditModal(\'' . $row["id"] . '\', \'' . $row["meat_type"] . '\', \'' . $row["part_name"] . '\', \'' . $row["price"] . '\', \'' . $row["date"] . '\', \'' . $row["batch_number"] . '\', \'' . $row["supplier"] . '\')">Edit</button>
                </form>
                <form>
                    <input type="hidden" name="id" value="' . $row["id"] . '" />
                    <button type="button" class="btn btn-delete btn-danger btn-sm" onclick="deleteMeatRecord(this)">Delete</button>
                </form>
                <form>
                    <button type="button" class="btn btn-barcode btn-info btn-sm" 
                        data-id="' . $row["id"] . '" 
                        data-meat-type="' . $row["meat_type"] . '" 
                        data-part-name="' . $row["part_name"] . '" 
                        data-price="' . $row["price"] . '" 
                        data-batch-number="' . $row["batch_number"] . '" 
                        data-supplier="' . $row["supplier"] . '">BARCODE</button>
                </form>
            </div>
        ';
        $data[] = $row;
    }
       
}

echo json_encode(['data' => $data]);

$connection->close();
?>

