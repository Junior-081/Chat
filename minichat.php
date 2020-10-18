<!DOCTYPE html >
<html>
   <head>
       <title>Minichat</title>
       <meta charset="utf-8" />
   </head>
   <style>
    form
    {
        text-align:center;
    }
    </style>
    <img src="image_couleur.php" />
   <body>
  <!-- <p><a href="bonjour.php?nom=Dupont&prenom=Jean">Dis-moi bonjour !</a></p> -->
   <form action="minichat_post.php" method="POST">
   </p><label>Pseudo : <input type="text" name="pseudo" /></label></p>
   </p><label>Message: <input type="text" name="message" /></label></p>
   </p><input type="submit" /></p>
   <?php
echo "<div class='sucess'>
<p>Click here to  <a href='window.php'>Return</a></p>
</div>";
?>
   </form>
   </body>
</html>