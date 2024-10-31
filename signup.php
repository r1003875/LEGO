<?php
    include_once(__DIR__."/classes/User.php");
    if(!empty($_POST)){
        if($_POST['password'] === $_POST['confirm_password']){
            try {
                $user = new User();
                $user->setFirstname($_POST['firstname']);
                $user->setLastname($_POST['lastname']);
                $user->setEmail($_POST['email']);
                $user->setPassword($_POST['password']);
                $user->save();
                header('Location: login.php');
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }
        else{
            $password_mismatch = "Passwords didn't match";
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
</head>
<body>
    <div class="bg_color1"></div>
    <div class="bg_color2"></div>
    <div class="lego_form">
        <a href="index.php"><img src="images/LEGO_logo.png" alt="logo" class="logo"></a>
        <h2>Sign up to create your LEGO® account</h2>
        <p>If you already have an account, log in.</p>
        <main>
            <form action="" method="post">
                <?php if(isset($error)): ?>
                <div class="woops">
                    <?php echo $error; ?>
                </div>
                <?php endif; ?>
                <?php if(isset($password_mismatch)): ?>
                <div class="woops">
                    <?php echo $password_mismatch; ?>
                </div>
                <?php endif; ?>
                <div>
                    <label for="firstname">Firstname</label>
                    <input type="text" class="text_input" id="firstname" name="firstname">
                </div>
                <div>
                    <label for="lastname">Lastname</label>
                    <input type="text" class="text_input" id="lastname" name="lastname">
                </div>
                <div>
                    <label for="email">Email</label><br>
                    <input type="text" class="text_input" id="email" name="email">
                </div>
                <div>
                    <label for="password">Password</label><br>
                    <input type="password" class="text_input" id="password" name="password">
                </div>
                <div>
                    <label for="confirm_password">Confirm Password</label><br>
                    <input type="password" class="text_input" id="confirm_password" name="confirm_password">
                </div>
                <div class="extra_links">
                    <a href="#">Help!</a>
                    <a href="login.php">Already an account? Log in!</a>
                </div>
                <div class="login_btn">
                    <input type="submit" value="Sign up" class="btn1">
                </div>
                
            </form>
            </div>
        </main>
    </div>
</body>
</html>