<?php
    session_start();
    if($_SESSION['loggedin'] !== true){
        header('Location: login.php');
    }
    include_once(__DIR__."/classes/Db.php");
    include_once(__DIR__."/classes/Product.php");
    include_once("classes/User.php");
    include_once("classes/Admin.php");
    include_once("classes/Category.php");
    $getUser = User::getUser($_SESSION['email']);
    if($getUser[0]['admin'] === 0){
        header('Location: index.php');
    }
    else{
        $user = new Admin();
    }
    if(!isset($_GET['p'])){
        exit("404");
    }
    else{
        $id = $_GET['p'];
        $product = Product::getProductById($id);
    }

    $categories = Category::getAll();

    if(!empty($_POST)){
        if(isset($_POST['delete'])){
            $product = new Product();
            $product->delete($id);
            header('Location: index.php');
        }
        try {
            //add all elements to a new product and update the existing product with the same id
            $updated_product = new Product();
            $updated_product->setName($_POST['name']);
            $updated_product->setPrice($_POST['price']);
            $updated_product->setPieces_amount($_POST['pieces_amount']);
            $updated_product->setMin_age($_POST['min_age']);
            $updated_product->setRating($_POST['rating']);
            $updated_product->setImage($_POST['image']);
            $updated_product->setCategory_id($_POST['category_id']);
            $updated_product->update($id);
            $succes = "Product updated!";
            $id = $_GET['p'];
            $product = Product::getProductById($id);
            
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
    
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=µ, initial-scale=1.0">
    <title>Edit</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" href="images/LEGO_logo.png" type="image/x-icon">
</head>
<body>
    <?php include_once('nav.inc.php'); ?>
    <div class="back">
        <a href="new.php">←</a>
    </div>
    <section class="edit_product">
        <h2>Edit</h2>
        <form action="" method="post">
                <?php if(isset($error)): ?>
                    <div class="woops"><?php echo $error; ?></div>
                <?php endif; ?>
                <div>
                    <label for="name">Name:</label>
                    <input type="text" id="name" class="text_input" name="name" value="<?php echo $product['name']; ?>">
                </div>
                <div>
                    <label for="price">Price:</label>
                    <input type="text" id="price" class="text_input" name="price" value="<?php echo $product['price']; ?>">
                </div>
                <div>
                    <label for="pieces_amount">Pieces amount:</label>
                    <input type="text" id="pieces_amount" class="text_input" name="pieces_amount" value="<?php echo $product['pieces_amount']; ?>">
                </div>
                <div>
                    <label for="min_age">Minimum age:</label>
                    <input type="text" id="min_age" class="text_input" name="min_age" value="<?php echo $product['min_age']; ?>">
                </div>
                <div>
                    <label for="rating">Rating:</label>
                    <input type="text" id="rating" class="text_input" name="rating" value="<?php echo $product['rating']; ?>">
                </div>
                <div>
                    <label for="image">Image:</label>
                    <input type="text" id="image" class="text_input" name="image" value="<?php echo $product['image']; ?>">
                </div>
                <div>
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id">
                        <?php foreach($categories as $key => $c ): ?>
                            <?php
                            if($key == $product['category_id']){
                                $selected = 'selected';
                            }
                            else{
                                $selected = '';
                            }
                            ?>
                            <option value="<?php echo $key ?>" <?php echo $selected; ?>><?php echo $c ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn1">Confirm changes</button>
                <?php if(isset($succes)): ?>
                    <div class="check"><?php echo $succes; ?></div>
                <?php endif; ?>
            </form>
            <form action="" method="post">
                <input type="hidden" name="delete" value="0">
                <button type="submit" class="btn1" name="delete">Delete product</button>
            </form>
        </section>
</body>
</html>