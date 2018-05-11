<?php require("connexion.inc.php"); ouvrirSession();?>
<HTML>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="css/common.css" />
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <title> Commentaire </title>
  </head>
  <body>
    <?php include('include/header.html');  ?>
    <div class="main">
      <br/>
      <div class="login-cadre">
        <h2>   <center>Votre commentaire </center> </h2>   <br/>
        <form action="commentaire.php" method="post">

          <?php
          echo '<input type="hidden" name="idLogement" value="';
          echo $_GET['idLogement'];
          echo '" />';
          ?>
          <label>Commentaire : </label>
          <br/>
          <textarea name="commentaire" id="commentaire" rows="10" placeholder="Saisissez votre commentaire" required></textarea>
          <br/>
          <input type="submit" class="bouton" name="Poster"  value="Poster" />
          <?php
          $bd = seConnecterABD();
          if (isset($_POST['Poster'])) {
            $requete = $bd->prepare('INSERT INTO commentaire(comment, idClient, idLogement) VALUES(:comment, :idClient,:idLogement)');
            $requete->execute(array(
              'comment' => (string)$_POST['commentaire'],
              'idClient' => $_SESSION['idClient'],
              'idLogement' => $_POST['idLogement']
            ));
            afficherMessageSucces("Votre logement a bien été enregistré!");
            header("refresh:3; url=pageLogement.php?idLogement=".(string)$_POST['idLogement']); //redirige vers la page du logement apres avoir poster le commentaire

          }
          ?>
        </form>
      </div>
    </div>
  </body>



</HTML>
