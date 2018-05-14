<?php  require_once('include/fonctions.php');
session_start();

function connexion($bd, $login, $mdp){
  if (empty($login)){
    echo "<br/><br/><br/><p>login vide</p>";
  }
  else{
    $reponse = $bd->query('SELECT * FROM session where login="'.$login.'"');
    if($reponse){
      $donnees = $reponse->fetch();
      $idClient = $donnees["idClient"];
      $loginClient = $donnees["login"];
      $mdpClient = $donnees["mdp"];
      if ($loginClient == $login && $mdpClient == hash('sha512',$mdp)){
        $_SESSION["idClient"] = $idClient;
        header("location: ./recherche.php");
      }
      else{
        echo "<br/><br/><br/><p>mauvais mdp</p>";
        header("Location: ./connexion.php?mauvaisLogin");
      }
    }else{
      echo "<br/><br/><br/><p>mauvais login</p>";
      header("Location: ./connexion.php?mauvaisLogin");
    }
  }
}

function ajoutUtilisateur($bd, $login, $mail, $mdp){
  $requete = $bd->prepare('INSERT INTO client (nom, mail) VALUES(:nom,:mail)');
  $requete->execute(array(
    'nom' => $login,
    'mail' => $mail
  ));
  $reponse = $bd->query('SELECT LAST_INSERT_ID();');
  $donnees = $reponse->fetch();
  $requete2 = $bd->prepare('INSERT INTO session (login, mdp, idClient) VALUES(:login,:mdp,:idClient)');
  $requete2->execute(array(
    'login' => $login,
    'mdp' => hash('sha512',$mdp),
    'idClient' => $donnees["LAST_INSERT_ID()"]
  ));
}

if ( isset($_POST["connexion"]) ) {
  $bd = seConnecterABD();
  connexion($bd, $_POST["login"], $_POST["mdp"]);
}elseif(isset($_POST["deconnexion"])){
  session_destroy();
  header("Location: ./connexion.php");
}elseif(isset($_POST["inscription"])){
  $bd = seConnecterABD();
  if(!loginExiste($_POST["loginInc"])){
    if(!mailExiste($_POST["mailInc"])){
      $patternMail = '/^[a-z0-9_.-]+@[a-z0-9._-]+\.[a-z0-9]+$/i';
      if(preg_match('/\s/', $_POST["loginInc"]) || empty($_POST["mdpInc"]) || !preg_match($patternMail, $_POST["mailInc"])){
        // il ne doit pas y avoir d'espace dans le login
        // le mot de passe ne doit pas etre vide
        // le mail doit etre de la bonne forme
        header("Location: ./connexion.php?mauvaiseForme");
      }else{
        ajoutUtilisateur($bd, $_POST["loginInc"], $_POST["mailInc"], $_POST["mdpInc"]);
        connexion($bd, $_POST["loginInc"], $_POST["mdpInc"]);
      }
    }else{
      header("Location: ./connexion.php?mailExistant");
    }
  }else{
    header("Location: ./connexion.php?loginExistant");
  }
}elseif (isset($_POST["suppressionCompte"]) && isset($_SESSION["idClient"])){
  $bd = seConnecterABD();
  $reponse1 = $bd->query('DELETE FROM session where idClient="'.$_SESSION['idClient'].'"');
  $reponse2 = $bd->query('DELETE FROM reserver where idClient="'.$_SESSION['idClient'].'"');
  $reponse3 = $bd->query('SELECT idLogement FROM logement where idClient="'.$_SESSION['idClient'].'"');
  while ($donnees=$reponse3->fetch()){
    $reponse4 = $bd->query('DELETE FROM reserver where idLogement="'.$donnees['idLogement'].'"');
    $reponse5 = $bd->query('DELETE FROM commentaire where idLogement="'.$donnees['idLogement'].'"');
  }
  $reponse6 = $bd->query('SELECT * FROM commentaire where idClient="'.$_SESSION['idClient'].'"');
  while ($donnees=$reponse6->fetch()){
    $requete = $bd->prepare('INSERT INTO commentaire (comment, idClient, idLogement) VALUES (:comment, :idClient, :idLogement)');
    $requete->execute(array(
      'comment' => $donnees['comment'],
      'idClient' => 1,
      'idLogement' => $donnees['idLogement']
    ));
  }
  $reponse6 = $bd->query('DELETE FROM commentaire where idClient="'.$_SESSION['idClient'].'"');
  $reponse7 = $bd->query('DELETE FROM logement where idClient="'.$_SESSION['idClient'].'"');
  $reponse8 = $bd->query('DELETE FROM client where idClient="'.$_SESSION['idClient'].'"');
  session_destroy();
  header("Location: ./connexion.php?suppressionSuccess");
}

?>
