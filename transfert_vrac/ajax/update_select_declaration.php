<?php 
require('../../database.php');
require('../controller/afficher_les_debarquements.php');
$navire=$_POST['navire'];
$produit=$_POST['produit'];
$poids_sac=$_POST['poids_sac'];
$destination=$_POST['destination']; 
$client=$_POST['client']; 

$type_de_navire=type_de_navire($bdd,$navire);

    $type_navire_deb=$type_de_navire->fetch();

?>
<select class="inputselect" name="declaration"  style="height: 30px;" id="declarationsain">
    <option  value="" > choisir une declaration </option>
    <?php

        if($type_navire_deb['type']=='SACHERIE'){  $resdes=declaration($bdd,$produit,$poids_sac,$navire,$destination);
             } 
              if($type_navire_deb['type']=='VRAQUIER'){  $resdes=declaration_vrac($bdd,$produit,$poids_sac,$navire,$destination,$client);
             }  
     while($dec=$resdes->fetch()){ 
     $id_declaration=$dec['id_declaration'];
     if($type_navire_deb['type']=='SACHERIE'){
     $suivi_dec_select=suivi_declaration_select($bdd,$produit,$poids_sac,$navire,$destination,$id_declaration);
     }
     if($type_navire_deb['type']=='VRAQUIER'){
     $suivi_dec_select=suivi_declaration_select_vrac($bdd,$produit,$poids_sac,$navire,$destination,$id_declaration,$client);
     }

     $suivi=$suivi_dec_select->fetch();
     $restant=$suivi['poids']-$suivi['sum(td.poids)'];  ?> 

    <option  class="restant_noir" value=<?php  echo $dec['id_declaration']; if($restant<=0){ ?> disabled='true' <?php } ?>  >  <?php  echo $dec['num_declaration']; ?> <?php if($restant<=0){ ?> (soldé) <?php } ?> <option class="restant" disabled='true' > (reste sur declaration= <?php echo number_format($restant, 3,',',' ').' T';   ?>)</option> </option>  
   <?php } ?>
    </select>