<?php
    session_start();
    if($_SESSION['loggedin'] !== true){
        header('Location: login.php');
    }
    if($_SESSION['can_checkout'] !== true){
        header('Location: cart.php');
    }
    include_once(__DIR__."/classes/Db.php");
    include_once(__DIR__."/classes/Product.php");
    include_once("classes/User.php");
    include_once("classes/Admin.php");
    include_once("classes/Customer.php");
    include_once("classes/Category.php");
    include_once("classes/Address.php");
    include_once("classes/Order.php");
    $getUser = User::getUser($_SESSION['email']);
    if($getUser[0]['admin'] === 0){
        $user = new Customer();
    }
    else{
        $user = new Admin();
    }
    $total_price = 0;
    if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
        foreach($_SESSION['cart'] as $key => $id){
            $product = Product::getProductById($id);
            $total_price += $product['price'];
        }
    }

    $credits = $getUser[0]['credits'];
    $new_balance = $credits - $total_price;
    if($new_balance < 0){
        $balance_error = "You don't have enough credits to buy these products.";
    }

    //if user already has an address_id that is not 0, use those values
    if($getUser[0]['address_id'] !== 0){
        $user_address = Address::getAddressById($getUser[0]['address_id']);
    }

    if(!empty($_POST)){
        try{
            $address = new Address();
            $address->setStreet($_POST['street']);
            $address->setHousenumber($_POST['housenumber']);
            $address->setCity($_POST['city']);
            $address->setCountry($_POST['country']);
            $doesAddressExist = $address->checkAddress($_POST['street'], $_POST['housenumber'], $_POST['city'], $_POST['country']);
            if(!$doesAddressExist){
                $address->save();
                $address_id = Address::getAddressId($_POST['street'], $_POST['housenumber'], $_POST['city'], $_POST['country']);
            }
            else{
                $address_id = $doesAddressExist;
            }
            
        }
        catch(Exception $e){
            $error = $e->getMessage();
        }

        
        $user->updateBalance($new_balance);
        $user->setAddress($address_id);

        $order = new Order();
        $order->setUser_id($getUser[0]['id']);
        $order->setAddress_id($address_id);
        $order_id = $order->save();

        foreach($_SESSION['cart'] as $key => $product_id){
            Order::addProductsToOrder($order_id, $product_id);
        }

        unset($_SESSION['cart']);
        header('Location: index.php');
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" href="images/LEGO_logo.png" type="image/x-icon">
</head>
<body>
    <?php include_once("nav.inc.php"); ?>
    <div class="back">
        <a href="cart.php">←</a>
    </div>
    <h2 class="cart_h2">Checkout</h2>
    <div class="checkout-container">
        <div class="products_in_cart">
        <?php 
            foreach($_SESSION['cart'] as $key => $id){
                $product = Product::getProductById($id);
                echo "<div class='product_in_cart'>";
                echo "<img src=".$product['image']." alt='product'>";
                echo "<p>".$product['name']."</p>";
                echo "<p>".$product['price']." ¢</p>";
                echo "</div>";
            }
        ?>
        <div class="checkout_information">
            <p>Total price: <span class="total_price"><?php echo $total_price ?></span> ¢</p>
            <?php if(!isset($balance_error)): ?>
                <p>Your balance after this transaction will be: <span class="new_balance"><?php echo $new_balance ?></span> ¢</p>                
            <?php endif; ?>
        </div>
        </div>
        <?php if(isset($balance_error)): ?>
            <p class="balance_woops"><?php echo $balance_error; ?></p>
        <?php else: ?>
            <form action="" method="post" class="adress_input">
            <?php if(isset($error)): ?>
                <p class="woops"><?php echo $error; ?></p>
            <?php endif; ?>
                <div>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="text_input" value="<?php echo $getUser[0]['first_name']." ".$getUser[0]['last_name']; ?>">
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="text_input" value="<?php echo $getUser[0]['email']; ?>">
                </div>
                <div>
                    <label for="street">Street</label>
                    <input type="text" name="street" id="street" class="text_input" value="<?php if(isset($user_address)){echo $user_address['street'];} ?>">
                </div>
                <div>
                    <label for="housenumber">Housenumber</label>
                    <input type="text" name="housenumber" id="housenumber" class="text_input" value="<?php if(isset($user_address)){echo $user_address['housenumber'];} ?>">
                </div>
                <div>
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" class="text_input" value="<?php if(isset($user_address)){echo $user_address['city'];} ?>">
                </div>
                <div>
                    <label for="country">Country</label>
                    <select name="country" id="country">
                        <option value="BE" <?php if(isset($user_address) && $user_address["country"] === "BE"){echo "selected";} ?>>Belgium</option>
                        <option value="NL" <?php if(isset($user_address) && $user_address["country"] === "NL"){echo "selected";} ?>>Netherlands</option>
                        <option value="FR" <?php if(isset($user_address) && $user_address["country"] === "FR"){echo "selected";} ?>>France</option>
                        <option value="DE" <?php if(isset($user_address) && $user_address["country"] === "DE"){echo "selected";} ?>>Germany</option>
                        <option value="UK" <?php if(isset($user_address) && $user_address["country"] === "UK"){echo "selected";} ?>>United Kingdom</option>
                    </select>
                </div>

                <input type="submit" value="Place order" class="btn1">
            </form>
        <?php endif; ?>
</body>
</html>