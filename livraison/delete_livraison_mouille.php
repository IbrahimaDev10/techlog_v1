<?php 
require("../database.php");
require("controller/bl_suivant.php");
require('controller/control_choix_des_excedents.php');
  $c=$_POST['dis_bl'];
   $id=$_POST['delete_id'];




  $delete=$bdd->prepare("DELETE FROM livraison_mouille  WHERE id_mo=?");
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


 <div class="container-fluid" class="" id="TableMouille"  >
      <div class="row">
  
    <div class="container-fluid" id="div_recap" >
        <div class="row">
          <center>  
        
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


  </center>
  <div class="col col-md-6" style="border: solid; border-color: blue;">
    <h3 style="background: black; text-align: center; color: white !important;">STOCK DEPART</h3>
   <h6 >STOCK DEPART: <span style="color: red;"><?php echo $total_sac.' SACS' ?></span> SOIT <span style="color: red;"><?php echo $total_poids.' T' ?></span></h6>
  <h6>SAINS: <span style="color: red;"><?php echo $SacSain.' SACS' ?></span> SOIT <span style="color: red;"><?php echo $poidsSain.' T' ?></span></h6>
     <h6>MOUILLE: <span style="color: red;"><?php echo $SacMouille.' SACS' ?></span> SOIT <span style="color: red;"><?php echo $poidsMouille.' T' ?></span></h6>
       <h6>BALAYURE: <span style="color: red;"><?php echo $rec['sum(sac_balayure_recond)'].' SACS' ?></span> SOIT <span style="color: red;"><?php echo $rec['sum(poids_balayure_recond)'].' T' ?></span></h6>
        <h6 style="background: yellow;" >STOCK DEPART: <span style="color: red;"><?php echo $total_sac.' SACS' ?></span> SOIT <span style="color: red;"><?php echo $total_poids.' T' ?></span></h6>
      </div>



          
          
<?php 
$perte_sac=$rec_liv['sum(sac_eventres_liv)']-$rec_liv['sum(sac_av_recond_liv)']-$rec_liv['sum(sac_balayure_recond_liv)'];
$perte_poids=$rec_liv['sum(poids_balayure_recond_liv)'];
$sac_reste_livrer=$total_sac-$TLivres['sum(sac_liv)']-$TLivresMo['sum(sac_mo)']-$perte_sac;
$poids_reste_livrer=$total_poids-$TLivres['sum(poids_liv)']-$TLivresMo['sum(poids_mo)'];
$total_sac_livrer=$TLivres['sum(sac_liv)']+$TLivresMo['sum(sac_mo)'];
$total_poids_livrer=$TLivres['sum(poids_liv)']+$TLivresMo['sum(poids_mo)'];
//$total_poids=$poidsSain+$poidsMouille+$rec['sum(poids_balayure_recond)'];

 ?>
 
<div class="col col-md-6" style="border: solid; border-color: blue;">
  <h3 style="background: black; text-align: center; color: white !important;">RESTE A LIVRER</h3>
  <h6 style="float: right;">SACS SAINS LIVRES: <span style="color: red;"><?php echo $TLivres['sum(sac_liv)'].' SACS' ?></span> SOIT <span style="color: red;"><?php echo $TLivres['sum(poids_liv)'].' T' ?></span></h6>
     <h6 style="float: right;">SACS MOUILLES LIVRES: <span style="color: red;"><?php echo $TLivresMo['sum(sac_mo)'].' SACS' ?></span> SOIT <span style="color: red;"><?php echo $TLivresMo['sum(poids_mo)'].' T' ?></span></h6>
      <h6 style="float: right;">SACS BALAYURES LIVRES: <span style="color: red;"><?php echo '0 SACS' ?></span> SOIT <span style="color: red;"><?php echo '0 T' ?></span></h6>
      <h6 style="float: right;">PERTE SUR RECONDITIONNEMENT: <span style="color: red;"><?php echo $perte_sac.' SACS' ?></span> SOIT <span style="color: red;"><?php echo $perte_poids.' T' ?></span></h6>

       <h6 style="background: yellow; float: right;">RESTE A LIVRER: <span style="color: red;"><?php echo $sac_reste_livrer.' SACS' ?></span> SOIT <span style="color: red;"><?php echo $poids_reste_livrer.' T' ?></span></h6>

      </div>
    
  </div>
</div>
<?php  } //FIN DU FETCH ?>

      

