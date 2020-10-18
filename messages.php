<!DOCTYPE html>
<html>
<head>
<!--<link rel="stylesheet" type="text/css" href="style.css">-->
</head>
<body>
<?php
echo "<div class='sucess'>
<center><h1>Sent messages</h1></center>
</div>";
?>
<?php
// Effectuer ici la requête qui insère le message
try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=chat_bd;charset=utf8', 'root', '');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

$reponse = $bdd->query('SELECT * FROM minichat ORDER BY id DESC LIMIT 10');

$key_password = "nethojunior081+";

// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{
    // DECRYPTER
$decryptedMessages = openssl_decrypt($donnees['message'], "AES-128-ECB" , $key_password);
?>
    <div class='mess'>
    <p>
    <strong>From</strong> : <?php echo htmlspecialchars($donnees['pseudo']); ?><br />
    Message : <?php echo htmlspecialchars($decryptedMessages); ?>
    </p>
    </div>
<?php
}
$reponse->closeCursor();
?>

<?php
echo "<div class='sucess'>
<center>
<p>Click here to  <a href='window.php'>Return</a></p>
</center>
</div>";
?>

</body>
</html>