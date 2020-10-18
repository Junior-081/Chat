<?php
	// Initialiser la session
	session_start();
	// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
	if(!isset($_SESSION["username"])){
		header("Location: login.php");
		exit(); 
	}
?>
<!DOCTYPE html >
<html>
   <head>
       <title>home page</title>
       <meta charset="utf-8" />
       <link rel="stylesheet" type="text/css" href="style.css">
   </head>
  
   <body>
<?php
require('config.php');
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


   $messages = $_POST['message']; 
   $key_password = "nethojunior081+";

    // CRYPTER
    $messageCrypte = openssl_encrypt($messages, "AES-128-ECB" ,$key_password);
   // var_dump($messageCrypte);
    //var_dump($decrypted_chaine);



// On insère les données dans la table minichat
$req = $bdd->prepare('SELECT * FROM users WHERE username = :pseudo');
$req->execute(array(
    'pseudo' => $_POST['pseudo']));
$resultat = $req->fetch();
//var_dump($resultat);

if ($_POST['pseudo']==$resultat['username']) {
    if($_SESSION['username']!==$_POST['pseudo']){
        $req = $bdd->prepare('INSERT INTO minichat(pseudo, message,date_chat) 
        VALUES(:pseudo, :message,CURRENT_DATE)');
        $req->execute(array(
            'pseudo' => $_POST['pseudo'],
            'message' => $messageCrypte
            ));
            $req->closeCursor(); // Termine le traitement de la requête   
    }
    else {
        echo "You cannot send the message to yourself";
        //$message="You cannot send the message to yourself";
    }

// On récupère tout le contenu de la table minichat
$reponse = $bdd->query('SELECT * FROM minichat');



// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{
// DECRYPTER
$decryptedMessages = openssl_decrypt($donnees['message'], "AES-128-ECB" , $key_password);
?>
    <p>
    <strong>Pszudo</strong> : <?php echo $donnees['pseudo']; ?><br />
    Message : <?php echo $decryptedMessages; ?>
   </p>
<?php
}
header('Location: minichat.php');
} else {
    echo "<div class='sucess'>
    <h3> The user ".$_POST['pseudo']." does not exist in the database</h3> 
    </div>";
    echo "<br>";
    echo "<div class='sucess'>
    <h3>Please register first before doing what you want.</h3>
    <p>Click here for  <a href='register.php'>registration</a></p>
    <p> Click here to  <a href='minichat.php'>Return</a></p>
    </div>";
   
}

?>
  </body>
</html>
