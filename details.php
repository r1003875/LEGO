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
    include_once(__DIR__."/classes/Review.php");
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
    $user_id = $getUser[0]['id'];   
    $allReviews = Review::getAll($product['id']);
    if(!empty($_POST)){
        if(!isset($_SESSION['cart']) || !in_array($_POST['id'], $_SESSION['cart'])){
            $_SESSION['cart'][] = $_POST['id'];
        }
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
    <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/2/24/LEGO_logo.svg/512px-LEGO_logo.svg.png" type="image/x-icon">
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
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
            <h2><?php echo $product['name'] ?></h2>
            <span class="age"><img src="images/cake-candles-solid.svg" alt="age" class="icon"> <?php echo $product['min_age'] ?>+</span>
            <span class="pieces"><img src="images/puzzle-piece-solid.svg" alt="pieces" class="icon"> <?php echo $product['pieces_amount'] ?></span>
            <span class="rating"><img src="images/star-solid.svg" alt="rating" class="icon"> <?php echo $product['rating'] ?></span>
            <span class="price"><?php echo $product['price']." ¢" ?></span>
            <input type="submit" class="btn2" value="Add to cart">
        </form>
        </div>
    </main>
    <section class="review_section">
        <h3>Reviews</h3>
        <div class="review_form">
            
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
                <input type="submit" value="Comment" class="btn1" id="addReviewBtn" data-product_id="<?php echo $product['id']; ?>" data-user_id="<?php echo $user_id; ?>">
            
        </div>
        <div class="reviews">
            <?php foreach($allReviews as $review): ?>
            <div class="review">
                <div class="review_details">
                    <span class="reviewer_name"><?php echo Review::getUserById($review['user_id']) ?></span>
                    <span class="rating"><img src="images/star-solid.svg" alt="rating" class="icon"><?php echo $review['rating'];?></span>
                    <span class="review_date"><?php $newDate = date("d-m-Y", strtotime($review['date'])); echo $newDate;?> </span>
                </div>
                <p class="comment"><?php echo $review['comment']; ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </section>   
    
    <script src="js/review.js"></script>
</body>
</html>