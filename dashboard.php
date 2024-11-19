<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Meat Registration</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    

        
    <!-- Add Print.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/print-js/1.6.0/print.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <style>
    #receipt-container {
        font-family: 'Courier', monospace;
        width: 240px; /* Reduced width */
        font-size: 10px; /* Smaller font size */
        line-height: 1.4; /* Reduced line height */
        margin: 10px auto;
        padding: 10px; /* Reduced padding */
        border: 1px solid #000;
        border-radius: 5px;
        background-color: #fff;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); /* Smaller shadow */
    }

    #receipt-container h2 {
        font-size: 1em; /* Smaller header size */
        margin: 5px 0 10px 0; /* Reduced margin */
        padding-bottom: 5px; /* Reduced padding */
    }

    #receipt-item-list li {
        margin: 5px 0; /* Reduced margin */
        padding: 4px 0; /* Reduced padding */
    }

    .place-order-container {
        bottom: 10px; /* Reduced spacing from the bottom */
        padding: 10px; /* Reduced padding */
    }

    .void-button {
        font-size: 0.8em; /* Smaller font size */
        padding: 4px 8px; /* Smaller padding */
    }

    .form-container {
        width: 60%; /* Increased width to 60% for a medium size */
        padding: 20px; /* Standard padding */
        margin: 0 auto; /* Center the form container */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .result-container {
        margin-top: 15px; /* Reduced margin */
        padding: 10px; /* Reduced padding */
    }

    #amount-received {
        width: 150px; /* Reduced input width */
    }

    #item-list li {
        margin-bottom: 8px; /* Reduced margin */
        padding: 8px; /* Reduced padding */
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); /* Smaller shadow */
    }

    /* Adjust the search bar size */
    .search-container input[type="number"] {
        width: 300px; /* Medium width */
        padding: 10px; /* Increased padding */
        font-size: 1.1em; /* Standard font size */
        min-width: 250px; /* Minimum width */
        margin-right: 10px; /* Space between input and button */
    }

    /* Adjust the Find button size */
    .search-container button {
        padding: 10px 20px; /* Increased padding */
        font-size: 1.1em; /* Standard font size */
        width: auto; /* Allow button to adjust size */
        min-width: 120px; /* Minimum width for responsiveness */
    }

    /* Center the search container */
    .search-container {
        display: flex;
        justify-content: center; /* Centers the content horizontally */
        align-items: center; /* Aligns items vertically */
        margin-top: 50px; /* Adds some space from the top */

        
    }
</style>

    
    <?php include("sidebar.php"); ?>
