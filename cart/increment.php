<?php
require('../controller/connect.php');
session_start();
$user_id = $_SESSION['user_id'];
if(isset($_POST['product_id'])){
    $product_id = $_POST['product_id'];
    $sql = "UPDATE cart SET quantity = quantity + 1 WHERE product_id = $product_id AND user_id = $user_id";
    $increment = mysqli_query($conn, $sql);
    header('location: ../cart.php');
}
 
?>