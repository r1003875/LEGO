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
        $profile = $user->getUser($getUser[0]['email']);

        if(!empty($_POST)){
            if(!empty($_POST['new_password']) && !empty($_POST['confirm_new_password'])){
                if($_POST['new_password'] === $_POST['confirm_new_password']){
                    $user->setPassword($_POST['new_password']);
                    $user->updatePassword($getUser[0]['email']);
                    $message = "Password updated.";
                }
                else{
                    $error = "Passwords do not match.";
                }
            }
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
    
    <main class="account">
        <h2>Account</h2>
        <form class="account_info" action="" method="post">
            <div class="left">
                <h3>First name</h3>
                <p><?php echo $profile[0]['first_name']; ?></p>
            </div>
            <div class="right">
                <h3>Last name</h3>
                <p><?php echo $profile[0]['last_name']; ?></p>
            </div>
            <div class="left">
                <h3>Email</h3>
                <p><?php echo $profile[0]['email']; ?></p>
            </div>
            <div class="right">
                <h3>Edit password</h3>
                <h4>New password</h4>
                <input type="password" name="new_password" value="">
                <h4>Confirm new password</h4>
                <input type="password" name="confirm_new_password" value="">
                <?php if(isset($error)): ?>
                    <div class="woops"><?php echo $error; ?></div>
                <?php endif; ?>
                <?php if(isset($message)): ?>
                    <div class="check"><?php echo $message; ?></div>
                <?php endif; ?>
                <input type="submit" value="Confirm" class="btn1">
            </div>
        </form>
        <section class="user_orders">
            <h2>Your orders</h2>
            <?php
                
            ?>
        </section>
    </main>
</body>
</html>