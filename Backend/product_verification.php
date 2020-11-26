<?php 

	session_start();


	// if (!isset($_SESSION['uname'])) {
  	// $_SESSION['msg'] = "You must log in first";
  	// header('location: login.php');
  	// }

  	// if ($_SESSION['uaccess'] == 'Customer') {
  	// 	$_SESSION['msg'] = "You do not have access to Product Verification page.";
  	// 	header('location: index.php');
  	// } 

	include './config/db.php';

    // initializing variables
    $manufacturer = $_SESSION['uname'];
    $product_name = "";
    $product_url = "";
    $product_category = "";
    $product_price = "";
    $product_quantity = "";
    $verify = 0;
    $errors = array();
    $origin = array(); 

    if (isset($_POST['verify'])) {
      // receive all input values from the form
      $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
      $product_url = $_POST['product_url'];
      $product_category = mysqli_real_escape_string($conn, $_POST['product_category']);
      $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
      $product_quantity = mysqli_real_escape_string($conn, $_POST['product_quantity']);
      array_push($origin, $_POST['Material-1']);
      array_push($origin, $_POST['Material-2']);
      array_push($origin, $_POST['Material-3']);

      // form validation: ensure that the form is correctly filled ...
      // by adding (array_push()) corresponding error unto $errors array
      if (empty($product_name)) { array_push($errors, "Product Name is required"); }
      if (empty($product_url)) { array_push($errors, "URL is required"); }
      if (empty($product_price)) { array_push($errors, "Price is required"); }
      if (empty($product_quantity)) { array_push($errors, "Quantity is required"); }

      // first check the database to make sure 
      // a user does not already exist with the same username and/or email
      // $user_check_query = "SELECT * FROM user WHERE email='$email' LIMIT 1";
      // $result = mysqli_query($conn, $user_check_query);
      // $user = mysqli_fetch_assoc($result);

      foreach ($origin as $org) {
      	# code...
      	if (strtolower($org) === 'india') {
      		# code...
      		$verify++;
      	}
      }
      
      if ($verify < 2) { array_push($errors, "Verification Unsuccessful - Sorry this product cannot be sold :("); }

      // Finally, register user if there are no errors in the form
      if (count($errors) == 0) {
        $thumbnail = explode(',', $product_url)[0];
        $query = "INSERT INTO product_details(name,price,quantity,manufacturer,primaryCategory,thumbnail,images)
            VALUES('$product_name','$product_price','$product_quantity','$manufacturer','$product_category','$thumbnail','$product_url')";
        mysqli_query($conn, $query);
        // $_SESSION['name'] = $name;
        // $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
      }
    }
   

 ?>

 <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Product Verification</title>
        <link rel="stylesheet" href="./css/homepage.css">
        <link rel="stylesheet" href="./css/signup.css">
        <link rel="stylesheet" href="./css/product_verification.css">
    </head>

    <body>
        <header>
            <h1>Product Verification</h1>
            <h3>Draft Your Product For Verification</h3>
        </header>

        <form action="product_verification.php" method="POST">

            <h4 id="error">
                <?php include './errors.php'; ?>
            </h4>

            <section class="">
                <input class="input-box" name="product_name" type="text" placeholder="Product Name" minlength="3" maxlength="20" required></input><br>
                <input class="input-box" name="product_url" type="url" placeholder="Product Image URL" required></input><br>
                <input class="input-box" name="product_category" type="text" placeholder="Product Category" minlength="3" maxlength="20" required></input><br>
                <input class="input-box" name="product_price" type="number" placeholder="Product Price (Rs.)" min="1" required></input>
                <input class="input-box" name="product_quantity" type="number" placeholder="Product Quantity" min="1" max="1000" required></input><br>
            </section>

            <hr>

            <section class="">

                <h3>Product Description</h3>

                <input class="input-box" type="text" placeholder="Material-1 Name" minlength="3" maxlength="20" required></input>
                <input class="input-box" name="Material-1" type="text" placeholder="Origin (Country)" minlength="3" maxlength="20" required></input><br>
                <input class="input-box" type="text" placeholder="Material-2 Name" minlength="3" maxlength="20" required></input>
                <input class="input-box" name="Material-2" type="text" placeholder="Origin (Country)" minlength="3" maxlength="20"required></input><br>
                <input class="input-box" type="text" placeholder="Material-3 Name" minlength="3" maxlength="20" required></input>
                <input class="input-box" name="Material-3" type="text" placeholder="Origin (Country)" minlength="3" maxlength="20"required></input><br>
                
                <button type="submit" name="verify">Verify</button>
            </section>

        </form>
    </body>
</html>