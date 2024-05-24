<?php 
require("../database.php");
require('../reception/controller/stock_depart.php');
require("controller/control_excedent.php");
require("controller/control_choix_des_excedents.php");
require('controller/afficher_les_livraisons.php');

  $poids_sac=$_POST['poids_sac'];
  $produit=$_POST['produit'];
  $id_dis=$_POST['id_dis'];
  $c=$id_dis;
  $navire=$_POST['navire'];
  $destination=$_POST['destination'];
  $relache_null=0;

$cherche_relache=relache_ou_non($bdd,$produit,$poids_sac,$navire,$destination);
$ch=$cherche_relache->fetch();
 
 echo $destination;


if(!empty($ch['banque']) AND  (!empty($_POST['sac']) AND !empty($_POST['date']) AND !empty($_POST['bl_fournisseur']) AND !empty($_POST['heure']) AND !empty($_POST['camion']) AND !empty($_POST['chauf']) AND !empty($_POST['permis']) AND !empty($_POST['tel']) AND !empty($_POST['dec']) AND !empty($_POST['rel']) ) OR empty($ch['banque']) AND  (!empty($_POST['sac']) AND !empty($_POST['date']) AND !empty($_POST['bl_fournisseur']) AND !empty($_POST['heure']) AND !empty($_POST['camion']) AND !empty($_POST['chauf']) AND !empty($_POST['permis']) AND !empty($_POST['tel']) AND !empty($_POST['dec']) ) )  {
  $date=$_POST['date'];
  $bl_fournisseur=$_POST['bl_fournisseur'];
  $heure=$_POST['heure'];
  $camion=$_POST['camion'];
  $chauf=$_POST['chauf'];
  $permis=$_POST['permis'];
  $tel=$_POST['tel'];
  $dec=$_POST['dec'];
  $bl_fictif=1;
  if(!empty($ch['banque'])){
   $rel=$_POST['rel']; 
  

  }
    if(empty($ch['banque'])){
   $rel=0; 
  }

 
// $identifier=identifier_type_relache($bdd,$rel);
 //  $identif=$identifier->fetch();
 
  
  $sac=$_POST['sac'];
 // $bl_simar=$_POST['bl_simar'];

  $poids=$sac*$poids_sac/1000;

   $poids_declaration=poids_declaration($bdd,$dec);
   $poids_relache=poids_relache($bdd,$rel);
   $poids_bl_fournisseur=poids_bl_fournisseur($bdd,$bl_fournisseur);

   $poids_livraison_sain=poids_livraison_sain($bdd,$dec);
   $poids_livraison_mouille=poids_livraison_mouille($bdd,$dec);
   $poids_livraison_balayure=poids_livraison_balayure($bdd,$dec);


   if(!empty($ch['banque'])){
    //and $identif['num_rel']!='depassement' )
   

   $poids_rel_livraison_sain=poids_rel_livraison_sain($bdd,$rel);
   $poids_rel_livraison_mouille=poids_rel_livraison_mouille($bdd,$rel);
   $poids_rel_livraison_balayure=poids_rel_livraison_balayure($bdd,$rel);
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
          $poids_rel=$poids_relache->fetch();
           $poids_rel_liv_sain=$poids_rel_livraison_sain->fetch();
           $poids_rel_liv_mouille=$poids_rel_livraison_mouille->fetch();
           $poids_rel_liv_balayure=$poids_rel_livraison_balayure->fetch();
         }

          $poids_bl_liv_sain=$poids_bl_livraison_sain->fetch();
           $poids_bl_liv_mouille=$poids_bl_livraison_mouille->fetch();
           $poids_bl_liv_balayure=$poids_bl_livraison_balayure->fetch();

         // $v_dec2=$verifier_dec2->fetch();
         if(!empty($ch['banque']) ){
          $excedent_relache=$poids_rel['quantite_dispath'] - $poids_rel_liv_sain['sum(poids_liv)'] - $poids_rel_liv_mouille['sum(poids_mo)'] - $poids_rel_liv_balayure['sum(poids_bal)'] - $poids;
        }
   
           $excedent_declaration=$poids_dec['poids_decliv']- $poids - $poids_liv_sain['sum(poids_liv)'] - $poids_liv_mouille['sum(poids_mo)'] - $poids_liv_balayure['sum(poids_bal)'];

           $excedent_bon=$poids_bl['poids_enleve'] - $poids_bl_liv_sain['sum(poids_liv)'] - $poids_bl_liv_mouille['sum(poids_mo)'] - $poids_bl_liv_balayure['sum(poids_bal)']  - $poids;
        }
        if(empty($excedent_relache)){
          $excedent_relache=0;
        }

        if(!empty($ch['banque']) AND ($excedent_relache>0 AND $excedent_declaration>0 AND $excedent_bon>0  )   OR empty($ch['banque']) AND ($excedent_declaration>0 AND $excedent_bon>0) ) {

	$insert=$bdd->prepare("INSERT INTO livraison_mouille(date_mo,heure_mo,bl_fournisseur_mo,camion_mo,chauffeur_mo,tel_mo,num_permis_mo,dec_mo,relache_mo,sac_mo,poids_mo,poids_sac_mo,id_produit_mo,id_dis_mo,id_navire_mo,bl_simar_mo) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	$insert->bindParam(1,$date);
	$insert->bindParam(2,$heure);
	$insert->bindParam(3,$bl_fournisseur);
	$insert->bindParam(4,$camion);
	$insert->bindParam(5,$chauf);
	$insert->bindParam(6,$tel);
	$insert->bindParam(7,$permis);
	$insert->bindParam(8,$dec);
	$insert->bindParam(9,$rel);
	$insert->bindParam(10,$sac);
	$insert->bindParam(11,$poids);
	$insert->bindParam(12,$poids_sac);
	$insert->bindParam(13,$produit);
	$insert->bindParam(14,$excedent_relache);
	$insert->bindParam(15,$navire);
  $insert->bindParam(16,$bl_fictif);
	$insert->execute();

  }
}

  require("requete.php");

  $infos=$bdd->prepare("SELECT dis.poids_kg, p.*, mg.mangasin, nav.navire, nav.type,cli.client
         from dispatching as dis
         inner join produit_deb as p on p.id=dis.id_produit
         inner join navire_deb as nav on nav.id=dis.id_navire
         inner join mangasin as mg on mg.id=dis.id_mangasin
         inner join client as cli on cli.id=dis.id_client
         where dis.id_dis=?
         ");
        $infos->bindParam(1,$c);
        $infos->execute();



 ?>


 <div class="container-fluid" class="" id="TableMouille"  >
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


      
<?php  
if(empty($_POST['sac']) OR empty($_POST['date']) OR empty($_POST['bl_fournisseur']) OR empty($_POST['heure']) OR empty($_POST['camion']) OR empty($_POST['chauf']) OR empty($_POST['permis']) OR empty($_POST['tel']) OR empty($_POST['dec']) OR (empty($_POST['rel']) and !empty($ch['banque'])) ){

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
<?php if(empty($_POST['rel'])){ ?>
 <h5 id="perreur"> Veuillez choisir une relache    </span> </h5><br>
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
          if(!empty($ch['banque']) AND (!empty($excedent_relache) AND !empty($excedent_declaration) AND !empty($excedent_bon)   )   OR empty($ch['banque']) AND (!empty($excedent_declaration) AND !empty($excedent_bon)) ) {
           if( $excedent_declaration<0 or $excedent_bon<0 or ($excedent_relache<0 and !empty($ch['banque'])  ) ){ 
          
 ?>
     <center> <div >
         <i class="fas fa-error"></i>
         
       </div>
     </center>
<center><div  class="err" id="LesErreurs" ><a  type="button" class="btn-close"  id="close_erreur" data-role="fermer" ></a>
  
  <h3 id="alerte_excedent"><i class="fa fa-bell" style="color: blue;"> </i> ALERTE SUR LES DEPASSEMENTS</h3>
  <h3 id="perreur" > ERREUR</h3>

  <?php if($excedent_relache<0 and !empty($ch['banque'])){ 
   $nom_relache_exces=$bdd->prepare("SELECT nr.*,dr.* from dispatching_relache as dr
   inner join numero_relache as nr on nr.id_relache=dr.id_relache where dr.id_relache=?");
     $nom_relache_exces->bindParam(1,$rel);
     $nom_relache_exces->execute();

    ?>

 <h5 id="p_erreur"> IL Y'A DEPASSEMENT AU NIVEAU DE LA RELACHE DE <span style="color: red;">  <?php if($le_nom_dec=$nom_relache_exces->fetch()){  echo $le_nom_dec['num_relache']; } ?></span> de <span style="color:blue; ">   <?php  echo $excedent_relache.' TONNES';   ?> </span> </h5> <?php } ?>

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

 <h5 id="p_erreur"> IL Y'A DEPASSEMENT AU NIVEAU DU BON D'ENLEVEMENT DE <span style="color: red;">  <?php if($le_nom_bon=$nom_bon_exces->fetch()){  echo $le_nom_bon['num_enleve']; } ?></span> de <span style="color:blue; ">   <?php  echo $excedent_bon.' TONNES';   ?> </span> </h5> <?php } ?>

  </div></center>
<?php } } ?>

<br><br>

<div class="col-md-12 col-lg-12">      
<?php  $res4=res4($bdd,$produit,$poids_sac,$navire,$destination);
   if($find=$res4->fetch()){ ?>     
<a  class="btn1"  style="background:rgb(0,162,232);" data-roles="afficher_formulaire_liv_mouille" data-produit="<?php echo $find['id_produit']; ?>" data-poids_sac="<?php echo $find['poids_kg']; ?>" data-navire="<?php echo $find['id_navire']; ?>" data-destination="<?php echo $find['id_mangasin']; ?>" >AJOUTER LIVRAISON MOUILLE  </a>
<?php   } ?>
<br><br>
</div>
<div class="col-md-12 col-lg-12">

 <div class="table-responsive" border=1>



  <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >

    

 <thead style="background:rgb(0,162,232);">
      <td  class="titreAVR" colspan="11"  >LIVRAISON DES MOUILLES</td> 
  
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
      
      <td id="mytd" scope="col"   >DATE</td>
      <td id="mytd" scope="col" > HEURE</td>
      <td id="mytd" scope="col"  >N° DECLARATION</td>
      <td id="mytd" scope="col"  >N° RELACHE</td>
      <td id="mytd" scope="col"  >BL SIMAR</td>
      <td id="mytd" scope="col"  >BL FOURNISSEUR</td>
      <td id="mytd" scope="col"  >CAMION</td>
      <td id="mytd" scope="col"  >CHAUFFEUR</td>
      <td id="mytd" scope="col"  >SAC</td>
      <td id="mytd" scope="col"  >POIDS</td>
       <td id="mytd" scope="col"  >ACTIONS</td>
      

  
     </tr>
     
    
     </thead>

<tbody> 
  <?php affichage_livraison_mouille($bdd,$produit,$poids_sac,$navire,$destination); ?>
 

 </tbody>
</table>
</div>
</div>
</div>
</div>
