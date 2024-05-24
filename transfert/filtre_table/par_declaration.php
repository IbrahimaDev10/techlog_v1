<?php require('../../database.php');
  require('../controller/afficher_les_filtres.php');
$produit=$_POST['produit'];
$poids_sac=$_POST['poids_sac'];
$destination=$_POST['destination'];
$statut=$_POST['statut'];
$navire=$_POST['navire'];
$declaration=$_POST['declaration']; ?>


    <?php   affichage_filtre_declaration($bdd,$produit,$poids_sac,$navire,$destination,$statut,$declaration); ?> 
