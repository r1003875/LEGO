<?php 
/*
    $conn = new mysqli('localhost', 'root', '', 'legoshop'); 
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
    $products = $result->fetch_all(MYSQLI_ASSOC);
*/
    $conn = new PDO('mysql:dbname=legoshop;host=localhost', "root", "");
    $statement = $conn->prepare('SELECT * FROM products');
    $statement->execute();
    $products = $statement->fetchall(PDO::FETCH_ASSOC);

    
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEGO</title>
</head>
<body>
    <h1>Webshop LEGO</h1>
    <?php foreach($products as $p): ?>
        <article>
            <h2><?php echo $p['title'] ?>: $<?php echo $p['price'] ?></h2>
        </article>
    <?php endforeach; ?>
</body>
</html>