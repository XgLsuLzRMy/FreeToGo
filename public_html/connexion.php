<!doctype html>
<?php require("connexion.inc.php") ?>
<?php
if (isset($_SESSION['idClient']) && !isset($_POST['suppressionCompte'])){
  header("Location: ./profil.php"); // redirige vers le profil si l'utilisateur est deja connecté et qu'il ne souahite pas supprimer son compte
}
?>
<HTML lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="css/common.css" />
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <title> Connexion </title>
  </head>
  <body>
    <?php include('include/header.html'); ?>
    <div class="main">
      <?php
      if (isset($_GET['suppressionSuccess'])){
        afficherMessageSucces('Votre compte a bien été supprimé');
      }
      if (isset($_GET['reserver'])){
        afficherMessageErreur('Veuillez vous connecter pour pouvoir reserver');
      }
      if (isset($_GET['commentaire'])){
        afficherMessageErreur('Veuillez vous connecter pour pouvoir commenter');
      }
      ?>
      <br/>
      <div class="login-cadre">
        <form action="connexion.php" method="post">
          <h2 style="text-align: center;">Connexion </h2>
          <br/>
          <label> Nom de l'utilisateur: </label>
          <br/>
          <input type="text" name="login" placeholder="Nom" required />
          <br/>
          <label> Mot de passe: </label>
          <br/>
          <input type="password" name="mdp" placeholder="Mot de passe" required />
          <br/>
          <input type="submit" class="bouton" name="connexion" value= "Se connecter" />
        </form>
      </div>
      <?php
      if (isset($_GET['mauvaisLogin'])){
        echo '<script>alert("Mauvais login...");</script>';
      }
      if (isset($_GET['mauvaiseForme'])){
        echo '<script>alert("mail de la mauvaise forme ou mot de passe vide...");</script>';
      }
      if (isset($_GET['mailExistant'])){
        echo '<script>alert("mail deja utilisé par un utilisateur...");</script>';
      }
      if (isset($_GET['loginExistant'])){
        echo '<script>alert("login deja utilisé par un utilisateur...");</script>';
      }
      ?>

      <div class="login-cadre">
        <form action="connexion.php" method="post">
          <h2 style="text-align: center;">Inscription </h2>
          <br/>
          <label> Nom de l'utilisateur: </label>
          <br/>
          <input type="text" name="loginInc" placeholder="Nom" required />
          <br/>
          <label> Adresse e-mail: </label>
          <br/>
          <input type="text" name="mailInc" placeholder="Mail" required />
          <br/>
          <label> Mot de passe: </label>
          <br/>
          <input type="password" name="mdpInc"  placeholder="Mot de passe" required />
          <br/>
          <input type="submit" class="bouton" name="inscription" value= "S'inscrire" />
        </form>
      </div>
    </div>
  </body>
</HTML>
