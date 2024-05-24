<?php require('../database.php');
  require('controller/afficher_les_debarquements.php');
require('controller/afficher_les_filtres.php');

$produit=$_POST['produit'];
$poids_sac=$_POST['poids_sac'];
$destination=$_POST['destination'];

$navire=$_POST['navire'];
$client=$_POST['client']; 
$tare_sac=$_POST['tare_sac']; 

$statut='sain';


$insert=$bdd->prepare('INSERT INTO tare_sac(poids_tare_sac,id_produit_tare,poids_sac_tare,id_navire_tare,id_destination_tare,id_client_tare) values(?,?,?,?,?,?)');
$insert->bindParam(1,$tare_sac);
$insert->bindParam(2,$produit);
$insert->bindParam(3,$poids_sac);
$insert->bindParam(4,$navire);
$insert->bindParam(5,$destination);
$insert->bindParam(6,$client);
$insert->execute();


?>


 
   
