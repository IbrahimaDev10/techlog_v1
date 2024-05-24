<?php require('../../database.php');
      require('../controller/afficher_les_filtres.php');
      require('../controller/afficher_les_debarquements.php');

$produit=$_POST['produit'];
$poids_sac=$_POST['poids_sac'];
$destination=$_POST['destination'];
$statut=$_POST['statut'];
$navire=$_POST['navire'];
$client=$_POST['client'];
$date_filtre=$_POST['date'];
$cale_filtre=''; ?>


    <?php  // affichage_filtre_date($bdd,$produit,$poids_sac,$navire,$destination,$statut,$date);
              affichage_sain_new($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client,$date_filtre,$cale_filtre);

   ?> 
