<!doctype html>
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="css/common.css" />
  <link rel="stylesheet" type="text/css" href="css/pageLogement.css" />
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
  <title>FreeToGo</title>
</head>
<body>
  <?php include('include/header.html'); require_once('include/fonctions.php'); ?>
    <?php
    //ouvrirSession(); // a enlever car cela redirige vers connexion.php si l'utilisateur qui souhaite regarder ce logement n'est pas connecté
    if (!isset($_GET["idLogement"]) || empty($_GET["idLogement"])){
      header("location: ./index.php");
    }else{
      $bd = seConnecterABD();
      $reponse=$bd->query('SELECT * FROM logement WHERE idLogement ="'.$_GET["idLogement"].'";');
      $donnees = $reponse->fetch();
      if (empty($donnees)){
        echo '<div style="margin-top:10%;"><h1>Logement inexistant</h1></div>';
        header("refresh:3; url=./index.php" );
      }else{
        $lien = 'logement.php?idLogement='.$_GET['idLogement'];
        header("location: ".$lien);
      }
    }
    ?>
</body>
</html>
