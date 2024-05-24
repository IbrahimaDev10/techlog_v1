<?php 
require('../database.php');
require('controller/afficher_les_debarquements.php');
require('controller/afficher_les_filtres.php');


$navire= $_POST['navire'];
$produit= $_POST['produit'];
$destination= $_POST['destination'];
$poids_sac= $_POST['poids_sac']; 
$client= $_POST['client']; 
$transfert_sain=$_POST['transfert_sain'];

$date_filtre='';
$cale_filtre='';

if($transfert_sain==1){
	$statut= $_POST['statut'];
}

    $type_de_navire=type_de_navire($bdd,$navire);

    $type_navire_deb=$type_de_navire->fetch();
    
$resfiltre =resfiltre($bdd,$produit,$poids_sac,$navire,$destination,$client);



        $filtreColonne= filtreColonne($bdd,$produit,$poids_sac,$navire,$destination,$client);

 ?>

<br><br>

 <div class="container-fluid bg-white" id="TableSain" <?php if($transfert_sain==0){ ?> style="display: none; <?php } ?> width: 100%; ">

<input type="text" name="" id="input_statut" value="<?php echo $statut; ?>" style='display:none;'>  
<br>
<div class="row">

 <?php include('recap_debarquement.php'); ?> 
<?php include('suivi_de_declaration.php'); ?>

<br><br>

<?php include('entete_tableau.php') ?>

    <tbody id='tbody_transfert_deb'>
    <?php  

   /* if($type_navire_deb['type']=='VRAQUIER'){ affichage_sain_new_vrac($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client);
    }*/
     //if($type_navire_deb['type']=='SACHERIE'){
      affichage_sain_new($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client,$date_filtre,$cale_filtre);
   // }          

            ?> 
    </tbody>       

            

</table>
<?php include('pied_tableau.php'); ?>
</div>



</div>
</div>
