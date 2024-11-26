<?php
    session_start();
    if($_SESSION['loggedin'] !== true){
        header('Location: login.php');
    }
    include_once(__DIR__."/classes/Db.php");
    include_once(__DIR__."/classes/Product.php");
    include_once(__DIR__."/classes/User.php");
    include_once(__DIR__."/classes/Admin.php");
    include_once(__DIR__."/classes/Customer.php");
    include_once(__DIR__."/classes/Category.php");
    $products = Product::getAll();
    $getUser = User::getUser($_SESSION['email']);
    if($getUser[0]['admin'] != 0){
        $user = new Admin();
    }
    else{
        $user = new Customer();
    }
    if(!isset($_GET['product'])){
        exit("404");
    }
    else{
        $product_ids = [];
        foreach($products as $key => $p){
            $product_ids[] = $p['id'];
        }  
        if(!in_array($_GET['product'], $product_ids)){
            header('Location: index.php');
        }
        $k = array_search($_GET['product'], $product_ids);

    }
    $product = $products[$k];
    
    if(!empty($_POST)){
        var_dump($_POST);
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['name']; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" href="images/LEGO_logo.png" type="image/x-icon">
</head>
<body>
    <?php include_once("nav.inc.php"); ?>
    <div class="back">
        <a href="index.php">←</a>
    </div>
    <main class="product_details">
        <div class="big_img_holder">
            <img src="<?php echo $product['image'] ?>" alt="<?php echo $product['name'] ?>">
        </div>
        <div class="product_information">
            <h2><?php echo $product['name'] ?></h2>
            <span class="age"><img src="images/cake-candles-solid.svg" alt="age" class="icon"> <?php echo $product['min_age'] ?>+</span>
            <span class="pieces"><img src="images/puzzle-piece-solid.svg" alt="pieces" class="icon"> <?php echo $product['pieces_amount'] ?></span>
            <span class="rating"><img src="images/star-solid.svg" alt="rating" class="icon"> <?php echo $product['rating'] ?></span>
            <span class="price">$<?php echo $product['price'] ?></span>
            <div class="btn2">Add to cart</div>
        </div>
    </main>
    <section class="review_section">
        <h3>Reviews</h3>
        <div class="review_form">
            <form action="" method="post">
                <label for="custom_review">Leave your review</label>
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <span class="rating"><img src="images/star-solid.svg" alt="rating" class="icon">
                    <select name="custom_rating" id="custom_rating">
                        <option value="0.0">0</option>
                        <option value="1.0">1</option>
                        <option value="2.0">2</option>
                        <option value="3.0">3</option>
                        <option value="4.0">4</option>
                        <option value="5.0" selected="selected">5</option>    
                    </select>
                </span>
                <textarea name="custom_review" id="custom_review"></textarea>
                <input type="submit" value="Comment" class="btn1">
            </form>
        </div>
        <div class="reviews">
            <div class="review">
                <div class="review_details">
                    <span class="reviewer_name">Arno Van Abbenyen</span>
                    <span class="rating"><img src="images/star-solid.svg" alt="rating" class="icon">5</span>
                    <span class="review_date">25-11-2024 </span>
                </div>
                <p class="comment">Goede kwaliteit. Snel geleverd. Top product!</p>
            </div>
            <div class="review">
                <div class="review_details">
                    <span class="reviewer_name">Simon Van den Eynde</span>
                    <span class="rating"><img src="images/star-solid.svg" alt="rating" class="icon">5</span>
                    <span class="review_date">26-11-2024 </span>
                </div>
                <p class="comment">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, numquam. Natus omnis iste eaque quibusdam est accusantium assumenda quasi a.</p>
            </div>
        </div>
    </section>    
</body>
</html>