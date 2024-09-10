<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Adding padding and adjusting layout for responsiveness */
        .main-content {
            padding: 20px;
        }

        /* Ensure that the cards stack on smaller screens */
        .row > .col-md-6, .row > .col-xl-3 {
            margin-bottom: 20px;
        }

        /* Adjust card size and add responsiveness */
        .card {
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transform: scale(1.05);
        }

        .h5 a {
            text-decoration: none;
            color: inherit;
        }

        .h5 a:hover {
            color: #007bff;
        }

        .card-body {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Responsive layout adjustments */
        @media (max-width: 767.98px) {
            .card-body {
                flex-direction: column;
                text-align: center;
            }

            .col-auto {
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
<?php
    include("sidebar.php");
?>
    <div class="main-content">
        <div class="container">
            <div class="row">
                <!-- Chicken Registration Card -->
                <div class="col-xl-3 col-md-6">
                    <div class="card border-left-primary shadow h-100 py-2" onclick="window.location.href='chicken_registration.php'">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Type of Meat
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <a href="chicken_registration.php">Chicken</a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-drumstick-bite fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Beef Registration Card -->
                <div class="col-xl-3 col-md-6">
                    <div class="card border-left-success shadow h-100 py-2" onclick="window.location.href='beef_registration.php'">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Type of Meat
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <a href="beef_registration.php">Beef</a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-hamburger fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pork Registration Card -->
                <div class="col-xl-3 col-md-6">
                    <div class="card border-left-warning shadow h-100 py-2" onclick="window.location.href='pork_registration.php'">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Type of Meat
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <a href="pork_registration.php">Pork</a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-bacon fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
