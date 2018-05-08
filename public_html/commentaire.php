<?php require("connexion.inc.php"); ouvrirSession();?>
<HTML>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="css/common.css" />
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <title> Connexion </title>
  </head>
  <body>
    <?php include('include/header.html');  ?>
    <div class="main">
      <br/>
     <div class="login-cadre">
    <form action=profil.php method=post enctype="multipart/form-data">
         <h2>   <center>Votre commentaire </h2> </center>
        <br/>
        <label>Commentaire : </label>
        <br/>
        <textarea name="commentaire" value= "commentaire" id="commentaire" rows="10" placeholder="Saisissez votre commentaire" required></textarea>
        <br/>
        <input type="submit" class="bouton" name="Poster"  value= "Poster" />
    </form>
</div>

  </body>

  <?php
    $bd = seConnecterABD();
    if (isset($_POST['Poster'])) {
      $requete = $bd->prepare('INSERT INTO commentaire(comment, idClient, idLogement) VALUES(:comment, :idClient,:idLogement)');
      $requete->execute(array(
        'comment' => (string)$_POST['commentaire'],
        'idClient' => $_SESSION['idClient'],
        'idLogement' => $_GET['idLogement']
    ));
  }
  ?>


</HTML>
