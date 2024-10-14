<?php
    function verifyLogin($e, $p){
        if($e === "simonvandeneynde@lego.com" && $p === "12345isnotsecure"){
            return true;
        }
        else{
            return false;
        }
    }
    if(!empty($_POST)){
        $email = $_POST['email'];
		$password = $_POST['password'];	
        if(verifyLogin($email, $password)){
            session_start();
			$_SESSION['loggedin'] = true;
			$_SESSION['email'] = $email;
            header('Location: index.php');
        }
        else{
            $error = true;
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
        <h2>Log in to access your LEGO® account</h2>
        <p>If you’re a new LEGO® fan, sign up to create an account.</p>
        <main>
            <form action="" method="post">
                <?php if(isset($error)): ?>
                <div class="woops">
                    <p>Wrong email or password. Please try again.</p>
                </div>
                <?php endif; ?>
                <div>
                    <label for="email">Email</label><br>
                    <input type="text" class="text_input" id="email" name="email" value="<?php
                        if(isset($email)){
                            echo $email;
                        }
                    ?>">
                </div>
                <div>
                    <label for="password">Password</label><br>
                    <input type="password" class="text_input" id="password" name="password">
                </div>
                <div class="extra_links">
                    <a href="">Forgot password?</a>
                    <a href="signup.php">No account yet? Sign up! </a>
                </div>
                <div class="login_btn">
                    <input type="submit" value="Log in" class="btn1">
                </div>
                
            </form>
            </div>
        </main>
    </div>
</body>
</html>