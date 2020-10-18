<?php
	// Initialiser la session
	session_start();
	// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
	if(!isset($_SESSION["username"])){
		header("Location: login.php");
		exit(); 
	}
?>
<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" href="style.css" />
	</head>
	<body>
		<div class="sucess">
		<h1>Welcome <?php echo $_SESSION['username']; ?>!</h1>
		<p>This is your dashboard.</p>
		<br>
		<br>
		<br>
		<p>
			<a href="minichat.php">Send the message</a>
		 </p>
		 <p>
			<a href="messages.php">Your messages</a>
	     </p>
		<br>
		<br>
		<br>
		<a href="logout.php">Logout</a>
		</div>
	</body>
</html>