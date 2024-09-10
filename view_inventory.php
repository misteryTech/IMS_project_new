
<?php
    include("include/header.php");
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include ('ims_sidebar.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                                include("include/topbar.php");
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>



                    <!-- Content Row -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Inventory List</h6>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>

                                            <th>Meat ID</th>
                                            <th>Transaction Type</th>
                                            <th>Quantity</th>
                                            <th>Transaction Date</th>
                                            <th>Action</th>

                                        </tr>
                                        <?php
                                            include("connection.php");
                                            // Retrieve data from the database
                                            $sql_select = "SELECT * FROM inventory_transactions";
                                            $result = $connection->query($sql_select);

                                        ?>
                                    </thead>

                                    <tbody>

                                                                                            <?php
                                                        // Output data of each row
                                                        if ($result->num_rows > 0) {
                                                            while($row = $result->fetch_assoc()) {
                                                                echo "<tr>";
                                                                echo "<td>" . $row["product_id"]. "</td>";
                                                                echo "<td>" . $row["transaction_type"]. "</td>";
                                                                echo "<td>" . $row["quantity"]. "</td>";
                                                                echo "<td>" . $row["transaction_date"]. "</td>";
                                                                echo "<td>";

                                                                echo "<form action='edit_process.php' method='post'>";
                                                                echo "<input type='hidden' name='id' value='" . $row["id"] . "' />";
                                                                echo "<button type='submit' class='btn btn-edit btn-success'>Edit</button>";
                                                                echo "</form>";

                                                                echo "<form action='delete_process.php' method='post'>";
                                                                echo "<input type='hidden' name='id' value='" . $row["id"] . "' />";
                                                                echo "<button type='submit' name='delete' class='btn btn-delete btn-danger'>Delete</button>";
                                                                echo "</form>";

                                                                echo "</td>";
                                                                echo "</tr>";

                                                            }
                                                        } else {
                                                            echo "<tr><td colspan='4'>0 results</td></tr>";
                                                        }
                                                        $connection->close();
                                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
    include("include/footer.php");
?>