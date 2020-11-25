<?php 

    if (isset($_SESSION['name'])) {
        $_SESSION['msg'] = "Already Logged In !";
        header('location: index.php');
    }

    include('./config/db.php');
    
    include ('server.php');

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" href="./css/signup.css">
    </head>
    <body>
        <section class="signup-section">

            <img id="logo" src="images/swadeshi_logo.png">

            <h1>Log-In</h1>
            
            <form action="login.php" method="POST">
                <?php include('errors.php'); ?>
                <input type="email" class="input-box" name="email" placeholder="Email" required></input><br>
                <input type="password" class="input-box" name="password" placeholder="Password" required></input><br>
                <button type="submit" name="login">Log In</button>
                <p>Do not have an account? <a href="./signup.php">Sign Up</a></p>
            </form>
            
        </section>
    </body>

</html>