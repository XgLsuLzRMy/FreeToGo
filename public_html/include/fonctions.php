<?php
function gererPhoto($donnees, $attribut, $imageParDefaut)
{
  if($donnees[$attribut]==NULL){
    $photo=$imageParDefaut;
  }else{$photo=$donnees[$attribut];}
  return $photo;
}

function seConnecterABD()
{
  $nomserveur='localhost'; //nom du seveur
  $nombd='freetogo'; //nom de la base de données
  $login='userfreetogo'; //login de l'utilisateur
  $mdp=''; // mot de passe
  $bd = new PDO('mysql:host='.$nomserveur.';dbname='.$nombd.'', $login);
  return $bd;
}



function afficherTableLogement($reponse,$bd){
  $num = 1;
  echo"<table>";
  if ($reponse){
    while ($donnees = $reponse->fetch())
    {
      $reponse2 = $bd->query('SELECT * FROM client where idClient="'.(string)$donnees["idClient"].'"');
      $donneesClient = $reponse2->fetch();
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
      <td>". htmlspecialchars($donnees["nomLogement"])."</td>
      <td>". htmlspecialchars($donnees["ville"])." (". htmlspecialchars($donnees['pays']).")</td>
      <td>Prix ".$donnees['prix']." €/nuit</td>
      <td>Mr/Mme ". htmlspecialchars($donneesClient["nom"])."</td>
      <td>
      <button class=\"bouton\" onclick=\"location.href='pageLogement.php?idLogement=".$donnees["idLogement"]."'\" type=\"button\">VOIR</button>
      </td>
      </tr>";
      $num = $num + 1;
    }
  }
  echo "</table>";
}


function afficherNom($donnees){
  echo "<h2>".$donnees['nom']." ".$donnees['prenom']."</h2>";
  $photo=gererPhoto($donnees,'photoProfil',"images/profil_default.png");
  echo '<img alt="photo de profil" class="photo"  src="'.$photo.'"/>';
}

function ouvrirSession(){
  if(session_id() == '') {
    session_start();
  }
  if(!isset($_SESSION['idClient'])){
    header("Location:connexion.php");
  }
}

function calculChamps($champ,$donnees){
  if (isset($_POST[$champ])) {
    return $_POST[$champ];
  }else{
    return $donnees[$champ];
  }
}


?>
