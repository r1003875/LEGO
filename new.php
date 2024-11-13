<?php
    session_start();
    if($_SESSION['loggedin'] !== true){
        header('Location: login.php');
    }
    include_once(__DIR__."/classes/Db.php");
    include_once(__DIR__."/classes/Product.php");
    if(!empty($_POST)){
        try {
            $product = new Product();
            $product->setName($_POST['name']);
            $product->setPrice($_POST['price']);
            $product->setPieces_amount($_POST['pieces_amount']);
            $product->setMin_age($_POST['min_age']);
            $product->setRating($_POST['rating']);
            $product->setImage($_POST['image']);
            $product->save();
            header('Location: index.php');
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include_once("nav.inc.php"); ?>
    <main class="new_product">
        <form action="" method="post">
            <?php if(isset($error)): ?>
                <div class="woops"><?php echo $error; ?></div>
            <?php endif; ?>
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" class="text_input" name="name">
            </div>
            <div>
                <label for="price">Price:</label>
                <input type="text" id="price" class="text_input" name="price">
            </div>
            <div>
                <label for="pieces_amount">Pieces amount:</label>
                <input type="text" id="pieces_amount" class="text_input" name="pieces_amount">
            </div>
            <div>
                <label for="min_age">Min age:</label>
                <input type="text" id="min_age" class="text_input" name="min_age">
            </div>
            <div>
                <label for="rating">Rating:</label>
                <input type="text" id="rating" class="text_input" name="rating">
            </div>
            <div>
                <label for="image">Image:</label>
                <input type="text" id="image" class="text_input" name="image">
            </div>
            <button type="submit" class="btn1">Add product</button>

        </form>
</body>
</html>