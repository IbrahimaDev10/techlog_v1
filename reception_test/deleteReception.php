<?php
require('../database.php');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");


if(isset($_POST['delete_id'])){
  
$id_dis_bl=$_POST['id_dis'];

$id=$_POST['delete_id'];
$getid=$_POST['getid'];

try{




  $delete=$bdd->prepare("DELETE from pre_register_reception where id_pre_register_manif=?");
  $delete->bindParam(1,$id);
  $delete->execute();
 
}

catch(PDOException $e){
    die('Erreur:' .$e->getMessage());
    
}


$select=$bdd->prepare("select pre.*,rm.*,cam.*,ch.*,p.produit,p.qualite, nav.navire, mang.id_mangasinier from register_manifeste as rm
            inner join pre_register_reception as pre on pre.id_pre_register_manif=rm.id_register_manif
            inner join camions as cam on cam.id_camions=rm.camions
            inner join chauffeur as ch on ch.id_chauffeur=rm.chauffeur
            inner join mangasin as mang on mang.id=rm.id_destination
            inner join produit_deb as p on p.id=rm.id_produit
            inner join navire_deb as nav on nav.id=rm.id_navire

            where mang.id_mangasinier=?");
               $select->bindParam(1,$getid);
               $select->execute(); 

                    $afficheAvaries = $bdd->prepare("select pre.*,trav.*,cam.*,ch.* , nav.navire, p.*,mg.id_mangasinier from pre_reception_avaries as pre inner join transfert_avaries as trav on pre.id_pre_tr_av=trav.id_tr_avaries inner join camions as cam on cam.id_camions=trav.id_cam inner join chauffeur as ch on ch.id_chauffeur=trav.id_chauffeur_tr
                       inner join navire_deb as nav on nav.id=trav.id_navire
                       inner join produit_deb as p on p.id=trav.id_produit
               inner join mangasin as mg on mg.id=id_destination_tr where mg.id_mangasinier=? ");
        
        
        $afficheAvaries->bindParam(1,$getid);
        $afficheAvaries->execute();

?> 

  <div class="main" id="pole">
         <div class="col-md-12 col-lg-12">
    <h3 class="operation"  >POLE DE RECEPTION</h3>
</div>
<div class="col-md-12 col-lg-12">
      <div  class="table-responsive" border=1 >
        
           
          
        
 <table  class='table table-hover table-bordered table-striped'  border='2'   id='tabledec2' >
   <td colspan="9" style="background: black; color: white;" class="titre"><i class="fas fa-truck" ></i> <i class="fas fa-truck" ></i> <i class="fas fa-truck" ></i> CAMIONS EN ATTENTES (SAINS)</td>
  
  <tr class="tr_attente_sain" >
     <th >DATE</th>
    <th >NAVIRE</th>
    <th >PRODUIT</th>
  <th >BL</th>
  <th >CAMION</th>
  <th >CHAUFFEUR</th>
  <th >SAC</th>
  <th >POIDS</th>
  <th >ACTIONS</th></tr>
  <tbody>

  <?php while($aff=$select->fetch()){ ?>
<tr class="tr_data_attente_sain" >
    <td id="<?php echo $aff['id_register_manif'].'date' ?>" ><?php echo $aff['dates']; ?></td>
    <td id="<?php echo $aff['id_register_manif'].'nav' ?>" ><?php echo $aff['navire']; ?></td>
  <td id="<?php echo $aff['id_register_manif'].'prod' ?>" ><?php echo $aff['produit']; ?> <?php echo $aff['qualite']; ?> <span style="color: red;"> <?php echo $aff['poids_sac'].'KGS'; ?></span></td>
     <td id="<?php echo $aff['id_register_manif'].'bl' ?>" ><?php echo $aff['bl']; ?></td>
      <td id="<?php echo $aff['id_register_manif'].'camion' ?>" ><?php echo $aff['num_camions']; ?></td>
       <td id="<?php echo $aff['id_register_manif'].'chauffeur' ?>" ><?php echo $aff['nom_chauffeur']; ?></td>
      <td id="<?php echo $aff['id_register_manif'].'sac' ?>" ><?php echo $aff['sac']; ?></td>
       <td id="<?php echo $aff['id_register_manif'].'poids' ?>" ><?php echo $aff['poids']; ?></td>
       <span style="display: none;" id="<?php echo $aff['id_register_manif'].'poids_sac'   ?>"> <?php echo $aff['poids_sac']   ?></span>
       <span style="display: none;" id="<?php echo $aff['id_register_manif'].'getid'   ?>"> <?php echo $getid;   ?></span>
       <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_produit'   ?>"> <?php echo $aff['id_produit']   ?></span>
        <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_dis_bl'   ?>"> <?php echo $aff['id_dis_bl']   ?></span>
         <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_declaration'   ?>"> <?php echo $aff['id_declaration']   ?></span>
          <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_destination'   ?>"> <?php echo $aff['id_destination']   ?></span>
           <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_client'   ?>"> <?php echo $aff['id_client']   ?></span>
            <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_navire'   ?>"> <?php echo $aff['id_navire']   ?></span>

        <td class="colcel"><a  href="#" data-role="insert_receptionSain" data-id="<?php echo $aff['id_register_manif']; ?>" ><i class="fas fa-check "></i></a>
          <a href="#" data-role="insert_reception" data-id="<?php echo $aff['id_register_manif']; ?>" ><i class="fa fa-edit "></i></a>
          <a href="#"  onclick="deletePre_Reception(<?php echo $aff['id_register_manif'] ?>)" ><i class="fa fa-trash "></i></a></td>

        </tr>
        <?php } ?>
      </tbody>
    </table>
  
</div>
</div>
<br><br>


<div class="col-md-12 col-lg-12">

  <div class="table-responsive" border=1>

  
  
 <table class='table table-hover table-bordered table-striped' id='table' border='2' >
    

 <thead >
       
     <td colspan="11" class="titre" style="background: black; color: orange;"><i class="fas fa-truck" style="color: orange" ></i> <i class="fas fa-truck" style="color: orange" ></i> <i class="fas fa-truck" style="color: orange" ></i>CAMIONS EN ATTENTES (AVARIES)</td>
    <tr class="tr_attente_avaries"  >
      
      
      
       <td scope="col"  rowspan="3"  >DATES</td> 
           <td  rowspan="3" >NAVIRE</td>
    <th  rowspan="3">PRODUIT</th>    
                 <td scope="col"  rowspan="3"  >BL</td>
               <td scope="col" rowspan="3"  >CAMIONS</td> 
               <td scope="col"  rowspan="3"  >CHAUFFEUR</td>       
      <td scope="col" colspan="2"  >FLASQUES</td>
      <td scope="col" colspan="2"  >MOUILLES</td>
      <td scope="col" rowspan="2" >ACTIONS</td>
      
     
  </tr>
    <tr class="tr_attente_avaries" >
      
      <td scope="col" >SACS</td>
      <td scope="col"  >POIDS</td>
      <td scope="col"  >SACS</td>
      <td scope="col" >POIDS</td>
      </tr>


     </thead>
<tbody>

<?php while($aff=$afficheAvaries->fetch()){ 
  if(!empty($aff['id_pre_ra'])){
  ?>
  
  <tr class="tr_data_attente_avaries" >
  <td id="<?php echo $aff['id_pre_ra'].'date_ra' ?>" ><?php echo $aff['date_tr_avaries'] ?></td> 
   <td  ><?php echo $aff['navire'] ?></td> 
  <td ><?php echo $aff['produit']; ?> <?php echo $aff['qualite']; ?> <span style="color: red;"> <?php echo $aff['poids_sac_tr_av'].'KGS'; ?></span></td> 
  <td id="<?php echo $aff['id_pre_ra'].'bl_ra' ?>" ><?php echo $aff['bl_tr'] ?></td> 
  <td id="<?php echo $aff['id_pre_ra'].'camion_ra' ?>" ><?php echo $aff['num_camions'] ?></td> 
  <td id="<?php echo $aff['id_pre_ra'].'chauffeur_ra' ?>" ><?php echo $aff['nom_chauffeur'] ?></td> 
  <td id="<?php echo $aff['id_pre_ra'].'sac_flasque_ra' ?>" ><?php echo $aff['sac_flasque_tr_av'] ?></td>
  <td id="<?php echo $aff['id_pre_ra'].'poids_flasque_ra' ?>" ><?php echo $aff['poids_flasque_tr_av'] ?></td> 
  <td id="<?php echo $aff['id_pre_ra'].'sac_mouille_ra' ?>" ><?php echo $aff['sac_mouille_tr_av'] ?></td>  
  <td id="<?php echo $aff['id_pre_ra'].'poids_mouille_ra' ?>" ><?php echo $aff['poids_mouille_tr_av'] ?></td>
  <span style="display: none;" id="<?php echo $aff['id_pre_ra'].'poids_sac_ra'   ?>"> <?php echo $aff['poids_sac_tr_av']   ?></span>
       <span style="display: none;" id="<?php echo $aff['id_pre_ra'].'id_produit_ra'   ?>"> <?php echo $aff['id_produit']   ?></span>
        <span style="display: none;" id="<?php echo $aff['id_pre_ra'].'id_dis_bl_ra'   ?>"> <?php echo $aff['id_dis_bl_tr']   ?></span>
         <span style="display: none;" id="<?php echo $aff['id_pre_ra'].'id_declaration_ra'   ?>"> <?php echo $aff['id_declaration_tr']   ?></span>
          <span style="display: none;" id="<?php echo $aff['id_pre_ra'].'id_destination_ra'   ?>"> <?php echo $aff['id_destination_tr']   ?></span>
           <span style="display: none;" id="<?php echo $aff['id_pre_ra'].'id_client_ra'?>"> <?php echo $aff['id_client']   ?></span>
            <span style="display: none;" id="<?php echo $aff['id_pre_ra'].'id_navire_ra'?>"> <?php echo $aff['id_navire']   ?></span>
            <span style="display: none;" id="<?php echo $aff['id_pre_ra'].'getid_avaries'?>"> <?php echo $getid;  ?></span> 
  
 
  <td class="colcel"><a  data-role="insert_rep_av" data-id="<?php echo $aff['id_pre_ra']; ?>" ><i class="fas fa-check "></i></a>
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
