<!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="css/common.css">
  <link rel="stylesheet" type="text/css" href="css/pageLogement.css">
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" >
  <title>FreeToGo</title>
</head>
<body>
  <?php include('include/header.html'); require_once('include/fonctions.php'); ?>
  <div class="main">
  <?php
  ouvrirSession();
    if (isset($_GET["idLogement"])){
      $bd = seConnecterABD();
      $reponse=$bd->query('SELECT * FROM logement WHERE idLogement ="'.$_GET["idLogement"].'";');
      $donnees = $reponse->fetch();
      echo "<p>Logement demandé : ".$_GET["idLogement"]."</p>";

      echo "<div id=\"container\">
    <div id=\"div_logement\" >
      <h2>Logement</h2>
      Type de logement :<br/>";
      //Type
      echo "<br/>Nombre de personnes<br/>";
      //nbPersonnes
      echo "<br/>
      Localisation :<br/>";
      //Ville
      echo "<br/>
      Prix :<br/>";
      //prix en euro
      echo "<br/>
      Description :<br/>";
      //Description du logement
      $photo=gererPhoto($donnees,'photo',"/images/logement_default.png");
      echo "<img src=".$photo." style=\"float:right;\" class=\"photo\" />
    </div>
    <div id=\"div_commentaire\">
      <h2>Commentaires</h2>
      <div class=\"commentaire\">";
        //Nom utilisateur 1:
        //<p>Blabla</p>
    echo "</div>
    </div>
  </div>
  <div>
    <h2>Fonctionnalités</h2>
    <ul>";
    $sdb = "checked";
    $wifi = "unchecked";
    $cuisine = "checked";
    echo "
      <li class=\"".$sdb."\">Salle de bain</li>
      <li class=\"".$wifi."\">Wifi</li>
      <li class=\"".$cuisine."\">Cuisine</li>
    </ul>
  </div>
  <h2>Profil Propriétaire</h2>
  <div style=\"display:flex;\">
    Nom :<br/>";
    //nom utilisateur
    echo "<br/>
    Age :<br/>";
    //Age utilisateur
    echo "<br/>
    Résidence Principale :<br/>";
    //Ville
    echo "<br/>
    Description :<br/>";
    //Description du propriétaire
    echo "<img src=\"images/profil_default.png\" style=\"float:right;margin-left:15%;\"/>
  </div>";
}else{
  echo "<p> Pas de logement demandé...</p>";
}
?>
</div>
</body>
</html>
