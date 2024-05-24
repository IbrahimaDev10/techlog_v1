<?php 
require('../database.php');
require('controller/afficher_les_receptions.php');
$statut= $_POST['statut'];
$navire= $_POST['navire'];
$produit= $_POST['produit'];
$destination= $_POST['destination'];
$poids_sac= $_POST['poids_sac']; 
$table_avaries_deb_visible=$_POST['table_avaries_deb_visible'];    ?>

<div class="container-fluid" id="TableReceptionAvaries" <?php if($table_avaries_deb_visible==0){

 ?> style="display: none;" <?php } ?>  <?php if($table_avaries_deb_visible==1){

 ?> style="display: block;" <?php } ?>> 

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

