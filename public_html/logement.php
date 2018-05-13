<!doctype html>
<?php
  session_start();
 ?>
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
  <div class="main">

    <?php
    if (isset($_GET['reservationEffectuee'])){
      afficherMessageSucces("reservation effectuée.");
      //echo '<script>alert("Hey");</script>';
    }
    if (isset($_GET['reservationEchouee'])){
      if ($_GET['reservationEchouee']==2){
        afficherMessageErreur('Appartement déja reservé en ces dates');
      }else if ($_GET['reservationEchouee']==3){
        afficherMessageErreur('erreur4');
      }else if ($_GET['reservationEchouee']==4){
        afficherMessageErreur('erreur1');
      }else if ($_GET['reservationEchouee']==5){
        afficherMessageErreur('Les dates de réservation ne sont pas cohérentes: la date d\'arrivée doit être préalable à la date de départ. Veuillez réffectuer la réservation.');
      }else if ($_GET['reservationEchouee']==6){
        afficherMessageErreur('La date de fin de sejour est non valide, veuillez recommencer la réservation.');
      }else if ($_GET['reservationEchouee']==7){
        afficherMessageErreur('erreur2');
      }else if ($_GET['reservationEchouee']==7){
        afficherMessageErreur( 'La date de début de sejour est non valide, veuillez recommencer la réservation.');
      }else if ($_GET['reservationEchouee']==8){
        afficherMessageErreur( 'erreur 3');
      }
    }
    ?>


    <?php
    //ouvrirSession(); // a enlever car cela redirige vers connexion.php si l'utilisateur qui souhaite regarder ce logement n'est pas connecté
    if (isset($_GET["idLogement"])){
      $bd = seConnecterABD();
      $reponse=$bd->query('SELECT * FROM logement WHERE idLogement ="'.$_GET["idLogement"].'";');
      $donnees = $reponse->fetch();
    }
    $photo=gererPhoto($donnees,'photo',"/images/logement_default.png");
    ?>

    <div id="container">
      <table style="width : 100%;">
        <tr>
          <td>
            <div id="div_logement" >
              <h2>Logement</h2>
              <?php
              echo '<img src="'.$photo.'" style="float:right;" class="photo" alt="photo du logement"/>';
              ?>

              <div class="attribut">
                <label>Description</label> :<br/>
                <span class="champLogement">
                  <?php
                  echo htmlspecialchars($donnees["description"]);
                  ?>

                </span>
              </div>

              <div class="attribut">
                <label>Type de logement :</label>
                <span class="champLogement">
                <?php
                echo htmlspecialchars($donnees["type"]);
                ?>
              </span>
              </div>

              <div class="attribut"><label>Nombre de personnes :</label>
                <span class="champLogement">
                  <?php
                  echo htmlspecialchars($donnees["effectif"]);
                  ?>

                </span>
              </div>

              <div class="attribut">
                <label>Localisation</label> : <br/>
                <span class="champLogement">
                  <?php
                  echo htmlspecialchars($donnees["ville"]);
                  ?>
                </span>
              </div>

              <div class="attribut">
                <label>Prix</label> :
                <span class="champLogement">
                  <?php
                  echo htmlspecialchars($donnees["prix"]).'€';
                  ?>
                </span>
              </div>

            </div> <!-- Fin de la div_logement -->
          </td>
          <td>
            <h2>Fonctionnalités</h2>
            <ul id="liste_fonctionnalites">
              <?php
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
              echo '
              <li class="'.$sdb.'">Salle de bain</li>
              <li class="'.$wifi.'">Wifi</li>
              <li class="'.$cuisine.'">Cuisine</li>';
              ?>
            </ul>
          </div>
          <div id="div_commentaire">
            <h2>Commentaires</h2>
            <div class="commentaire">
              <table id="tableaux">
                <tr>
                  <th></th>
                  <th>Nom du client</th>
                  <th>Commentaire</th>
                </tr>
                <?php
                $reponse = $bd->query('SELECT * FROM commentaire where idLogement="'.$_GET["idLogement"].'"');
                $num = 1;
                while ($donnees1 = $reponse->fetch()) //tant qu'il y a des lignes de commentaires pour ce logment
                {
                  $reponse2 = $bd->query('SELECT * FROM client where idClient="'.(string)$donnees1['idClient'].'"');
                  $donnees = $reponse2->fetch();
                  echo '
                  <tr>
                  <td>'.$num.'</td>
                  <td> '.$donnees["nom"].'</td>
                  <td> '.$donnees1["comment"].'</td>
                  </tr>';
                  $num = $num + 1;
                }
                ?>
              </table>
            </div> <!-- Fin de la div commentaire -->
          </div> <!-- Fin de la div_commentaire -->
        </td>
      </tr>
    </table> <!-- Fin du tabeau permettant de séparer en deux colonnes la partie logement et la partie commentaires -->
  </div> <!-- Fin de la div container -->
  <div id="fonctionnalites">

    <h2>Profil Propriétaire</h2>
    <div id="description_proprietaire" style="display:flex;">
      <?php
      $idProprietaire = $donnees["idClient"];
      $reponse2=$bd->query('SELECT * FROM client WHERE idClient ="'.$idProprietaire.'";');
      $donneesProprietaire = $reponse2->fetch();
      ?>

      <div class="attribut">
        <label>Nom : </label>
        <span class="champLogement">
          <?php
          echo $donneesProprietaire["nom"]." ".$donneesProprietaire["prenom"];
          ?>
        </span>
      </div>

      <div class="attribut">
        <label>Age : </label>
        <span class="champLogement">
          <?php
          if (!empty($donneesProprietaire["age"])){
            echo $donneesProprietaire["age"];
          }else{
            echo "inconnu";
          }
          ?>
        </span>
      </div>

      <div class="attribut">
        <label>Résidence Principale : </label>
        <span class="champLogement">
          <?php
          if (!empty($donneesProprietaire["ville"])){
            echo $donneesProprietaire["ville"];
          }else{
            echo "inconnue";
          }
          ?>
        </span>
      </div>

      <div class="attribut">
        <label>Description :</label>
        <span class="champLogement">
          <?php
          if (!empty($donneesProprietaire["description"])){
            echo $donneesProprietaire["description"];
          }
          ?>
        </span>
      </div>
      <!-- Il faudrait afficher l'image du propriétaire -->
      <img src=<?php echo $donneesProprietaire["photoProfil"] ?> style="float:right;margin-left:15%;" class="photo" alt="photo de profil du proprietaire"/>

    </div> <!-- Fin de la div description_proprietaire -->
      <!-- A faire -->
    </div>


  <div class="ligne">
    <div class="colonne">
      <h2>demande de reservation</h2>
      <div class= "main" >
        <form method="post">
          <div style="margin-bottom:5%;">
            <label> Date arrivee</label>
            <input type="date" name="ddebut" required />
          </div>
          <div style="margin-bottom:3%;">
            <label> Date depart </label>
            <input type="date" name="dfin" required>
          </div>
          <?php
          echo '<input type= "hidden" name= "idLogement1" value= "'.$_GET["idLogement"].'" />';
          ?>
          <input type="submit" class= "bouton" name= "Reservation" value="Reserver ce logement" />
        </form>
      </div>
    </div>
    <div class="colonne" >
      <h2> Logement indisponible aux dates suivantes: </h2>
     <?php
     if (isset($_GET["idLogement"])){
       $bd = seConnecterABD();
       $r=$bd->query('SELECT datedebut, datefin FROM reserver WHERE idLogement ="'.$_GET["idLogement"].'";');

       echo '<table id="tableaux">';
         echo '
         <tr>
         <th> Date de début de reservation</th>
          <th> Date de fin de reservation</th>
         </tr>';

          while($d=$r->fetch()){

         echo '
         <tr>
         <td> '.$d['datedebut'].' </td>
         <td> '.$d['datefin'].' </td>
         </tr>' ;
         }
     }
     ?>
    </div>
  </div>
    <?php
    if (isset($_POST['Reservation'])) {
      if(isset($_SESSION['idClient'])){
      $res = reserver();
      if ($res == 1){
        $url = "./logement.php?idLogement=".$_GET['idLogement']."\&reservationEffectuee";
        $str = "Location: ".$url;
        echo '<script>window.location.replace("'.$url.'");</script>';
      }else{
        $url = "./logement.php?idLogement=".$_GET['idLogement']."\&reservationEchouee=".$res;
        $str = "Location: ".$url;
        echo '<script>window.location.replace("'.$url.'");</script>';
      }
    }else{
      echo '<script>window.location.replace("./connexion.php?reserver");</script>';
    }
  }
    ?>
  </div>
</body>
</html>
