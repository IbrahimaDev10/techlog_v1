<?php 
require("../database.php");
require("controller/bl_suivant.php");
require('controller/control_choix_des_excedents.php');

  $c=$_POST['dis_bl'];
  $id=$_POST['delete_id'];
 

  
	$delete=$bdd->prepare("DELETE FROM  livraison_balayure   WHERE id_bal=? ");
	$delete->bindParam(1,$id);


	$delete->execute();


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
  $TotalLivresMo=total_livraison_mouille($bdd,$c);
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
 <table  class='table table-hover table-bordered table-striped'  border='2' style="width: 80%; " id='tabledec1'>
  <thead> 
    <tr> 
    <th id="RecapStockDep" colspan="10"> STOCK RESTANT </th> 
    </tr>
       <tr id="EnteteRecapStockDep"> 
    <th  colspan="4">  LIVRAISON </th>
     <th rowspan="2" colspan="2"> PERTE SUR RECONDITIONNEMENT </th>  
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
     <th> SACS </th> 
    <th> POIDS </th>
  
     </tr>
     </thead>
     <tbody>  
<?php 
$perte_sac=$rec_liv['sum(sac_eventres_liv)']-$rec_liv['sum(sac_av_recond_liv)']-$rec_liv['sum(sac_balayure_recond_liv)'];
$perte_poids=$rec_liv['sum(poids_balayure_recond_liv)'];
$sac_reste_livrer=$total_sac-$TLivres['sum(sac_liv)']-$TLivresMo['sum(sac_mo)']-$perte_sac;
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
              <td> <?php echo number_format($perte_sac, 0,',',' '); ?></td>
       <td > <?php echo number_format($perte_poids,3,',',' '); ?></td>
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

<br>
<div class="col-md-12 col-lg-12">      
<a  class="btn1"  style="background: rgb(65,180,190); "  data-roles="afficher_formulaire_liv_balayure" data-id=<?php echo $c; ?>  >AJOUTER LIVRAISON BALAYURE </a>
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
  <td class="colaffiches" ><?php echo $aff['id_bal'] ?></td>
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

