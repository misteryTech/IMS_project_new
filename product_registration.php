
<?php
 include('connection.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = $_POST['name'];
        $category = $_POST['category'];
        $weight = $_POST['weight'];
        $price = $_POST['price'];
        $expiry_date = $_POST['received_date'];
        $batch_number = $_POST ['batch_number'];
        $received_date = $_POST ['received_date'];
        $supplier = $_POST['supplier'];


        $insert_query_product = "INSERT INTO products (name, category, weight, price, expiry_date, batch_number, received_date, supplier) VALUES
        ('$name','$category','$weight','$price','$expiry_date','$batch_number','$received_date','$supplier')";


       if($connection->query($insert_query_product) === TRUE){

                       echo "<script>alert('Product Registration Successful')</script>";

            }else{
                     echo "Error: " . $insert_query_product . "<br>" . $connection->error;
        }
}
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
                        <h1 class="h3 mb-0 text-gray-800">Register</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Fill Up</h1>
                            </div>
                           <form method="post" class="user">
                                    <label>Name</label>
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control form-control-user" placeholder="Product Name" required>
                                    </div>
                                    <label>Category</label>
                                    <div class="form-group">
                                        <select  class="form-control" aria-label="Default select example" name="category" required>
                                                <option selected>Select Type</option>
                                                <option value="Pig">Pig</option>
                                                <option value="Chicken">Chicken</option>
                                                <option value="Cow">Cow</option>
                                         </select>
                                    </div>

                                    <label>Weight</label>
                                    <div class="form-group">
                                        <input type="number" name="weight" class="form-control form-control-user" placeholder="Type" required>
                                    </div>
                                    <label>Price</label>
                                    <div class="form-group">
                                        <input type="number" name="price" class="form-control form-control-user" placeholder="Price" required>
                                    </div>


                                    <label>Batch Number</label>
                                    <div class="form-group">
                                        <input type="number" name="batch_number" class="form-control form-control-user" required>
                                    </div>


                                    <label>Received Date</label>
                                    <div class="form-group">
                                        <input type="date" name="received_date" class="form-control form-control-user"  required>
                                    </div>

                                    <div class="form-group">
                                    <label>Supplier</label>
                                    <select class="form-control" id="supplier" name="supplier" required>
                                        <?php
                                       include("connection.php");

                                              $mysqli_query_supplier =  mysqli_query($connection,"SELECT * FROM supplier");
                                                          echo "<option>Select Supplier</option></option>";
                                                    while ($row = mysqli_fetch_assoc($mysqli_query_supplier)) {

                                                      echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                                                              }
                ?>

                                        </select>
                                    </div>




                                    <button type="submit" class="btn btn-primary btn-user btn-block"> Register Meat</button>
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