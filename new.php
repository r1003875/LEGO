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
    if(!empty($_POST)){
        try {
            $product = new Product();
            $product->setName($_POST['name']);
            $product->setPrice($_POST['price']);
            $product->setPieces_amount($_POST['pieces_amount']);
            $product->setMin_age($_POST['min_age']);
            $product->setRating($_POST['rating']);
            $product->setImage($_POST['image']);
            $product->setCategory_id($_POST['category_id']);
            $product->save();
            header('Location: index.php');
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }

    $categories = Category::getAll();
    $products = Product::getAll();



    
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/2/24/LEGO_logo.svg/512px-LEGO_logo.svg.png" type="image/x-icon">
</head>
<body>
    <?php include_once("nav.inc.php"); ?>
    <main class="new_product">
        <h2>Add new product</h2>
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
                <label for="min_age">Minimum age:</label>
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
            <div>
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id">
                    <?php foreach($categories as $key => $c ): ?>
                        <option value="<?php echo $key ?>"><?php echo $c ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn1">Add product</button>

        </form>
    </main>
    <section class="edit_product">
        <h2>Edit product</h2>
        <select name="select_product" id="select_product">
            <?php foreach($products as $key => $p): ?>
                <option value="<?php echo $p['id'] ?>"><?php echo $p['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <a href="edit.php?p=0" class="btn1" id="edit_link">Edit this product</a>
    </section>

    <script>
        let select = document.querySelector('#select_product');
        let link = document.querySelector('#edit_link');
        link.href = `edit.php?p=${select.value}`;
        select.addEventListener('change', function(){
            console.log(select.value);
            link.href = `edit.php?p=${select.value}`;
        }); 
    </script>
</body>
</html>