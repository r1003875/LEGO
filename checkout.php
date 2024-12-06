<?php
            session_start();
            if($_SESSION['loggedin'] !== true){
                header('Location: login.php');
            }
            include_once(__DIR__."/classes/Db.php");
            include_once(__DIR__."/classes/Product.php");
            include_once("classes/User.php");
            include_once("classes/Admin.php");
            include_once("classes/Customer.php");
            include_once("classes/Category.php");
            $getUser = User::getUser($_SESSION['email']);
            if($getUser[0]['admin'] === 0){
                $user = new Customer();
            }
            else{
                $user = new Admin();
            }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" href="images/LEGO_logo.png" type="image/x-icon">
</head>
<body>
    <?php include_once("nav.inc.php"); ?>
</body>
</html>