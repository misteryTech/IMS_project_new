<?php
 include('connection.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $meat_type = $_POST['meat_type'];
        $part = $_POST['part'];



        $price = $_POST['price'];
        $received_date = $_POST['received_date'];
        $supplier =$_POST['supplier'];




        $insert_query_product = "INSERT INTO meat_db(meat_type, meat_parts, meat_price, purchased_date, supplier_id) VALUES
        ('$meat_type','$part','$price','$received_date','$supplier')";

       if($connection->query($insert_query_product) === TRUE){

                       echo "<script>alert('Product Registration Successful')</script>";
                    echo "<script>window.location.href='meat_page.php'</script>";
            }else{
                     echo "Error: " . $insert_query_product . "<br>" . $connection->error;
        }
}
?>