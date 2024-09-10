
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
                        <h1 class="h3 mb-0 text-gray-800">Meat Details</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>


                                            <?php
                        include("connection.php");

                        if ($_SERVER["REQUEST_METHOD"] == "POST"){



                        $meat_id = $_POST["id"];

                        $sql_select = "SELECT * FROM products WHERE id = '$meat_id'";
                        $result = $connection->query($sql_select);

                        if ($result->num_rows == 1) {
                            $row = $result->fetch_assoc();

                            $meat_new_id = $row["id"];
                            $name = $row["name"];

                            $category = $row["category"];
                            $weight = $row["weight"];
                            $price = $row["price"];
                            $expiry_date = $row["expiry_date"];
                            $batch_number = $row["batch_number"];
                            $received_date = $row["received_date"];
                            $supplier_id = $row["supplier"];

                        } else {
                            echo "User not found";
                            exit;
                        }



                        }
                        ?>
                    <!-- Content Row -->
                    <div class="row">

                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Edit Form</h1>
                            </div>
                            <form action="meat_edit_price.php" method="post" class="user">
                                <div class="form-group row">

                                </div>
                                <div class="form-group">
                                    <label> meat id </label>
                                        <input type="hidden" name="meat_new_id" value="<?php echo $meat_new_id ?>" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="ID">

                                        <input type="text" value="<?php echo $meat_new_id ?>" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="ID" disabled>
                                </div>

                                <div class="form-group">
                                <label> Meat Name </label>
                                    <input type="text" name="name" value="<?php echo $name ?> "class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Name">

                                </div>


                                <div class="form-group">
                                <label> Meat Price </label>
                                    <input type="number" name="price" value="<?php echo $price ?>" class="form-control form-control-user" id="exampleInputEmail" >



                                </div>
                                <div class="form-group">
                                <label> Meat Type </label>
                                    <input type="text" name="category" value="<?php echo $category ?> "class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Type">

                                </div>


                                <div class="form-group">
                                <label> Weight </label>
                                    <input type="text" name="weight" value="<?php echo $weight ?>" class="form-control form-control-user" id="exampleInputEmail"
                                    required>


                                </div>

                                <div class="form-group">
                                <label> Purchased Date </label>
                                <input type="date" name="received_date" value="<?php echo $received_date; ?>" class="form-control form-control-user">


                                </div>

                                <div class="form-group">
                                <label> Batch Number </label>
                                <input type="number" name="batch_number" value="<?php echo $batch_number; ?>" class="form-control form-control-user">
                                </div>


                                <div class="form-group">
                                <label> Expiry Date </label>
                                <input type="date" name="expiry_date" value="<?php echo $expiry_date; ?>" class="form-control form-control-user">
                                </div>


                                        <div class="form-group">
                                    <label>Supplier</label>
                                    <select class="form-control" id="supplier" name="supplier" required>
                                        <?php
                                       include("connection.php");

                                              $mysqli_query_supplier =  mysqli_query($connection,"SELECT * FROM supplier");
                                              ?>
                                              <option value="<?php echo $supplier_id; ?>" selected><?php echo $supplier_id; ?></option>

                                              <?php
                                                    while ($row = mysqli_fetch_assoc($mysqli_query_supplier)) {


                                                      echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                                                              }
                                                                   ?>

                                        </select>
                                    </div>




                                <button type="submit" class="btn btn-primary btn-user btn-block"> Edit</button>



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