<!doctype html>
<?php require("connexion.inc.php");  ?>
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="css/common.css" />
  <link rel="stylesheet" type="text/css" href="css/recherche.css" />
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
  <title>FreeToGo</title>
</head>
<body>
  <?php include('include/header.html');  require_once('include/fonctions.php'); ?>
  <div class="main">
    <div id="container">
      <div id="recherche">
        <h2>Recherche de logements</h2>
        <form action="recherche.php" method="get">
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
        <?php
        $bd = seConnecterABD();
        if (isset($_SESSION["idClient"])){
          $reponse=$bd->query('SELECT * FROM client WHERE idClient ="'.$_SESSION["idClient"].'";');
          $donnees = $reponse->fetch();
          afficherNom($donnees);
          echo '
          <form action="profil.php">
          <input type="submit" value="Voir Profil" class="bouton"/>
          </form>
          <form action="connexion.inc.php" method="post">
          <input type="submit" name="deconnexion" value="Déconnexion" class="bouton"/>
          </form>';
        }else{
          $donnees['nom'] = "Connectez-vous";
          $donnees['prenom'] = "";
          $donnees['photoProfil']="images/profil_default.png";
          afficherNom($donnees);
          echo '
          <form action="connexion.php">
          <input type="submit" value="Connexion/Inscription" class="bouton"/>
          </form>';
        }
        ?>
      </div>
    </div> <!-- Fin de la div container -->

    <h2>Affichage des logements</h2>
    <?php
    $bd = seConnecterABD();

    if (isset($_GET["rechercher"])){
      $tableauRequetes = array();
      if(!empty($_GET["lieu"])){
        array_push($tableauRequetes, 'ville LIKE "%'.$_GET["lieu"].'%" ');
        // les % fonctionnent comme les * d'habitude
        // Cette requete permet de reconnaitre le mot "Ville" en ayant écrit "ill", "Vil" ou "lle" mais pas "Villes" ou "LaVille" par exemple
      }
      if(!empty($_GET["prixMin"])){
        array_push($tableauRequetes, 'prix>'.$_GET["prixMin"].' ');
      }
      if(!empty($_GET["prixMax"])){
        array_push($tableauRequetes, 'prix<'.$_GET["prixMax"].' ');
      }
      if(!empty($_GET["nbPersonnes"])){
        array_push($tableauRequetes, 'effectif>='.$_GET["nbPersonnes"].' ');
      }
    }
    if(!empty($tableauRequetes)){
      $nombreAnd = count($tableauRequetes) -1;
      $requete = $tableauRequetes[0];
    }else{
      $nombreAnd = 0;
      $requete = "";
    }
    if($nombreAnd>0){
      for ($i = 0; $i <= $nombreAnd; $i++) {
        $requete = $requete." AND ".$tableauRequetes[$i];
      }
    }
    $requete = 'SELECT * FROM logement where '.$requete;
    $reponse = $bd->query($requete);
    afficherTableLogement($reponse, $bd);
    ?>
  </div> <!-- Fin de la div main -->
</body>
</html>