</head>
<body>
    <div class="main-content">
        <header>
            <h1>
                Welcome to Tan Meat Shop Daahbord</h1>
        </header>
        <div class="content">
            <!-- Search bar -->
            <div class="search-container">
                <form onsubmit="searchById(event)">
                    <input type="number" id="search_query" name="search_query" placeholder="Enter ID to search..." required>
                    <button type="submit">Find</button>
                </form>
            </div>

            <!-- Result List Section -->
            <div id="result-list" class="result-container">
                <h4>Selected Items</h4>
                <ul id="item-list"></ul>
            </div>


          <!-- Place Order Section -->
          <div class="place-order-container fixed-container mt-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>Total: P<span id="tally-amount">0.00</span></h4>
                    <div class="d-flex align-items-center">
                        <label for="amount-received" class="mr-2">Amount Received: </label>
                        <input type="number" id="amount-received" class="form-control mr-2" placeholder="Enter amount received">
                        <button id="place-order" class="btn btn-primary">Place Order</button>
                    </div>
                    <div class="mt-2">
                        <p><strong>Change: </strong><span id="change-amount">P0.00</span></p>
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
                    <p><strong>Price:</strong> <span id="modal-price"></span></p>
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" min="1" placeholder="Enter quantity">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="confirmSelection()">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Receipt Container (hidden initially) -->
    <div id="receipt-container" style="display:none;">
        <h2>Receipt</h2>
        <p><strong>Order ID:</strong> <span id="receipt-order-id"></span></p>
        <p><strong>Date:</strong> <span id="receipt-date"></span></p>
        <ul id="receipt-item-list">
            <!-- Dynamically populated list of items -->
        </ul>
        <div id="receipt-footer">
            <p><strong>Total Amount:</strong> P<span id="receipt-total-amount">0.00</span></p>
            <p><strong>Amount Received:</strong> P<span id="receipt-amount-received">0.00</span></p>
            <p><strong>Change:</strong> P<span id="receipt-change">0.00</span></p>
            <p>Thank you for your purchase!</p>
        </div>
    </div>


    <script>
    let currentItem = {};  // Holds the current item selected for the order
    let tallyAmount = 0; // Track the total amount of the order
    let quantityFocusInterval;  // Interval to keep cursor active in the quantity field

    // Focus on the input field when the page loads
    window.onload = function() {
        document.getElementById('search_query').focus();
    };

    // Trigger search on Enter key press and refocus on input field
    document.getElementById('search_query').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();  // Prevents form submission if it’s inside a form
            searchById(event);       // Calls the search function automatically

            // Refocus on the input field after the search function runs
            setTimeout(() => {
                document.getElementById('search_query').focus();
            }, 100); // A short delay helps ensure the focus is reset after processing
        }
    });

    // Keep the cursor active in the quantity field when the modal is shown
    $('#resultModal').on('show.bs.modal', function() {
        // Set an interval to focus on the quantity input field
        quantityFocusInterval = setInterval(() => {
            $('#quantity').focus();
        }, 100);  // Adjust the interval time as necessary (e.g., 100 ms)
    });

    // Clear the interval when the modal is closed
    $('#resultModal').on('hide.bs.modal', function() {
        clearInterval(quantityFocusInterval);
    });

    // Detect Enter key in the modal to trigger confirmSelection
    $('#resultModal').on('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            confirmSelection();
        }
    });

    // Void item button handler
    $(document).on('click', '.void-button', function() {
        let itemTotal = parseFloat($(this).closest('li').find('.badge').text().replace('Total: P', ''));
        tallyAmount -= itemTotal; // Subtract the voided item's price from tallyAmount
        $('#tally-amount').text(tallyAmount.toFixed(2)); // Update the total display
        $(this).closest('li').remove(); // Remove the list item
    });

    // Search function by item ID
    function searchById(event) {
        event.preventDefault();
        var searchQuery = document.getElementById('search_query').value;

        $.ajax({
            url: 'ajax/meat_search.php',
            type: 'GET',
            data: { search_query: searchQuery },
     success: function(response) {
    try {
        var data = JSON.parse(response);

        if (data) {
            // Store data for the current item
            currentItem = data;

            // Populate modal fields
            $('#modal-meat-type').text(data.meat_type);
            $('#modal-part-name').text(data.part_name);
            $('#modal-price').text(data.price);

            // Show modal dialog
            $('#resultModal').modal('show');
        } else {
            alert('No data found for the entered ID.');
        }
    } catch (e) {
        console.error('Error parsing JSON:', e);
        console.error('Raw response:', response);
        alert('Unexpected response format. Check server output.');
    }
},
            error: function() {
                alert('This Barcode is Not Existing');
            }
        });
    }

    // Confirm the selection, add item to list, clear the search field, and refocus on it
    function confirmSelection() {
        var quantity = $('#quantity').val();
        var price = parseFloat($('#modal-price').text());

        if (quantity && price) {
            // Calculate total price
            var totalPrice = price * quantity;

            // Add item to list
            $('#item-list').append(`
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>
                        <strong>${currentItem.meat_type} - ${currentItem.part_name}</strong><br>
                        <small>Price: P${currentItem.price} | Quantity: ${quantity}</small>
                    </span>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-danger btn-sm mr-3 void-button">Void</button>
                        <span class="badge badge-success">Total: P${totalPrice.toFixed(2)}</span>
                    </div>
                </li>
            `);

            // Update tally amount
            tallyAmount += totalPrice;
            $('#tally-amount').text(tallyAmount.toFixed(2)); // Update the total display

            // Clear the search input field and refocus on it
            $('#search_query').val('').focus();
            $('#quantity').val(''); // Clear the quantity input field


            // Close the modal
            $('#resultModal').modal('hide');
        } else {
            alert('Please enter a valid quantity.');
        }
    }

    // Calculate the change based on the amount received
    $('#amount-received').on('input', function() {
        let amountReceived = parseFloat($(this).val()) || 0;
        let change = amountReceived - tallyAmount; // Calculate change
        $('#change-amount').text('P' + (change >= 0 ? change.toFixed(2) : '0.00')); // Display change or 0 if insufficient funds
    });

    // Place order button functionality
    $('#place-order').on('click', function() {
        if (tallyAmount <= 0) {
            alert('Please add items to the order before placing it.');
            return;
        }

        let amountReceived = parseFloat($('#amount-received').val()) || 0;
        if (amountReceived < tallyAmount) {
            alert('Insufficient funds. Please enter a valid amount received.');
            return;
        }

        // Prepare the order data
        let orderData = {
            items: []
        };

        // Clear the receipt list before adding items
        $('#receipt-item-list').empty();

        // Capture items for both the order data and the receipt
        $('#item-list li').each(function() {
            let item = {
                meat_type: $(this).find('strong').text().split(' - ')[0],
                part_name: $(this).find('strong').text().split(' - ')[1],
                quantity: $(this).find('small').text().split('Quantity: ')[1].split(' |')[0],
                price: parseFloat($(this).find('.badge').text().replace('Total: P', '')) / parseInt($(this).find('small').text().split('Quantity: ')[1].split(' |')[0])
            };
            
            // Add item to orderData
            orderData.items.push(item);

            // Add item to receipt list
            let itemName = $(this).find('span').first().text();  
            let quantity = $(this).find('small').text().split('Quantity: ')[1].split(' |')[0];
            let itemTotal = $(this).find('.badge').text().replace('Total: P', '').trim();
            $('#receipt-item-list').append(`
                <li>
                    <span>${itemName}</span>
                    <span>${quantity} x P${itemTotal}</span>
                </li>
            `);
        });

        // Send the order data to the server via AJAX
        $.ajax({
            url: 'place_order.php',
            type: 'POST',
            data: { 
                orderData: JSON.stringify(orderData),
                totalAmount: tallyAmount.toFixed(2),
                amountReceived: amountReceived.toFixed(2)
            },
            success: function(response) {
                alert(response);
                // Reset the order form
                $('#item-list').empty();
                $('#tally-amount').text('0.00');
                $('#amount-received').val('');
                $('#change-amount').text('P0.00');

                // Populate remaining receipt details
                $('#receipt-order-id').text(new Date().getTime());
                $('#receipt-date').text(new Date().toLocaleString());
                $('#receipt-total-amount').text(tallyAmount.toFixed(2));
                $('#receipt-amount-received').text(amountReceived.toFixed(2));
                $('#receipt-change').text((amountReceived - tallyAmount).toFixed(2));

                // Show the receipt container
                $('#receipt-container').show();

                // Trigger the print functionality using Print.js
                console.log("Preparing to print");
            printJS({
            printable: 'receipt-container',
            type: 'html',
            style: '@media print { body { font-size: 12px; } }'
            });console.log("Print job sent");

                // Optionally, hide the receipt again after printing
                $('#receipt-container').hide();
            },
            error: function() {
                alert('Error placing the order.');
            }
        });
    });
</script>


</body>
</html>