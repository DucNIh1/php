<?php
require('../controller/connect.php');
session_start();
$user_id = $_SESSION['user_id'];
if(isset($_POST['product_id'])){
    $product_id = $_POST['product_id'];
    
    $sql = "UPDATE cart
            SET quantity = CASE
                WHEN quantity = 1 THEN 0  -- Nếu quantity = 1, thì thực hiện xóa sản phẩm (quantity = 0)
                ELSE quantity - 1         -- Nếu quantity > 1, thực hiện giảm số lượng đi 1 (quantity - 1)
             END
            WHERE quantity >= 1 AND user_id = $user_id AND product_id = $product_id";
    $increment = mysqli_query($conn, $sql);
    $sql2 = "DELETE FROM cart WHERE quantity = 0 AND user_id = $user_id AND product_id = $product_id";
    mysqli_query($conn, $sql2);
    header('location: ../cart.php');
}
?>