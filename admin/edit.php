<?php
require_once('../controller/connect.php');

session_start();
$product_id = $_GET['product_id'];
$query = "SELECT * FROM product WHERE id = $product_id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);


if(isset($_POST['edit'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    // Lấy tên của hình ảnh
    $img = $_FILES['hinhanh']['name'];
    // Lấy đường dẫn của hình ảnh
    $img_tmp = $_FILES['hinhanh']['tmp_name'];
    $des = $_POST['des'];
    $type = $_POST['type'];
    $sql = "UPDATE product SET name = '$name', price = $price,image = '$img' ,description ='$des', type = '$type' WHERE id = $product_id ";
   
     if(mysqli_query($conn, $sql)){
         move_uploaded_file($img_tmp, '../img/'.$img);
         header('location: index.php');
     }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Lobster&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="./css/add.css">
    <title>Document</title>
</head>

<body>

    <form method="post" enctype="multipart/form-data">
        <h1>Edit sản phẩm</h1>
        <div class="field">
            <label for="name">Tên sản phẩm</label>
            <input type="text" name="name" id="name" value="<?php echo $row['name']?>">
        </div>
        <div class="field">
            <label for="price">Giá bán</label>
            <input type="text" name="price" id="price" value="<?php echo $row['price']?>">
        </div>
        <div class="field">
            <label for="hinhanh">Hình ảnh</label>
            <input type="file" name="hinhanh" id="hinhanh" value="<?php echo $row['image']?>">
        </div>
        <div class="field">
            <label for="des">Mô tả</label>
            <textarea name="des" id="des" cols="30" rows="7"><?php echo $row['description']?></textarea>
        </div>
        <div class="field">
            <label for="des">Thể loại</label>
            <select name="type" id="type" value="<?php echo $row['type']?>">
                <option value="ao">Áo</option>
                <option value="quan">Quần</option>
                <option value="dep">Dép</option>
                <option value="non">Nón</option>
                <option value="vi">Ví</option>
            </select>
        </div>
        <button name="edit">Sửa</button>
    </form>
</body>

</html>