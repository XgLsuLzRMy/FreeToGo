<!doctype html>
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="css/common.css" />
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
  <title>FreeToGo</title>
</head>

<body>
  <?php include('include/header.html'); require_once('include/fonctions.php');  ?>
  <div class="main">
    <!--la partie pour décrire les informations du logement -->
    <form action=ajoutlogement.php method=post enctype="multipart/form-data">
      <div class="ligne">
        <div class="colonne" >
          <h2> Votre logement </h2>
          <label>Photo du logement : </label>
          <br/>
          <input type="file" accept="image/jpeg" name="photoLogement" id="photo" />
          <br/>
          <br/>
          <label> Nom du logement : </label>
          <input type="text" name="nomLogement" id="nom" placeholder="saisissez le nom du logement" required />
          <br/>
          <label> Type de logement : </label>
          <input type="text" name="typeLogement" id="type" placeholder="saisissez le type du logement" required />
          <br/>
          <label>Nombre de personnes : </label>
          <input type="number" name="nbPersonne" id="nbPersonne" value="1" min="1" max="30" required />
          <br/>

        </div>
        <div class="column" style="margin-top: 50px;">
          <label>Pays : </label>
          <input type="text" name="pays" id="pays" placeholder="saisissez le pays"/>
          <br/>
          <label>Ville : </label>
          <input type="text" name="ville" id="ville" placeholder="saisissez la ville"/>
          <br/>
          <label>Adresse : </label>
          <input type="text" name="adresse" id="adresse" placeholder="saisissez l'adresse"/>
          <br/>
          <label> Prix (pour une nuit) : </label>
          <input type="number" name="prixNuit" id="prixNuit" value="5" min="5" placeholder="saisissez le prix pour une nuit" required />
          <br/>
        </div>
        <div class="column" style="margin-top: 50px;margin-left: 50px;">
          <label>Description : </label>
          <br/>
          <textarea name="description" rows="10" cols="80" placeholder="saisissez la description du logement"></textarea>
        </div>
      </div>

      <h2> Fonctionnalités </h2>
      <p>
        Veuillez indiquer les fonctionnalités du logement :<br />
        <input type="checkbox" name="salledebain"  id="salledebain" /> <label for="salledebain">Salle de bain</label><br/>
        <input type="checkbox" name="wifi" id="wifi" /> <label for="wifi">Wifi</label><br/>
        <input type="checkbox" name="cuisine" value="Cuisine" id="cuisine" /> <label for="cuisine">Cuisine</label><br/>
      </p>
      <input type="submit" class="bouton" name="Enregistrer_Logement" value ="Enregistrer" />
      
      <?php
      session_start();
      $bd = seConnecterABD();
      $reponse=$bd->query('SELECT * FROM client WHERE idClient ="'.$_SESSION['idClient'].'";');
      $donnees = $reponse->fetch();
      $name="";
      $dossier = './images/logements';
      if(!empty($_FILES)){
        //copier l'image chargée dans le dossier image
        $tmp_name = $_FILES['photoLogement']["tmp_name"];
        $name = $_FILES['photoLogement']['name'];
        move_uploaded_file($tmp_name, "$dossier/$name");
      }
      if($name==""){
        $name="logement_default.png";
      }

      if (isset($_POST['Enregistrer_Logement'])) {
        if (isset($_POST['wifi'])) {
          $wifi = 1;
        }else {$wifi = 0;}
        if (isset($_POST['cuisine'])) {
          $cuisine = 1;
        }else {$cuisine = 0;}
        if (isset($_POST['salledebain'])) {
          $salledebain = 1;
        }else {$salledebain = 0;}
        $requete = $bd->prepare('INSERT INTO logement(prix,type,idClient, nomLogement,effectif, adresse, photo, description, ville, pays, wifi, cuisine,salledebain) VALUES(:prix,:type,:idClient,:nomLogement,:effectif,:adresse,:photo,:description,:ville,:pays,:wifi,:cuisine,:salledebain)');
        $requete->execute(array(
          'prix' => $_POST['prixNuit'],
          'type' => $_POST['typeLogement'],
          'idClient' => $donnees['idClient'],
          'nomLogement' => $_POST['nomLogement'],
          'effectif' => $_POST['nbPersonne'],
          'adresse' => $_POST['adresse'],
          'photo' => "$dossier/$name",
          'description' => (string)$_POST['description'],
          'ville' => $_POST['ville'],
          'pays' => $_POST['pays'],
          'wifi' => $wifi,
          'cuisine' => $cuisine,
          'salledebain' => $salledebain
        ));
        //afficherMessageSucces("Votre logement a bien été enregistré!");
        $reponse = $bd->query('SELECT LAST_INSERT_ID();');
        $donnees = $reponse->fetch();
        header("refresh:0; url=logement.php?idLogement=".$donnees["LAST_INSERT_ID()"]."&logementEnregistre");
      }
      ?>
    </form>
  </div>
</body>
</html>
