<!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="css/common.css">
  <title>FreeToGo</title>
</head>
<?php include('include/header.html'); require_once('include/fonctions.php');
ouvrirSession();
if (isset($_SESSION['idClient'])){
  $bd = seConnecterABD();
  $reponse=$bd->query('SELECT * FROM client WHERE idClient ="'.$_SESSION['idClient'].'";');
  $donnees = $reponse->fetch();
}
?>
<body>
  <div class="main">
  <!--la partie pour modifier le profil de l'utilisateur -->
<table>
   <tr>
     <td>
       <form  method=post enctype="multipart/form-data">
        <h2> Votre profil </h2>
        <br/>
        <label>Nom : </label>
        <br/>
        <input type="text" name="nom" id="nom" value="<?php if(isset($donnees)){echo $donnees['nom'];}?>"/ required>
        <br/>
        <label>Prenom : </label>
        <br/>
        <input type="text" name="prenom" id="nom" value="<?php if(isset($donnees)){echo $donnees['prenom'];}?>"/>
        <br/>
        <label>age : </label>
        <br/>
        <input type="number" name="age" id="nom" value="<?php if(isset($donnees)){echo $donnees['age'];}?>"/>
        <br/>
        <label>Adresse : </label>
        <br/>
        <input type="text" name="adresse" id="nom" value="<?php if(isset($donnees)){echo $donnees['adresse'];}?>"/>
        <br/>
        <label>Telephone : </label>
        <br/>
        <input type="text" name="telephone" id="nom" value="<?php if(isset($donnees)){echo $donnees['telephone'];}?>"/>
        <br/>
        <label>Email : </label>
        <br/>
        <input type="text" name="mail" id="nom" value="<?php if(isset($donnees)){echo $donnees['mail'];}?>"/ required>
        <br/>
        <label>Description : </label>
        <br/>
        <textarea name="description" rows="10" cols="80" value="<?php if(isset($donnees)){echo $donnees['description'];}?>"></textarea>
        <br/>
        <input type="submit" class="bouton" name="Enregistrer" value="Enregistrer"/>
    </td>
  <td align="top" >
    <label>Photo de profil : </label>
    <br/>
    <?php
    if(isset($donnees)){
      $data=$donnees;
    }else{
      $data=NULL;
    }
    $photo=gererPhoto($data, 'photoProfil', "/images/profil_default.png");
    echo "<input type=\"file\" name=\"photoProfil\" id=\"photo\"/>";
    echo "<img  class=\"photo\"  src=\"".$photo."\"/>";
    ?>
    <br/>
  </td>
  </tr>
    </table>
    <?php



    if (isset($_POST['Enregistrer'])) {
      $nom = calculChamps("nom",$donnees);
      $prenom = calculChamps("prenom",$donnees);
      $age = calculChamps("age",$donnees);
      $adresse = calculChamps("adresse",$donnees);
      $telephone = calculChamps("telephone",$donnees);
      $mail = calculChamps("mail",$donnees);
      $description = calculChamps("description",$donnees);


      $name="";
      $dossier = './images';
      if(file_exists($_FILES['photoProfil']['tmp_name']) || is_uploaded_file($_FILES['photoProfil']['tmp_name'])) {
        //copier l'image chargée dans le dossier image
        $dossier = './images';
        $tmp_name = $_FILES['photoProfil']["tmp_name"];
        $name = $_FILES['photoProfil']['name'];
        move_uploaded_file($tmp_name, "$dossier/$name");
        if($name==""){
          $name="profil_default.png";
          $photoProfil="$dossier/$name";
        }
        $photoProfil="$dossier/$name";
      }elseif($donnees["photoProfil"]!=NULL){
        $photoProfil=$donnees["photoProfil"];
      }

      //$photoProfil = calculChamps('photoProfil',$donnees);

      $requete = $bd->prepare('UPDATE client SET nom = :nom, prenom = :prenom, age = :age, adresse = :adresse, telephone = :telephone, mail =:mail, description = :description, photoProfil = :photoProfil WHERE idClient = :idClient');
      $requete->execute(array(
        'nom' => $nom,
        'prenom' => $prenom,
        'age' => $age,
        'adresse' => $adresse,
        'telephone' => $telephone,
        'mail' =>  $mail,
        'description' => $description,
        'photoProfil' => $photoProfil,
        'idClient' => $donnees['idClient']
      ));
      header("Refresh:0");
    }

      ?>
    </form>

    <!--la partie pour ajouter un logement a louer sur le site -->

    <section>
      <h2> Vos logements </h2>
      <br/>
      <?php
      if (isset($_SESSION['idClient'])){
      $reponse = $bd->query('SELECT * FROM logement where idClient="'.(string)$_SESSION['idClient'].'"');

      $num = 1;
      echo"<table>";
      while ($donnees = $reponse->fetch()) //tant qu'il y a des lignes de logements
      {
        echo "
        <tr>
        <th></th>
        <th>Nom du logement</th>
        <th>Localisation</th>
        <th>Prix</th>
        <th>Voir</th>
        </tr>
        <tr>
        <td>".$num."</td>
        <td>Logement ".$donnees["nomLogement"]."</td>
        <td>".$donnees["ville"]."</td>
        <td>".$donnees["prix"]."</td>
        <td>
        <button onclick=\"location.href='pageLogement.php?idLogement=".(string)$donnees["idLogement"]."'\" type=\"button\">VOIR</button>
        </td>
        </tr>";
        $num = $num + 1;
      }
      echo "</table>";
    }
      ?>
      <br/>
      <form action="ajoutlogement.php" method="post">
        <input type="submit" class="bouton" name="lienAjoutLogement" value="Ajouter un logement"/>
      </form>
    </section>

    <!-- la partie pour voir les réservations -->

    <section>
      <h2> Vos reservations </h2>
      <?php
      if (isset($_SESSION['idClient'])){
        $reponse = $bd->query('SELECT * FROM reserver where idClient="'.(string)$_SESSION['idClient'].'"');
        $num = 1;
        echo"<table>";
        while ($donnees1 = $reponse->fetch()) //tant qu'il y a des lignes de logements
        {
          $reponse2 = $bd->query('SELECT * FROM logement where idLogement="'.(string)$_donnees['idLogement'].'"');
          $donnees = $reponse2->fetch();
          echo "
          <tr>
          <th></th>
          <th>Nom du logement</th>
          <th>Localisation</th>
          <th>Prix</th>
          <th>nom du propriétaire</th>
          <th>Voir</th>
          <th>Commenter</th>
          </tr>
          <tr>
          <td>".$num."</td>
          <td>Logement ".$donnees["nomLogement"]."</td>
          <td>".$donnees["ville"]."</td>
          <td>".$donnees["prix"]."</td>
          <td>Mr/MMe ".$donnees["nom"]."</td>
          <td>
          <button onclick=\"location.href='pageLogement.php?idLogement=".(string)$donnees["idLogement"]."'\" type=\"button\">VOIR</button>
          </td>
          <td>
          <form action=\"profil.php\" method=\"post\">
          <input type= \"button\" class=\"bouton\" name=\"commenter\" value=\"ajouter un commentaire\"/>
          </td> <input type=\"text\" name=\"cache\" style=\"visible:off\" value=\"".$donnees['idLogement']."\"/>
          </form>

          </tr>";
          $num = $num + 1;
        }
        echo "</table>";
      }
      ?>

      <?php
      // faire un commentaire :

      if (isset($_POST['commenter'])) {
        $reponse=$bd->query('SELECT * FROM logement WHERE idLogement ="'.$_SESSION['cache'].'";');
        $donnees = $reponse->fetch();

        echo "  <label>Commenter le logement ".$donnes['nomLogement'] ." : </label>
        <br/>
        <textarea name=\"description\" rows=\"10\" cols=\"80\" placeholder=\"Ecrire un commentaire\"></textarea>
        <br/>
        <form action=\"profil.php\" method=\"post\">
        <input type=\"submit\" class=\"bouton\" name=\"poster\" value=\"poster le commentaire\"/>
        </form>";
        if (isset($_POST['poster'])) {

          $requete = $bd->prepare('INSERT INTO commentaire VALUES comment = :commenter, idCommentaire = :idCommentaire, idClient = :idClient');

          $requete->execute(array(
            'commenter' => $_POST['commenter'],
            'idClient' => $_SESSION['idClient'],
            'idCommentaire' => $com
          ));
          $reponse2=$bd->query('SELECT idCommentaire FROM commentaire');
          $com = 0;
          while ($donnees2 = $reponse2->fetch()) //tant qu'il y a des lignes de logements
          {
            $com = $com + 1 ;
          }
        }
      }
      ?>


      <!-- il faudra faire un bouton qui permet d'ajouter un commentaire  : -->


    </section>
  </div>
  </body>
  </html>
