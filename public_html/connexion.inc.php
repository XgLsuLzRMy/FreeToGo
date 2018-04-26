<?php

session_start();
if ( isset($_POST["connexion"]) ) {
  // recherche de l'utilisateur : fichier plat ou bd
  $loginAutorise="lucas";
  $passwordAutorise="123";

  if ( $_POST['login'] == $loginAutorise && $_POST['mdp'] == $passwordAutorise ){
    $_SESSION["login"] = $_POST['login'];
    echo "<p>OK</p>";
    header("location: ./index.php");
  }else{
    header("Location: ./connexion.php");
    echo "<p>KO</p>";
  }
}else if(isset($_POST["deconnexion"])){
  session_destroy();
  header("Location: ./connexion.php");
}
 ?>
