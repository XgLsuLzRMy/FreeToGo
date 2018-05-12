<?php  require_once('include/fonctions.php');
session_start();

function connexion($bd, $login, $mdp){
  if (empty($login)){
    //header("Location: ./connexion.php");
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
        header("Location: ./connexion.php?mauvaisLogin=1");
        //header("Location: ./connexion.php");
      }
    }else{
      echo "<br/><br/><br/><p>mauvais login</p>";
      header("Location: ./connexion.php?mauvaisLogin=1");
      //header("Location: ./connexion.php");
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
}else if(isset($_POST["deconnexion"])){
  session_destroy();
  header("Location: ./connexion.php");
}else if(isset($_POST["inscription"])){
  $bd = seConnecterABD();
  $con = mysqli_connect("localhost", "userfreetogo", "", "freetogo");
  //$reponseLogin = $bd->query('SELECT * FROM session WHERE login="'.$_POST["loginInc"].'"'); // verifier que le login n'existe pas deja
  $reponseLogin = mysqli_query($con, 'SELECT * FROM session WHERE login="'.$_POST["loginInc"].'"'); // verifier que le login n'existe pas deja
  //$reponseMail = $bd->query('SELECT * FROM session WHERE login="'.$_POST["mailInc"].'"'); // verifier que le login n'existe pas deja
  $reponseMail = mysqli_query($con, 'SELECT * FROM client WHERE mail="'.$_POST["mailInc"].'"'); // verifier que le login n'existe pas deja
  if(mysqli_num_rows($reponseLogin) == 0 && mysqli_num_rows($reponseMail) == 0){
    $patternMail = '/[a-z0-9]+@[a-z0-9]+\.[a-z0-9]+/i';
    if(preg_match('/\s/', $_POST["loginInc"]) || empty($_POST["mdpInc"]) || !preg_match($patternMail, $_POST["mailInc"])){
      // il ne doit pas y avoir d'espace dans le login
      // le mot de passe ne doit pas etre vide
      // le mail doit etre de la bonne forme
      echo "<br/><br/><br/><p>login, mail ou mot de passe de la mauvaise forme</p>";
      header("Location: ./connexion.php?mauvaiseForme=1");
    }else{
      ajoutUtilisateur($bd, $_POST["loginInc"], $_POST["mailInc"], $_POST["mdpInc"]);
      connexion($bd, $_POST["loginInc"], $_POST["mdpInc"]);
    }
  }else{
    echo "<br/><br/><br/><p>utilisateur existe deja</p>";

  }
}
?>
