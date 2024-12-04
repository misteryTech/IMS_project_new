<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tan Meat Shop Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }

        h1, h3 {
            font-weight: bold;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            font-size: 1.2em;
        }

        .btn {
            font-size: 1.2em;
        }

        #total-display {
            font-size: 1.5em;
            font-weight: bold;
            margin-top: 20px;
        }

        #change-display {
            font-size: 1.2em;
            font-weight: bold;
        }

        .list-group-item {
            font-size: 1.2em;
        }

        .modal-body p, .modal-body label, .modal-footer button {
            font-size: 1.2em;
        }
    </style>
</head>
<body>
   <a href="http://localhost/ims_project_new/meat_view.php"> <h1 class="text-center text-primary mb-4">Tan Meat Shop Dashboard</h1></a>

    <div class="container">
        <div class="row">
            <!-- Search Section -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <h3 class="text-center text-dark">Search Meat by Batch Number</h3>
                    <form onsubmit="searchByBatch(event)">
                        <input type="text" id="search_query" class="form-control mb-4" placeholder="Enter Batch Number...">
                        <button type="submit" class="btn btn-primary btn-block">Find</button>
                    </form>
                </div>
            </div>

            <!-- Purchase Section -->
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <h3 class="text-center text-dark">List of Purchased Items</h3>
                    <ul id="item-list" class="list-group mb-4"></ul>
                    <div id="total-display" class="text-center text-success">Total Amount to Pay: ₱ 0.00</div>

                    <div class="form-group mt-4">
                        <label for="payment-amount">Enter Payment Amount (₱):</label>
                        <input type="number" id="payment-amount" class="form-control" min="0" placeholder="Enter amount">
                    </div>

                    <div id="change-display" class="text-center text-info mt-2"></div>

                    <div class="action-buttons mt-4">
                        <button class="btn btn-success btn-block" onclick="processPayment()">Proceed to Payment</button>
                        <button class="btn btn-danger btn-block" onclick="cancelPurchase()">Cancel Purchase</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Dialog for Search Result -->
    <div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="resultModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resultModalLabel">Meat Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Meat Type:</strong> <span id="modal-meat-type"></span></p>
                    <p><strong>Part Name:</strong> <span id="modal-part-name"></span></p>
                    <p><strong>Price:</strong> ₱<span id="modal-price"></span></p>
                    <p><strong>Stock:</strong> <span id="modal-stock"></span> available</p>
                    <label for="modal-quantity"><strong>Quantity:</strong></label>
                    <input type="number" id="modal-quantity" class="form-control" placeholder="Enter Quantity" min="1">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="confirmPurchase()">Confirm Purchase</button>
                </div>
            </div>
        </div>
    </div>

        <script>
            let currentItem = {};
            let tallyAmount = 0;
            let purchasedItems = [];
        
            

            function searchByBatch(event) {
        event.preventDefault();
        const batchNumber = $('#search_query').val().trim();

        if (!batchNumber) {
            alert('Please enter a valid batch number.');
            return;
        }

        $.ajax({
            url: 'ajax/meat-search.php',
            type: 'GET',
            data: { batch_number: batchNumber },
            success(response) {
                const data = typeof response === 'string' ? JSON.parse(response) : response;

                if (data.error) {
                    alert(data.error);
                } else {
                    currentItem = data;
                    $('#modal-meat-type').text(data.meat_type);
                    $('#modal-part-name').text(data.part_name);
                    $('#modal-price').text(data.price);
                    $('#modal-stock').text(data.stock);
                    $('#resultModal').modal('show');
                }
            },
            error() {
                alert('Error retrieving batch details. Please try again.');
            }
        });
    }



    function updateStockInDatabase(batchNumber, newStock) {
        if (!batchNumber) {
            console.error("Invalid batch number:", batchNumber);
            alert("Failed to update stock. Invalid batch number.");
            return;
        }

        $.ajax({
            url: 'ajax/update-stock.php',
            type: 'POST',
            data: { batch_number: batchNumber, new_stock: newStock },
            success(response) {
                const data = typeof response === 'string' ? JSON.parse(response) : response;

                if (data.error) {
                    alert(data.error);
                } else {
                    console.log(data.message);
                }
            },
            error(xhr, status, error) {
                console.error('Error updating stock:', status, error, xhr.responseText);
                alert('Error updating stock in database. Please try again later.');
            }
        });
    }

    function confirmPurchase() {
        const quantity = parseInt($('#modal-quantity').val());
        if (!quantity || quantity <= 0) {
            alert('Please enter a valid quantity.');
            return;
        }

        if (quantity > currentItem.stock) {
            alert('Not enough stock available.');
            return;
        }

        const itemCost = currentItem.price * quantity;
        currentItem.stock -= quantity;

        purchasedItems.push({ ...currentItem, quantity, cost: itemCost });
        tallyAmount += itemCost;

        const listItem = `<li class="list-group-item">
                            ${currentItem.meat_type} (${currentItem.part_name}) - ₱${currentItem.price} x ${quantity}
                        </li>`;
        $('#item-list').append(listItem);
        $('#total-display').text(`Total Amount to Pay: ₱${tallyAmount.toFixed(2)}`);

        $('#resultModal').modal('hide');
        updateStockInDatabase(currentItem.batch_number, currentItem.stock);
    }




            function confirmPurchase() {
                const quantity = parseInt($('#modal-quantity').val());
                if (!quantity || quantity <= 0) {
                    alert('Please enter a valid quantity.');
                    return;
                }

                if (quantity > currentItem.stock) {
                    alert('Not enough stock available.');
                    return;
                }

                const itemCost = currentItem.price * quantity;
                currentItem.stock -= quantity;

                purchasedItems.push({ ...currentItem, quantity, cost: itemCost });
                tallyAmount += itemCost;

                const listItem = `<li class="list-group-item">
                                    ${currentItem.meat_type} (${currentItem.part_name}) - ₱${currentItem.price} x ${quantity}
                                </li>`;
                $('#item-list').append(listItem);
                $('#total-display').text(`Total Amount to Pay: ₱${tallyAmount.toFixed(2)}`);

                $('#resultModal').modal('hide');
                // Pass the batch number along with the updated stock for database update
                updateStockInDatabase(currentItem.batch_number, currentItem.stock);
            }

        
            function updateChangeDisplay() {
                const paymentAmount = parseFloat(document.getElementById('payment-amount').value);
            
                if (isNaN(paymentAmount) || paymentAmount < tallyAmount) {
                    document.getElementById('change-display').textContent = `Change: ₱ 0.00`;
                    return;
                }
            
                const change = paymentAmount - tallyAmount;
                document.getElementById('change-display').textContent = `Change: ₱ ${change.toFixed(2)}`;
            }

            function processPayment() {
                const paymentAmount = parseFloat(document.getElementById('payment-amount').value);
            
                if (paymentAmount < tallyAmount) {
                    alert('Insufficient payment amount.');
                    return;
                }
            
                const change = paymentAmount - tallyAmount;
                document.getElementById('change-display').textContent = `Change: ₱ ${change.toFixed(2)}`;
            
                $.post('save-transaction.php',
                    {
                        items: purchasedItems,
                        total: tallyAmount,
                        payment: paymentAmount,
                        change: change
                    },
                    function(response) {
                        console.log('Response from server:', response);
                        alert('Payment processed successfully.');
                        resetPurchase();
                    }
                ).fail(function(jqXHR, textStatus, errorThrown) {
                    console.error('Error details:', textStatus, errorThrown);
                    alert('Failed to save transaction. Please try again.');
                });
            }

            function cancelPurchase() {
                if (confirm('Are you sure you want to cancel the purchase?')) {
                    resetPurchase();
                }
            }

            function resetPurchase() {
                purchasedItems = [];
                tallyAmount = 0;
                document.getElementById('item-list').innerHTML = '';
                document.getElementById('total-display').textContent = 'Total Amount to Pay: ₱ 0.00';
                document.getElementById('payment-amount').value = '';
                document.getElementById('change-display').textContent = 'Change: ₱ 0.00';
            }

            document.getElementById('payment-amount').addEventListener('input', updateChangeDisplay);
        </script>
    </body>
    </html>
