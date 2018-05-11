<!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="css/common.css" />
  <link rel="stylesheet" type="text/css" href="css/pageLogement.css" />
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
  <title>FreeToGo</title>
</head>
<body>
  <?php include('include/header.html'); require_once('include/fonctions.php'); ?>
  <div class="main">
    <?php
    //ouvrirSession(); // a enlever car cela redirige vers connexion.php si l'utilisateur qui souhaite regarder ce logement n'est pas connecté
    if (isset($_GET["idLogement"])){
      $bd = seConnecterABD();
      $reponse=$bd->query('SELECT * FROM logement WHERE idLogement ="'.$_GET["idLogement"].'";');
      $donnees = $reponse->fetch();

      echo "<div id=\"container\">
      <div id=\"div_logement\" >
      <h2>Logement</h2>
      Type de logement :<br/>";
      //Type
      echo htmlspecialchars($donnees["type"]);
      echo "<br/>Nombre de personnes<br/>";
      //nbPersonnes
      echo htmlspecialchars($donnees["effectif"]);
      echo "<br/>
      Localisation :<br/>";
      //Ville
      echo htmlspecialchars($donnees["ville"]);
      echo "<br/>
      Prix :<br/>";
      //prix en euro
      echo htmlspecialchars($donnees["prix"]);
      echo "<br/>
      Description :<br/>";
      //Description du logement
      echo htmlspecialchars($donnees["description"]);
      $photo=gererPhoto($donnees,'photo',"/images/logement_default.png");
      echo "<img src=".$photo." style=\"float:right;\" class=\"photo\" />
      </div>
      <div id=\"div_commentaire\">
      <h2>Commentaires</h2>
      <div class=\"commentaire\">";
      //Affichage des commentaires associés au logement
        $reponse = $bd->query('SELECT * FROM commentaire where idLogement="'.$_GET["idLogement"].'"');
        $num = 1;
        echo '<table id="tableaux">';
        echo '
        <tr>
        <th></th>
        <th>Nom du client</th>
        <th>Commentaire</th>
        </tr>';
        while ($donnees1 = $reponse->fetch()) //tant qu'il y a des lignes de commentaires pour ce logment
        {
          $reponse2 = $bd->query('SELECT * FROM client where idClient="'.(string)$donnees1['idClient'].'"');
          $donnees = $reponse2->fetch();
          echo '
          <tr>
          <td>'.$num.'</td>
          <td> '.$donnees["nom"].' </td>
          <td> '.$donnees1["comment"].'</td>
          </tr>';
          $num = $num + 1;
        }
        echo "</table>";

      echo "</div>
      </div>
      </div>
      <div>
      <h2>Fonctionnalités</h2>
      <ul>";
      $wifi = "unchecked";
      $sdb = "unchecked";
      $cuisine = "unchecked";
      if ($donnees["wifi"]){
        $wifi = "checked";
      }
      if ($donnees["salledebain"]){
        $sdb = "checked";
      }
      if ($donnees["cuisine"]){
        $cuisine = "checked";
      }
      echo "
      <li class=\"".$sdb."\">Salle de bain</li>
      <li class=\"".$wifi."\">Wifi</li>
      <li class=\"".$cuisine."\">Cuisine</li>
      </ul>
      </div>
      <h2>Profil Propriétaire</h2>
      <div style=\"display:flex;\">";
      $idProprietaire = $donnees["idClient"];
      $reponse2=$bd->query('SELECT * FROM client WHERE idClient ="'.$idProprietaire.'";');
      $donneesProprietaire = $reponse2->fetch();
      echo "Nom :<br/>";
      //nom utilisateur
      echo $donneesProprietaire["nom"]." ".$donneesProprietaire["prenom"];
      echo "<br/>
      Age :<br/>";
      //Age utilisateur
      if (!empty($donneesProprietaire["age"])){
        echo $donneesProprietaire["age"];
      }else{
        echo "inconnu";
      }
      echo "<br/>
      Résidence Principale :<br/>";
      //Ville
      if (!empty($donneesProprietaire["ville"])){
        echo $donneesProprietaire["ville"];
      }else{
        echo "inconnue";
      }
      echo "<br/>
      Description :<br/>";
      //Description du propriétaire
      if (!empty($donneesProprietaire["description"])){
        echo $donneesProprietaire["description"];
      }
      echo "<img src=\"images/profil_default.png\" style=\"float:right;margin-left:15%;\"/>
      </div>";
      echo "
      <h2>demande de reservation</h2>
       </div>";
       echo '
       <div class= "main" >
       <form  method="post">
       <tr>
          <th> Date arrivee</th>
          <th> <input type="date" name="ddebut" placeholder="Début reservation" required /> </th>
          <br/>
          <br/>
          <br/>
            <th> Date depart </th>
        <th> <input type="date" name="dfin" placeholder="Fin reservation" required> </th>
        <br/>
        <br/>
        <input type= "hidden" name= "idLogement1" value= "'.$_GET["idLogement"].'" />
        <input type="submit" class= "bouton" name= "Reservation" value="Reserver ce logement"></p>

     </div>
     ';
       if (isset($_POST['Reservation'])) {
         session_start();
         reserver();
       }

    }else{
      echo "<p> Pas de logement demandé...</p>";
    }
    ?>
  </div>
</body>
</html>
