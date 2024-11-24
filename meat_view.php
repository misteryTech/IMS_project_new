<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <!-- jQuery (necessary for DataTables JavaScript plugins) -->
    <script src="include/jquery-3.6.0.min.js"></script>

    <link href="include/datatables.min.css" rel="stylesheet">

    <script src="include/datatables.min.js"></script>

</head>
<body>

<?php
    include("sidebar.php");
?>

<div class="main-content">
    <header>
        <h1>Registered Meat</h1>
        <button id="menu-toggle">Menu</button>
    </header>
    <div class="content">
        <h2>Registered Meat</h2>
        <table id="dataTable" class="display">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Parts</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Purchased Date</th>
                    <th>Meat Disposed</th>
                    <th>Batch Number</th>
                    <th>Supplier</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="user-table">
                <!-- Data will be loaded here by DataTables AJAX -->
            </tbody>

        </table>
    </div>

    <!-- Barcode Modal -->
    <div id="barcodeModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2><span id="modalMeatType"></span></h2>
            <p id="barcodeValue"></p>
            
            
            <div style="display: flex; align-items: center;">
                <ul style="margin: 0; padding: 0; list-style: none;">
                <h3>Details:</h3>
                    <li><strong>Parts:</strong> <span id="modalPartName"></span></li>
                    <li><strong>Price:</strong> <span id="modalPrice"></span></li>
                    <li><strong>Batch Number:</strong> <span id="modalBatchNumber"></span></li>
                    <li><strong>Supplier:</strong> <span id="modalSupplier"></span></li>
                </ul>
                <div style="margin-left: 20px;">
                    <svg id="barcode"></svg> <!-- Placeholder for the barcode -->
                </div>
            </div>
            <br>
            <br>
            
            <!-- Print Barcode Button -->
            <button id="printBarcodeButton" class="btn btn-print">Print Barcode</button>
           
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">&times;</span>
            <h2>Edit Meat Details</h2>
            <form id="editForm">
                <input type="hidden" name="meat_id" id="editMeatId">
                <div class="form-group">
                    <label for="editMeatType">Type</label>
                    <input type="text" id="editMeatType" name="meat_type" required>
                </div>
                <div class="form-group">
                    <label for="editPartName">Parts</label>
                    <input type="text" id="editPartName" name="part_name" required>
                </div>
                <div class="form-group">
                    <label for="editPrice">Price</label>
                    <input type="number" id="editPrice" name="price" required>
                </div>
                <div class="form-group">
                    <label for="editPurchasedDate">Purchased Date</label>
                    <input type="date" id="editPurchasedDate" name="purchased_date" required>
                </div>
                <div class="form-group">
                    <label for="editBatchNumber">Batch Number</label>
                    <input type="text" id="editBatchNumber" name="batch_number" required>
                </div>
                <div class="form-group">
                    <label for="editSupplier">Supplier</label>
                    <input type="text" id="editSupplier" name="supplier" required>
                </div>
                <button type="button" onclick="submitEditForm()">Save Changes</button>
            </form>
        </div>
    </div>

</div>

<!-- Initialize DataTables -->
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "ajax": "fetch_meat_data.php",
            "columns": [
                { "data": "meat_type" },
                { "data": "part_name" },
                { "data": "price" },
                { "data": "stock" },
                { "data": "date" },
                { "data": "dispatch_date" },
                { "data": "batch_number" },
                { "data": "supplier" },
                { "data": "action" }
            ],
            "language": {
                "emptyTable": "No data available in table"
            },
            "drawCallback": function() {
                $(".btn-barcode").off("click").on("click", function() {
                    const meatId = $(this).data("id");
                    const meatType = $(this).data("meat-type");
                    const partName = $(this).data("part-name");
                    const price = $(this).data("price");
                    const batchNumber = $(this).data("batch-number");
                    const supplier = $(this).data("supplier");

                    openBarcodeModal(meatId, meatType, partName, price, batchNumber, supplier);
                });
            }
        });
    });
</script>

