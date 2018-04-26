<!doctype html>
<?php require("connexion.inc.php") ?>
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="css/common.css">
  <link rel="stylesheet" type="text/css" href="css/recherche.css">
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" >
  <title>FreeToGo</title>
</head>
<body>
  <?php include('include/header.html'); ?>
  <?php
    if (isset($_SESSION["idClient"])){
      echo "<p>".$_SESSION["idClient"]."</p>";
    }else{
      echo "<p>pas de session</p>";
    }
   ?>
  <div id="container">
    <div id="recherche">
      <h2>Recherche de logements</h2>
      <form action="recherche.php" method="post">
        <div id="col_gauche">
          <label>Lieu</label>
          <input type="text" name="lieu" placeholder="Ville où se situe le logement"/>
          <br/>
          <label>Date d'arrivée</label>
          <input type="text" name="DateDebut" placeholder="Début de la location"/>
          <br/>
          <label>Prix min (1 nuit)</label>
          <input type="text" name="prixMin" placeholder="Prix min" />
        </div>
        <div id="col_droite">
          <label>Nombre de personnes</label>
          <input type="text" name="nbPersonnes" placeholder="Nombre de personnes"/>
          <br/>
          <label>Date de départ</label>
          <input type="text" name="DateFin" placeholder="Fin de la location"/>
          <br/>
          <label>Prix max</label>
          <input type="text" name="prixMax" placeholder="Prix max"/>
        </div>
        <input type="submit" name="rechercher" class="bouton" value="Rechercher" />
      </form>
    </div>
    <div id="profil">
      <!-- Code a remplacer par du php -->
      <h2>Nom Prenom</h2>
      <img id="imageProfil" src="images/profil_default.png" alt="image de profil" />
      <!-- Le boutton inscription ne devrait apparaitre que si l'utilisateur n'est pas connecté avec du php -->
      <form action="connexion.php">
        <input type="submit" value="Inscription" class="bouton"/>
      </form>
      <form action="profil.php">
        <input type="submit" value="Voir Profil" class="bouton"/>
      </form>
      <!-- Le boutton déconnection ne devrait apparaitre que si l'utilisateur est connecté avec du php -->
      <form action="connexion.inc.php" method="post">
        <input type="submit" name="deconnexion" value="Déconnexion" class="bouton"/>
      </form>
    </div>
  </div>
  <h2>Affichage des logements</h2>
  <?php
  if (isset($_POST["rechercher"])){
    if(!empty($_POST["lieu"])){
      echo "<p>Ville recherchée : ".$_POST["lieu"]."</p>";
      $nomserveur='localhost'; //nom du seveur
      $nombd='freetogo'; //nom de la base de données
      $login='userfreetogo'; //login de l'utilisateur
      $mdp=''; // mot de passe

      $bd = new PDO('mysql:host='.$nomserveur.';dbname='.$nombd.'', $login);
      $reponse = $bd->query('SELECT * FROM logement where ville="'.(string)$_POST["lieu"].'"');

      $num = 1;
      echo"<table>";
      while ($donnees = $reponse->fetch()) //on affiche toutes les instances de Client
      {

        $reponse2 = $bd->query('SELECT * FROM client where idClient="'.(string)$donnees["idClient"].'"');
        $nom = $reponse2->fetch();
        $nom = $nom["nom"];
        echo "
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
        <td>Mr/MMe ".(string)$nom."</td>
        <td>

        <button onclick=\"location.href='pageLogement.php?idLogement=".(string)$donnees["idLogement"]."'\" type=\"button\">VOIR</button>

        </td>
        </tr>";
        $num = $num + 1;
      }
      echo "</table>";
    }else{
      echo "<p>La ville n'a pas été écrite...</p>";
    }
  }
  ?>
</body>
</html>
