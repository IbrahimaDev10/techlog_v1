<?php 

require("../database.php");
$id=$_POST['delete_id'];
$delete=$bdd->prepare("DELETE from fichier_deb_sain where id_fich_sain=?");
$delete->bindParam(1,$id);
$delete->execute();
 ?>