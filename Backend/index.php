<?php

	session_start();

	if (!isset($_SESSION['name'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }

  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['name']);
  	header("location: login.php");
  }
	
	include('./config/db.php');

	// query for all values from railway
	$sql = 'SELECT * FROM user';

	// make query & get result
	$result = mysqli_query($conn, $sql);

	// fetch the resulting rows as an array
	$users = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
	print_r($users);

?>

<!DOCTYPE html>
<html>
	
	<nav>
        <h3 class='navbar'><a href="./homepage.php">SNEH MODI</a></h3>
        <button class='navbar btn'><a href="./signup.php">Hello</a></button>
    </nav>

	<h3>
		<?php echo $_SESSION['name']; ?>
	</h3>
	
	<!-- notification message -->
  	<?php if (isset($_SESSION['msg'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['msg']; 
          	unset($_SESSION['msg']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>


	<!-- logged in user information -->
    <?php  if (isset($_SESSION['name'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['name']; ?></strong></p>
    	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
	
</html>