<?php
require('./controller/connect.php');
session_start();
if(isset($_SESSION['user_id'])){
    header('location: index.php');
}
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin đăng nhập từ form
    $email = $_POST['email'];
    $password = $_POST['password'];


    // Kiểm tra thông tin đăng nhập ở đây...
      if (isset($_POST["remember"])) {
        // Nếu người dùng chọn "Nhớ tài khoản", lưu thông tin đăng nhập vào session
        $_SESSION['remember_email'] = $email;
        $_SESSION['remember_password'] = $password;
    } else {
        // Ngược lại, xóa thông tin đăng nhập khỏi session
        unset($_SESSION['remember_email']);
        unset($_SESSION['remember_password']);
    }
   


    
    // Thực hiện truy vấn để kiểm tra thông tin đăng nhập
    $query = "SELECT * FROM taikhoan WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        // Đăng nhập thành công
        // Nếu thông tin đăng nhập chính xác, lấy user_id và lưu vào SESSION
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $email;
        $_SESSION['password'] =  $password;
        $_SESSION['level'] = $row['level'];
        $_SESSION['avatar'] = $row['avatar'];
        echo $_SESSION['level'];
        // Chuyển hướng đến trang chào mừng hoặc trang khác
        if( $_SESSION['level'] == 1){
            header('Location: ./admin/index.php');
        }else{
            header("Location: index.php");
        }
        
    } else {
        // Đăng nhập thất bại
        echo "<script>alert('Tài khoản hoặc mật khẩu không chính xác!')</script>";

        header("Location: login.php");

    }
}

   

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Lobster&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" href="../img/logo.jpg" type="image/gif" sizes="16x16">
    <title>Login</title>
    <style>
    </style>
</head>

<body>
    <div class="login_left">
        <div>

            <a href="index.php" class="back_to_home"> <i class='bx bx-arrow-back'></i></a>

        </div>
        <form action="login.php" method="post">
            <h1 class="form_header">LOGIN</h1>
            <div class="filed">
                <label for="email">Email</label>
                <input type="email" name="email" id="email"
                    value="<?php echo isset($_SESSION['remember_email']) ? $_SESSION['remember_email'] : ''?>">
            </div>
            <div class="filed">
                <label for="password">Password</label>
                <div class="pass_box">
                    <input type="password" name="password" id="password"
                        value="<?php echo isset($_SESSION['remember_password']) ? $_SESSION['remember_password'] : ''?>">
                    <span id="icon_pass"><i class="fa-solid fa-eye-slash"></i></span>

                    <!-- <i class="fa-solid fa-eye"></i> -->
                </div>
            </div>
            <div class="remember">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Duy trì đăng nhập</label>
            </div>
            <button class="btn_login" name="submit">Login</button>
            <div class="to_register">
                <p>Not a member? <a href="register.php">Register</a></p>
            </div>
        </form>
    </div>
    <div class="login_right">
    </div>

    <script>
    const icon_pass = document.querySelector('#icon_pass');
    const icon = document.querySelector('#icon_pass i');
    const inputPass = document.querySelector('#password');
    icon_pass.onclick = function() {
        if (icon.classList.contains('fa-eye-slash')) {
            icon.classList.replace('fa-eye-slash', 'fa-eye');
            inputPass.setAttribute('type', 'text');
        } else {
            icon.classList.replace('fa-eye', 'fa-eye-slash');
            inputPass.setAttribute('type', 'text');
            inputPass.setAttribute('type', 'password');


        }
    }
    console.log(icon_pass);
    </script>
</body>

</html>