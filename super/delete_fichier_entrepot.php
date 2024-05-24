<?php
require('../database.php');
$id = $_POST['delete_id'];



$supprimerDemande=$bdd->prepare('delete from fichier_entrepot where id_fich_ent=?');
$supprimerDemande->bindParam(1, $id);
 $supprimerDemande->execute();


 
 
?>