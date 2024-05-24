<?php 
require('../database.php');
require('controller/afficher_les_receptions.php');
$statut= $_POST['statut'];
$navire= $_POST['id_navire'];
$produit= $_POST['id_produit'];
$destination= $_POST['id_destination'];
$poids_sac= $_POST['poids_sac']; 

$bl=$_POST['bl'];
$id=$_POST['delete_id'];
$etat_reception='non';
//$table_avaries_deb_visible=$_POST['table_avaries_deb_visible'];    

$delete=$bdd->prepare('DELETE from reception_transfert_des_avaries where id=?');
$delete->bindParam(1,$id);
$delete->execute();

$update=$bdd->prepare('UPDATE transfert_debarquement set  etat_reception=? where bl=?');
$update->bindParam(1,$etat_reception);
$update->bindParam(2,$bl);
$update->execute();




?>

<div class="container-fluid" id="TableReceptionAvaries"> 

        <div class="row">
            
            
               
        <div class="col-md-12 col-lg-12">      


<div class="table-responsive" border=1>
 <table class='table table-hover table-bordered table-striped' id='table' border='2' >
   <input type="" name="" id="input_statut" value="<?php echo $statut; ?>">

 <thead style=" background: #1B2B65;" >
  <td   id="titreAVDEB" colspan="12"  >RECEPTION DES <?php echo strtoupper($statut).'S'; ?></td> 
 
       
    
    <tr id="tr_attente_avdeb"  >
      
      
      <td scope="col"    >ROTATIONS</td>
       <td scope="col"   >DATE</td>
              <td scope="col"    >HEURE</td>
       
                      <td scope="col"    >BL</td>
               <td scope="col"   >CAMIONS</td> 
               <td scope="col"   >CHAUFFEUR</td>
               <td scope="col"   >N° DECLARATION</td>

                        
      <td scope="col"   >SAC</td>
      <td scope="col"   >POIDS</td>
      <td scope="col"  rowspan="3"  >ACTIONS</td>
      
     
  </tr>
    
      
      
     </thead>


<tbody>

<?php


 affichage_reception_avaries_deb($bdd,$produit,$poids_sac,$navire,$destination,$statut); ?>


</tbody>
             

  
</table> 
</div>
</div>
</div>
</div>

