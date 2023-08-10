<?php
require_once('controller/connect.php');
session_start();
$sql = "SELECT * FROM product LIMIT 9";
$sql2 = "SELECT * FROM product ORDER BY price DESC LIMIT 2;";
$featured = mysqli_query($conn, $sql2 );
$products = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Lobster&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="icon" href="img/logo.jpg" type="image/gif" sizes="16x16">

    <title>CDN</title>
    <style>

    </style>
</head>

<body>

    <div class="on-to-top"><a href="#banner"><i class='bx bxs-arrow-to-top'></i></a></div>
    <div class="header">
        <?php include('components/header.php')?>
    </div>
    <!---------------------------------------------------- End header --------------------------->

    <section class="container banner_wrapper" id="banner">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img src="img/banner2.avif" alt=""></div>
                <div class="swiper-slide"><img src="img/banner1.avif" alt=""></div>
                <div class="swiper-slide"><img src="img/banner3.avif" alt=""></div>
                <div class="swiper-slide"><img src="img/banner4.avif" alt=""></div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="banner">
            <h2>BEST PLACE TO BUY CLOTHES</h2>
            <h1>LocalStar</h1>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corrupti ex corporis commodi illum, accusamus
                necessitatibus!</p>
            <a href="productsPage.php"><button>Explore our products</button></a>
        </div>
    </section>
    <!-- ---------------------------------------------------End banner-------------------------->

    <section class="container">
        <div class="story animate__animated" id="myElement">
            <h1>This is the story that inspired us to create this brand</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti impedit in cumque ab doloremque odit
                dicta rerum debitis nostrum ea, praesentium eum, molestias nemo doloribus obcaecati corrupti pariatur et
                iste omnis voluptas officiis sapiente asperiores minus quas. Molestias veniam quisquam perferendis quod
                voluptatem, iusto iste repellat voluptates, reiciendis ducimus animi.</p>
            <a href="#">Read the full Story</a>
        </div>
    </section>

    <!-- --------------------------------------End story-------------------------------------- -->

    <div class="subheadline">
        <span></span>
        Featured products
        <span></span>
    </div>
    <!-- --------------------------------------End line-------------------------------------- -->

    <section class="main">
        <div class="featured-products">
            <?php

            if (mysqli_num_rows($featured) > 0 ) {
                while ($item = mysqli_fetch_assoc($featured)) {
                    ?>
            <div class="product">
                <div class="product-img">
                    <img src="img/<?php echo $item['image']?>" alt="">
                </div>
                <div class="product-content">
                    <div class="product-info">
                        <p class="product-name"><?php echo $item["name"]?></p>
                        <p class="product-price"><?php echo $item['price'] . " $"?></p>
                    </div>
                    <a href="productDetails.php?product_id=<?php echo $item['id']?>"
                        style="display: block;"><button>EXPLORE MUG</button></a>
                </div>
            </div>
            <?php
            }
        }
        ?>
        </div>
    </section>
    <!-- --------------------------------------featured-products-------------------------------------- -->
    <div class='subheadline'>
        <span></span>
        More products
        <span></span>
    </div>

    <!-- --------------------------------------End line-------------------------------------- -->

    <section class="main">
        <div class="list-products">
            <?php

            if (mysqli_num_rows($products) > 0 ) {
                while ($row = mysqli_fetch_assoc($products)) {
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
    <!-- --------------------------------------End Products List-------------------------------------- -->

    <section>
        <div class="video">
            <video id="myVideo" src="img/video.mp4" autoplay width="100%" muted preload"></video>
        </div>
    </section>
    <!-- --------------------------------------End Video-------------------------------------- -->
    <div class="subheadline">
        <span></span>
        BUY 2 ITEMS AND GET A CLOTHES MAGAZINE FREE
        <span></span>
    </div>
    <!-- --------------------------------------End line-------------------------------------- -->
    <section class="main">
        <div class="magazine">
            <div class="magazine-left">
                <h3>PREMIUM OFFER</h3>
                <h1>Get our Coffee Magazine</h1>
                <p>The most versatile furniture system ever created. Designed to fit your life.</p>
                <a href="productsPage.php"><button>START SHOPPING</button></a>
            </div>
            <div class="magazine-right">
                <div class="magazine1">
                    <img src="img/magazine/magazine1.avif" alt="">
                </div>
                <div class="magazine23">
                    <div class="magazine2">
                        <img src="img/magazine/magazine2.avif" alt="">
                    </div>
                    <div class="magazine3">
                        <img src="img/magazine/magazine3.avif" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- --------------------------------------End magazine-------------------------------------- -->
    <?php include('components/subcribe.php')?>
    <!-- --------------------------------------End SUBCRIBE---------------------------------------- -->
    <?php include('components/footer.php')?>


    <!-- Swiper JS -->


    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
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
    <script src="main.js"></script>

</body>

</html>