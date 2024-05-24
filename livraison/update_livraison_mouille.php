<?php 
require("../database.php");
require("controller/control_excedent.php");
require("controller/control_choix_des_excedents.php");
  $c=$_POST['id_dis'];
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


	$insert=$bdd->prepare("UPDATE livraison_mouille SET date_mo=?, heure_mo=? ,bl_fournisseur_mo=? ,camion_mo=? ,chauffeur_mo=? ,dec_mo=? ,relache_mo=? ,sac_mo=? ,poids_mo=? WHERE id_mo=?");
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
  
  <h3 id="alerte_excedent"><i class="fa fa-bell" style="color: blue;"> </i> ALERTE SUR LES DEPASSEMENTS</h3>
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
<a  class="btn1"  style=" background:rgb(0,162,232); " data-roles="afficher_formulaire_liv_mouille" data-id="<?php echo $c; ?>" >AJOUTER LIVRAISON  </a>
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


