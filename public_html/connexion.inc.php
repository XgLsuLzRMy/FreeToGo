<?php
session_start();
if ( isset($_POST["connexion"]) ) {

  $OK = false;

  $nomserveur='localhost'; //nom du seveur
  $nombd='freetogo'; //nom de la base de données
  $login='userfreetogo'; //login de l'utilisateur
  $mdp=''; // mot de passe

  $bd = new PDO('mysql:host='.$nomserveur.';dbname='.$nombd.'', $login);
  $reponse = $bd->query('SELECT * FROM session where login="'.(string)$_POST["login"].'"');
  $donnees = $reponse->fetch();

  $idClient = $donnees["idClient"];
  $loginClient = $donnees["login"];
  $mdp=$donnees["mdp"];

  if ($loginClient == $_POST["login"] && $mdp == $_POST["mdp"]){
    $_SESSION["idClient"] = $idClient;
    header("location: ./index.php");
  }
  else{
    header("Location: ./connexion.php");

  }
}else if(isset($_POST["deconnexion"])){
  session_destroy();
  header("Location: ./connexion.php");
}else if(isset($_POST["inscription"])){
  echo "<p>inscription</p>";
  $nomserveur='localhost'; //nom du seveur
  $nombd='freetogo'; //nom de la base de données
  $login='userfreetogo'; //login de l'utilisateur
  $mdp=''; // mot de passe
  $bd = new PDO('mysql:host='.$nomserveur.';dbname='.$nombd.'', $login);

  $reponse = $bd->query('SELECT * FROM client');
  while ($donnees = $reponse->fetch()){

  }
  $idNouveauClient = $donnees["idClient"]+1;
  echo "<p>".$idNouveauClient."</p>";
  $reponse2 = $bd->query('INSERT INTO client (idClient, nom, mail) VALUES'.'("'.$idNouveauClient.'", "'.$_POST["login"].'", "'.$_POST["mail"].'")');
  $reponse = $bd->query('SELECT * FROM client where idClient=1');
  $donnees = $reponse->fetch();
  echo "<p>".$donnees["nom"]."</p>";
  $reponse2 = $bd->query('INSERT INTO session (login, mdp, idClient) VALUES'.'("'.$_POST["login"].'", "'.$_POST["mdp"].'", '.$idNouveauClient.')');

  //header("Location: ./index.php");
}
 ?>
