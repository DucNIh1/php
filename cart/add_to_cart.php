<?php
require_once('../controller/connect.php');
session_start();
// Kiểm tra xem người dùng đã nhấp vào nút Thêm vào giỏ hàng chưa
if(isset($_SESSION['user_id'])){
    if (isset($_POST['add_to_cart'])) {
        $product_id = $_POST['product_id'];
        $size = $_POST['size'];
        $user_id = $_SESSION['user_id'];
        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        $query = "INSERT INTO cart (user_id, product_id, quantity,size) VALUES ($user_id, $product_id, 1, '$size')";
        mysqli_query($conn, $query);
        header('location: ../productDetails.php?product_id='.$product_id);
    }
}else{
    $product_id = $_POST['product_id'];
    header('location: ../productDetails.php?product_id='.$product_id);
}
// Đóng kết nối đến cơ sở dữ liệu
mysqli_close($conn);
?>




<!-- if (isset($_POST['add_to_cart'])) {
        $product_id = $_POST['product_id'];
        $size = $_POST['size'];
        $user_id = $_SESSION['user_id'];

        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        $query = "SELECT * FROM cart WHERE user_id = $user_id AND product_id = $product_id";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['total'] =mysqli_num_rows($result);
            // Nếu sản phẩm đã tồn tại, tăng quantity lên 1
            $query = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = $user_id AND product_id = $product_id";
            mysqli_query($conn, $query);
            header('location: ../productDetails.php?product_id='.$product_id);
        } else {
            // Nếu sản phẩm chưa tồn tại, thêm bản ghi mới vào bảng cart với quantity là 1
            $query = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, 1)";
            mysqli_query($conn, $query);
            header('location: ../productDetails.php?product_id='.$product_id);
        }   
    } -->