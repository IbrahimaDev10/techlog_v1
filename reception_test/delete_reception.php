<?php 
require('../database.php');
require('controller/afficher_les_receptions.php');
require('controller/requete_des_filtres.php');
$statut= $_POST['statut'];
$navire= $_POST['id_navire'];
$produit= $_POST['id_produit'];
$destination= $_POST['id_destination'];
$poids_sac= $_POST['poids_sac'];

$bl=$_POST['bl'];
$id=$_POST['delete_id'];
$etat_reception='non';

echo $id.' ';
echo $bl;
//$table_avaries_deb_visible=$_POST['table_avaries_deb_visible'];    

$delete=$bdd->prepare('DELETE from reception_navire where id=?');
$delete->bindParam(1,$id);
$delete->execute();

$update=$bdd->prepare('UPDATE transfert_debarquement set etat_reception=? where bl=?');
$update->bindParam(1,$etat_reception);
$update->bindParam(2,$bl);
$update->execute();

    ?>

<div class="container-fluid" id="TableReceptionAvaries" > 

  <?php require('entete_tableau_reception.php'); ?>


<tbody>

<?php


 affichage_reception($bdd,$produit,$poids_sac,$navire,$destination); ?>


</tbody>
             

  
</table> 
</div>
</div>
</div>
</div>


