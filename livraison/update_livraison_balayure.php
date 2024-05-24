<?php 
require("../database.php");
require("controller/control_excedent.php");
require("controller/control_choix_des_excedents.php");

  $id_dis=$_POST['id_dis'];
  $c=$id_dis;
 

  $select_kg=$bdd->prepare("SELECT poids_kg from dispatching where id_dis=?");
  $select_kg->bindParam(1,$c);
  $select_kg->execute();
  $poids=0;
  if($kg=$select_kg->fetch()){
  $poids=$_POST['sac']*$kg['poids_kg']/1000;
}

if(!empty($_POST['sac']) AND !empty($_POST['date']) AND !empty($_POST['bl_fournisseur']) AND !empty($_POST['heure']) AND !empty($_POST['camion']) AND !empty($_POST['chauf'])  AND !empty($_POST['dec']) AND !empty($_POST['rel']) ){
	$date=$_POST['date'];
	$bl_fournisseur=$_POST['bl_fournisseur'];
	$heure=$_POST['heure'];
	$camion=$_POST['camion'];
	$chauf=$_POST['chauf'];

	$dec=$_POST['dec'];
	$rel=$_POST['rel'];
	$sac=$_POST['sac'];
  $id=$_POST['id'];



    $verifier_dec=$bdd->prepare("SELECT dc.*, sum(liv_sain.poids_liv)  from declaration_liv as dc 
          left join livraison_sain as liv_sain on liv_sain.dec_liv=dc.id_decliv
    
         where dc.id_dis_decliv=? and liv_sain.dec_liv=? ");
         $verifier_dec->bindParam(1,$c);
         $verifier_dec->bindParam(2,$dec);
         $verifier_dec->execute();

          $verifier_dec2=$bdd->prepare("SELECT dc.*, sum(liv_mouille.poids_mo)  from declaration_liv as dc 
          left join livraison_mouille as liv_mouille on liv_mouille.dec_mo=dc.id_decliv
    
         where dc.id_dis_decliv=? and liv_mouille.dec_mo=? ");
         $verifier_dec2->bindParam(1,$c);
         $verifier_dec2->bindParam(2,$dec);
         $verifier_dec2->execute();

         $verifier_bon=$bdd->prepare("SELECT bon.*, sum(liv_sain.poids_liv)  from bon_enlevement as bon 
          left join livraison_sain as liv_sain on liv_sain.bl_fournisseur_liv=bon.id_enleve
    
         where bon.id_dis_enleve=? and liv_sain.bl_fournisseur_liv=? ");
         $verifier_bon->bindParam(1,$c);
         $verifier_bon->bindParam(2,$bl_fournisseur);
        $verifier_bon->execute();

                 $verifier_bon2=$bdd->prepare("SELECT bon.*, sum(liv_mouille.poids_mo)  from bon_enlevement as bon 
          left join livraison_mouille as liv_mouille on liv_mouille.bl_fournisseur_mo=bon.id_enleve
    
         where bon.id_dis_enleve=? and liv_mouille.bl_fournisseur_mo=? ");
         $verifier_bon2->bindParam(1,$c);
         $verifier_bon2->bindParam(2,$bl_fournisseur);
        $verifier_bon2->execute();

          $verifier_dec2=$bdd->prepare("SELECT dc.*, sum(liv_mouille.poids_mo)  from declaration_liv as dc 
          left join livraison_mouille as liv_mouille on liv_mouille.dec_mo=dc.id_decliv
    
         where dc.id_dis_decliv=? and liv_mouille.dec_mo=? ");
         $verifier_dec2->bindParam(1,$c);
         $verifier_dec2->bindParam(2,$dec);
         $verifier_dec2->execute();


         $verifier_rel2=$bdd->prepare("SELECT rel.*, sum(liv_mouille.poids_mo)  from relache as rel 
          left join livraison_mouille as liv_mouille on liv_mouille.relache_mo=rel.id_rel
    
         where rel.id_dis_rel=? AND liv_mouille.relache_mo=? ");
        $verifier_rel2->bindParam(1,$c);
        $verifier_rel2->bindParam(2,$rel);
        $verifier_rel2->execute();
 

  $verifier_rel=$bdd->prepare("SELECT rel.*, sum(liv_sain.poids_liv)  from relache as rel 
          left join livraison_sain as liv_sain on liv_sain.relache_liv=rel.id_rel
    
         where rel.id_dis_rel=? and liv_sain.relache_liv=? ");
         $verifier_rel->bindParam(1,$c);
         $verifier_rel->bindParam(2,$rel);
         $verifier_rel->execute();

         $verifier_rel2=$bdd->prepare("SELECT rel.*, sum(liv_mouille.poids_mo)  from relache as rel 
          left join livraison_mouille as liv_mouille on liv_mouille.relache_mo=rel.id_rel
    
         where rel.id_dis_rel=? AND liv_mouille.relache_mo=? ");
        $verifier_rel2->bindParam(1,$c);
        $verifier_rel2->bindParam(2,$rel);
        $verifier_rel2->execute();
        while($v_rel1=$verifier_rel->fetch()){
          $v_rel2=$verifier_rel2->fetch();
          $v_dec1=$verifier_dec->fetch();
          $v_dec2=$verifier_dec2->fetch();
          $v_bon1=$verifier_bon->fetch();
          $v_bon2=$verifier_bon2->fetch();
          $excedent_relache=$v_rel1['poids_rel'] - $v_rel1['sum(liv_sain.poids_liv)'] - $v_rel2['sum(liv_mouille.poids_mo)'] - $poids;

           $excedent_declaration=$v_dec1['poids_decliv'] - $v_dec1['sum(liv_sain.poids_liv)'] - $v_dec2['sum(liv_mouille.poids_mo)'] - $poids;

           $excedent_bon=$v_bon1['poids_enleve'] - $v_bon1['sum(liv_sain.poids_liv)'] - $v_bon2['sum(liv_mouille.poids_mo)'] - $poids;
        }

        if($excedent_relache>0 AND $excedent_declaration>0 AND $excedent_bon>0){

	$insert=$bdd->prepare("UPDATE  livraison_balayure SET date_bal=? , heure_bal=? , bl_fournisseur_bal=? , camion_bal=? , chauffeur_bal=? , dec_bal=?,relache_bal=? , sac_bal=? , poids_bal=?  WHERE id_bal=? ");
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

  

 <div class="container-fluid" class="" id="TableBalayure" >
      <div class="row">

          <div class="container-fluid" id="div_recap" >
        <div class="row">
          <center>  
          <div class="col-lg-12">
             <h3 class="titre_recap" style="color: blue !important! "> RECAPITULATION </h3>  
          </div>
          <div class="col-lg-12">
          <div   class="table-responsive" border=1>
 <table  class='table table-hover table-bordered table-striped'  border='2' style="width: 50%; " id='tabledec1'>
  <thead> 
    <tr> 
    <th id="RecapStockDep" colspan="8"> STOCK DEPART </th> 
    </tr>
       <tr id="EnteteRecapStockDep"> 
    <th  colspan="2"> SAINS </th> 
    <th colspan="2"> MOUILLES </th>
    <th colspan="2"> BALAYURES </th>
    <th colspan="2"> TOTAL </th>
    </tr> 
    <tr id="EnteteRecapStockDep">
    <th> SACS </th> 
    <th> POIDS </th>
    <th> SACS </th> 
    <th> POIDS </th>
    <th> SACS </th> 
    <th> POIDS </th>
    <th> SACS </th> 
    <th> POIDS </th>
    
     </tr>
     </thead>
     <tbody>  
<?php
$TLivresMo=$TotalLivresMo_BAL->fetch();

 while($sain=$Sains_Recap_BAL->fetch()){ 
    $avr=$SomAvr_DEPART_Recap_BAL->fetch();
    

$rec=$recond_DEPART_Recap_BAL->fetch();


  $SomRa_DEPART_Recap_BAL->execute();

  $ra=$SomRa_DEPART_Recap_BAL->fetch();

  $TLivres=$TotalLivresL_BAL->fetch();
 

$poidsf_avr=$avr['sum(sac_flasque_avr)']*$sain['poids_sac_recep']/1000;
$SacSain=$sain['sum(sac_recep)']-$avr['sum(sac_flasque_avr)']-$avr['sum(sac_mouille_avr)']+$rec['sum(sac_av_recond)'];
$poidsSain=$SacSain*$sain['poids_sac_recep']/1000;
$poidsflasque=$poidsf_avr+$ra['sum(poids_flasque_ra)'];
$SacMouille=$avr['sum(sac_mouille_avr)']+$ra['sum(sac_mouille_ra)'];
$poidsMouille=$SacMouille*$sain['poids_sac_recep']/1000;

$total_sac=$SacSain+$SacMouille+$rec['sum(sac_balayure_recond)'];
$total_poids=$poidsSain+$poidsMouille+$rec['sum(poids_balayure_recond)'];

 ?>
 <tr class="celrecap"> 
 <td class="celrecap"> <?php echo number_format($SacSain, 0,',',' '); ?></td>
       <td > <?php echo number_format($poidsSain,3,',',' '); ?></td>
       <td> <?php echo number_format($SacMouille, 0,',',' '); ?></td>
       <td > <?php echo number_format($poidsMouille,3,',',' '); ?></td>
       <td> <?php echo number_format($rec['sum(sac_balayure_recond)'], 0,',',' '); ?></td>
       <td > <?php echo number_format($rec['sum(poids_balayure_recond)'],3,',',' '); ?></td>
       <td> <?php echo number_format($total_sac, 0,',',' '); ?></td>
       <td > <?php echo number_format($total_poids,3,',',' '); ?></td>

       </tr>
     

     </tbody>
    </table>
   </div>
  </div>
  </center>





          <center>  
          <div class="col-lg-12">
             
          </div>
          <div class="col-lg-12">
          <div   class="table-responsive" border=1>
 <table  class='table table-hover table-bordered table-striped'  border='2' style="width: 50%; " id='tabledec1'>
  <thead> 
    <tr> 
    <th id="RecapStockDep" colspan="8"> STOCK RESTANT </th> 
    </tr>
       <tr id="EnteteRecapStockDep"> 
    <th  colspan="4">  LIVRAISON </th> 
    <th rowspan="2" colspan="2"> TOTAL LIVRAISON </th> 
    <th rowspan="2" colspan="2"> RESTE A LIVRER </th>

    </tr> 
        <tr id="EnteteRecapStockDep">
    <th colspan="2"> SAINS </th> 
    <th colspan="2"> MOUILLES </th>
      </tr>
    <tr id="EnteteRecapStockDep">
    <th> SACS </th> 
    <th> POIDS </th>
    <th> SACS </th> 
    <th> POIDS </th>
    <th> SACS </th> 
    <th> POIDS </th>
     <th> SACS </th> 
    <th> POIDS </th>
  
     </tr>
     </thead>
     <tbody>  
<?php 

$sac_reste_livrer=$total_sac-$TLivres['sum(sac_liv)']-$TLivresMo['sum(sac_mo)'];
$poids_reste_livrer=$total_poids-$TLivres['sum(poids_liv)']-$TLivresMo['sum(poids_mo)'];
$total_sac_livrer=$TLivres['sum(sac_liv)']+$TLivresMo['sum(sac_mo)'];
$total_poids_livrer=$TLivres['sum(poids_liv)']+$TLivresMo['sum(poids_mo)'];
//$total_poids=$poidsSain+$poidsMouille+$rec['sum(poids_balayure_recond)'];

 ?>
 <tr class="celrecap"> 
 <td> <?php echo number_format($TLivres['sum(sac_liv)'], 0,',',' '); ?></td>
       <td > <?php echo number_format($TLivres['sum(poids_liv)'],3,',',' '); ?></td>
        <td> <?php echo number_format($TLivresMo['sum(sac_mo)'], 0,',',' '); ?></td>
       <td > <?php echo number_format($TLivresMo['sum(poids_mo)'],3,',',' '); ?></td>
       <td> <?php echo number_format($total_sac_livrer, 0,',',' '); ?></td>
       <td > <?php echo number_format($total_poids_livrer,3,',',' '); ?></td>
       <td> <?php echo number_format($sac_reste_livrer, 0,',',' '); ?></td>
       <td > <?php echo number_format($poids_reste_livrer,3,',',' '); ?></td>
</tr>
     

     </tbody>
    </table>
   </div>
  </div>
  </center>
 </div> 
</div>

<?php  } //FIN DU FETCH ?>



<br>
<?php  
if(empty($_POST['sac']) OR empty($_POST['date']) OR empty($_POST['bl_fournisseur']) OR empty($_POST['heure']) OR empty($_POST['camion']) OR empty($_POST['chauf'])  OR empty($_POST['dec']) OR empty($_POST['rel']) ){

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


</div>
</center>
<?php } ?>



          <?php
          if(!empty($excedent_relache) and !empty($excedent_declaration) and !empty($excedent_bon)){
           if($excedent_relache<0 or $excedent_declaration<0 or $excedent_bon<0){ 
          
 ?>
     <center> <div >
         <i class="fas fa-error"></i>
         
       </div>
     </center>

<center><div  class="err" id="LesErreurs" ><a  type="button" class="btn-close"  id="close_erreur" data-role="fermer" ></a>
  <h3 id="alerte_excedent">ALERTE SUR LES EXCEDENTS</h3>
  <h3 id="perreur" > ERREUR</h3>
  <?php if($excedent_relache<0){ 
   $nom_relache_exces=$bdd->prepare("SELECT num_rel from relache where id_rel=?");
     $nom_relache_exces->bindParam(1,$rel);
     $nom_relache_exces->execute();

    ?>

 <h5 id="p_erreur"> IL Y'A DEPASSEMENT AU NIVEAU DE LA RELACHE DE <span style="color: red;">  <?php if($le_nom_dec=$nom_relache_exces->fetch()){  echo $le_nom_dec['num_rel']; } ?></span> de <span style="color:blue; ">   <?php  echo $excedent_relache.' TONNES';   ?> </span> </h5> <?php } ?>

 <?php if($excedent_declaration<0){ 
   $nom_declaration_exces=$bdd->prepare("SELECT num_decliv from declaration_liv where id_decliv=?");
     $nom_declaration_exces->bindParam(1,$dec);
     $nom_declaration_exces->execute();

    ?>

 <h5 id="p_erreur"> IL Y'A DEPASSEMENT AU NIVEAU DE LA DECLARATION DE <span style="color: red;">  <?php if($le_nom_dec2=$nom_declaration_exces->fetch()){  echo $le_nom_dec2['num_decliv']; } ?></span> de <span style="color:blue; ">   <?php  echo $excedent_declaration.' TONNES';   ?> </span> </h5> <?php } ?>

<?php if($excedent_bon<0){ 
   $nom_bon_exces=$bdd->prepare("SELECT num_enleve from bon_enlevement where id_enleve=?");
     $nom_bon_exces->bindParam(1,$bl_fournisseur);
     $nom_bon_exces->execute();

    ?>

 <h5 id="p_erreur"> IL Y'A DEPASSEMENT AU NIVEAU DU BON D'ENLEVEMENT DE <span style="color: red;">  <?php if($le_nom_bon=$nom_bon_exces->fetch()){  echo $le_nom_bon['num_enleve']; } ?></span> de <span style="color:blue; ">   <?php  echo $excedent_bon.' TONNES';   ?> </span> </h5> <?php } ?>

  </div></center>
<?php } } ?>

<br>
<div class="col-md-12 col-lg-12">      
<a  class="btn1"  style="background: rgb(65,180,190); "data-roles="afficher_formulaire_liv_balayure" data-id=<?php  echo $c; ?>  >AJOUTER LIVRAISON BALAYURE </a>
<br><br>
</div>
<div class="col-md-12 col-lg-12">

 <div class="table-responsive" border=1>



  <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >


    

 <thead style="background:  rgb(65,180,190);">
      <td  class="titreAVR" colspan="11"  >LIVRAISON DES BALAYURES</td> 
  
       
  
    <?php
      
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

     if($inf=$infos->fetch()){

     ?>
      <tr  style="background: rgb(65,180,190); color: white;  font-size: 12px; vertical-align: middle; border: none;"   >
     <td class="no_border"  colspan="2">NAVIRE: <span id="lesInfos"> <?php echo $inf['navire']; ?></span></td>
      <td class="no_border" colspan="2">TYPE:<span id="lesInfos"> <?php echo $inf['type']; ?></span></td>
      <td class="no_border" colspan="4">PRODUIT:<span id="lesInfos"> <?php echo $inf['produit']; ?> <?php echo $inf['qualite']; ?> </span></td>
        <td class="no_border" colspan="3">CONDITIONNEMENT:<span id="lesInfos"> <?php echo $inf['poids_kg'].' KG';; ?></span></td>
        </tr>
        <tr  style="background: rgb(65,180,190); color: white; border-color: black; font-size: 12px; vertical-align: middle;"   >
         <td class="no_border" colspan="2">ENTREPOT:<span id="lesInfos"> <?php echo $inf['mangasin']; ?></span></td>
          <td class="no_border" colspan="2">RECEPTIONNAIRE:<span id="lesInfos"> <?php echo $inf['client']; ?></span></td>
           <td class="no_border" colspan="7"></td>
        </tr>
<?php } ?>

      <?php 

      $affiche = $bdd->prepare("SELECT r.*,d.*, be.*, liv.*, sum(liv.sac_bal),sum(liv.poids_bal)  FROM livraison_balayure as liv 
                
             inner join relache as r on r.id_rel=liv.relache_bal
             inner join declaration_liv as d on d.id_decliv=liv.dec_bal
             inner join bon_enlevement as be on be.id_enleve=liv.bl_fournisseur_bal

                   WHERE liv.id_dis_bal=? group by liv.date_bal, liv.id_bal with rollup ");
        
        
        $affiche->bindParam(1,$c);
        $affiche->execute(); 



       ?>
        
    
    <tr  style="background: linear-gradient(to bottom, #FFFFFF, rgb(65,180,174)); text-align: center; color: white; font-weight: bold;"  >
      
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
      <td> ACTIONS </td>
      

  
     </tr>
     
    
     </thead>

<tbody> 
   <?php while ($aff=$affiche->fetch()){
 if(!empty($aff['date_bal']) and !empty($aff['id_bal'])){
    ?>

<tr style="vertical-align: middle;">
  <td class="colaffiches" id="<?php echo $aff['id_bal'].'date_bal' ?>" ><?php echo $aff['date_bal'] ?></td>
  <td class="colaffiches" id="<?php echo $aff['id_bal'].'heure_bal' ?>" ><?php echo $aff['heure_bal'] ?></td>
    <td class="colaffiches" id="<?php echo $aff['id_bal'].'dec_bal' ?>" ><?php echo $aff['num_decliv'] ?></td>
  <td class="colaffiches" id="<?php echo $aff['id_bal'].'rel_bal' ?>" ><?php echo $aff['num_rel'] ?></td>
  <td class="colaffiches" ><?php echo $aff['bl_simar_bal'] ?></td>
  <td class="colaffiches" id="<?php echo $aff['id_bal'].'bl_fournisseur_bal' ?>" ><?php echo $aff['num_enleve'] ?></td>

<span class="colaffiches" id="<?php echo $aff['id_bal'].'id_dec_bal' ?>" ><?php echo $aff['dec_bal'] ?></span>
  <sapn class="colaffiches" id="<?php echo $aff['id_bal'].'id_rel_bal' ?>" ><?php echo $aff['relache_bal'] ?></sapn>
  
  <span class="colaffiches" id="<?php echo $aff['id_bal'].'id_bl_fournisseur_bal' ?>" ><?php echo $aff['bl_fournisseur_bal'] ?></span>
  <span class="colaffiches" id="<?php echo $aff['id_bal'].'id_dis_bal' ?>" ><?php echo $aff['id_dis_bal'] ?></span>
  

  <td class="colaffiches" id="<?php echo $aff['id_bal'].'camion_bal' ?>" ><?php echo $aff['camion_bal'] ?></td>
  <td class="colaffiches" id="<?php echo $aff['id_bal'].'chauffeur_bal' ?>" ><?php echo $aff['chauffeur_bal'] ?></td>

  <td class="colaffiches" id="<?php echo $aff['id_bal'].'sac_bal' ?>" ><?php echo $aff['sac_bal'] ?></td>
  <td class="colaffiches" ><?php echo $aff['poids_bal'] ?></td>

  <td class="cacher_cellule"  style="vertical-align: middle; text-align: center; " >
  
   <div style="display: flex; justify-content: center;">

 <a class="fabtn"  data-roles='update_livraison_balayure' data-id="<?php echo $aff['id_bal'];  ?>" > <i class="fa fa-edit "  ></i></a>


<a type="" class="fabtn" href="visualisation_archive.php?id=<?php echo $aff['id_bal']; ?>"   >
  <i class="fa fa-eye " ></i> 
</a>

<a    id="<?php echo $aff['id_bal'] ?>" name="delete"   class="fabtn1 " onclick="delete_livraison_balayure(<?php echo $aff['id_bal'] ?>)" > <i class="fa fa-trash  " ></i> </a>
</div>
</td>

</tr>
<?php } ?> 

<?php  
if(!empty($aff['date_bal']) and empty($aff['id_bal'])){
    ?>

<tr style="background: black; color: white; text-align: center; vertical-align: middle; ">
  <td style="color: white;" class="sous_tatal_livraison" colspan="8"> TOTAL <?php echo $aff['date_bal'] ?></td>
 
  <td style="color: white;" class="sous_tatal_livraison" ><?php echo $aff['sum(liv.sac_bal)'] ?></td>
  <td style="color: white;" class="sous_tatal_livraison" ><?php echo $aff['sum(liv.poids_bal)'] ?></td>
   <td style="color: white;" class="sous_tatal_livraison" ></td>
  

</tr>
<?php } ?> 



<?php } ?> 
  

</tbody>
 
 
</table>
</div>
</div>
</div>
</div>

