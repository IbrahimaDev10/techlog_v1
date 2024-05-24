<?php 
include('../database.php');
require('controller/requete_predebarquement.php');
$message="";

//$req = $bdd->query('SELECT * FROM prendre_rendez_vous ');
$id = $_POST['delete_id'];
$b=$_POST['navire'];


$supprimerDemande=$bdd->prepare('delete from dispats where id_dis=?');
$supprimerDemande->bindParam(1, $id);
 $supprimerDemande->execute(); ?>
 
 <div class="container-fluid" id="parconnaissement"  >

  <?php  affichage_par_connaissement($bdd,$b); ?>
   
 </div>  

 
 