<?php
require('../database.php');
$id = $_POST['delete_id'];



$supprimerDemande=$bdd->prepare('delete from mangasin where id=?');
$supprimerDemande->bindParam(1, $id);
 $supprimerDemande->execute();


 
 
?>