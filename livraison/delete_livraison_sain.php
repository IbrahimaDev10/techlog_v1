<?php 
require("../database.php");
require("controller/control_excedent.php");
require("controller/control_choix_des_excedents.php");
require('../reception/controller/stock_depart.php');
require('controller/afficher_les_livraisons.php');

require("requete.php");

 
  $id=$_POST['delete_id'];
  $c=$_POST['dis_bl'];

    $produit=$_POST['id_produit'];
  $poids_sac=$_POST['poids_sac'];
  $navire=$_POST['id_navire'];
  $destination=$_POST['id_destination'];
 
 $delete=$bdd->prepare("DELETE FROM  livraison_sain WHERE id_liv=? ");
  $delete->bindParam(1,$id);
 
  
  $delete->execute();  
     
  echo $produit;
   echo $poids_sac;
  echo $navire;
  echo $destination;

 

   

 ?>

  

 
  <div class="container-fluid" class="" id="TableLivraison"  >
      <div class="row">

          <div class="container-fluid" id="div_recap" >
        <div class="row">
          <center>  
        
<?php
 /* $TotalLivresMo=total_livraison_mouille($bdd,$c);
  $Sains_Recap=sain_reception($bdd,$c);
$SomAvr_DEPART_Recap=avaries_reception($bdd,$c);
$SomRa_DEPART_Recap=reception_avaries_reception($bdd,$c);
$TotalLivresL=total_livraison_sain($bdd,$c);

$recond_DEPART_Recap=reconditionnement_reception($bdd,$c);
$recond_LIV=reconditionnement_livraison($bdd,$c);

$TLivresMo=$TotalLivresMo->fetch();


 while($sain=$Sains_Recap->fetch()){
    $avr=$SomAvr_DEPART_Recap->fetch();
    

$rec=$recond_DEPART_Recap->fetch();
$rec_liv=$recond_LIV->fetch();


  $SomRa_DEPART_Recap->execute();

  $ra=$SomRa_DEPART_Recap->fetch();

  $TLivres=$TotalLivresL->fetch();
 

$poidsf_avr=$avr['sum(sac_flasque_avr)']*$sain['poids_sac_recep']/1000;
$SacSain=$sain['sum(sac_recep)']-$avr['sum(sac_flasque_avr)']-$avr['sum(sac_mouille_avr)'];
$poidsSain=$SacSain*$sain['poids_sac_recep']/1000;
$poidsflasque=$poidsf_avr+$ra['sum(poids_flasque_ra)'];
$SacMouille=$avr['sum(sac_mouille_avr)']+$ra['sum(sac_mouille_ra)'];
$poidsMouille=$SacMouille*$sain['poids_sac_recep']/1000;
$perte=$rec['sum(sac_eventres)']-$rec['sum(sac_av_recond)']-$rec['sum(sac_balayure_recond)'];

$total_sac=$SacSain+$SacMouille+$avr['sum(sac_flasque_avr)']+$avr['sum(sac_mouille_avr)']+$ra['sum(sac_flasque_ra)']+$ra['sum(sac_mouille_ra)']-$perte;
$total_poids=$poidsSain+$poidsMouille+$rec['sum(poids_balayure_recond)'];*/

 ?>


  </center>
  <?php afficher_stock_depart_livraison($bdd,$produit,$poids_sac,$navire,$destination); ?>



          
          
<?php 
/*
$perte_sac=$rec_liv['sum(sac_eventres_liv)']-$rec_liv['sum(sac_av_recond_liv)']-$rec_liv['sum(sac_balayure_recond_liv)'];
$perte_poids=$rec_liv['sum(poids_balayure_recond_liv)'];
$sac_reste_livrer=$total_sac-$TLivres['sum(sac_liv)']-$TLivresMo['sum(sac_mo)']-$perte_sac;
$poids_reste_livrer=$total_poids-$TLivres['sum(poids_liv)']-$TLivresMo['sum(poids_mo)'];
$total_sac_livrer=$TLivres['sum(sac_liv)']+$TLivresMo['sum(sac_mo)'];
$total_poids_livrer=$TLivres['sum(poids_liv)']+$TLivresMo['sum(poids_mo)'];
//$total_poids=$poidsSain+$poidsMouille+$rec['sum(poids_balayure_recond)']; */

 ?>
 
