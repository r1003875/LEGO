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
    $getUser = User::getUser($_SESSION['email']);
    if($getUser[0]['admin'] != 0){
        $user = new Admin();
    }
    else{
        $user = new Customer();
    }
    $_SESSION['first_name'] = $getUser[0]['first_name'];
    $categories = Category::getAll();
    if(isset($_GET['category'])){
        if($_GET['category'] == 'all'){
            $products = Product::getAll();
        }
        else{
            $products = Product::getProductsByCategory($_GET['category']);
        }
    }
    else{
        $products = Product::getAll();
    }

    if(!empty($_POST)){
        if(!in_array($_POST['id'], $_SESSION['cart'])){
            $_SESSION['cart'][] = $_POST['id'];
        }
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
    <link rel="shortcut icon" href="images/LEGO_logo.png" type="image/x-icon">

</head>
<body>
    <?php include_once("nav.inc.php"); ?>
    <div class="categories">
        <?php foreach($categories as $key => $c): ?>
            <a href="index.php?category=<?php echo $c; ?>"><?php echo $c; ?></a>
        <?php endforeach; ?>
    </div>
    <main class="shopping_page">
    <?php foreach($products as $key => $p): ?>
        <a href="details.php?product=<?php echo $p['id']; ?>" class="article_frame">
            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $p['id']; ?>">
                <article>
                    <div class="img_holder">
                        <img src=<?php echo $p['image']?> alt="notre dame">
                    </div>
                    <div class="span_div">
                        <span class="age"><img src="images/cake-candles-solid.svg" alt="age" class="icon"> <?php echo $p['min_age'] ?>+</span>
                        <span class="pieces"><img src="images/puzzle-piece-solid.svg" alt="pieces" class="icon"> <?php echo $p['pieces_amount'] ?></span>
                        <span class="rating"><img src="images/star-solid.svg" alt="rating" class="icon"> <?php echo $p['rating'] ?></span>
                    </div>
                    <h4><?php echo $p['name'] ?></h4>
                    <span class="price"><?php echo $p['price']." ¢" ?></span>
                    <input type="submit" class="btn2" value="Add to cart">
                </article>
            </form>
        </a> 
    <?php endforeach; ?>        
    </main>

</body>
</html>