<?php 
require('../database.php');
require('controller/afficher_les_receptions.php');

$navire= $_POST['navire'];
$produit= $_POST['produit'];
$destination= $_POST['destination'];
$poids_sac= $_POST['poids_sac'];

$type_navire=type_navire($bdd,$navire);

$type_nav=$type_navire->fetch();
 
      $table_avaries_reception_visible=$_POST['table_avaries_reception_visible']; ?>
    <div class="container-fluid" class="" id="avaries_receptions" <?php if($table_avaries_reception_visible==0){

 ?> style="display: none;" <?php } ?>  <?php if($table_avaries_reception_visible==1){

 ?> style="display: block;" <?php } ?> >
      <div class="row">
<?php $selectid_dis=bouton_avaries($bdd,$produit,$poids_sac,$navire,$destination);
if($afdis=$selectid_dis->fetch()){ ?>
  <div class="col-md-12 col-lg-12">      
<a  class="btn1"  style="background: rgb(65,180,190); " data-role="situation_reception" data-id="<?php echo $afdis['id'] ?>" data-navire="<?php echo $afdis['id_navire'] ?>"
data-declaration="<?php echo $afdis['id_declaration'] ?>" data-destination="<?php echo $afdis['id_destination'];  ?>"  data-produit="<?php echo $afdis['id_produit'] ?>" data-poids_sac="<?php echo $afdis['poids_sac'] ?>"  >AJOUTER AVARIES  </a>


<span style="display: none;" id="poids_sac_avr" ><?php echo $afdis['poids_sac'] ?></span>
<span style="display: none;" id="id_produit_avr" ><?php echo $afdis['id_produit'] ?></span>
<span style="display: none;" id="id_destination_avr" ><?php echo $afdis['id_destination'] ?></span>
<span style="display: none;" id="id_navire_avr" ><?php echo $afdis['id_navire'] ?></span>
<span style="display: none;" id="id_declaration_avr" ><?php echo $afdis['id_declaration'] ?></span>

</div>
<?php } ?>

<div class="col-md-12 col-lg-12">

 <div class="table-responsive" border=1>
<?php 
 ?>


  <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >

    

 <thead style="background:  rgb(65,180,190);">
      <td  class="titreAVR" colspan="5"  >AVARIES DE RECEPTION</td>  
    
   
    
    <tr  style="background: linear-gradient(to bottom, #FFFFFF, rgb(65,180,174)); text-align: center; color: white; font-weight: bold;"  >
      
      <td id="mytd" scope="col"   >DATES</td>
     
     

      <td id="mytd" scope="col"  >SACS FLASQUES</td>
      <td id="mytd" scope="col"  >SACS MOUILLES</td>
      <td id="mytd" scope="col"  >TOTAL AVARIES</td>
      
       <td id="mytd"  scope="col"  >ACTIONS</td>
     </tr>
    
     </thead>

<tbody> 
<?php affichage_avaries($bdd,$produit,$poids_sac,$navire,$destination); ?>
 </tbody>
</table>
</div>
</div>
</div>
</div>

