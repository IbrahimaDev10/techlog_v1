<?php 
require("../database.php");

require("controller/control_excedent.php");
require("controller/control_choix_des_excedents.php");
require('../reception/controller/stock_depart.php');
require('controller/afficher_les_livraisons.php');

require('requete.php');

 $id=$_POST['id'];
  $id_dis=$_POST['id_dis'];
  $c=$id_dis;
  $produit=$_POST['id_produit'];
  $poids_sac=$_POST['poids_sac'];
  $navire=$_POST['id_navire'];
  $destination=$_POST['id_destination'];

 /* $select_kg=$bdd->prepare("SELECT poids_kg from dispat where id_dis=?");
  $select_kg->bindParam(1,$c);
  $select_kg->execute();
  $poids=0; */
 // if($kg=$select_kg->fetch()){
	$poids=$_POST['sac']*$poids_sac/1000;
//}

if(/*!empty($_POST['sac']) AND */ !empty($_POST['date']) /* AND !empty($_POST['bl_fournisseur']) AND !empty($_POST['heure']) AND !empty($_POST['camion']) AND !empty($_POST['chauf'])  AND !empty($_POST['dec']) AND !empty($_POST['rel']) */ ){
	$date=$_POST['date'];
	$bl_fournisseur=$_POST['bl_fournisseur'];
	$heure=$_POST['heure'];
	$camion=$_POST['camion'];
	$chauf=$_POST['chauf'];
	//$permis=$_POST['permis'];
	//$tel=$_POST['tel'];
	$dec=$_POST['dec'];
	$rel=$_POST['rel'];
	$sac=$_POST['sac'];


   $poids_declaration=poids_declaration($bdd,$dec);
   $poids_relache=poids_relache($bdd,$rel);
   $poids_bl_fournisseur=poids_bl_fournisseur($bdd,$bl_fournisseur);

   $poids_livraison_sain=poids_livraison_sain($bdd,$dec);
   $poids_livraison_mouille=poids_livraison_mouille($bdd,$dec);
   $poids_livraison_balayure=poids_livraison_balayure($bdd,$dec);

   $poids_rel_livraison_sain=poids_rel_livraison_sain($bdd,$rel);
   $poids_rel_livraison_mouille=poids_rel_livraison_mouille($bdd,$rel);
   $poids_rel_livraison_balayure=poids_rel_livraison_balayure($bdd,$rel);

    $poids_bl_livraison_sain=poids_bl_livraison_sain($bdd,$bl_fournisseur);
   $poids_bl_livraison_mouille=poids_bl_livraison_mouille($bdd,$bl_fournisseur);
   $poids_bl_livraison_balayure=poids_bl_livraison_balayure($bdd,$bl_fournisseur);


      
        while($poids_rel=$poids_relache->fetch()){
         // $v_rel2=$verifier_rel2->fetch();
          $poids_dec=$poids_declaration->fetch();
          $poids_bl=$poids_bl_fournisseur->fetch();

          $poids_liv_sain=$poids_livraison_sain->fetch();
           $poids_liv_mouille=$poids_livraison_mouille->fetch();
           $poids_liv_balayure=$poids_livraison_balayure->fetch();

           $poids_rel_liv_sain=$poids_rel_livraison_sain->fetch();
           $poids_rel_liv_mouille=$poids_rel_livraison_mouille->fetch();
           $poids_rel_liv_balayure=$poids_rel_livraison_balayure->fetch();

          $poids_bl_liv_sain=$poids_bl_livraison_sain->fetch();
           $poids_bl_liv_mouille=$poids_bl_livraison_mouille->fetch();
           $poids_bl_liv_balayure=$poids_bl_livraison_balayure->fetch();

         // $v_dec2=$verifier_dec2->fetch();
         
          $excedent_relache=$poids_rel['quantite'] - $poids_rel_liv_sain['sum(poids_liv)'] - $poids_rel_liv_mouille['sum(poids_mo)'] - $poids_rel_liv_balayure['sum(poids_bal)'] - $poids;

           $excedent_declaration=$poids_dec['poids_decliv']- $poids - $poids_liv_sain['sum(poids_liv)'] - $poids_liv_mouille['sum(poids_mo)'] - $poids_liv_balayure['sum(poids_bal)'];

           $excedent_bon=$poids_bl['poids_enleve'] - $poids_bl_liv_sain['sum(poids_liv)'] - $poids_bl_liv_mouille['sum(poids_mo)'] - $poids_bl_liv_balayure['sum(poids_bal)']  - $poids;
        }

      //  if($excedent_relache>0 AND $excedent_declaration>0 AND $excedent_bon>0){

	$insert=$bdd->prepare("UPDATE  livraison_sain set date_liv=? , heure_liv=? , bl_fournisseur_liv=? , camion_liv=? , chauffeur_liv=? , dec_liv=? , relache_liv=? , sac_liv=? , poids_liv=? where id_liv=? ");
	$insert->bindParam(1,$date);
	$insert->bindParam(2,$heure);
	$insert->bindParam(3,$bl_fournisseur);
	$insert->bindParam(4,$camion);
	$insert->bindParam(5,$chauf);

	$insert->bindParam(6,$dec);
	$insert->bindParam(7,$rel);
	$insert->bindParam(8,$sac);
	$insert->bindParam(9,$poids);
	$insert->bindParam(10,$id);
	
	$insert->execute();
//}
}


echo $excedent_relache;
echo $poids;
echo $bl_fournisseur;
echo $dec;
echo $rel;

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

