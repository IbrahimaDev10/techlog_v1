<?php 
include('../database.php');
require('controller/requete_predebarquement.php');
$message="";

//$req = $bdd->query('SELECT * FROM prendre_rendez_vous ');
$id = $_POST['delete_id'];
$navire=$_POST['navire'];
$b=$_POST['navire'];


$supprimerDemande=$bdd->prepare('delete from declaration_chargement where id_dec=?');
$supprimerDemande->bindParam(1, $id);
 $supprimerDemande->execute(); ?>
 
 <?php affichage_par_cale($bdd,$b); ?>
 
 
 