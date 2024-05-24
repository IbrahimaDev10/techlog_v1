<?php require('../../database.php');
    require('../controller/afficher_pont_bascule.php');
$navire= $_POST['navire'];
$produit= $_POST['produit'];
$destination= $_POST['destination'];
$poids_sac= $_POST['poids_sac']; 
$client= $_POST['client']; 
$transfert_sain=$_POST['transfert_sain'];

//$statut=$_POST['statut'];

$statut='sain';
 ?>

       

<div class="container-fluid bg-white" id="Table_pont" style="background: white; border: solid; border-radius: 2%;">



  <br>    



<div class="row">

 <?php //include('recap_debarquement.php'); ?> 
<?php //include('suivi_de_declaration.php'); ?>

<br><br>
<div>
  
 <?php include('../entete_tableau_pont.php'); ?>
 <div class="table-body" id="tbody_transfert_deb" >
    <tbody  >
    <?php    //if($type_navire_deb['type']=='VRAQUIER'){ affichage_sain_new_vrac($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client);
   // }
    // if($type_navire_deb['type']=='SACHERIE'){ 
     affichage_pont_bascule($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client);
    //}   ?> 
    </tbody>   
    </div>    

            

</table>
<?php //include('pied_tableau.php'); ?>
</div>


</div>
</div>


