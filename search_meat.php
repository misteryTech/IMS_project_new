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
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-size: 14px;
            margin-bottom: 5px;
            display: block;
        }
        input, select {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px 15px;
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
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .search-container {
            margin-bottom: 30px;
            text-align: center;
        }
        .search-container input[type="text"] {
            width: 70%;
            padding: 10px;
            font-size: 16px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .search-container button {
            width: 15%;
            padding: 10px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
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




</head>
<body>
    <div class="main-content">
        <header>
            <h1>Meat Registration Search</h1>
        </header>
        <div class="content">

            <!-- Search bar -->
            <div class="search-container">
                <form action="ajax/meat_search.php" method="GET">
                    <input type="text" id="search_query" name="search_query" placeholder="Search for registered meat products..." onkeyup="suggestKeywords(this.value)">
                    <div class="suggestions" id="suggestions"></div>
                    <button type="submit">Search</button>

                </form>
            </div>

            <!-- Search Results Table -->

        </div>
    </div>

    <script>
        function suggestKeywords(query) {
            if (query.length > 2) {
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "ajax/suggest_keywords.php?q=" + query, true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var suggestionsBox = document.getElementById("suggestions");
                        suggestionsBox.innerHTML = xhr.responseText;
                        suggestionsBox.style.display = "block";
                    }
                };
                xhr.send();
            } else {
                document.getElementById("suggestions").style.display = "none";
            }
        }

        function selectSuggestion(keyword) {
            document.getElementById("search_query").value = keyword;
            document.getElementById("suggestions").style.display = "none";
        }
    </script>
</body>
</html>
