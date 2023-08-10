<?php
// Kết nối CSDL ở đây (sử dụng mysqli hoặc PDO)
require_once('controller/connect.php');
session_start();
// Số sản phẩm trên mỗi trang
$productsPerPage = 6;
$type = $_GET['type'];
// Xác định trang hiện tại (mặc định là trang đầu tiên)
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}
// Tính chỉ mục bắt đầu của sản phẩm trong CSDL cho trang hiện tại
$startIndex = ($currentPage - 1) * $productsPerPage;


if(!empty($_GET['type'])){
    $query = "SELECT * FROM product WHERE type='$type'  LIMIT $productsPerPage OFFSET $startIndex";
    $query2 = "SELECT * FROM product WHERE type = '$type'";
}else if(isset($_GET['search_btn'])){
    $text = $_GET['search_input'];
    $query = "SELECT * FROM product WHERE name LIKE '%" .$text. "%' LIMIT $productsPerPage OFFSET $startIndex";
    $query2 = "SELECT * FROM product WHERE name LIKE '%" .$text. "%'";
}
else{
    $query = "SELECT * FROM product LIMIT $productsPerPage OFFSET $startIndex";
    $query2 = "SELECT * FROM product";
}
$results = mysqli_query($conn, $query);


// Tính tổng số trang dựa trên tổng số sản phẩm và số sản phẩm trên mỗi trang
$sqlResults = mysqli_query($conn,  $query2);
$totals = mysqli_num_rows($sqlResults);
$totalPages = ceil($totals/ $productsPerPage);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo.jpg" type="image/gif" sizes="16x16">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Lobster&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/productsPage.css">


    <title>CDN</title>
    <style>
    .header {
        margin-bottom: 200px;
    }
    </style>
</head>

<body>
    <div class="header">
        <?php include('components/header.php')?>
    </div>
    <nav class="nav">
        <div>
            <h1 class="nav-header">Our Products</h1>
            <p class="nav-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

            <form method="get" class="search_box">
                <input type="text" placeholder="Search..." name="search_input">
                <button name="search_btn"><i class='bx bx-search'></i></button>
            </form>
            <ul class="nav-menu">
                <li class="nav-item"><a href="productsPage.php">all product</a></li>
                <li class="nav-item"><a href="?type=ao">T-shirt</a></li>
                <li class="nav-item"><a href="?type=quan">trouser</a></li>
                <li class="nav-item"><a href="?type=non">hat</a></li>
                <li class="nav-item"><a href="?type=vi">wallet</a></li>
                <li class="nav-item"><a href="?type=dep">sandal</a></li>




            </ul>

        </div>
    </nav>

    <section class="main wrapper">
        <div class="list-products">
            <?php

            if (mysqli_num_rows($results) > 0 ) {
                while ($row = mysqli_fetch_assoc($results)) {
                    ?>
            <div class="product">
                <div class="product-img">
                    <img src="img/<?php echo $row['image']?>" alt="">
                </div>
                <div class="product-content">
                    <div class="product-info">
                        <p class="product-name"><?php echo $row["name"]?></p>
                        <p class="product-price"><?php echo $row['price'] . " $"?></p>
                    </div>
                    <a href="productDetails.php?product_id=<?php echo $row['id']?>"><button>EXPLORE MUG</button></a>
                </div>
            </div>
            <?php
            }
        }
        ?>
        </div>
    </section>

    <div class="page-list">
        <ul>
            <?php
            if (isset($_GET['search_btn'])) {
                if ($currentPage > 3) {
        echo "<li><a href='?search_input=$text&search_btn=&page=1'>Trang đầu</a></li> ";
    }
    for ($page = 1; $page <= $totalPages; $page++) {
        if ($currentPage != $page) {
            if ($page >= $currentPage - 3 && $page <= $currentPage + 3) {
                echo "<li><a href='?search_input=$text&search_btn=&page=$page' >$page</a></li> ";
            }
        } else {
            echo "<li><a href='?search_input=$text&search_btn=&page=$page' style='background-color: #fba1b7; color: #fff'>$page</a></li> ";

        }
    }
    if ($currentPage < $totalPages - 2) {
                echo "<li><a href='?search_input=$text&search_btn=&page=$totalPages' >Trang cuối</a></li> ";

    }
            }
        else{
            if($currentPage > 3){
            ?>
            <li><a href="?type=<?php echo $type.'&page=1' ?>"><?php echo 'Trang đầu' ?></a></li>
            <?php }
    ?>
            <?php
        for ($i = 1; $i <= $totalPages; $i++) {
        ?>
            <?php
    if ($currentPage != $i) {
        if ($i >= $currentPage - 3 && $i <= $currentPage + 3) {
            ?>

            <li><a href="?type=<?php echo $type.'&page='.$i ?>"><?php echo $i ?></a></li>
            <?php }
    } 
            else{
            ?>
            <li><a href="?type=<?php echo $type.'&page='.$i ?>"
                    style="background-color: #fba1b7; color: #fff"><?php echo $i?></a></li>
            <?php } ?>
            <?php }
    ?>
            <?php 
        if($currentPage < $totalPages -2){
            ?>
            <li><a href="?type=<?php echo $type.'&page='.$totalPages ?>"><?php echo 'Trang cuối' ?></a></li>
            <?php }
        }
    ?>
        </ul>
    </div>
    <!-- ------------page-list------------------------- -->
    <div>
        <?php require_once('components/subcribe.php')?>
    </div>
    <div>
        <?php require_once('components/footer.php')?>

    </div>
</body>

</html>

<?php
if (isset($_GET['search_btn'])) {
    if ($currentPage > 3) {
        echo "<li><a href='?search_input=$text&search_btn=&page=1'>Trang đầu</a></li> ";
    }
    for ($page = 1; $page <= $totalPages; $page++) {
        if ($currentPage != $page) {
            if ($page >= $currentPage - 3 && $page <= $currentPage + 3) {
                echo "<li><a href='?search_input=$text&search_btn=&page=$page' >$page</a></li> ";
            }
        } else {
            echo "<li><a href='?search_input=$text&search_btn=&page=$page' style='background-color: #fba1b7; color: #fff'>$page</a></li> ";

        }
    }
    if ($currentPage < $totalPages - 2) {
                echo "<li><a href='?search_input=$text&search_btn=&page=$totalPages' >Trang cuối</a></li> ";

    }


}?>