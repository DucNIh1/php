<?php
require('./controller/connect.php');

// Truy vấn cơ sở dữ liệu để lấy thông tin sản phẩm trong giỏ hàng của người dùng
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT product.name, product.price, product.image, product.id, cart.quantity
            FROM product 
            INNER JOIN cart ON product.id = cart.product_id 
            WHERE cart.user_id = $user_id";
    $result2 = mysqli_query($conn, $query);
    $numrow = mysqli_num_rows($result2);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/header.css">
    <style>
    .hightlight {
        color: red;
    }
    </style>
    <title>Document</title>
</head>

<body>
    <header id="header">
        <div class="header-logo"><a href="./index.php">
                <img src="./img/logo.jpg" alt="" width="50" height="50">
            </a></div>
        <!-- End logo -->
        <nav>
            <ul>
                <li><a href="/index.php">Home</a></li>
                <li><a href="/productsPage.php">Our Product</a></li>
                <li><a href="/about.php">About</a></li>
                <li><a href="/contact.php">Contact</a></li>
            </ul>
        </nav>
        <!-- end nav -->
        <div class="header-cart">
            <div>
                <span class="header-cart__icon"><i class='bx bx-cart-add'></i></span>
                <span class="header-cart__link"><a href="/cart.php">Cart</a></span>
                <span class="header-cart__total"><?php echo isset($numrow) ? $numrow : 0?></span>
            </div>
            <div class="person" st>
                <div class="person_img" style="cursor:pointer">
                    <img src="../img/<?php echo isset($_SESSION['avatar']) ? $_SESSION['avatar'] : 'user_default.jpg'?>"
                        alt="">
                </div>
                <div class="person_menu">
                    <div class="person_menu__info">
                        <div class="person_img__sub">
                            <img src="../img/<?php echo isset($_SESSION['avatar']) ? $_SESSION['avatar'] : 'user_default.jpg'?>"
                                alt="">
                        </div>
                        <h4 class="person_name">
                            <?php echo isset($_SESSION['username']) ?$_SESSION['username']: 'user' ?></h4>
                    </div>
                    <hr>
                    <ul>
                        <?php 
                            if(!isset($_SESSION['user_id'])){
                             ?>
                        <li><a href="login.php">Đăng nhập</a></li>
                        <hr>
                        <?php } ?>
                        <li><a href="register.php">Đăng kí</a></li>
                        <hr>
                        <?php 
                            if(isset($_SESSION['user_id'])){
                             ?>
                        <li><a href="logout.php">Đăng Xuất</a></li>
                        <hr>
                        <?php } ?>
                        <?php 
                            if(isset($_SESSION['user_id'])){
                             ?>
                        <li><a href="setting.php">Chỉnh sửa thông tin</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>

    </header>
    <script>
    const person = document.querySelector('.person');
    const person_menu = document.querySelector('.person_menu')
    // Lấy đối tượng nav và tất cả các liên kết trong nó
    var nav = document.querySelector('nav');
    var links = nav.getElementsByTagName('a');

    // Lặp qua các liên kết và thêm lớp 'active' cho liên kết tương ứng với URL hiện tại
    for (var i = 0; i < links.length; i++) {
        if (links[i].href === window.location.href) {
            links[i].classList.add('active');
        }
    }

    person.onclick = function() {
        person_menu.classList.toggle('active');
    }

    window.onclick = function(e) {
        if (!person.contains(event.target) && !person_menu.contains(event.target)) {
            person_menu.classList.remove('active');
        }
    }
    </script>
</body>

</html>