<br>
<div class="col-md-12 col-lg-12">      
<a  class="btn1"  style=" background:rgb(0,162,232); " data-bs-toggle="modal" data-bs-target="#form_livraison_mouille" >AJOUTER LIVRAISON  </a>
<br><br>
</div>
<div class="col-md-12 col-lg-12">

 <div class="table-responsive" border=1>



  <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >

    

 <thead style="background:rgb(0,162,232);">
      <td  class="titreAVR" colspan="11"  >LIVRAISON DES MOUILLES</td> 
  
    <?php   $infos=$bdd->prepare("SELECT dis.poids_kg, p.*, mg.mangasin, nav.navire, nav.type,cli.client
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
      <tr  style="background:rgb(0,162,232); color: white; border-color: black; font-size: 12px; vertical-align: middle;"   >
     <td  colspan="2">NAVIRE: <span id="lesInfos"> <?php echo $inf['navire']; ?></span></td>
      <td colspan="2">TYPE:<span id="lesInfos"> <?php echo $inf['type']; ?></span></td>
      <td colspan="4">PRODUIT:<span id="lesInfos"> <?php echo $inf['produit']; ?> <?php echo $inf['qualite']; ?> </span></td>
        <td colspan="3">CONDITIONNEMENT:<span id="lesInfos"> <?php echo $inf['poids_kg'].' KG';; ?></span></td>
        </tr>
        <tr  style="background:rgb(0,162,232); color: white; border-color: black; font-size: 12px; vertical-align: middle;"   >
         <td colspan="2">ENTREPOT:<span id="lesInfos"> <?php echo $inf['mangasin']; ?></span></td>
          <td colspan="3">RECEPTIONNAIRE:<span id="lesInfos"> <?php echo $inf['client']; ?></span></td>
           <td colspan="6"></td>
        </tr>
<?php } ?>

      <?php 

        $affiche = $bdd->prepare("SELECT r.*,d.*, mo.*, b.*, sum(mo.sac_mo),sum(mo.poids_mo)  FROM livraison_mouille as mo 
                
             inner join relache as r on r.id_rel=mo.relache_mo
             inner join declaration_liv as d on d.id_decliv=mo.dec_mo
             inner join bon_enlevement as b on b.id_enleve=mo.bl_fournisseur_mo

                   WHERE mo.id_dis_mo=? group by mo.date_mo, mo.id_mo with rollup ");
        
        
        $affiche->bindParam(1,$c);
        $affiche->execute();


       ?>

    
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
  <?php while ($aff=$affiche->fetch()){
 if(!empty($aff['date_mo']) and !empty($aff['id_mo'])){
    ?>

<tr style="vertical-align: middle;">
  <td class="colaffiche" id="<?php echo $aff['id_mo'].'date_mouille'; ?>" ><?php echo $aff['date_mo'] ?></td>
  <td class="colaffiche" id="<?php echo $aff['id_mo'].'heure_mouille'; ?>" ><?php echo $aff['heure_mo'] ?></td>
    <td class="colaffiche" id="<?php echo $aff['id_mo'].'dec_mouille'; ?>" ><?php echo $aff['num_decliv'] ?></td>
  <td class="colaffiche" id="<?php echo $aff['id_mo'].'rel_mouille'; ?>" ><?php echo $aff['num_rel'] ?></td>
  <span id="<?php echo $aff['id_mo'].'id_dec_mouille'; ?>" ><?php echo $aff['dec_mo'] ?></span>
  <span id="<?php echo $aff['id_mo'].'id_rel_mouille'; ?>" ><?php echo $aff['relache_mo'] ?></span>
  <span id="<?php echo $aff['id_mo'].'id_bl_fournisseur_mouille'; ?>" ><?php echo $aff['bl_fournisseur_mo'] ?></span>
  <span id="<?php echo $aff['id_mo'].'id_dis_mouille'; ?>" ><?php echo $aff['id_dis_mo'] ?></span>
  <td class="colaffiche" ><?php echo $aff['id_mo'] ?></td>
  <td class="colaffiche" id="<?php echo $aff['id_mo'].'bl_fournisseur_mouille'; ?>"><?php echo $aff['num_enleve'] ?></td>
  <td class="colaffiche" id="<?php echo $aff['id_mo'].'camion_mouille'; ?>" ><?php echo $aff['camion_mo'] ?></td>
  <td class="colaffiche" id="<?php echo $aff['id_mo'].'chauffeur_mouille'; ?>"><?php echo $aff['chauffeur_mo'] ?></td>

  <td class="colaffiche" id="<?php echo $aff['id_mo'].'sac_mouille'; ?>" ><?php echo $aff['sac_mo'] ?></td>
  <td class="colaffiche" ><?php echo $aff['poids_mo'] ?></td>

   <td class="cacher_cellule"  style="vertical-align: middle; text-align: center; " >
  
   <div style="display: flex; justify-content: center;">

 <a class="fabtn"  data-roles='update_livraison_mouille' data-id="<?php echo $aff['id_mo'];  ?>" > <i class="fa fa-edit "  ></i></a>


<a type="" class="fabtn" href="visualisation_archive.php?id=<?php echo $aff['id_mo']; ?>"   >
  <i class="fa fa-eye " ></i> 
</a>

<a    id="<?php echo $aff['id_mo'] ?>" name="delete"   class="fabtn1 " onclick="delete_livraison_mouille(<?php echo $aff['id_mo'] ?>)" > <i class="fa fa-trash  " ></i> </a>
</div>
</td>


</tr>
<?php } ?> 

<?php  
if(!empty($aff['date_mo']) and empty($aff['id_mo'])){
    ?>

<tr style="background: black; color: white; text-align: center; vertical-align: middle; ">

  <td style="color: white;"  class="colaffiche" colspan="8"> TOTAL <?php echo $aff['date_mo'] ?></td>
 
  <td style="color: white;" class="colaffiche" ><?php echo $aff['sum(mo.sac_mo)'] ?></td>
  <td style="color: white;" class="colaffiche" ><?php echo $aff['sum(mo.poids_mo)'] ?></td>
   <td style="color: white;" class="colaffiche" ></td>
  

</tr>
<?php } ?> 



<?php } ?> 
  
   

 




 </tbody>
</table>
</div>
</div>
</div>
</div>


