<!--DOCTYPE HTML-->
<HTML>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" >
    <title> Connexion </title>
  </head>
  <body>
    <?php include('include/header.html'); ?>

    <form action="connexion.php">
      <fieldset>
        <legend> Connexion </legend>
        <br/>
        <label> Nom de l'utilisateur: </label>
        <br/>
        <input type="text" name="nom" placeholder="Nom" size= "10"/>
        <br/>
        <label> Mot de passe: </label>
        <br/>
        <!-- Pourquoi le mot de passe ne ferait que 8 caracteres maximum ?? -->
        <input type="password" name="mdp" placeholder="Mot de passe" size="10" maxlength="8"/>
        <br/>
        <br/>
        <input type="submit" class="bouton" name="connexion" value= "Se connecter" />

      </fieldset>
    </form>

    <br/>
    <hr/>
    <br/>

    <form action="inscription.php">
      <fieldset>
        <legend> Inscription </legend>
        <br/>
        <label> Nom de l'utilisateur: </label>
        <br/>
        <input type="text" name="nom" placeholder="Nom" size= "10"/>
        <br/>
        <label> Adresse e-mail: </label>
        <br/>
        <input type="text" name="mail" placeholder="Mail" size= "10"/>
        <br/>
        <label> Mot de passe: </label>
        <br/>
        <input type="password" name="mdp"  placeholder="Mot de passe" size="10" maxlength="8"/>
        <br/>
        <br/>
        <input type="submit" class="bouton" name="inscription" value= "S'inscrire" />
        <br/>
      </fieldset>
    </form>
  </body>


</HTML>
