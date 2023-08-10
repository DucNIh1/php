<?php
require_once('./controller/connect.php');
session_start();

if($_POST['search_btn']){
    $text = $_POST['search_input'];
    $sql = "SELECT * FROM product WHERE name LIKE %'$text'%";
}

?>