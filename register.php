<?php
require('./controller/connect.php');
 session_start();
// validate form
$err = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username
    if (empty($_POST["username"])) {
        $err['username'] = "Username is required";
    } else if (strlen($_POST['username']) <= 5) {
        $err['username'] = 'Username must be at least 5 characters';
    }

    // email
    if (empty($_POST["email"])) {
        $err['email'] = "Email is required";
    } else if (!preg_match('/([\w\-]+\@[\w\-]+\.[\w\-]+)/', $_POST["email"])) {
        $err['email'] = "You Entered An Invalid Email Format";
    }

    if(empty($_POST["password"])){
        $err['password'] = "Password is required";
    }
    else{
        if (strlen($_POST["password"]) <= '8') {
            $err['password'] = "Your Password Must Contain At Least 8 Characters!";
        } else if (!preg_match("#[0-9]+#", $_POST["password"]) || !preg_match("#[A-Z]+#", $_POST["password"])) {
            $err['password'] = "Your Password Must Contain at Least 1 number and 1 capital Letter!";
        }else if (!preg_match("#[a-z]+#", $_POST["password"])) {
            $err['password'] = "Your Password Must Contain At Least 1 Lowercase Letter!";
        } 
    }

    if(empty($_POST["confirmPassword"]) && empty($err['password'])){
        $err['confirmPassword'] = 'Please confirm your password';
    }else if($_POST["confirmPassword"] != $_POST["password"]){
        $err['confirmPassword'] = 'Confirm your password dont match!';
    }
    // End validate

    // Them tai khoan vao database
   
    // Kiểm tra xem người dùng đã nhấn nút Đăng ký chưa
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy thông tin đăng ký từ form
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        // Kiểm tra xem tên đăng nhập đã tồn tại trong cơ sở dữ liệu chưa
        $query = "SELECT * FROM taikhoan WHERE username='$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "Tài khoản đã tồn tại.";
        }else{
            // Thêm thông tin đăng ký vào cơ sở dữ liệu
            $query = "INSERT INTO taikhoan (username, password, email) VALUES ('$username', '$password', '$email')";
            if (mysqli_query($conn, $query)) {
                echo "Đăng ký thành công.";
                // Chuyển hướng đến trang đăng nhập hoặc trang khác sau khi đăng ký thành công
                header("Location: login.php");
            } else {
                echo "Đăng ký thất bại. Vui lòng thử lại.";
                header("Location: register.php");
            }
        }
    }
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  return $data;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/register.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="img/logo.jpg" type="image/gif" sizes="16x16">

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Lobster&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <title>Document</title>
    <style>
    </style>
</head>

<body>
    <div class="register_left">
        <div>

            <a href="index.php" class="back_to_home"> <i class='bx bx-arrow-back'></i></a>

        </div>
        <form action="register.php" method="post">
            <h1 class="form_header">Register</h1>
            <div class="filed">
                <label for="username">Username</label>
                <input type="text" name="username" id="username">
                <span><?php echo empty( $err['username']) ? '' :  $err['username']?></span>
            </div>
            <div class="filed">
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
                <span><?php echo empty( $err['email']) ? '' :  $err['email']?></span>
            </div>
            <div class="filed">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
                <span> <?php echo empty( $err['password']) ? '' :  $err['password']?> </span>
            </div>
            <div class="filed">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" name="confirmPassword" id="confirmPassword">
                <span?> <?php echo empty( $err['confirmPassword']) ? '' :  $err['confirmPassword']?></span>
            </div>
            <button class="btn_register" name="submit">Register</button>
            <div class="to_register">
                <p>Already have an account. <a href="#">login?</a></p>
            </div>
        </form>
    </div>
    <div class="register_right">
    </div>
</body>

</html>