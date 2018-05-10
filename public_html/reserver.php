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
    
    
    
    if (isset($_POST['ddebut'])) {
      
      //la date d'arrivee doit être supérieur à la date actuelle
        
        $date = date('Y-m-d');
        $dateactuelle = date_create( $date);
        $datedebutreservation = date_create($_POST['ddebut']);
        $interval = date_diff($dateactuelle, $datedebutreservation);
        if ($interval->format('%R%a days') >0){
        
        
            if (isset($_POST['dfin'])) {
            
            //de même pour la date de départ
        
            $date = date('Y-m-d');
            $dateactuelle = date_create( $date);
            $datefinreservation = date_create($_POST['dfin']);
            $diff = date_diff($dateactuelle, $datefinreservation);
            if ($diff->format('%R%a days') > 0){
            
            
            //la date d'arrivée doit être chronologiquement avant la date de départ
                $datedebutreservation = date_create($_POST['ddebut']);
                $datefinreservation = date_create($_POST['dfin']);
                $diff = date_diff($datedebutreservation, $datefinreservation);
                
            
                if ($diff->format('%R%a days') > 0){
            
            
            
                    if (isset($_SESSION['idClient'])) {
                    if (isset($_POST['idLogement1'])) {
                    
                    //les dates de réservation arrivee et depart ne doivent pas être inclu dans les dates de reservation déjà existente
                    //count permet de compter le nombre de ligne de la requete: si le nombre de ligne est 0, c'est que la condition est verifié
                   
                    
                    $rep = $bd->query('select count(*) from reserver where (idLogement= "'.(string)$_POST['idLogement1'].'") and ( \''.$_POST['ddebut'].'\' between datedebut and datefin) or (\''.$_POST['dfin'].'\' between datedebut and datefin);');
                    while($rep2 = $rep->fetch()){
                    
                    }
                    
                    //de même les dates de réservation déja existante ne doivent pas être inclu dans l'intervalle de date demandé
                    //donc de même si le nombre de ligne est 0, c'est que la condition est verifiée
                    
                    $rep = $bd->query('select count(*) from reserver where (idLogement= "'.(string)$_POST['idLogement1'].'") and ( datedebut between  \''.$_POST['ddebut'].'\'and  \''.$_POST['dfin'].'\') or ( datefin between  \''.$_POST['ddebut'].'\'and  \''.$_POST['dfin'].'\');');
                    while($rep3 = $rep->fetch()){
                    }
                    //on verifie ces deux conditions avant de faire la réservations
                    
                    if  ( ( $rep2["count(*)"] = 0) & ($rep3["count(*)"] = 0 )) {
                    
                    
                   
                    
                
                        $requeteReservation = $bd->prepare('INSERT INTO reserver (idClient, datedebut, datefin,idLogement) VALUES(:idClient,:datedebut,:datefin,:idLogement);');
                        $requeteReservation->execute(array(

                            'idClient'=> (int) $_SESSION['idClient'],
                            'datedebut' => $_POST['ddebut'],
                            'datefin' => $_POST['dfin'],
                            'idLogement' => (int) $_POST["idLogement1"]
                            ));
 
                            echo "reservation effectuée.";
                            
                    
            } else { echo 'Appartement déja reservé en ces dates';}
            }else {echo 'erreur4';}
          }else { echo 'erreur1';}
          }else { echo 'Les dates de réservation ne sont pas cohérentes: la date d\'arrivée doit être préalable à la date de départ. Veuillez réffectuer la réservation.';}
        }else {echo 'La date de fin de sejour est non valide, veuillez recommencer la réservation.';}
        }else { echo 'erreur2';}
     }else{ echo 'La date de début de sejour est non valide, veuillez recommencer la réservation.';}
     
    } else {echo 'erreur3';} 

?>

 </div>
</body>
</html>