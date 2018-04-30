<?php require("connexion.inc.php") ?>
<HTML>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" >
    <title> Connexion </title>
  </head>
  <body>
    <?php include('include/header.html'); ?>
    <div class="main">
    <?php
      if (isset($_POST["connexion"])){
        echo "<p>connexion</p>";
      }elseif (isset($_POST["inscription"])){
        echo "<p>inscription</p>";
      }else {
        echo "<p>Un des boutons n'a pas encore été appuyé</p>";
      }
    ?>
     <div class="login-cadre">
    <form action="connexion.php" method="post">
         <h2>   <center>Connexion </h2> </center>
        <br/>
        <label> Nom de l'utilisateur: </label>
        <br/>
        <input type="text" name="login" placeholder="Nom" />
        <br/>
        <label> Mot de passe: </label>
        <br/>
        <input type="password" name="mdp" placeholder="Mot de passe" />
        <br/>
        <input type="submit" class="bouton" name="connexion" value= "Se connecter" />
    </form>
</div>

   <div class="login-cadre">
    <form action="connexion.php" method="post">
        <h2>   <center> Inscription </h2> </center>
        <br/>
        <label> Nom de l'utilisateur: </label>
        <br/>
        <input type="text" name="login" placeholder="Nom" />
        <br/>
        <label> Adresse e-mail: </label>
        <br/>
        <input type="text" name="mail" placeholder="Mail" />
        <br/>
        <label> Mot de passe: </label>
        <br/>
        <input type="password" name="mdp"  placeholder="Mot de passe" />
        <br/>
        <input type="submit" class="bouton" name="inscription" value= "S'inscrire" />
    </form>
    </div>
  </div>
  </body>


</HTML>
