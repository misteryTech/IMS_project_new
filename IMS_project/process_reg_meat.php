<?php
 include('connection.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = $_POST['name'];
        $type = $_POST['type'];
        $price = $_POST['price'];
        $expiry_date = $_POST['expiry_date'];
        $batch_number =$_POST['batch_number'];
        $received_date = $_POST ['received_date'];
        $supplier = $_POST['supplier'];



        $insert_query_product = "INSERT INTO meat(name, type, price, expiry_date, batch_number, received_date, supplier) VALUES
        ('$name','$type','$price','$expiry_date','$batch_number','$received_date','$supplier')";

       if($connection->query($insert_query_product) === TRUE){

                       echo "<script>alert('Product Registration Successful')</script>";
                    echo "<script>window.location.href='meat_page.php'</script>";
            }else{
                     echo "Error: " . $insert_query_product . "<br>" . $connection->error;
        }
}
?>