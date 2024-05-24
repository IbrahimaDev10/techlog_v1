<?php 
require('../database.php');
require('controller/afficher_les_receptions.php');
require('controller/requete_des_filtres.php');
$statut= $_POST['statut'];
$navire= $_POST['id_navire'];
$produit= $_POST['id_produit'];
$destination= $_POST['id_destination'];
$poids_sac= $_POST['poids_sac'];
$date=$_POST['dates'];
$heure=$_POST['heure'];
$manquant=$_POST['manquant'];
$destination_recep=$_POST['destination_recep'];

$bl=$_POST['bl'];
$sac=$_POST['sacf'];
$id=$_POST['id'];

$date2=date("Y-m-d", strtotime($date));


echo $date;
if($statut=='sain' or $statut=='mouille'){
  $poids=$sac*$poids_sac/1000;
}
if($statut=='flasque' or $statut=='balayure'){
  $poids=$sac*$_POST['poidsf'];
}
//$table_avaries_deb_visible=$_POST['table_avaries_deb_visible'];    

$update=$bdd->prepare('UPDATE reception_navire SET dates=?, heure=?, sac=?, poids=?, manquant=?, bl=? , id_destination=?  where id=?');
$update->bindParam(1,$date2);
$update->bindParam(2,$heure);
$update->bindParam(3,$sac);
$update->bindParam(4,$poids);
$update->bindParam(5,$manquant);
$update->bindParam(6,$bl);
$update->bindParam(7,$destination_recep);
$update->bindParam(8,$id);

$update->execute();



    ?>

<div class="container-fluid" id="TableReceptionAvaries" > 
<?php  
  require('entete_tableau_reception.php'); ?>

<tbody>

<?php


 affichage_reception($bdd,$produit,$poids_sac,$navire,$destination,$statut); ?>


</tbody>
             

  
</table> 
</div>
</div>
</div>
</div>

<?php if($update){

 ?>
<script type="text/javascript">
   Swal.fire({
        icon: 'success',
        title: 'Reussi',
        text: 'Camion modifie avec succes.',
        confirmButtonText: 'OK'
    });
</script>
<?php } ?>

