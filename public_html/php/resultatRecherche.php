<!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="../css/common.css">
  <link rel="stylesheet" type="text/css" href="../css/recherche.css">
  <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon" >
  <title>FreeToGo</title>
</head>
<body>
  <?php include('include/header.html'); ?>

  <?php
  if(!empty($_POST["lieu"])){
    echo "<p>Ville recherchée : ".$_POST["lieu"]."</p>";
    $nomserveur='localhost'; //nom du seveur
    $nombd='freetogo'; //nom de la base de données
    $login='userfreetogo'; //login de l'utilisateur
    $mdp=''; // mot de passe

    $bd = new PDO('mysql:host='.$nomserveur.';dbname='.$nombd.'', $login);
    $reponse = $bd->query('SELECT * FROM logement where ville="'.$_POST["lieu"].'"');

    $num = 1;
    while ($donnees = $reponse->fetch()) //on affiche toutes les instances de Client
    {
      $reponse2 = $bd->query('SELECT nom FROM hote where idHote='.$_POST["idHote"]);

      echo"<table>
      <tr>
      <th></th>
      <th>Nom du logement</th>
      <th>Localisation</th>
      <th>Prix</th>
      <th>nom du propriétaire</th>
      <th>Voir</th>
      </tr>
      <tr>
      <td>".$num."</td>
      <td>Logement ".$donnees["idLogement"]."</td>
      <td>".$donnees["ville"]."</td>
      <td>Prix €</td>
      <td>Mr/MMe ".$reponse2."</td>
      <td>
      <form>
      </form>
      </td>
      </tr>";
      $num = $num + 1;
    }
    echo "</table>";
  }else{
    echo "<p>La ville n'a pas été écrite...</p>";
  }

  echo "</body></html>"
  ?>
