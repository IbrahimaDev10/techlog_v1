<?php 
require('../database.php');
require('controller/afficher_les_receptions.php');
require('controller/requete_des_filtres.php');
$statut= $_POST['statut'];
$navire= $_POST['navire'];
$produit= $_POST['produit'];
$destination= $_POST['destination'];
$poids_sac= $_POST['poids_sac'];

$table_avaries_deb_visible=$_POST['table_avaries_deb_visible'];    ?>

<div class="container-fluid" id="TableReceptionAvaries" <?php if($table_avaries_deb_visible==0){

 ?> style="display: none;" <?php } ?>  <?php if($table_avaries_deb_visible==1){

 ?> style="display: block;" <?php } ?>> 

<?php include('entete_tableau_reception.php'); ?>


<tbody>

<?php


 affichage_reception($bdd,$produit,$poids_sac,$navire,$destination); ?>


</tbody>
             

  
</table> 
</div>
</div>
</div>
</div>


