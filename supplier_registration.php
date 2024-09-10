<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){



  $shopname = $_POST["shopname"];
  $supplier_name = $_POST["supplier_name"];
  $supplier_contact = $_POST["supplier_contact"];
  $location = $_POST["location"];



  // SQL query to insert data into the database
  $sql = "INSERT INTO supplier (shopname, location, supplier_contact, supplier_shop_name) VALUES
   ('$shopname', '$location', '$supplier_contact', '$supplier_name')";

  if ( $connection->query($sql) === TRUE) {
      echo "New record created successfully";
      header("Location: supplier_page.php");

  } else {
      echo "Error: " . $sql . "<br>" .  $connection->error;
  }
};



?>


<?php
    include("include/header.php");
?>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'ims_sidebar.php'; ?>
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
                        <h1 class="h3 mb-0 text-gray-800">Supplier</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Registration Form</h1>
                            </div>
                            <form action="supplier_db.php" method="post" class="user">

                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control form-control-user" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Location</label>
                                        <input type="text" name="location" class="form-control form-control-user" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Register Supplier</button>
                                </form>


                        </div>
                    </div>
                </div>

                    <!-- Content Row -->


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
    include("include/footer.php");
?>