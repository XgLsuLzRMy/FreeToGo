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
  <?php include('include/header.html'); ?>

  <div id="container">
    <div id="div_logement" >
      <h2>Logement</h2>
      Type de logement :<br/>
      Type
      <br/>
      Nombre de personnes :<br/>
      x nbPersonnes
      <br/>
      Localisation :<br/>
      Ville
      <br/>
      Prix :<br/>
      prix en euro
      <br/>
      Description :<br/>
      Description du logement
      <img src="images/logement_default.png" style="float:right;" />
    </div>
    <div id="div_commentaire">
      <h2>Commentaires</h2>
      <div class="commentaire">
        Nom utilisateur 1:
        <p>Blabla</p>
      </div>
      <div class="commentaire">
        Nom utilisateur 2:
        <p>Blabla</p>
      </div>
    </div>
  </div>
  <div>
    <h2>Fonctionnalités</h2>
    <ul>
      <li class="checked">Salle de bain</li>
      <li class="unchecked">Wifi</li>
      <li class="checked">Cuisine</li>
    </ul>
  </div>
  <h2>Profil Propriétaire</h2>
  <div style="display:flex;">
    Nom :<br/>
    nom utilisateur
    <br/>
    Age :<br/>
    Age utilisateur
    <br/>
    Résidence Principale :<br/>
    Ville
    <br/>
    Description :<br/>
    Description du propriétaire
    <img src="images/profil_default.png" style="float:right;margin-left:15%;"/>
  </div>

</body>
</html>
