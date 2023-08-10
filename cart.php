<?php
require('./controller/connect.php');
session_start();
$user_id = $_SESSION['user_id'];
if(!isset($_SESSION['user_id'])){
    header('location:index.php');
}
// Truy vấn cơ sở dữ liệu để lấy thông tin sản phẩm trong giỏ hàng của người dùng
$query = "SELECT product.name, product.price, product.image, product.id, cart.quantity, cart.size
          FROM product 
          INNER JOIN cart ON product.id = cart.product_id 
          WHERE cart.user_id = $user_id";
$result = mysqli_query($conn, $query);
$numrow = mysqli_num_rows($result);
$_SESSION['total'] = $numrow;


// xử lí form mua hàng
$err = [];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // username
    if (empty($_POST['name'])) {
        $err['name'] = "name is required";
    } else if (strlen($_POST['name']) <= 5) {
        $err['name'] = 'name must be at least 5 characters';
    }

    // sdt
    if (empty($_POST["sdt"])) {
        $err['sdt'] = "Phone number is required";
    } else if (!preg_match('/^[0-9]{10}+$/', $_POST['sdt'])) {
        $err['sdt'] = "Phone number is not valid";
    }

    if (empty($_POST['address'])) {
        $err['address'] = "Address is required";
    }

    if(empty( $err['name']) && empty( $err['sdt']) && empty( $err['address'])){
        header('location: thank.php');
    }else if(!empty( $err['name']) && !empty( $err['sdt']) && !empty( $err['address'])){
        echo "<script>alert('Vui lòng điền đẩy đủ thông tin!')</script>";
    }
}
// Đóng kết nối đến cơ sở dữ liệu
mysqli_close($conn);
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
    <link rel="icon" href="img/logo.jpg" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="css/cart.css">
    <title>Cart</title>
</head>

<body>

    <div class="header">
        <?php require('./components/header.php')?>
    </div>
    <section class="cart">

        <div class="cart_left">
            <h1>Shopping cart</h1>

            <hr>
            <div class="cart_list">
                <?php
                $totalPay = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Tính giá mới nếu quantity > 1
                        $_SESSION['total'] += $row['quantity'];
                        $total_price = $row['quantity'] * $row['price'];
                    $totalPay += $total_price;
                        ?>
                <div class="cart_item">
                    <form action="/cart/delete.php" method="post">
                        <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">

                        <button type="submit" name="submit" class="cart_delete"><i class='bx bx-x'></i></button>
                    </form>
                    <div class=" cart_img">
                        <img src="img/<?php echo $row['image']?>" alt="">
                    </div>
                    <div class="cart_name"><?php echo $row['name']?></div>
                    <div class="cart_price"><?php echo $row['price'] . "<b>$</b>"?></div>
                    <div class="cart_calc">
                        <form action="/cart/decrement.php" method="post">
                            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">

                            <button type="submit" name="submit" class="decrement">-</button>
                        </form>
                        <div><?php echo $row['quantity']?></div>
                        <form action="/cart/increment.php" method="post">
                            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">

                            <button type="submit" name="submit" class="increment">+</button>
                        </form>
                    </div>
                    <div><?php echo strtoupper($row['size'])?></div>
                    <div><?php echo $total_price . "<b>$</b>"?></div>
                </div>
                <?php }
                ?>
            </div>

            <div class="test">hello</div>
        </div>
        <div class="cart_right">
            <h1>Cart totals</h1>
            <hr>
            <div class="subtotal">
                <h2>Subtotal</h2>
                <p><?php echo $totalPay . "<b>$</b>"?></p>
            </div>
            <hr>
            <div class="form-contact">
                <form action="cart.php" method="post">
                    <div class="field">
                        <label for="name">Name</label>
                        <input id="name" name="name" type="text" placeholder="Enter your name...">
                        <span><?php echo empty( $err['name']) ? '' :  $err['name']?></span>
                    </div>
                    <div class="field">
                        <label for="sdt">Phone Number</label>
                        <input id="sdt" name="sdt" type="text" placeholder="Enter your number...">
                        <span><?php echo empty( $err['sdt']) ? '' :  $err['sdt']?></span>
                    </div>
                    <div class="field">
                        <label for="address">Address</label>
                        <input id="address" name="address" type="text" placeholder="Enter your address...">
                        <span><?php echo empty( $err['address']) ? '' :  $err['address']?></span>
                    </div>
                    <button class="pay">Pay</button>
                </form>
            </div>
        </div>

    </section>
</body>

</html>