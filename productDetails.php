<?php
require_once('controller/connect.php');
session_start();


//truy van thong tin san pham
$product_id = $_GET['product_id'];
$sql = "SELECT * FROM product WHERE id = $product_id";
$product = mysqli_query($conn, $sql);
$result=mysqli_fetch_assoc($product);
$type = $result['type'];
$sql2 = "SELECT * FROM product WHERE type = '$type' AND id <> $product_id ";
$similar = mysqli_query($conn, $sql2);



// Số sản phẩm trên mỗi trang
$commentPerPage = 4;
// Xác định trang hiện tại (mặc định là trang đầu tiên)
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}
// Tính chỉ mục bắt đầu của sản phẩm trong CSDL cho trang hiện tại
$startIndex = ($currentPage - 1) * $commentPerPage;
// Truy vấn CSDL để lấy dữ liệu sản phẩm cho trang hiện tại
// Sử dụng LIMIT để giới hạn số sản phẩm và OFFSET để chọn các sản phẩm từ chỉ mục bắt đầu
$query = 
    "SELECT taikhoan.username, taikhoan.avatar, comment.content 
     FROM comment  INNER JOIN taikhoan ON comment.user_id = taikhoan.id
      WHERE comment.product_id = $product_id LIMIT $commentPerPage OFFSET $startIndex";
$comment_results = mysqli_query($conn, $query);
// Tính tổng số trang dựa trên tổng số sản phẩm và số sản phẩm trên mỗi trang
$query2 = "SELECT taikhoan.username, taikhoan.avatar, comment.content 
          FROM comment  INNER JOIN taikhoan ON comment.user_id = taikhoan.id
      WHERE comment.product_id = $product_id ";
$total_results = mysqli_query($conn, $query2);
$comments = mysqli_num_rows($total_results);
$totalPages = ceil($comments/ $commentPerPage);




// truy van comment
;
?>
<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/product_details.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="icon" href="img/logo.jpg" type="image/gif" sizes="16x16">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>CDN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

    <style>
    .header {
        margin-bottom: 200px;
    }
    </style>
</head>

<body>
    <div class="header">
        <?php
            require_once('components/header.php');
        ?>
    </div>

    <div class="product-details main">
        <div class="product-details-img">
            <img src="img/<?php echo $result['image']?>" alt="">
        </div>
        <div class="product-details-info">
            <h1><?php echo $result['name']?></h1>
            <p><?php echo $result['description']?></p>
            <p class="product-details-info__price">
                <?php echo $result['price'] . "$"?>
            </p>
            <form method="post" action="cart/add_to_cart.php" id="add_form">
                <select name="size" id="size">
                    <option value="s">S</option>
                    <option value="m">M</option>
                    <option value="l">L</option>
                </select>

                <input type="hidden" name="product_id" value="<?php echo $result['id']; ?>">
                <input class="add_to_cart" type="submit" name="add_to_cart" value="Thêm vào giỏ hàng">
            </form>
        </div>
    </div>
    <!-- --------------------------Comment------------------------------------ -->
    <div class="main comment_wrapper">
        <h1 class="comment_title">
            Đánh giá sản phẩm
        </h1>
        <form method="post" class="form_comment" action="comment.php?product_id=<?php echo $product_id?>">
            <input type="text" name="comment" placeholder="Nhập bình luận của bạn...">
            <button name="sent_comment">Gửi</button>
        </form>
        <div class="list_comment">
            <?php if (mysqli_num_rows($comment_results) > 0) {
                while($com = mysqli_fetch_assoc($comment_results)){
                ?>
            <div class="comment">
                <div class="user_infor">
                    <img src="./img/<?php echo $com['avatar']?>" alt="" class="user_infor__img">
                    <p class="user_infor__name"><?php echo $com['username']?></p>
                </div>
                <div class="content_comment">
                    <?php echo $com['content']?>
                </div>
            </div>
            <?php }
            }?>

        </div>
        <div style="margin: 50px 0">
            <?php require('./components/comment_paganation.php')?>
        </div>
    </div>
    <!-- Swiper -->
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="img/banner2.avif" alt=""></div>
            <div class="swiper-slide"><img src="img/banner1.avif" alt=""></div>
            <div class="swiper-slide"><img src="img/banner3.avif" alt=""></div>
            <div class="swiper-slide"><img src="img/banner4.avif" alt=""></div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <!-- --------------------------------------End slider-------------------------------------- -->


    <div class="subheadline">
        <span></span>
        YOU MIGHT ALSO LIKE THESE

        <span></span>
    </div>
    <!-- --------------------------------------End line-------------------------------------- -->

    <div class="more-product">
        <?php 
            if (mysqli_num_rows($similar ) > 0 && mysqli_num_rows($similar)<=9) {
            while ($row = mysqli_fetch_assoc($similar)) {
            ?>

        <div class="product-similar">
            <div class="product-similar__img">
                <a href="productDetails.php?product_id=<?php echo $row['id']?>"><img
                        src="img/<?php echo $row['image']?>" alt=""></a>
            </div>
            <span class="product-similar__price"><?php echo $row['price'] . "$"?></span>
        </div>

        <?php
                }
            }
        ?>
    </div>
    <!-- --------------------------------------End more-product-------------------------------------- -->
    <div>
        <?php require('components/subcribe.php')?>
    </div>
    <div>
        <?php require('components/footer.php')?>
    </div>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
    var swiper = new Swiper(".mySwiper", {
        // Tùy chọn autoplay
        autoplay: {
            delay: 2000, // Thời gian tự động chuyển slide, tính bằng mili giây (ở đây là 3 giây)
            disableOnInteraction: false, // Cho phép tự động chuyển slide khi người dùng tương tác (mặc định là true)
        },
        pagination: {
            el: ".swiper-pagination",
        },
    });
    </script>
</body>

</html>