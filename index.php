<?php 
    session_start();
    if($_SESSION['loggedin'] !== true){
        header('Location: login.php');
    }
    include_once(__DIR__."/classes/Db.php");
    include_once(__DIR__."/classes/Product.php");
    $products = Product::getAll();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEGO</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include_once("nav.inc.php"); ?>
    <main class="shopping_page">
    <?php foreach($products as $p): ?>
        <article>
            <div>
                <img src=<?php echo $p['image']?> alt="notre dame">
            </div>
            <div class="span_div">
                <span class="age"><img src="images/cake-candles-solid.svg" alt="age" class="icon"> <?php echo $p['min_age'] ?>+</span>
                <span class="pieces"><img src="images/puzzle-piece-solid.svg" alt="pieces" class="icon"> <?php echo $p['pieces_amount'] ?></span>
                <span class="rating"><img src="images/star-solid.svg" alt="rating" class="icon"> <?php echo $p['rating'] ?></span>
            </div>
            <h4><?php echo $p['name'] ?></h4>
            <span class="price">$<?php echo $p['price'] ?></span>
            <div class="btn2">Add to cart</div>
        </article>  
    <?php endforeach; ?>        
    </main>

</body>
</html>