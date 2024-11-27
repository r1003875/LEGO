<?php
        session_start();
        if($_SESSION['loggedin'] !== true){
            header('Location: login.php');
        }
        include_once(__DIR__."/classes/Db.php");
        include_once(__DIR__."/classes/User.php");
        include_once(__DIR__."/classes/Admin.php");
        include_once(__DIR__."/classes/Customer.php");
        $getUser = User::getUser($_SESSION['email']);
        if($getUser[0]['admin'] != 0){
            $user = new Admin();
        }
        else{
            $user = new Customer();
        }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" href="images/LEGO_logo.png" type="image/x-icon">
</head>
<body>
    <?php include_once("nav.inc.php"); ?>
</body>
</html>