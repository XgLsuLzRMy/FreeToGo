<?php  require_once('include/fonctions.php');
session_start();

function connexion($bd, $login, $mdp){
  $reponse = $bd->query('SELECT * FROM session where login="'.$login.'"');
  $donnees = $reponse->fetch();
  $idClient = $donnees["idClient"];
  $loginClient = $donnees["login"];
  $mdpClient = $donnees["mdp"];
  if ($loginClient == $login && $mdpClient == hash('sha512',$mdp)){
    $_SESSION["idClient"] = $idClient;
    header("location: ./recherche.php");
  }
  else{
    header("Location: ./connexion.php");
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
  ajoutUtilisateur($bd, $_POST["loginInc"], $_POST["mailInc"], $_POST["mdpInc"]);
  connexion($bd, $_POST["loginInc"], $_POST["mdpInc"]);
}
?>
