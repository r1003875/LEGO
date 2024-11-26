<?php 
    include_once("classes/User.php"); 
?><nav>
    <div class="primary_links">
        <a href="index.php"><img src="images/LEGO_logo.png" alt="logo" class="logo"></a>
        <a href="index.php">SHOP</a>
        <a href="">DISCOVER</a>
        <a href="">HELP</a>
        <a href="new.php" class="highlighted <?php if(!$user->canAddProduct()){echo "hidden";} ?>">NEW</a>
    </div>
    
    <div class="secondary_links">
        <input type="text" placeholder="Search..." class="search_input">
        <a href=""><img src="images/bag-shopping-solid.svg" alt="cart" class="shopping_bag"></a>
        <a href=""><?php echo htmlspecialchars(strtoupper($_SESSION['first_name'])); ?></a>
        <a href="logout.php">LOG OUT</a>
    </div>
</nav>