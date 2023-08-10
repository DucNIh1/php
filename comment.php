<?php
require_once('./controller/connect.php');
session_start();
$user_id = $_SESSION['user_id'];
if(isset($_POST['sent_comment'])){
    $comment = $_POST['comment'];
    $product_id = $_GET['product_id'];
    $sql = "INSERT INTO comment (content, product_id, user_id) VALUES ('$comment', $product_id, $user_id)";
    mysqli_query($conn, $sql);
    header('location: productDetails.php?product_id=' . $product_id);
}

?>