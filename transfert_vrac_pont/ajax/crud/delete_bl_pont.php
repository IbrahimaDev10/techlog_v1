<?php 
 require('../../../database.php');
  require '../../../vendor/autoload.php';
 require('../../controller/afficher_pont_bascule.php');

$navire=$_POST['navire'];
$produit=$_POST['produit'];
$poids_sac=$_POST['poids_sac'];
$destination=$_POST['destination'];
$client=$_POST['client'];

$statut='sain';

$id=$_POST['delete_id'];

$id_transfert=$_POST['id_transfert'];

$etat_pont='non';


     

$delete=$bdd->prepare("DELETE from pont_bascule  where id_pont=? ");
$delete->bindParam(1,$id);

$delete->execute();

$update=$bdd->prepare("UPDATE  transfert_debarquement set etat_pont='non' where id_register_manif=? ");
$update->bindParam(1,$id_transfert);
$update->execute();



 ?>


<div class="container-fluid bg-white" id="Table_pont" style="background: white; border: solid; border-radius: 2%;">

<?php 


 ?>

  <br>    



<div class="row">

 <?php //include('recap_debarquement.php'); ?> 
<?php //include('suivi_de_declaration.php'); ?>

<br><br>
  
 <?php include('../../entete_tableau_pont.php'); ?>
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
