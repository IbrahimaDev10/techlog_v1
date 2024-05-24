<?php 
require("../database.php");
require('../reception/controller/stock_depart.php');
require("controller/control_excedent.php");
require("controller/control_choix_des_excedents.php");
require('controller/afficher_les_livraisons.php');
require('controller/automatisation_des_relaches.php');

  $poids_sac=$_POST['poids_sac'];
  $produit=$_POST['id_produit'];
  $id_dis=$_POST['id_dis'];
  $c=$id_dis;
  $navire=$_POST['navire'];
  $destination=$_POST['destination'];
  //$relache_null=0;
   $statut=$_POST['statut'];

$cherche_relache=relache_ou_non($bdd,$produit,$poids_sac,$navire,$destination);
$ch=$cherche_relache->fetch();
 
 echo $destination;


if(/*!empty($ch['banque'])*/!empty($_POST['sac']) AND !empty($_POST['date']) AND !empty($_POST['bl_fournisseur']) AND !empty($_POST['heure']) AND !empty($_POST['camion']) AND !empty($_POST['chauf']) AND !empty($_POST['permis']) AND !empty($_POST['tel']) AND !empty($_POST['dec'])  )   {
	$date=$_POST['date'];
	$bl_fournisseur=$_POST['bl_fournisseur'];
	$heure=$_POST['heure'];
	$camion=$_POST['camion'];
	$chauf=$_POST['chauf'];
	$permis=$_POST['permis'];
	$tel=$_POST['tel'];
	$dec=$_POST['dec'];
  $bl_fictif=1;
  $bl_simar=$_POST['bl_simar'];
   $sac=$_POST['sac'];
   $id_bon=$_POST['bl_fournisseur'];

  //$destination_livraison=strtoupper($_POST['destination_livraison']);
  if(!empty($ch['banque'])){
   //$rel=$_POST['rel']; 
  

  }
    if(empty($ch['banque'])){
   //$rel=-1; 
  }

 
// $identifier=identifier_type_relache($bdd,$rel);
 //  $identif=$identifier->fetch();
 
	

 // $bl_simar=$_POST['bl_simar'];

	$poids=$sac*$poids_sac/1000;

   $poids_declaration=poids_declaration($bdd,$dec);
   //$poids_relache=poids_relache($bdd,$rel);
   $poids_bl_fournisseur=poids_bl_fournisseur($bdd,$bl_fournisseur);

   $poids_livraison_sain=poids_livraison_sain($bdd,$dec);
   $poids_livraison_mouille=poids_livraison_mouille($bdd,$dec);
   $poids_livraison_balayure=poids_livraison_balayure($bdd,$dec);


   if(!empty($ch['banque'])){
    //and $identif['num_rel']!='depassement' )
   
  // $statu=statu_relache($bdd,$rel);
  /* $poids_rel_livraison_sain=poids_rel_livraison_sain($bdd,$rel);
   $poids_rel_livraison_mouille=poids_rel_livraison_mouille($bdd,$rel);
   $poids_rel_livraison_balayure=poids_rel_livraison_balayure($bdd,$rel); */
   }



    $poids_bl_livraison_sain=poids_bl_livraison_sain($bdd,$bl_fournisseur);
   $poids_bl_livraison_mouille=poids_bl_livraison_mouille($bdd,$bl_fournisseur);
   $poids_bl_livraison_balayure=poids_bl_livraison_balayure($bdd,$bl_fournisseur);


      
        while($poids_bl=$poids_bl_fournisseur->fetch()){
         // $v_rel2=$verifier_rel2->fetch();
          $poids_dec=$poids_declaration->fetch();
         // $poids_bl=$poids_bl_fournisseur->fetch();

          $poids_liv_sain=$poids_livraison_sain->fetch();
           $poids_liv_mouille=$poids_livraison_mouille->fetch();
           $poids_liv_balayure=$poids_livraison_balayure->fetch();

       if(!empty($ch['banque'])  ){
          /*$poids_rel=$poids_relache->fetch();
           $poids_rel_liv_sain=$poids_rel_livraison_sain->fetch();
           $poids_rel_liv_mouille=$poids_rel_livraison_mouille->fetch();
           $poids_rel_liv_balayure=$poids_rel_livraison_balayure->fetch();
           $status=$statu->fetch(); */
         }

          $poids_bl_liv_sain=$poids_bl_livraison_sain->fetch();
           $poids_bl_liv_mouille=$poids_bl_livraison_mouille->fetch();
           $poids_bl_liv_balayure=$poids_bl_livraison_balayure->fetch();

         // $v_dec2=$verifier_dec2->fetch();
         if(!empty($ch['banque']) ){
        /*  $excedent_relache=$poids_rel['quantite'] - $poids_rel_liv_sain['sum(poids_liv)'] - $poids_rel_liv_mouille['sum(poids_mo)'] - $poids_rel_liv_balayure['sum(poids_bal)'] - $poids;
          $statu_du_relache=$status['status']; */
        }
   
           $excedent_declaration=$poids_dec['poids_decliv']- $poids - $poids_liv_sain['sum(poids_liv)'] - $poids_liv_mouille['sum(poids_liv)'] - $poids_liv_balayure['sum(poids_liv)'];

           $excedent_bon=$poids_bl['quantite'] - $poids_bl_liv_sain['sum(poids_liv)'] - $poids_bl_liv_mouille['sum(poids_liv)'] - $poids_bl_liv_balayure['sum(poids_liv)']  - $poids;
        }
      /*  if(empty($excedent_relache)){
          $excedent_relache=0;
        } */

        if( $excedent_declaration>=0 AND $excedent_bon>=0   )   {

	$insert=$bdd->prepare("INSERT INTO livraison_sain(date_liv,heure_liv,bl_fournisseur_liv,camion_liv,chauffeur_liv,tel_liv,num_permis_liv,dec_liv,sac_liv,poids_liv,poids_sac_liv,id_produit_liv,id_dis_liv,id_navire_liv,bl_simar,statut) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	$insert->bindParam(1,$date);
	$insert->bindParam(2,$heure);
	$insert->bindParam(3,$bl_fournisseur);
	$insert->bindParam(4,$camion);
	$insert->bindParam(5,$chauf);
	$insert->bindParam(6,$tel);
	$insert->bindParam(7,$permis);
	$insert->bindParam(8,$dec);
//	$insert->bindParam(9,$rel);
	$insert->bindParam(9,$sac);
	$insert->bindParam(10,$poids);
	$insert->bindParam(11,$poids_sac);
	$insert->bindParam(12,$produit);
	$insert->bindParam(13,$navire);
	$insert->bindParam(14,$navire);
  $insert->bindParam(15,$bl_simar);
  $insert->bindParam(16,$statut);

 
	$insert->execute();

   $dernier=dernier_enregistrement($bdd,$id_bon);
   $derniers=$dernier->fetch();
   $id_liv=$derniers['id_liv'];
   $poids_relacher=$derniers['poids_liv'];

 $verif_rel= verifier_etat_relache($bdd,$id_bon);
 $vr=$verif_rel->fetch();
 if($vr['count(bn.id_bon)']==0){
  $affiche=Etat_relache_exact($bdd,$produit,$poids_sac,$navire,$destination,$id_bon);
  $affiches=$affiche->fetch();
  if($affiches){

    $id_bon_relache=$affiches['id_bon_relache'];

  /*  $qr=quantite_relacher($bdd,$id_bon_relache);
    $qrs=$qr->fetch(); */

    $quantite_restant=$affiches['quantite_relache_init']-$poids_relacher;
    $dette=0;

    $insert_relache=$bdd->prepare("INSERT INTO etat_relache(bon_relache_id,id_liv,quantite_relacher,quantite_dette,restant_relache) VALUES(?,?,?,?,?) ");
    $insert_relache->bindParam(1,$id_bon_relache);
  
    $insert_relache->bindParam(2,$id_liv);
    $insert_relache->bindParam(3,$poids_relacher);
    $insert_relache->bindParam(4,$dette);
    $insert_relache->bindParam(5,$quantite_restant);
    
    $insert_relache->execute();
  }
 }
  if($vr['count(bn.id_bon)']>0){
   $verif_rel2= verifier_etat_Plusieurs($bdd,$produit,$poids_sac,$navire,$destination,$id_bon);
   $find_relache=$verif_rel2->fetch();
   $id_bon_relache=$find_relache['id_bon_relache'];
    $quantite_restant=$find_relache['restant_relache']-$poids_relacher;
    $dette=0;
    if($quantite_restant==0 or $quantite_restant>0){

     $insert_relache=$bdd->prepare("INSERT INTO etat_relache(bon_relache_id,id_liv,quantite_relacher,quantite_dette,restant_relache) VALUES(?,?,?,?,?) ");
    $insert_relache->bindParam(1,$id_bon_relache);
   
    $insert_relache->bindParam(2,$id_liv);
    $insert_relache->bindParam(3,$poids_relacher);
    $insert_relache->bindParam(4,$dette);
    $insert_relache->bindParam(5,$quantite_restant);
    
    $insert_relache->execute();
  }

   if($quantite_restant<0){
    $verif_rel3=verifier_etat_Second($bdd,$produit,$poids_sac,$navire,$destination,$id_bon,$id_bon_relache);
    $find_relache_second=$verif_rel3->fetch();

    if($find_relache_second){
     $quantite_restant=$find_relache['restant_relache']-$poids_relacher;
    $dette=0;

      $restant_zero=$poids_relacher+ $quantite_restant;
      $zero=0;
      $poids_relacher2=-1*$quantite_restant;
      $quantite_restant2=$find_relache_second['quantite_relache_init']-$poids_relacher2;
      $id_bon_relache=$find_relache['id_bon_relache'];


        $insert_relache=$bdd->prepare("INSERT INTO etat_relache(bon_relache_id,id_liv,quantite_relacher,quantite_dette,restant_relache) VALUES(?,?,?,?,?) ");
    $insert_relache->bindParam(1,$id_bon_relache);
  
    $insert_relache->bindParam(2,$id_liv);
    $insert_relache->bindParam(3,$restant_zero);
    $insert_relache->bindParam(4,$dette);
    $insert_relache->bindParam(5,$zero);
    
    $insert_relache->execute();

      $id_bon_relache=$find_relache_second['id_bon_relache'];



     $insert_relache2=$bdd->prepare("INSERT INTO etat_relache(bon_relache_id, id_liv,quantite_relacher,quantite_dette,restant_relache) VALUES(?,?,?,?,?) ");
    $insert_relache2->bindParam(1,$id_bon_relache);
    
    $insert_relache2->bindParam(2,$id_liv);
    $insert_relache2->bindParam(3,$poids_relacher2);
    $insert_relache2->bindParam(4,$dette);
    $insert_relache2->bindParam(5,$quantite_restant2);
    
    $insert_relache2->execute();

    }



   
  
 }

  }



}
}

  require("requete.php");

 
   

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





<br>
<?php  
if(empty($_POST['sac']) OR empty($_POST['date']) OR empty($_POST['bl_fournisseur']) OR empty($_POST['heure']) OR empty($_POST['camion']) OR empty($_POST['chauf']) OR empty($_POST['permis']) OR empty($_POST['tel']) OR empty($_POST['dec'])  ){

  ?>

  <center><div  class="ers" id="VIDES" ><a  type="button" class="btn-close"  id="close_erreur" data-role="fermerVIDES" ></a><h3 id="perreurVIDES" > ERREUR</h3>
    <?php if(empty($_POST['date'])){ ?>
 <h5 id="perreur"> Veuillez completer la date     </span> </h5><br>
<?php } ?>
    <?php if(empty($_POST['heure'])){ ?>
 <h5 id="perreur"> Veuillez saisir l'heure     </span> </h5><br>
<?php } ?>
<?php if(empty($_POST['sac'])){ ?>
 <h5 id="perreur"> Veuillez saisir sac     </span> </h5><br>
<?php } ?>
<?php if(empty($_POST['dec'])){ ?>
 <h5 id="perreur"> Veuillez choisir une declaration     </span> </h5><br>
<?php } ?>

<?php if(empty($_POST['bl_fournisseur'])){ ?>
 <h5 id="perreur"> Veuillez choisir un bon de fournisseur    </span> </h5><br>
<?php } ?>
<?php if(empty($_POST['camion'])){ ?>
 <h5 id="perreur"> Veuillez choisir un camion     </span> </h5><br>
<?php } ?>
<?php if(empty($_POST['chauf'])){ ?>
 <h5 id="perreur"> Veuillez choisir un chauffeur     </span> </h5><br>
<?php } ?>
<?php if(empty($_POST['permis'])){ ?>
 <h5 id="perreur"> Veuillez choisir un permis     </span> </h5><br>
<?php } ?>

</div>
</center>
<?php } ?>



          <?php
          
           if( $excedent_declaration<0 or $excedent_bon<0  ){ 
          
 ?>
     <center> <div >
         <i class="fas fa-error"></i>
         
       </div>
     </center>
<center><div  class="err" id="LesErreurs" ><a  type="button" class="btn-close"  id="close_erreur" data-role="fermer" ></a>
  
  <h3 id="alerte_excedent"><i class="fa fa-bell" style="color: red;"> </i> ALERTE SUR LES DEPASSEMENTS</h3>
  <h3 id="perreur" > ERREUR</h3>

  <?php /* if($excedent_relache<0 and !empty($ch['banque'])){ 
   $nom_relache_exces=$bdd->prepare("SELECT nr.*,dr.* from dispatching_relache as dr
   inner join numero_relache as nr on nr.id_relache=dr.id_relache where dr.id_relache=?");
     $nom_relache_exces->bindParam(1,$rel);
     $nom_relache_exces->execute(); */

    ?>

 

 <?php if($excedent_declaration<0){ 
   $nom_declaration_exces=$bdd->prepare("SELECT num_decliv from declaration_sortie where id_decliv=?");
     $nom_declaration_exces->bindParam(1,$dec);
     $nom_declaration_exces->execute();

    ?>

 <h5 id="p_erreur"> IL Y'A DEPASSEMENT AU NIVEAU DE LA DECLARATION DE <span style="color: red;">  <?php if($le_nom_dec2=$nom_declaration_exces->fetch()){  echo $le_nom_dec2['num_decliv']; } ?></span> de <span style="color:blue; ">   <?php  echo $excedent_declaration.' TONNES';   ?>  </span> </h5> <?php } ?>

<?php if($excedent_bon<0){ 
   $nom_bon_exces=$bdd->prepare("SELECT num_enleve from bon_enlevement where id_enleve=?");
     $nom_bon_exces->bindParam(1,$bl_fournisseur);
     $nom_bon_exces->execute();

    ?>

 <h5 id="p_erreur"> IL Y'A DEPASSEMENT AU NIVEAU DU BON D'ENLEVEMENT DE <span style="color: red;">  <?php if($le_nom_bon=$nom_bon_exces->fetch()){  echo $le_nom_bon['quantite']; } ?></span> de <span style="color:blue; ">   <?php  echo $excedent_bon.' TONNES';   ?> </span> </h5> <?php } ?>

  </div></center>
<?php }  ?>

<br><br>

<div class="col-md-12 col-lg-12"> 
<?php  $res4=res4($bdd,$produit,$poids_sac,$navire,$destination);
   if($find=$res4->fetch()){ ?>     
<a  class="btn1"  style="background:rgb(0,162,232);" <?php if($statut=='mouille'){ echo "data-roles='afficher_formulaire_liv_mouille'";} 
elseif ($statut=='sain') {
echo "data-roles='afficher_formulaire_liv_sain'";
}
else  {
echo "data-roles='afficher_formulaire_liv_balayure'";
}  ?> data-produit="<?php echo $find['id_produit']; ?>" data-poids_sac="<?php echo $find['poids_kg']; ?>" data-navire="<?php echo $find['id_navire']; ?>" data-destination="<?php echo $find['id_mangasin']; ?>" >AJOUTER LIVRAISON  </a>
<?php   } ?>
<br><br>
</div>
<div class="col-md-12 col-lg-12">

 <div class="table-responsive" border=1>



  <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >


    

 <thead style="background:rgb(0,162,232);">
      <td  class="titreAVR" colspan="11"  > LIVRAISON <?php echo strtoupper($statut).'S'; ?></td> 
  
       
  
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
  <?php affichage_livraison_sain($bdd,$produit,$poids_sac,$navire,$destination,$statut); ?>
   

 




 </tbody>
</table>
</div>
</div>
</div>
</div>
