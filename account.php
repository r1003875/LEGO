<?php
        session_start();
        if($_SESSION['loggedin'] !== true){
            header('Location: login.php');
        }
        include_once(__DIR__."/classes/Db.php");
        include_once(__DIR__."/classes/User.php");
        include_once(__DIR__."/classes/Admin.php");
        include_once(__DIR__."/classes/Customer.php");
        include_once(__DIR__."/classes/Order.php");
        include_once(__DIR__."/classes/Product.php");
        $getUser = User::getUser($_SESSION['email']);
        if($getUser[0]['admin'] != 0){
            $user = new Admin();
        }
        else{
            $user = new Customer();

        }
        $profile = $user->getUser($getUser[0]['email']);

        if(!empty($_POST)){
            if(!empty($_POST['new_password']) && !empty($_POST['confirm_new_password'])){
                if($_POST['new_password'] === $_POST['confirm_new_password']){
                    $user->setPassword($_POST['new_password']);
                    $user->updatePassword($getUser[0]['email']);
                    $message = "Password updated.";
                }
                else{
                    $error = "Passwords do not match.";
                }
            }
        }

        $orders = Order::getOrders($getUser[0]['id']);
        
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/2/24/LEGO_logo.svg/512px-LEGO_logo.svg.png" type="image/x-icon">
</head>
<body>
    <?php include_once("nav.inc.php"); ?>
    
    <main class="account">
        <h2>Account</h2>
        <form class="account_info" action="" method="post">
            <div class="left">
                <h3>First name</h3>
                <p><?php echo htmlspecialchars($profile[0]['first_name']); ?></p>
            </div>
            <div class="right">
                <h3>Last name</h3>
                <p><?php echo htmlspecialchars($profile[0]['last_name']); ?></p>
            </div>
            <div class="left">
                <h3>Email</h3>
                <p><?php echo htmlspecialchars($profile[0]['email']); ?></p>
            </div>
            <div class="right">
                <h3>Edit password</h3>
                <h4>New password</h4>
                <input type="password" name="new_password" value="">
                <h4>Confirm new password</h4>
                <input type="password" name="confirm_new_password" value="">
                <?php if(isset($error)): ?>
                    <div class="woops"><?php echo $error; ?></div>
                <?php endif; ?>
                <?php if(isset($message)): ?>
                    <div class="check"><?php echo $message; ?></div>
                <?php endif; ?>
                <input type="submit" value="Confirm" class="btn1">
            </div>
        </form>
        <section class="user_orders">
            <h2>Your orders</h2>
            <?php foreach($orders as $order): ?>
                    <article>
                    <?php 
                        $order_products = Order::getOrderProducts($order['id']);
                        echo "<div class='order'>";
                        echo "<p>Order: #".$order['id']."</p>";
                        echo "<p>Order date: ".date("d-m-Y", strtotime($order['order_date']))."</p>";
                        echo "<p>Status: ".$order['status']."</p>";
                        echo "</div>";
                        echo "<div class='products'>";
                        foreach($order_products as $product){
                            $product_id = $product['products_id'];
                            $product = Product::getProductById($product_id);
                            echo "<div class='product'>";
                            echo "<div class='order_image_holder'><img src='".$product['image']."' alt='".$product['name']."'></div>";
                            echo "<p>".$product['name']."</p>";
                            echo "</div>";
                        }
                    ?>
                    </article>
                <?php endforeach;?>
        </section>
    </main>
</body>
</html>