<div class="col col-md-6" style="border: solid; border-color: blue;">
  <h3 style="background: black; text-align: center; color: white !important;">RESTE A LIVRER</h3>
  <h6 style="float: right;">SACS SAINS LIVRES: <span style="color: red;"><?php //echo $TLivres['sum(sac_liv)'].' SACS' ?></span> SOIT <span style="color: red;"><?php //echo $TLivres['sum(poids_liv)'].' T' ?></span></h6>
     <h6 style="float: right;">SACS MOUILLES LIVRES: <span style="color: red;"><?php //echo $TLivresMo['sum(sac_mo)'].' SACS' ?></span> SOIT <span style="color: red;"><?php //echo $TLivresMo['sum(poids_mo)'].' T' ?></span></h6>
      <h6 style="float: right;">SACS BALAYURES LIVRES: <span style="color: red;"><?php //echo '0 SACS' ?></span> SOIT <span style="color: red;"><?php //echo '0 T' ?></span></h6>
      <h6 style="float: right;">PERTE SUR RECONDITIONNEMENT: <span style="color: red;"><?php //echo $perte_sac.' SACS' ?></span> SOIT <span style="color: red;"><?php //echo $perte_poids.' T' ?></span></h6>

       <h6 style="background: yellow; float: right;">RESTE A LIVRER: <span style="color: red;"><?php //echo $sac_reste_livrer.' SACS' ?></span> SOIT <span style="color: red;"><?php //echo $poids_reste_livrer.' T' ?></span></h6>

      </div>
    
  </div>
</div>



<?php  //} //FIN DU FETCH ?>


      

<br><br>
<div class="col-md-12 col-lg-12"> 
<?php  $res4=res4($bdd,$produit,$poids_sac,$navire,$destination);
   if($find=$res4->fetch()){ ?>     
<a  class="btn1"  style="background:rgb(0,162,232);" data-roles="afficher_formulaire_liv_sain" data-produit="<?php echo $find['id_produit']; ?>" data-poids_sac="<?php echo $find['poids_kg']; ?>" data-navire="<?php echo $find['id_navire']; ?>" data-destination="<?php echo $find['id_mangasin']; ?>" >AJOUTER LIVRAISON  </a>
<?php   } ?>
<br><br>
</div>
<div class="col-md-12 col-lg-12">

 <div class="table-responsive" border=1>



  <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >


    

 <thead style="background:rgb(0,162,232);">
      <td  class="titreAVR" colspan="11"  >LIVRAISON SAINS</td> 
  
       
  
    <?php $infos=afficher_infos($bdd,$produit,$poids_sac,$navire,$destination);
    while($inf=$infos->fetch()){ 

     ?>
      <tr  style="background:rgb(0,162,232); color: white;  font-size: 12px; vertical-align: middle; border: none;"   >
     <td class="no_border"  colspan="2">NAVIRE: <span id="lesInfos"> <?php echo $inf['navire']; ?></span></td>
      <td class="no_border" colspan="2">TYPE:<span id="lesInfos"> <?php echo $inf['type']; ?></span></td>
      <td class="no_border" colspan="4">PRODUIT:<span id="lesInfos"> <?php echo $inf['produit']; ?> <?php echo $inf['qualite']; ?> </span></td>
        <td class="no_border" colspan="3">CONDITIONNEMENT:<span id="lesInfos"> <?php echo $inf['poids_kg'].' KG';; ?></span></td>
        </tr>
        <tr  style="background:rgb(0,162,232); color: white; border-color: black; font-size: 12px; vertical-align: middle;"   >
         <td class="no_border" colspan="2">ENTREPOT:<span id="lesInfos"> <?php echo $inf['mangasin']; ?></span></td>
          <td class="no_border" colspan="3">RECEPTIONNAIRE:<span id="lesInfos"> <?php echo $inf['client']; ?></span></td>
           <td class="no_border" colspan="6"></td>
        </tr>
<?php } ?>


        
    
    <tr  style="background:rgb(0,162,232); text-align: center; color: white; font-weight: bold;"  >
      
      <td class="colaffiches" scope="col"   >DATE</td>
      <td class="colaffiches" scope="col" > HEURE</td>
      <td class="colaffiches" scope="col"  >N° DECLARATION</td>
      <td class="colaffiches"  >N° RELACHE</td>
      <td class="colaffiches"  >BL SIMAR</td>
      <td class="colaffiches"  >BL FOURNISSEUR</td>
      <td class="colaffiches"  >CAMION</td>
      <td class="colaffiches"  >CHAUFFEUR</td>
      <td class="colaffiches"  >SAC</td>
      <td class="colaffiches"  >POIDS</td>
      <td class="colaffiches"  >ACTIONS</td>
      

  
     </tr>
     
    
     </thead>

<tbody> 
  <?php affichage_livraison_sain($bdd,$produit,$poids_sac,$navire,$destination); ?>
   

 </tbody>
</table>
</div>
</div>
</div>
</div>


