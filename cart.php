<?php
        session_start();
        if($_SESSION['loggedin'] !== true){
            header('Location: login.php');
        }
        include_once(__DIR__."/classes/Db.php");
        include_once(__DIR__."/classes/Product.php");
        include_once("classes/User.php");
        include_once("classes/Admin.php");
        include_once("classes/Customer.php");
        include_once("classes/Category.php");
        $getUser = User::getUser($_SESSION['email']);
        if($getUser[0]['admin'] === 0){
            $user = new Customer();
        }
        else{
            $user = new Admin();
        }
        $total_price = 0;
        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
            $_SESSION['can_checkout'] = true;
            foreach($_SESSION['cart'] as $key => $id){
                $product = Product::getProductById($id);
                $total_price += $product['price'];
            }
        }
        if(!empty($_POST)){
            if(isset($_POST['id'])){
                $key = array_search($_POST['id'], $_SESSION['cart']);
                unset($_SESSION['cart'][$key]);
                $product = Product::getProductById($_POST['id']);
                $total_price -= $product['price'];
                if(empty($_SESSION['cart'])){
                    $_SESSION['can_checkout'] = false;
                }
            }
        }
       
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" href="images/LEGO_logo.png" type="image/x-icon">
</head>
<body>
    <?php include_once("nav.inc.php"); ?>
    <h2 class="cart_h2">Shopping cart</h2>
    <main class="cart">
        <?php if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
        <?php foreach($_SESSION['cart'] as $key => $id): ?>
        <?php $product = Product::getProductById($id); ?>
            <form action="" method="post">
                <article>
                    <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
                    <div class="img_holder">
                        <img src=<?php echo $product['image']?> alt="notre dame">
                    </div>
                    <div class="span_div">
                        <span class="age"><img src="images/cake-candles-solid.svg" alt="age" class="icon"> <?php echo $product['min_age'] ?>+</span>
                        <span class="pieces"><img src="images/puzzle-piece-solid.svg" alt="pieces" class="icon"> <?php echo $product['pieces_amount'] ?></span>
                        <span class="rating"><img src="images/star-solid.svg" alt="rating" class="icon"> <?php echo $product['rating'] ?></span>
                    </div>
                    <h4><?php echo $product['name'] ?></h4>
                    <span class="price"><?php echo $product['price']." ¢" ?></span>
                    <input type="submit" class="btn2" value="Remove">
                </article>
            </form>
        <?php endforeach; ?>
            <div class="checkout">
                <p>Total price: <span class="total_price"><?php echo $total_price ?></span> ¢</p>
                <a href="checkout.php" class="btn1">Checkout</a>
            </div>
        <?php else: ?>
            <div class="empty">
                <p>Your cart is empty</p>
            </div>
        <?php endif; ?>
    </main>

</body>
</html>