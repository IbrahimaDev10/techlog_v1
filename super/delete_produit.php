<?php
require('../database.php');
$id = $_POST['delete_id'];



$supprimerDemande=$bdd->prepare('delete from categories where id_categories=?');
$supprimerDemande->bindParam(1, $id);
 $supprimerDemande->execute();


 
 
?>