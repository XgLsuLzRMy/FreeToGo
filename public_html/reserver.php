!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="css/common.css" />
  <link rel="stylesheet" type="text/css" href="css/pageLogement.css" />
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
  <title>FreeToGo</title>
</head>
<body>
  <?php include('include/header.html'); require_once('include/fonctions.php'); ?>
  <div class="main">
    <?php
//  ouvrirSession();
  session_start();
    $bd = seConnecterABD();
if (isset($_SESSION['idClient'])) {
    if (isset($_POST['idLogement1'])) {
      if (isset($_POST['ddebut'])) {
        if (isset($_POST['dfin'])) {
            
        
            
    ;
    $requeteReservation = $bd->prepare('INSERT INTO reserver (idClient, datedebut, datefin,idLogement) VALUES(:idClient,:datedebut,:datefin,:idLogement)');
    $requeteReservation->execute(array(

      'idClient'=> (int) $_SESSION['idClient'],
      'datedebut' => $_POST['ddebut'],
      'datefin' => $_POST['dfin'],
      'idLogement' => (int) $_POST["idLogement1"]
    ));
 
echo "reservation effectuée.";

            }
          }else { echo 'erreur1';}
        }else { echo 'erreur2';}
     }else{ echo 'erreur3';}

?>

 </div>
</body>
</html>