<script>
    // Get the modal
    var modal = document.getElementById("barcodeModal");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    let currentMeatId; // Global variable to store the current meat ID

    function openBarcodeModal(meatId, meatType, partName, price, batchNumber, supplier) {
        currentMeatId = batchNumber;
        document.getElementById("modalMeatType").innerText = meatType || "N/A";
        document.getElementById("modalPartName").innerText = partName || "N/A";
        document.getElementById("modalPrice").innerText = price || "N/A";
        document.getElementById("modalBatchNumber").innerText = batchNumber || "N/A";
        document.getElementById("modalSupplier").innerText = supplier || "N/A";

        modal.style.display = "block";
        generateBarcode(currentMeatId);
    }

    // Ensure the close button works as expected
    document.querySelector(".close").addEventListener("click", function () {
        modal.style.display = "none";
    });

    // Prevent modal from closing when clicking inside it
    document.querySelector(".modal-content").addEventListener("click", function (event) {
        event.stopPropagation();
    });

    // Close the modal when clicking outside the content area
    window.addEventListener("click", function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    });

    // Event listener for the print button
    document.getElementById("printBarcodeButton").addEventListener("click", function() {
        printBarcode();
    });

    // Close the modal when the close button is clicked
    span.addEventListener("click", function() {
        modal.style.display = "none";
    });

    // When the user clicks anywhere outside of the modal, close it
    window.addEventListener("click", function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    });

    function generateBarcode(meatId) {
        JsBarcode("#barcode", meatId, {
            format: "CODE128",
            lineColor: "#000", // Change this to black
            width: 2,
            height: 50,
            displayValue: true
        });
    }

    function printBarcode() {
        // Generate the barcode before printing
        generateBarcode(currentMeatId);

        // Open a new tab/window at the top of the current browser
        const printWindow = window.open('', '_blank', 'toolbar=0,location=0,menubar=0,resizable=1,scrollbars=1,width=600,height=400');

        // Check if the new window was successfully created
        if (printWindow) {
            printWindow.document.write(`
                <html>
                    <head>
                        <title>Print Barcode</title>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                text-align: center;
                            }
                            #barcode {
                                margin: 20px auto;
                            }
                            h2 {
                                margin-bottom: 0;
                            }
                        </style>
                    </head>
                    <body>
                        <h2>${document.getElementById("modalMeatType").innerText}</h2>
                        <svg id="barcode"></svg>
                        <p>Price: ${document.getElementById("modalPrice").innerText}</p>
                    </body>
                </html>
            `);

            printWindow.document.close(); // Close the document to apply styles
            printWindow.focus(); // Focus on the new window

            // Generate the barcode in the print window
            JsBarcode(printWindow.document.getElementById("barcode"), currentMeatId, {
                format: "CODE128",
                lineColor: "#000", // Change this to black
                width: 2,
                height: 50,
                displayValue: true
            });

            // Open the print dialog
            printWindow.print();

            // Close the print window after printing
            printWindow.close();
        } else {
            alert('Please allow popups for this website to print the barcode.');
        }
    }
</script>

