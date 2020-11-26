<?php 

    include ('./config/db.php');

    include ('server.php');

 ?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign-Up</title>
        <link rel="stylesheet" href="css/signup.css">
        <script src="./js/form_validation.js"></script>
    </head>
    <body>
        <section class="signup-section">

            <img id="logo" src="images/swadeshi_logo.png">

            <h1>Sign-Up</h1>
            
            <form name="signup_form" onsubmit="return validateForm()" action="signup.php" method="POST">
                <?php include 'errors.php'; ?>
                <input type="text" class="input-box" name="name" placeholder="Name" value="<?php echo $name; ?>" minlength="3" maxlength="20" required ></input><br>
                <div class="error" id="nameErr"></div>
                <input type="email" class="input-box" name="email" placeholder="Email" value="<?php echo $email; ?>" required ></input><br>
                <div class="error" id="emailErr"></div>
                <input type="password" class="input-box" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required></input><br>
                <div class="error" id="passwordErr"></div>
                <input type="radio" class="account-type" name="account-type" value="Customer">Customer</input>
                <input type="radio" class="account-type" name="account-type" value="Business">Business</input>
                <div class="error" id="accountErr"></div>

                <button type="submit" name="submit">Sign-Up</button>
                <p>Already have an account? <a href="./login.php">Login</a></p>
            </form>
            
        </section>
        
        
    </body>

</html>