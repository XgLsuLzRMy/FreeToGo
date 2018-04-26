<?php


if ( isset($_POST["connexion"]) ) {
  session_start();
  $OK = false;

  $nomserveur='localhost'; //nom du seveur
  $nombd='freetogo'; //nom de la base de données
  $login='userfreetogo'; //login de l'utilisateur
  $mdp=''; // mot de passe

  $bd = new PDO('mysql:host='.$nomserveur.';dbname='.$nombd.'', $login);
  $reponse = $bd->query('SELECT * FROM session where login="'.(string)$_POST["login"].'"');
  $donnees = $reponse->fetch();
  $loginClient = $reponse["login"];
  $idClient = $donnees[""];
  $mdp=$donnees["mdp"];

  if ($loginClient == $_POST["login"] && $mdp == $_POST["mdp"]){
    $_SESSION["login"] = $_POST['login'];
    header("location: ./index.php");
  }
  else{
    header("Location: ./connexion.php");

  }
}else if(isset($_POST["deconnexion"])){
  session_destroy();
  header("Location: ./connexion.php");
}else if(isset($_POST["inscription"])){
  // lire la bdd
  header("Location: ./index.php");
}
 ?>
