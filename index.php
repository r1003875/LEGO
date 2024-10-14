<?php 
    session_start();
    if($_SESSION['loggedin'] !== true){
        header('Location: login.php');
    }
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
        <article>
            <div>
                <img src="images/notre_dame.png" alt="notre dame">
            </div>
            <div class="span_div">
                <span class="age"><img src="images/cake-candles-solid.svg" alt="age" class="icon"> 18+</span>
                <span class="pieces"><img src="images/puzzle-piece-solid.svg" alt="pieces" class="icon"> 4862</span>
                <span class="rating"><img src="images/star-solid.svg" alt="rating" class="icon"> 5.0</span>
            </div>
            <h4>Lego City - Brandweer</h4>
            <span class="price">$299.99</span>
            <div class="btn2">Add to cart</div>
        </article> 
        <article>
            <div>
                <img src="images/notre_dame.png" alt="notre dame">
            </div>
            <div class="span_div">
                <span class="age"><img src="images/cake-candles-solid.svg" alt="age" class="icon"> 18+</span>
                <span class="pieces"><img src="images/puzzle-piece-solid.svg" alt="pieces" class="icon"> 4862</span>
                <span class="rating"><img src="images/star-solid.svg" alt="rating" class="icon"> 5.0</span>
            </div>
            <h4>Lego City - Brandweer</h4>
            <span class="price">$299.99</span>
            <div class="btn2">Add to cart</div>
        </article>     
        <article>
            <div>
                <img src="images/notre_dame.png" alt="notre dame">
            </div>
            <div class="span_div">
                <span class="age"><img src="images/cake-candles-solid.svg" alt="age" class="icon"> 18+</span>
                <span class="pieces"><img src="images/puzzle-piece-solid.svg" alt="pieces" class="icon"> 4862</span>
                <span class="rating"><img src="images/star-solid.svg" alt="rating" class="icon"> 5.0</span>
            </div>
            <h4>Lego City - Brandweer</h4>
            <span class="price">$299.99</span>
            <div class="btn2">Add to cart</div>
        </article>     
        <article>
            <div>
                <img src="images/notre_dame.png" alt="notre dame">
            </div>
            <div class="span_div">
                <span class="age"><img src="images/cake-candles-solid.svg" alt="age" class="icon"> 18+</span>
                <span class="pieces"><img src="images/puzzle-piece-solid.svg" alt="pieces" class="icon"> 4862</span>
                <span class="rating"><img src="images/star-solid.svg" alt="rating" class="icon"> 5.0</span>
            </div>
            <h4>Lego City - Brandweer</h4>
            <span class="price">$299.99</span>
            <div class="btn2">Add to cart</div>
        </article>           
    </main>

</body>
</html>