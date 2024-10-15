<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Meat Registration</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .form-container {
            width: 60%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .form-group, .search-container, table {
            margin: 20px auto;
            width: 80%;
        }
        label, input, select, button {
            display: block;
            width: 100%;
            margin: 8px 0;
        }
        input, select {
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        .suggestions {
            border: 1px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
            margin-top: 5px;
            display: none;
        }
        .suggestions div {
            padding: 8px;
            cursor: pointer;
            background-color: white;
        }
        .suggestions div:hover {
            background-color: #f1f1f1;
        }
    </style>
    <link href="include/datatables.min.css" rel="stylesheet">
    <script src="include/jquery-3.6.0.min.js"></script>
    <script src="include/datatables.min.js"></script>
</head>
<body>
    <?php include("sidebar.php"); ?>

    <div class="main-content">
        <header>
            <h1>Meat View</h1>
        </header>
        <div class="content">

            <!-- Search bar -->
            <div class="search-container">
                <form id="search-form" method="GET">
                    <input type="text" id="search_query" name="search_query" placeholder="Search for registered meat products..." onkeyup="suggestKeywords(this.value)">
                    <div class="suggestions" id="suggestions"></div>
                    <button type="submit">Search</button>
                </form>
            </div>

            <!-- Search Results Table -->
            <div id="search-results" style="display: none;">
                <table id="dataTable" class="display">
                    <thead>
                        <tr>
                            <th>Meat ID</th>
                            <th>Type</th>
                            <th>Parts</th>
                            <th>Price</th>
                            <th>Purchased Date</th>
                            <th>Meat Disposed</th>
                            <th>Supplier</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="result-body"></tbody>
                </table>
            </div>

        </div>
    </div>

    <script>
        // Function to handle keyword suggestions
        function suggestKeywords(query) {
            if (query.length > 2) {
                $.ajax({
                    url: 'ajax/suggest_keywords.php',
                    type: 'GET',
                    data: { q: query },
                    success: function (response) {
                        $('#suggestions').html(response).show();
                    }
                });
            } else {
                $('#suggestions').hide();
            }
        }

        // Function to select a suggestion
        function selectSuggestion(keyword) {
            $('#search_query').val(keyword);
            $('#suggestions').hide();
        }

        // Handle search form submission
        $('#search-form').on('submit', function (e) {
            e.preventDefault(); // Prevent the default form submission

            var query = $('#search_query').val();

            // Perform AJAX request to fetch search results
            $.ajax({
                url: 'ajax/meat_search2.php',
                type: 'GET',
                data: { search_query: query },
                success: function (response) {
                    // Show the search results table and populate it with the response
                    $('#search-results').show();
                    $('#result-body').html(response);

                    // Initialize or reinitialize DataTable
                    $('#dataTable').DataTable({
                        destroy: true // Ensures DataTable is reinitialized properly
                    });
                },
                error: function () {
                    alert('Error retrieving search results. Please try again.');
                }
            });
        });
    </script>
</body>
</html>
