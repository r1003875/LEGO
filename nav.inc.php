<?php 
    include_once("classes/User.php"); 
    include_once("classes/Customer.php");
?><nav>
    <div class="primary_links">
        <a href="index.php"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/24/LEGO_logo.svg/512px-LEGO_logo.svg.png" alt="logo" class="logo"></a>
        <a href="index.php">SHOP</a>
        <a href="">DISCOVER</a>
        <a href="">HELP</a>
        <a href="new.php" class="highlighted <?php if(!$user->canAddProduct()){echo "hidden";} ?>">NEW</a>
    </div>
    
    <div class="secondary_links">
        <input type="text" placeholder="Search..." class="search_input">
        <span><?php
         $credits = User::getUser($_SESSION['email'])[0]['credits']; 
         echo $credits." ¢";
         ?></span>
        <a href="cart.php"><img src="images/bag-shopping-solid.svg" alt="cart" class="shopping_bag"><span class="cart_items_amount"><?php if(isset($_SESSION['cart'])){if(count($_SESSION['cart']) !== 0){echo count($_SESSION['cart']);} }?></span></a>
        <a href="account.php"><?php echo htmlspecialchars(strtoupper($_SESSION['first_name'])); ?></a>
        <a href="logout.php">LOG OUT</a>
    </div>
</nav>