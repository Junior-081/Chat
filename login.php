<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
require('config.php');
session_start();

if (isset($_POST['username'])){
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($conn, $username);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($conn, $password);
    $query = "SELECT * FROM `users` WHERE username='$username' and password='".hash('sha256', $password)."'";
	$result = mysqli_query($conn,$query) or die($mysqli->error);
	$rows = mysqli_num_rows($result);
	if($rows==1){
	    $_SESSION['username'] = $username;
	    header("Location: window.php");
	}else{
		$message = "The username or password is incorrect.";
	}
}
?>
<form class="box" action="" method="post" name="login">
<h1 class="box-title">Login</h1>
<input type="text" class="box-input" name="username" placeholder="Username">
<input type="password" class="box-input" name="password" placeholder="Password">
<input type="submit" value="Connexion " name="submit" class="box-button">
<p class="box-register">You are new here ? <a href="register.php">Login</a></p>
<?php if (! empty($message)) { ?>
    <p class="errorMessage"><?php echo $message; ?></p>
<?php } ?>
</form>
</body>
</html>