<!-- codes related for deletion of meat -->
<script>
    function deleteMeatRecord(button) {
        // Show a confirmation dialog
        if (confirm("Are you sure you want to delete this record?")) {
            const form = $(button).closest("form");
            const meatId = form.find("input[name='id']").val();

            $.ajax({
                url: "delete_process.php",
                method: "POST",
                data: { id: meatId },
                dataType: "json",
                success: function(response) {
                    if (response.status === "success") {
                        alert(response.message);
                        $('#dataTable').DataTable().ajax.reload(null, false); // Reload table without refreshing the page
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert("An error occurred while deleting the record.");
                }
            });
        } else {
            // If the user cancels the deletion, you can add any additional logic here if needed
            alert("Deletion canceled.");
        }
    }

    $(document).on("submit", ".delete-form", function(event) {
        event.preventDefault();

        const form = $(this);
        const meatId = form.find("input[name='id']").val();

        $.ajax({
            url: "delete_process.php",
            method: "POST",
            data: { id: meatId },
            dataType: "json",
            success: function(response) {
                if (response.status === "success") {
                    alert(response.message);
                    $('#dataTable').DataTable().ajax.reload(); // Reload DataTable without page refresh
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert("An error occurred while deleting the record.");
            }
        });
    });
</script>

<!-- codes related for edit of meat -->
<script>
    // Function to open the edit modal and populate fields
    function openEditModal(meatId, meatType, partName, price, purchasedDate, batchNumber, supplier) {
        document.getElementById("editMeatId").value = meatId;
        document.getElementById("editMeatType").value = meatType;
        document.getElementById("editPartName").value = partName;
        document.getElementById("editPrice").value = price;
        document.getElementById("editPurchasedDate").value = purchasedDate;
        document.getElementById("editBatchNumber").value = batchNumber;
        document.getElementById("editSupplier").value = supplier;

        // Show the modal
        document.getElementById("editModal").style.display = "block";
    }

    // Function to close the modal
    function closeEditModal() {
        document.getElementById("editModal").style.display = "none";
    }

    // Function to submit the edit form
    function submitEditForm() {
        const formData = $("#editForm").serialize();

        $.ajax({
            url: "update_meat.php",
            method: "POST",
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response.status === "success") {
                    alert(response.message);
                    // Find the specific row and update its data
                    let rowId = "#row_" + $("#editMeatId").val();
                    $('#dataTable').DataTable().ajax.reload(null, false); // Reload the row without refreshing the entire table
                    closeEditModal(); // Close modal after successful update
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert("An error occurred while updating the record.");
            }
        });
    }


</script>

<script src="https://cdn.rawgit.com/lindell/JsBarcode/master/dist/JsBarcode.all.min.js"></script>

<style>
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto; /* Center the modal */
            padding: 20px;
            border: 1px solid #888;
            width: 30%; /* Reduced width */
            max-width: 600px; /* Optional: limit maximum width */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Optional: add shadow */
            border-radius: 8px; /* Optional: rounded corners */
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

        #printBarcodeButton {
            background-color: #4CAF50; /* Green background */
            color: white; /* White text */
            padding: 10px 15px; /* Padding */
            border: none; /* Remove border */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor on hover */
            font-size: 16px; /* Font size */
            transition: background-color 0.3s; /* Smooth transition */
        }

        #printBarcodeButton:hover {
            background-color: #45a049; /* Darker green on hover */
        }

        @media print {
            body {
                width: 100%; /* or set a specific width */
                height: auto; /* Adjust height as needed */
                margin: 0; /* Remove default margins */
                padding: 0; /* Remove default padding */
            }
            #barcode {
                width: 100%; /* Make the barcode take full width */
                height: auto; /* Adjust height accordingly */
            }
        }

        .btn-barcode {
        background-color: #007BFF; /* Bootstrap primary color */
        color: white; /* White text color */
        padding: 5px 10px; /* Reduced padding for a smaller button */
        border: none; /* Remove border */
        border-radius: 5px; /* Rounded corners */
        cursor: pointer; /* Pointer cursor on hover */
        font-size: 12px; /* Match the font size of other buttons */
        transition: background-color 0.3s, transform 0.2s; /* Smooth transition for hover effects */
    }

        .btn-barcode:hover {
            background-color: #0056b3; /* Darker shade for hover effect */
            transform: scale(1.05); /* Slightly enlarge the button on hover */
        }

        .btn-barcode:focus {
            outline: none; /* Remove outline on focus */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Add a subtle shadow on focus */
        }

        .action-buttons {
            display: flex; /* Use flexbox to arrange buttons in a row */
            gap: 5px; /* Space between buttons */
        }

        .action-buttons .btn {
            margin: 0; /* Remove any default margin */
            font-size: 12px; /* Smaller font size */
            padding: 5px 10px; /* Adjust padding for smaller size */
        }
</style>

<script src="script.js"></script>
</body>
</html>
