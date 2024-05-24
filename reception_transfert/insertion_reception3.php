<?php
require('../database.php');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");


if(isset($_POST['id']) ){
  if(!empty($_POST['date']) and !empty($_POST['bl']) and !empty($_POST['chauffeur']) and !empty($_POST['camion']) and !empty($_POST['sac'])) {
$date=$_POST['date'];
$bl=$_POST['bl'];
$chauffeur=$_POST['chauffeur'];
$camions=$_POST['camion'];
$sac=$_POST['sac'];
$manquant=$_POST['manquant'];
$poids_sac=$_POST['poids_sac'];
$client=$_POST['id_client'];
$destination=$_POST['id_destination'];
$navire=$_POST['id_navire'];
$declaration=$_POST['id_declaration'];
$id_dis_bl=$_POST['id_dis_bl'];
$id_produit=$_POST['id_produit'];
$poids=$sac*$poids_sac/1000;
$id=$_POST['id'];
$getid=$_POST['getid'];

try{
$insert=$bdd->prepare("INSERT INTO reception(dates_recep,bl_recep,id_dis_recep_bl,id_dec,camion_recep,chauffeur_recep,sac_recep,poids_recep,manquant_recep,id_produit_recep,poids_sac_recep,id_client_recep,id_destination_recep,id_navire_recep) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
  $insert->bindParam(1,$date);
  $insert->bindParam(2,$bl);
  $insert->bindParam(3,$id_dis_bl);
  $insert->bindParam(4,$declaration);
  $insert->bindParam(5,$camions);
  $insert->bindParam(6,$chauffeur);
  $insert->bindParam(7,$sac);
  $insert->bindParam(8,$poids);
  $insert->bindParam(9,$manquant);
  $insert->bindParam(10,$id_produit);
  $insert->bindParam(11,$poids_sac);
  $insert->bindParam(12,$client);
  $insert->bindParam(13,$destination);
  $insert->bindParam(14,$navire);
  $insert->execute();
  

  $delete=$bdd->prepare("delete from pre_register_reception where id_pre_register_manif=?");
  $delete->bindParam(1,$id);
  $delete->execute();
 
}

catch(PDOException $e){
    die('Erreur:' .$e->getMessage());
    
}
}

$select=$bdd->prepare("select pre.*,rm.*,cam.*,ch.*, mang.id_mangasinier from register_manifeste as rm
            inner join pre_register_reception as pre on pre.id_pre_register_manif=rm.id_register_manif
            inner join camions as cam on cam.id_camions=rm.camions
            inner join chauffeur as ch on ch.id_chauffeur=rm.chauffeur
            inner join mangasin as mang on mang.id=rm.id_destination

            where mang.id_mangasinier=?");
               $select->bindParam(1,$getid);
               $select->execute(); 

                    $afficheAvaries = $bdd->prepare("select pre.*,trav.*,cam.*,ch.*,mg.id_mangasinier from pre_reception_avaries as pre inner join transfert_avaries as trav on pre.id_pre_tr_av=trav.id_tr_avaries inner join camions as cam on cam.id_camions=trav.id_cam inner join chauffeur as ch on ch.id_chauffeur=trav.id_chauffeur_tr
               inner join mangasin as mg on mg.id=id_destination_tr where mg.id_mangasinier=? ");
        
        
        $afficheAvaries->bindParam(1,$getid);
        $afficheAvaries->execute();

?> 

  <div class="main" id="pole">
         <div class="col-md-12 col-lg-12">
    <h3 class="operation text-white " style=" font-weight: bold; width: 100%; background: rgb(0,141,202);"  >POLE DE RECEPTION</h3>
</div>
<div class="col-md-12 col-lg-12">
      <div  class="table-responsive" border=1 >
        <center>
            <h4>CAMIONS EN ATTENTES</h4>
            </center>
        
 <table  class='table table-hover table-bordered table-striped'  border='2'   id='tabledec2' >
  <tbody>
  <tr style="background: black; color:white; text-align:center; vertical-align: middle; ">
  <th style="color:white;">DATE</th>
  <th style="color:white;">BL</th>
  <th style="color:white;">CAMION</th>
  <th style="color:white;">CHAUFFEUR</th>
  <th style="color:white;">SAC</th>
  <th style="color:white;" >POIDS</th>
  <th style="color:white;">ACTIONS</th></tr>

  <?php while($aff=$select->fetch()){ ?>
<tr style="text-align: center;">
    <td id="<?php echo $aff['id_register_manif'].'date' ?>" class="colcel"><?php echo $aff['dates']; ?></td>
     <td id="<?php echo $aff['id_register_manif'].'bl' ?>" class="colcel"><?php echo $aff['bl']; ?></td>
      <td id="<?php echo $aff['id_register_manif'].'camion' ?>" class="colcel"><?php echo $aff['num_camions']; ?></td>
       <td id="<?php echo $aff['id_register_manif'].'chauffeur' ?>" class="colcel"><?php echo $aff['nom_chauffeur']; ?></td>
      <td id="<?php echo $aff['id_register_manif'].'sac' ?>" class="colcel"><?php echo $aff['sac']; ?></td>
       <td id="<?php echo $aff['id_register_manif'].'poids' ?>" class="colcel"><?php echo $aff['poids']; ?></td>
       <span style="display: none;" id="<?php echo $aff['id_register_manif'].'poids_sac'   ?>"> <?php echo $aff['poids_sac']   ?></span>
       <span style="display: none;" id="<?php echo $aff['id_register_manif'].'getid'   ?>"> <?php echo $getid;   ?></span>
       <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_produit'   ?>"> <?php echo $aff['id_produit']   ?></span>
        <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_dis_bl'   ?>"> <?php echo $aff['id_dis_bl']   ?></span>
         <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_declaration'   ?>"> <?php echo $aff['id_declaration']   ?></span>
          <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_destination'   ?>"> <?php echo $aff['id_destination']   ?></span>
           <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_client'   ?>"> <?php echo $aff['id_client']   ?></span>
            <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_navire'   ?>"> <?php echo $aff['id_navire']   ?></span>

        <td class="colcel"><a  href="#" data-role="insert_receptionSain3" data-id="<?php echo $aff['id_register_manif']; ?>" ><i class="fas fa-check "></i></a>
          <a href="#" data-role="insert_reception" data-id="<?php echo $aff['id_register_manif']; ?>" ><i class="fa fa-edit "></i></a>
          <a href="#" data-role="insert_reception" data-id="<?php echo $aff['id_register_manif']; ?>" ><i class="fa fa-trash "></i></a></td>

        </tr>
        <?php } ?>
      </tbody>
    </table>
  
</div>
</div>
<br><br>

<div class="col-md-12 col-lg-12">

  <div class="table-responsive" border=1>

  <center>
  <h4>CAMIONS DES AVARIES EN ATTENTES</h4>
  </center>
  
<?php


 echo " <table class='table table-hover table-bordered table-striped' id='table' border='2' >";
    
?> 
 <thead style="background-color: rgba(50, 159, 218, 0.9);">
       
    
    <tr  style="background: black; color:white; text-align:center; vertical-align: middle; "  >
      
      
      
       <td scope="col"  rowspan="3"  style="color: white; font-weight: bold; vertical-align: middle;">DATES</td>     
                 <td scope="col"  rowspan="3"  style="color: white; font-weight: bold; vertical-align: middle;">BL</td>
               <td scope="col" rowspan="3"  style="color: white; font-weight: bold; vertical-align: middle; vertical-align: middle;">CAMIONS</td> 
               <td scope="col"  rowspan="3"  style="color: white; font-weight: bold; vertical-align: middle;">CHAUFFEUR</td>       
      <td scope="col" colspan="2"  style="color: white; font-weight: bold; vertical-align: middle;">FLASQUES</td>
      <td scope="col" colspan="2"  style="color: white; font-weight: bold; vertical-align: middle;">MOUILLES</td>
      <td scope="col" rowspan="2"  style="color: white; font-weight: bold; vertical-align: middle;">ACTIONS</td>
      
     
  </tr>
    <tr style="background: black; color:white; text-align:center; vertical-align: middle; " >
      
      <td scope="col"   style="color: white; font-weight: bold; vertical-align: middle;">SACS</td>
      <td scope="col"  style="color: white; font-weight: bold; vertical-align: middle;">POIDS</td>
      <td scope="col"   style="color: white; font-weight: bold; vertical-align: middle;">SACS</td>
      <td scope="col"  style="color: white; font-weight: bold; vertical-align: middle;">POIDS</td>
      </tr>

      

     
     
    


      
     </thead>


<tbody>
<?php while($aff=$afficheAvaries->fetch()){ 
  if(!empty($aff['id_pre_ra'])){
  ?>
  
  <tr style="text-align: center;">
  <td id="<?php echo $aff['id_pre_ra'].'date_ra' ?>" class="colcel"><?php echo $aff['date_tr_avaries'] ?></td> 
  <td id="<?php echo $aff['id_pre_ra'].'bl_ra' ?>" class="colcel"><?php echo $aff['bl_tr'] ?></td> 
  <td id="<?php echo $aff['id_pre_ra'].'camion_ra' ?>" class="colcel"><?php echo $aff['num_camions'] ?></td> 
  <td id="<?php echo $aff['id_pre_ra'].'chauffeur_ra' ?>" class="colcel"><?php echo $aff['nom_chauffeur'] ?></td> 
  <td id="<?php echo $aff['id_pre_ra'].'sac_flasque_ra' ?>" class="colcel"><?php echo $aff['sac_flasque_tr_av'] ?></td>
  <td id="<?php echo $aff['id_pre_ra'].'poids_flasque_ra' ?>" class="colcel"><?php echo $aff['poids_flasque_tr_av'] ?></td> 
  <td id="<?php echo $aff['id_pre_ra'].'sac_mouille_ra' ?>" class="colcel"><?php echo $aff['sac_mouille_tr_av'] ?></td>  
  <td id="<?php echo $aff['id_pre_ra'].'poids_mouille_ra' ?>" class="colcel"><?php echo $aff['poids_mouille_tr_av'] ?></td>
  <span style="display: none;" id="<?php echo $aff['id_pre_ra'].'poids_sac_ra'   ?>"> <?php echo $aff['poids_sac_tr_av']   ?></span>
       <span style="display: none;" id="<?php echo $aff['id_pre_ra'].'id_produit_ra'   ?>"> <?php echo $aff['id_produit']   ?></span>
        <span style="display: none;" id="<?php echo $aff['id_pre_ra'].'id_dis_bl_ra'   ?>"> <?php echo $aff['id_dis_bl_tr']   ?></span>
         <span style="display: none;" id="<?php echo $aff['id_pre_ra'].'id_declaration_ra'   ?>"> <?php echo $aff['id_declaration_tr']   ?></span>
          <span style="display: none;" id="<?php echo $aff['id_pre_ra'].'id_destination_ra'   ?>"> <?php echo $aff['id_destination_tr']   ?></span>
           <span style="display: none;" id="<?php echo $aff['id_pre_ra'].'id_client_ra'?>"> <?php echo $aff['id_client']   ?></span>
            <span style="display: none;" id="<?php echo $aff['id_pre_ra'].'id_navire_ra'?>"> <?php echo $aff['id_navire']   ?></span> 
  
 
  <td class="colcel"><a  href="#" data-role="insert_reception_avaries" data-id="<?php echo $aff['id_pre_ra']; ?>" ><i class="fas fa-check "></i></a>
          <a href="#" data-role="update_reception_avaries" data-id="<?php echo $aff['id_pre_ra']; ?>" ><i class="fa fa-edit "></i></a>
          <a href="#" data-role="delete_reception_avaries" data-id="<?php echo $aff['id_pre_ra']; ?>" ><i class="fa fa-trash "></i></a></td> 

  

  </tr>
  <?php } ?>
<?php } ?>
</tbody>
</table>
</div>
  

</div>

         
     </div>
        <br><br>
     



<?php  
}

?>	
