<?php
session_start();
// nếu tồn tại tài khoản thì xóa session quay về trang login
if(isset($_SESSION['email'])){
    unset($_SESSION['email']);
    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
    unset($_SESSION['level']);
    unset($_SESSION['password']);
    unset($_SESSION['avatar']);
    // session_destroy();
    header('location:login.php');
}else{
    // nếu chưa tồn tài tại khoản thì chuyển về trang index 
    header('location:index.php');
}
?>