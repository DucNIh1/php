<?php
require_once('controller/connect.php');

session_start();

if($_SESSION['user_id']){
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM taikhoan WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
}



if(isset($_POST['edit'])){
    $name = $_POST['name'];
    $password = $_POST['password'];
    // Lấy tên của hình ảnh
    $img = $_FILES['avatar']['name'];
    // Lấy đường dẫn của hình ảnh
    $img_tmp = $_FILES['avatar']['tmp_name'];
    $sql = "UPDATE taikhoan SET username = '$name', password = '$password', avatar = '$img'  WHERE id = $user_id ";
    
     if(mysqli_query($conn, $sql)){
         move_uploaded_file($img_tmp, './img/'.$img);
        $_SESSION['username'] =  $name;
        $_SESSION['password'] =  $password;
        $_SESSION['avatar'] = $img;
        header('location:index.php');
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
    <link rel="stylesheet" href="./css/setting.css">
    <title>Document</title>
</head>

<body>

    <form method="post" enctype="multipart/form-data">
        <h1>Chỉnh sửa thông tin cá nhân</h1>
        <div class="field">
            <label for="name">Username</label>
            <input type="text" name="name" id="name" value="<?php echo $row['username']?>">
        </div>
        <div class="field">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" value="<?php echo $row['password']?>">
        </div>
        <div class=" field">
        </div>
        <label for="avatar">Avatar</label>
        <input type="file" name="avatar" id="avatar">
        </div>
        <button name="edit">Xác nhận</button>
    </form>
</body>

</html>