<?php
require('../controller/connect.php');
session_start();

if( $_SESSION['level'] != 1){
    header('location: ../index.php');
}
// Số sản phẩm trên mỗi trang
$productsPerPage = 4;
// Xác định trang hiện tại (mặc định là trang đầu tiên)
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}
// Tính chỉ mục bắt đầu của sản phẩm trong CSDL cho trang hiện tại
$startIndex = ($currentPage - 1) * $productsPerPage;
// Truy vấn CSDL để lấy dữ liệu sản phẩm cho trang hiện tại
// Sử dụng LIMIT để giới hạn số sản phẩm và OFFSET để chọn các sản phẩm từ chỉ mục bắt đầu

$query = "SELECT * FROM product LIMIT $productsPerPage OFFSET $startIndex";
   
$list = mysqli_query($conn, $query);


// Tính tổng số trang dựa trên tổng số sản phẩm và số sản phẩm trên mỗi trang
$sql = "SELECT * FROM product";
$results = mysqli_query($conn, $sql);
$totals = mysqli_num_rows($results);
$totalPages = ceil($totals/ $productsPerPage);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Lobster&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="icon" href="../img/logo.jpg" type="image/gif" sizes="16x16">

    <title>Admin</title>
</head>

<body>
    <header>
        <div class="left">
            <div class="logo">

                <a href="../index.php"><img src="../img/logo.jpg" alt="" width="50" height="50"></a>
            </div>
            <p>xin chào <span style="color:#fba1b7">admin</span></p>
        </div>
        <div class="right">
            <div class="home">
                <a href="../index.php">
                    <span>Trang chủ</span>
                    <span><i class='bx bx-home'></i></span>
                </a>
            </div>
            <div class="logout">
                <a href="../logout.php">
                    <span>Đăng xuất</span>
                    <span> <i class='bx bx-log-out'></i></span>
                </a>
            </div>
        </div>
    </header>


    <section>
        <div class="menu">
            <h1>Danh sách sản phẩm</h1>
            <a href="add.php"><button>Thêm sản phẩm</button></a>
            <table>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Loại sản phẩm</th>
                    <th>Sửa</th>
                    <th>Xóa</th>

                </tr>
                <?php

            if (mysqli_num_rows($list) > 0 ) {
                while ($row = mysqli_fetch_assoc($list)) {
                    ?>
                <tr>
                    <td>
                        <img src="../img/<?php echo $row['image']?>" alt="" width="200" height="200">
                    </td>
                    <td><?php echo $row["name"]?></td>
                    <td><?php echo $row['price'] . " $"?></td>
                    <td><?php echo $row['type']?></td>
                    <td><a href="edit.php?product_id=<?php echo $row['id']?>">Sửa</a></td>
                    <td><a href="delete.php?product_id=<?php echo $row['id']?>">Xóa</a></td>
                </tr>
                <?php
            }
        }
        ?>

                <td colspan="6">
                    <?php require('paganation.php')?>
                </td>
            </table>
        </div>
    </section>
</body>

</html>