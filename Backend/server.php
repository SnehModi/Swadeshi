<?php 

    session_start();

    // initializing variables
    $name = "";
    $email = "";
    $password = "";
    $account = "";
    $errors = array(); 

    if (isset($_POST['submit'])) {
      // receive all input values from the form
      $name = mysqli_real_escape_string($conn, $_POST['name']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);
      $account = mysqli_real_escape_string($conn, $_POST['account-type']);

      // form validation: ensure that the form is correctly filled ...
      // by adding (array_push()) corresponding error unto $errors array
      if (empty($name)) { array_push($errors, "Username is required"); }
      if (empty($email)) { array_push($errors, "Email is required"); }
      if (empty($password)) { array_push($errors, "Password is required"); }
      if (empty($account)) { array_push($errors, "Account-Type is required"); }

      // first check the database to make sure 
      // a user does not already exist with the same username and/or email
      $user_check_query = "SELECT * FROM user WHERE email='$email' LIMIT 1";
      $result = mysqli_query($conn, $user_check_query);
      $user = mysqli_fetch_assoc($result);
      
      if ($user) { 
        // if user exists
        //     if ($user['username'] === $username) {
        //       array_push($errors, "Username already exists");
        //     }

        if ($user['email'] === $email) {
          array_push($errors, "Email already exists");
        }
      }

      // Finally, register user if there are no errors in the form
      if (count($errors) == 0) {
        $password = md5($password);//encrypt the password before saving in the database

        $query = "INSERT INTO user(name,email,password,account)VALUES('$name','$email','$password','$account')";
        mysqli_query($conn, $query);
        $user_check_query = "SELECT * FROM user WHERE email='$email' LIMIT 1";
        $result = mysqli_query($conn, $user_check_query);
        $user = mysqli_fetch_assoc($result);
        $_SESSION['uid'] = $user['id'];
        $_SESSION['uname'] = $name;
        $_SESSION['uaccess'] = $account;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
      }
    }

    // LOGIN USER
    if (isset($_POST['login'])) {
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);

      if (empty($email)) {
        array_push($errors, "Email is required");
      }
      if (empty($password)) {
        array_push($errors, "Password is required");
      }

      if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM user WHERE email='$email' AND password='$password'";
        $results = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($results);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['uid'] = $user['id'];
          $_SESSION['uname'] = $user['name'];
          $_SESSION['uaccess'] = $user['account'];
          $_SESSION['success'] = "Logged in : ";
          header('location: index.php');
        }else {
          array_push($errors, "Wrong email/password combination");
        }
      }
    }

 ?>