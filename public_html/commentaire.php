<?php require("connexion.inc.php"); ouvrirSession();?>
<HTML>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <title> Connexion </title>
  </head>
  <body>
    <?php include('include/header.html');  ?>
    <div class="main">
      <br/>
     <div class="login-cadre">
    <form action="profil.php" method="post">
         <h2>   <center>Votre commentaire </h2> </center>
        <br/>
        <label>Commentaire : </label>
        <br/>
        <textarea name="commentaire" rows="10" placeholder="Saisissez votre commentaire"></textarea>
        <br/>
        <input type="submit" class="bouton" name="poster" value= "Poster" />
    </form>
</div>

  </body>


</HTML>
