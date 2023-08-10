<?php
require('./controller/connect.php');

if(isset($_POST['sub'])){
    $email = $_POST['email'];
    $user_id = $_SESSION['user_id'];
    $sql = "UPDATE taikhoan SET subcribe = 1 WHERE  id =  $user_id";
    mysqli_query($conn,$sql);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/subcribe.css">
    <title>Document</title>
</head>

<body>
    <section class="container">
        <div class="subcribe">
            <div class="sub-line">
                <span></span>
                SUBCRIBE AND GET FREE VOUCHER
                <span></span>
            </div>
            <h1 class="subcribe-title">Products Updates</h1>
            <form method="post" id="subcribe_form">
                <input type=" email" name="email" id="email" placeholder="CUSTOMER@GMAIL.COM">
                <button name="sub" id="btn_sub">SUBCRIBE</button>
            </form>
        </div>

    </section>
    <script>
    const subcribe_form = document.getElementById("subcribe_form");
    subcribe_form.addEventListener("submit", (e) => {
        e.preventDefault();
        const btn_sub = document.getElementById("btn_sub");
        btn_sub.textContent = "Please wait...";
        setTimeout(() => {
            subcribe_form.innerHTML =
                "<p>Thank you! Your submission has been received!</p>";
        }, 2000);
    });
    </script>
</body>

</html>