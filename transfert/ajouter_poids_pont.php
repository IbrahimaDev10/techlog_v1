<?php require('../database.php');
  require('controller/afficher_les_debarquements.php');
require('controller/afficher_les_filtres.php');

$poids_pont=$_POST['poids_pont']; 
$ticket_pont=$_POST['ticket_pont']; 
$tare_vehicule=$_POST['tare_vehicule']; 
$id=$_POST['id']; 

$update=$bdd->prepare('UPDATE transfert_debarquement set ticket_pont=? , poids_brut=?, tare_vehicule=? where id_register_manif=?');
$update->bindParam(1,$ticket_pont);
$update->bindParam(2,$poids_pont);
$update->bindParam(3,$tare_vehicule);

$update->bindParam(4,$id);
$update->execute();

$produit=$_POST['produit'];
$poids_sac=$_POST['poids_sac'];
$destination=$_POST['destination'];

$navire=$_POST['navire'];
$client=$_POST['client']; 




$statut='sain';




?>


 
    <?php   affichage_sain_new($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client); ?>
