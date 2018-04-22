<!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="css/ajoutLogement.css">
  <link rel="stylesheet" type="text/css" href="css/common.css">
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" >
  <title>FreeToGo</title>
</head>

<body>
  <?php include('include/header.html'); ?>

  <!--la partie pour décrire les informations du logement -->

  <form>
    <h3> Votre logement </h3>
    <label>Photo du logement : </label>
    <br/>
    <input type="file" name="photoLogement" id="photo"/>
    <br/>
    <br/>
    <label> Type de logement : </label>
    <input type="text" name="typeLogement" id="type" placeholder="saisissez le type du logement"/>
    <br/>
    <label>Nombre de personnes : </label>
    <input type="number" name="nbPersonne" id="nbPersonne" value="1" min="1" max="30">
    <br/>
    <label>Localisation : </label>
    <input type="text" name="localisation" id="localisation" placeholder="saisissez la localisation"/>
    <br/>
    <label> Prix (pour une nuit) : </label>
    <input type="text" name="prixNuit" id="prixNuit" placeholder="saisissez le prix pour une nuit"/>
    <br/>
    <label>Description : </label>
    <br/>
    <textarea name="texte" rows="10" cols="80" placeholder="saisissez la description du logement"></textarea>


    <!--la partie pour ajouter un logement a louer sur le site -->

    <section>
      <h3> Fonctionnalités </h3>
      <p>
        Veuillez indiquer les fonctionnalités du logement :<br />
        <input type="checkbox" name="salledebain" value="Salle de bain" id="salledebain" /> <label for="salledebain">Salle de bain</label><br />
        <input type="checkbox" name="wifi" value="Wifi" id="wifi" /> <label for="wifi">Wifi</label><br />
        <input type="checkbox" name="cuisine" value="Cuisine" id="cuisine" /> <label for="cuisine">Cuisine</label><br />
      </p>

      <input type="submit" class="bouton" name="Enregistrer_Logement" value ="Enregistrer"/>
    </section>

  </form>
</body>
</html>
