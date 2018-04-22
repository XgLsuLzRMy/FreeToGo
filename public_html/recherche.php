<!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="css/common.css">
  <link rel="stylesheet" type="text/css" href="css/recherche.css">
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" >
  <title>FreeToGo</title>
</head>
<body>
  <?php include('include/header.html'); ?>

  <div id="container">
    <div id="recherche">
      <h2>Recherche de logements</h2>
      <form action="">
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
        <input type="submit" name="rechercher" class="boutton" value="Rechercher" />
      </form>
    </div>
    <div id="profil">
      <!-- Code a remplacer par du php -->
      <h2>Nom Prenom</h2>
      <img id="imageProfil" src="images/profil_default.png" alt="image de profil" />
      <!-- Le boutton inscription ne devrait apparaitre que si l'utilisateur n'est pas connecté avec du php -->
      <form action="inscription.php">
        <input type="submit" value="inscription" class="boutton"/>
      </form>
      <form action="profil.php">
        <input type="submit" value="Voir Profil" class="boutton"/>
      </form>
      <!-- Le boutton déconnection ne devrait apparaitre que si l'utilisateur est connecté avec du php -->
      <form action="deconnexion.php">
        <input type="submit" value="Déconnexion" class="boutton"/>
      </form>
    </div>
  </div>
  <h2>Affichage des logements</h2>
  <table>
    <tr>
      <th></th>
      <th>Nom du logement</th>
      <th>Localisation</th>
      <th>Prix</th>
      <th>nom du propriétaire</th>
      <th>Voir</th>
    </tr>
    <!-- La partie ci dessous sera génrée par du php -->
    <tr>
      <td>1</td>
      <td>Logement 1</td>
      <td>Localisation 1</td>
      <td>Prix 1€</td>
      <td>Mr/MMe 1</td>
      <td>
        <form action="pageLogement1.html"><input type="submit" value="voir" />
        </form>
      </td>
    </tr>
    <tr>
      <td>2</td>
      <td>Logement 2</td>
      <td>Localisation 2</td>
      <td>Prix 2€</td>
      <td>Mr/MMe 2</td>
      <td>
        <form action="pageLogement2.html"><input type="submit" value="voir" />
        </form>
      </td>
    </tr>
    <!-- Fin partie générée par php -->
  </table>
</body>
</html>