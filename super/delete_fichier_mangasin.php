<?php
require('../database.php');
$id = $_POST['delete_id'];



$supprimerDemande=$bdd->prepare('delete from fichier_mangasin where id_fich_mg=?');
$supprimerDemande->bindParam(1, $id);
 $supprimerDemande->execute();


 
 
?>