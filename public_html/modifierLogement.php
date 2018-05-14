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
    if (isset($_GET["idLogement"])){
      // si on ne modifie pas le logement
        $bd = seConnecterABD();
        $reponse=$bd->query('SELECT * FROM logement WHERE idLogement ="'.$_GET["idLogement"].'";');
        $donnees = $reponse->fetch();
    }elseif(isset($_POST["idLogement"])){
      $bd = seConnecterABD();
      $reponse=$bd->query('SELECT * FROM logement WHERE idLogement ="'.$_POST["idLogement"].'";');
      $donnees = $reponse->fetch();
    }else{
      die();
    }
    if (isset($_POST['enregistrer'])){
      $prix = calculChamps("prix", $donnees);
      $type = calculChamps("type", $donnees);
      $nomLogement = calculChamps("nomLogement", $donnees);
      $effectif = calculChamps("effectif", $donnees);
      $adresse = calculChamps("adresse", $donnees);
      $description = calculChamps("description", $donnees);
      $ville = calculChamps("ville", $donnees);
      $pays = calculChamps("pays", $donnees);
      $wifi = calculChamps("wifi", $donnees);
      $cuisine = calculChamps("cuisine", $donnees);
      $salledebain = calculChamps("salledebain", $donnees);

      $name = "";
      $dossier = './images';

      if(file_exists($_FILES['photo']['tmp_name']) || is_uploaded_file($_FILES['photo']['tmp_name'])) {
        // supprimer l'image précédente
        if (file_exists($donnees['photo'])){
          unlink($donnees['photo']);
        }
        //copier l'image chargée dans le dossier image
        $dossier = './images/logements';
        $tmp_name = $_FILES['photo']["tmp_name"];
        $name = "photo_".$_POST['idLogement'].".".pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        move_uploaded_file($tmp_name, "$dossier/$name");
        if($name==""){
          $name="logement_default.png";
          $photo="$dossier/$name";
        }
        $photo="$dossier/$name";
      }elseif($donnees["photo"]!=NULL){
        $photo=$donnees["photo"];
      }

      echo '<script>alert("prix=-'.$prix.'-");</script>';
      echo '<script>alert("type=-'.$type.'-");</script>';
      echo '<script>alert("nomLogement=-'.$nomLogement.'-");</script>';
      echo '<script>alert("adresse=-'.$adresse.'-");</script>';
      echo '<script>alert("effectif=-'.$effectif.'-");</script>';
      echo '<script>alert("photo=-'.$photo.'-");</script>';
      echo '<script>alert("description=-'.$description.'-");</script>';
      echo '<script>alert("ville=-'.$ville.'-");</script>';
      echo '<script>alert("pays=-'.$pays.'-");</script>';
      echo '<script>alert("wifi=-'.$wifi.'-");</script>';
      echo '<script>alert("cuisine=-'.$cuisine.'-");</script>';
      echo '<script>alert("salledebain=-'.$salledebain.'-");</script>';
      echo '<script>alert("idLogement=-'.$_POST['idLogement'].'-");</script>';

      $requete = $bd->prepare('UPDATE logement SET prix = :prix, type = :type, nomLogement = :nomLogement, adresse = :adresse, effectif = :effectif, photo =:photo, description = :description, ville = :ville, pays = :pays, wifi = :wifi, cuisine = :cuisine, salledebain = :salledebain WHERE idLogement = :idLogement');
      $requete->execute(array(
        'prix' => $prix,
        'type' => $type,
        'nomLogement' => $nomLogement,
        'adresse' => $adresse,
        'effectif' => $effectif,
        'photo' =>  $photo,
        'description' => $description,
        'ville' => $ville,
        'pays' => $pays,
        'wifi' => $wifi,
        'salledebain' => $salledebain,
        'cuisine' => $cuisine,
        'idLogement' => $_POST['idLogement']
      ));
      //echo '<script>window.location.replace("./logement.php?idLogement='.$_POST['idLogement'].'&succes");</script>';
      //die();
    }

    $photo=gererPhoto($donnees,'photo',"/images/logement_default.png");

    if (isset($_GET['logementEnregistre'])){
      afficherMessageSucces("Votre logement a bien été enregistré!");
    }
    ?>
    <div id="container">
      <div class="ligne">
        <div class="colonne" >
          <div id="div_logement" >
            <form method="post" enctype="multipart/form-data">
              <?php
              echo '  <h2>Logement '.$donnees["nomLogement"].'</h2>';
              echo '<input type="file" name="photo" id="photo" />';
              echo '<img src="'.$photo.'" style="float:right;" class="photo" alt="photo du logement"/>';
              ?>

              <div class="attribut">
                <label>Description</label> :<br/>
                <textarea ><?php echo htmlspecialchars($donnees["description"]);?></textarea>
              </div>

              <div class="attribut">
                <label>Nom du logement :</label>
                <input type="text" name="nomLogement" class="champLogement" value="<?php echo htmlspecialchars($donnees["nomLogement"]);?>" />
              </div>

              <div class="attribut">
                <label>Type de logement :</label>
                <input type="text" name="type" class="champLogement" value="<?php echo htmlspecialchars($donnees["type"]);?>" />
              </div>

              <div class="attribut"><label>Nombre de personnes :</label>
                <input type="text" name="effectif" class="champLogement" value="<?php echo htmlspecialchars($donnees["effectif"]);?>" />
              </div>

              <div class="attribut">
                <label>Localisation</label> : <br/>
                <input type="text" name="ville" class="champLogement" value="<?php echo htmlspecialchars($donnees["ville"]);?>" />
              </div>

              <div class="attribut">
                <label>Prix</label> :
                <input type="text" name="prix" class="champLogement" value="<?php echo htmlspecialchars($donnees["prix"]);?>" />
              </div>
              <input type="hidden" name="idLogement" value="<?php echo $_GET['idLogement'];?>" />
              <input type="hidden" name="wifi" value="<?php echo $donnees['wifi'];?>" />
              <input type="hidden" name="salledebain" value="<?php echo $donnees['salledebain'];?>" />
              <input type="hidden" name="cuisine" value="<?php echo $donnees['cuisine'];?>" />
              <input type="submit" name="enregistrer" class="bouton" value="enregistrer" />

            </form>
          </div> <!-- Fin de la div_logement -->
        </div>
        <div class="colonne">
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
            <input type="checkbox" '.$sdb.'/>Salle de bain
            <br/>
            <input type="checkbox" '.$wifi.'/>Wifi
            <br/>
            <input type="checkbox" '.$cuisine.'/>Cuisine';
            ?>
          </ul>
        </div>
        <div class="colonne">
          <div id="div_commentaire">
            <h2>Commentaires</h2>
            <div class="commentaire">
              <table class="tableaux">
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
                  $donnees2 = $reponse2->fetch();
                  echo '
                  <tr>
                  <td>'.$num.'</td>
                  <td> '.$donnees2["nom"].'</td>
                  <td> '.$donnees1["comment"].'</td>
                  </tr>';
                  $num = $num + 1;
                }
                ?>
              </table>
            </div> <!-- Fin de la div commentaire -->
            <?php
            echo '<button style="margin-left:75%;" onclick="location.href=\'commentaire.php?idLogement='.$_GET["idLogement"].'\'" type="button" class="bouton">Commenter</button>';
            ?>
          </div> <!-- Fin de la div_commentaire -->
        </div>
      </div>
    </div>

    <div class="ligne">
      <div class="colonne" >
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
              if (!empty($donneesProprietaire["adresse"])){
                echo $donneesProprietaire["adresse"];
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
        </div> <!-- Fin de la div description_proprietaire -->
      </div>
      <div class="colonne" style="margin-top:30px">
        <img src="<?php echo gererPhoto($donneesProprietaire, "photoProfil", "./images/profil_default.png"); ?>" style="float:right;margin-left:15%;" class="photo_profil" alt="photo de profil du proprietaire"/>
      </div>
    </div> <!-- Fin de la div ligne -->

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
              <input type="date" name="dfin" required />
            </div>
            <?php
            echo '<input type= "hidden" name= "idLogement1" value= "'.$_GET["idLogement"].'" />';
            ?>
            <input type="submit" class= "bouton" name= "Reservation" value="Reserver ce logement" />
          </form>
        </div>
      </div>
      <div class="colonne">
        <h2> Logement indisponible aux dates suivantes: </h2>
        <?php
        if (isset($_GET["idLogement"])){
          $bd = seConnecterABD();
          $r=$bd->query('SELECT datedebut, datefin FROM reserver WHERE idLogement ="'.$_GET["idLogement"].'";');

          echo '<table class="tableaux">';
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
          echo '</table>';
        }
        ?>
      </div>
    </div> <!-- Fin de la div ligne -->
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
  </div> <!-- Fin de la div main -->
</body>
</html>
