<?php
require('../controller/connect.php');
if(isset($_POST['submit'])){
    $product_id = $_POST['product_id'];
    $sql = "DELETE FROM cart WHERE product_id = $product_id";
    $delete = mysqli_query($conn, $sql);
    header('location: ../cart.php');
}

?>