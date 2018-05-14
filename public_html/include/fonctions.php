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
  echo '<table class="tableaux">';
  if ($reponse){
    echo "
    <tr>
    <th></th>
    <th>Nom du logement</th>
    <th>Localisation</th>
    <th> Nombre de personnes </th>
    <th>Prix</th>
    <th>nom du propriétaire</th>
    <th>Voir</th>
    </tr>";
    while ($donnees = $reponse->fetch())
    {
      $reponse2 = $bd->query('SELECT * FROM client where idClient="'.(string)$donnees["idClient"].'"');
      $donneesClient = $reponse2->fetch();
      echo "
      <tr>
      <td>".$num."</td>
      <td>". htmlspecialchars($donnees["nomLogement"])."</td>
      <td>". htmlspecialchars($donnees["ville"])." (". htmlspecialchars($donnees['pays']).")</td>
      <td> ".$donnees['effectif']." </td>
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
  // width:250px pour que l'image soit de taille fixe
  echo '<img alt="photo de profil" class="photo photo_profil" src="'.$photo.'"/>';
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

function afficherMessageErreur($s){
  echo '<div id="alertErreur">';
  echo '<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>';
  echo '<strong>Attention!</strong> '.$s;
  echo '</div>';
}

function afficherMessageSucces($s){
  echo '<div id="alertSucces">';
  echo '<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>';
  echo '<strong>'.$s.'</strong> ';
  echo '</div>';
}

function reserver(){
  $bd = seConnecterABD();
  if (isset($_POST['ddebut'])) {

    //la date d'arrivee doit être supérieur à la date actuelle
    $date = date('Y-m-d');
    $dateactuelle = date_create( $date);
    $datedebutreservation = date_create($_POST['ddebut']);
    $interval = date_diff($dateactuelle, $datedebutreservation);
    if ($interval->format('%R%a days') >0){

      if (isset($_POST['dfin'])) {
        //de même pour la date de départ
        $date = date('Y-m-d');
        $dateactuelle = date_create( $date);
        $datefinreservation = date_create($_POST['dfin']);
        $diff = date_diff($dateactuelle, $datefinreservation);
        if ($diff->format('%R%a days') > 0){
          //la date d'arrivée doit être chronologiquement avant la date de départ
          $datedebutreservation = date_create($_POST['ddebut']);
          $datefinreservation = date_create($_POST['dfin']);
          $diff = date_diff($datedebutreservation, $datefinreservation);
          if ($diff->format('%R%a days') > 0){
            if (isset($_SESSION['idClient'])) {
              if (isset($_POST['idLogement1'])) {

                //les dates de réservation arrivee et depart ne doivent pas être inclu dans les dates de reservation déjà existente
                //count permet de compter le nombre de ligne de la requete: si le nombre de ligne est 0, c'est que la condition est verifié

                $rep = $bd->query('select count(*) from reserver where (idLogement= "'.(string)$_POST['idLogement1'].'") and (( \''.$_POST['ddebut'].'\' between datedebut and datefin) or (\''.$_POST['dfin'].'\' between datedebut and datefin));');
                $rep2 = $rep->fetch();

                //de même les dates de réservation déja existante ne doivent pas être inclu dans l'intervalle de date demandé
                //donc de même si le nombre de ligne est 0, c'est que la condition est verifiée

                $rep = $bd->query('select count(*) from reserver where (idLogement= "'.(string)$_POST['idLogement1'].'") and (( datedebut between  \''.$_POST['ddebut'].'\'and  \''.$_POST['dfin'].'\') or ( datefin between  \''.$_POST['ddebut'].'\'and  \''.$_POST['dfin'].'\'));');
                $rep3 = $rep->fetch();
                //on verifie ces deux conditions avant de faire la réservations

                if  ( ( $rep2["count(*)"] == 0) & ($rep3["count(*)"] == 0 )) {
                  $requeteReservation = $bd->prepare('INSERT INTO reserver (idClient, datedebut, datefin,idLogement) VALUES(:idClient,:datedebut,:datefin,:idLogement);');
                  $requeteReservation->execute(array(

                    'idClient'=> (int) $_SESSION['idClient'],
                    'datedebut' => $_POST['ddebut'],
                    'datefin' => $_POST['dfin'],
                    'idLogement' => (int) $_POST["idLogement1"]
                  ));
                  //afficherMessageSucces("reservation effectuée.");
                  return 1;
                } else {
                  //afficherMessageErreur('Appartement déja reservé en ces dates');
                  return 2;
                }
              }else {
                //afficherMessageErreur('erreur4');
                return 3;
              }
            }else {
              //afficherMessageErreur('erreur1');
              return 4;
            }
          }else {
            //afficherMessageErreur('Les dates de réservation ne sont pas cohérentes: la date d\'arrivée doit être préalable à la date de départ. Veuillez réffectuer la réservation.');
            return 5;
          }
        }else {
          //afficherMessageErreur('La date de fin de sejour est non valide, veuillez recommencer la réservation.');
          return 6;
        }
      }else {
        //afficherMessageErreur('erreur2');
        return 7;
      }
    }else{
      //afficherMessageErreur( 'La date de début de sejour est non valide, veuillez recommencer la réservation.');
      return 8;
    }
  } else {
    //'erreur3';
    return 9;
  }
}

function loginExiste($login){
  $con = mysqli_connect("localhost", "userfreetogo", "", "freetogo");
  $reponseLogin = mysqli_query($con, 'SELECT * FROM session WHERE login="'.$login.'"'); // verifier que le login n'existe pas deja
  if(mysqli_num_rows($reponseLogin) == 0){
    return false;
  }else{
    return true;
  }
}

function mailExiste($mail){
  $con = mysqli_connect("localhost", "userfreetogo", "", "freetogo");
  $reponseMail = mysqli_query($con, 'SELECT * FROM client WHERE mail="'.$mail.'"'); // verifier que le mail n'existe pas deja
  if(mysqli_num_rows($reponseMail) == 0){
    return false;
  }else{
    return true;
  }
}
?>
