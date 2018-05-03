<?php  require_once('include/fonctions.php');
session_start();
if ( isset($_POST["connexion"]) ) {

  $OK = false;

  $bd = seConnecterABD();
  $reponse = $bd->query('SELECT * FROM session where login="'.(string)$_POST["login"].'"');
  $donnees = $reponse->fetch();

  $idClient = $donnees["idClient"];
  $loginClient = $donnees["login"];
  $mdp=$donnees["mdp"];

  if ($loginClient == $_POST["login"] && $mdp == $_POST["mdp"]){
    $_SESSION["idClient"] = $idClient;
    header("location: ./recherche.php");
  }
  else{
    header("Location: ./connexion.php");

  }
}else if(isset($_POST["deconnexion"])){
  session_destroy();
  header("Location: ./connexion.php");
}else if(isset($_POST["inscription"])){
  $bd = seConnecterABD();
  $requete = $bd->prepare('INSERT INTO client (nom, mail) VALUES(:nom,:mail)');
  $requete->execute(array(
    'nom' => $_POST["loginInc"],
    'mail' => $_POST["mailInc"]
  ));
  $reponse = $bd->query('SELECT LAST_INSERT_ID();');
  $donnees = $reponse->fetch();
  $requete2 = $bd->prepare('INSERT INTO session (login, mdp, idClient) VALUES(:login,:mdp,:idClient)');
  $requete2->execute(array(
    'login' => $_POST["loginInc"],
    'mdp' => $_POST["mdpInc"],
    'idClient' => $donnees["LAST_INSERT_ID()"]
  ));


}
 ?>
