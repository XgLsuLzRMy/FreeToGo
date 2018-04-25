<!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="css/common.css">
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" >
  <title>FreeToGo</title>
</head>
<body>
  <?php include('include/header.html'); ?>


  <!--la partie pour modifier le profil de l'utilisateur -->

  <form>
    <h3> Votre profil </h3>
    <br/>
    <label>Nom : </label>
    <br/>
    <input type="text" name="nom" id="nom" placeholder="saisissez votre nom"/>
    <br/>
    <label>Prenom : </label>
    <br/>
    <input type="text" name="preNom" id="nom" placeholder="saisissez votre prenom"/>
    <br/>
    <label>age : </label>
    <br/>
    <input type="text" name="age" id="nom" placeholder="saisissez votre age"/>
    <br/>
    <label>Adresse : </label>
    <br/>
    <input type="text" name="adresse" id="nom" placeholder="saisissez votre adresse"/>
    <br/>
    <label>Description : </label>
    <br/>
    <textarea name="description" rows="10" cols="80" placeholder="saisissez votre description"></textarea>
    <br/>
    <label>Photo de profil : </label>
    <br/>
    <input type="file" name="photo" id="photo"/>
    <br/>

    <input type="submit" class="bouton" name="Enregistrer" value="Enregistrer"/>
  </form>

  <!--la partie pour ajouter un logement a louer sur le site -->

  <section>
    <h3> Vos logements </h3>
    <br/>
    <!-- il faudra faire un tableau en PHP avec un tableau du modele si dessous :
    <thead> <td colspan="2"> Logements </thead>
    <table>
    <tbody>
    <tr> <td> logement 1 </td>
    <td> <input type="submit" class="bouton" name="Enregistrer" value="voir"/> </td>
  </tr>
  <tr> <td> logement 2 </td>
  <td> <input type="submit" class="bouton" name="Enregistrer" value="voir"/> </td>
</tr>
</tbody>
</table>
-->
<br/>
<form action="ajoutlogement.php">
  <input type="submit" value="Ajouter un logement" name="lienAjoutLogement" class="bouton"/>
</form>
</section>

<!-- la partie pour voir les réservations -->

<section>
  <h3> Vos reservations </h3>
  <!-- il faudra faire  une liste avec les reservations et un bouton qui permet d'ajouter un commentaire -->
</section>

</body>
</html>




<!-- form pour interaction avec utilisateur -->
