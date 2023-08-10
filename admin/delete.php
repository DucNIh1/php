<?php 
require_once('../controller/connect.php');

session_start();
$product_id = $_GET['product_id'];
$sql = "DELETE FROM product WHERE id = $product_id";
if(mysqli_query($conn, $sql)){
    header("Location: index.php");
    echo "<script>alert('Xóa thành công!')</script>";
}
?>