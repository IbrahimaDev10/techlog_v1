<?php  
function afficher_transfert_sain($bdd,$produit,$poids_sac,$navire,$destination){
         $affiche = $bdd->prepare("SELECT dt.*, trs.*,dis.id_dis,dis.id_produit,dis.poids_kg,dis.id_mangasin,nc.id_navire, ch.*,cam.*, sum(trs.sac_trsain),sum(trs.poids_trsain)  FROM transfert_sain as trs
                
           /*  left join dispatching_relache as r on r.id_dis_relache=liv.relache_liv */
             inner join declaration_transfert as dt on dt.id_declaration_transfert=trs.dec_trsain
            
             inner join dispat as dis on dis.id_dis=dt.id_bl_transfert
             inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
             left join camions as cam on cam.id_camions=trs.camion_trsain
             left join chauffeur as ch on ch.id_chauffeur=trs.chauffeur_trsain
            

      
         WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? group by trs.date_trsain, trs.id_trsain with rollup");
        $affiche->bindParam(1,$produit);
        $affiche->bindParam(2,$poids_sac);
        $affiche->bindParam(3,$navire);
         $affiche->bindParam(4,$destination);
        $affiche->execute();
        return $affiche;
      }

      function afficher_transfert_avaries($bdd,$produit,$poids_sac,$navire,$destination,$statut){
         $affiche = $bdd->prepare("SELECT dt.*, trav.*,dis.id_dis,dis.id_produit,dis.poids_kg,dis.id_mangasin,nc.id_navire, ch.*,cam.*, sum(trav.sac),sum(trav.poids)  FROM transfert_des_avaries as trav
                
           /*  left join dispatching_relache as r on r.id_dis_relache=liv.relache_liv */
             inner join declaration_transfert as dt on dt.id_declaration_transfert=trav.id_declaration
            
             inner join dispat as dis on dis.id_dis=dt.id_bl_transfert
             inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
             left join camions as cam on cam.id_camions=trav.id_camion
             left join chauffeur as ch on ch.id_chauffeur=trav.id_chauffeur
            

      
         WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? and trav.statut=? group by trav.dates, trav.id with rollup");
        $affiche->bindParam(1,$produit);
        $affiche->bindParam(2,$poids_sac);
        $affiche->bindParam(3,$navire);
         $affiche->bindParam(4,$destination);
          $affiche->bindParam(5,$statut);
        $affiche->execute();
        return $affiche;
      }
      ?>



 <?php  
 
  function affichage_transfert_sain($bdd,$produit,$poids_sac,$navire,$destination){

 ?>
   <?php
        $affiche=afficher_transfert_sain($bdd,$produit,$poids_sac,$navire,$destination);

   while ($aff=$affiche->fetch()){
 if(!empty($aff['date_trsain']) and !empty($aff['id_trsain'])){
    ?>

<tr   style="vertical-align: middle;" >
  <td  style=" vertical-align: middle; color:black"  class="colaffiches" id="<?php echo $aff['id_trsain'].'date_sain'; ?>"    ><?php echo $aff['date_trsain'] ?></td>
  <td  style=" vertical-align: middle; color:black" class="colaffiches" id="<?php echo $aff['id_trsain'].'heure_sain'; ?>"><?php echo $aff['heure_trsain'] ?></td>
    <td  style=" vertical-align: middle; color:black"  class="colaffiches" id="<?php echo $aff['id_trsain'].'dec_sain'; ?>" ><?php echo $aff['num_dec_transfert'] ?></td>
     <span style="display: none;"  id="<?php echo $aff['id_trsain'].'id_dec_sain'; ?>">   <?php echo $aff['dec_trsain'] ?> </span>
         
            
  <td>  </td>
  <td> </td>
  <td  ></td>
  <td  style=" vertical-align: middle; color:black"  class="colaffiches" id= ><?php echo $aff['num_camions'] ?></td>
  <td  style=" vertical-align: middle; color:black"  class="colaffiches" id="<?php echo $aff['id_trsain'].'chauffeur_sain'; ?>" ><?php echo $aff['nom_chauffeur'] ?></td>
  <span style="display: none;" id="<?php echo $aff['id_trsain'].'id_dis_sain'; ?>">   <?php echo $aff['id_dis_liv'] ?> </span>
   <span style="display: none;" id="<?php echo $aff['id_trsain'].'id_produit_sain'; ?>">   <?php echo $aff['id_produit'] ?> </span>
   <span style="display: none;" id="<?php echo $aff['id_trsain'].'poids_sac_sain'; ?>">   <?php echo $aff['poids_kg'] ?> </span>
   <span style="display: none;" id="<?php echo $aff['id_trsain'].'id_destination_sain'; ?>">   <?php echo $aff['id_mangasin'] ?> </span>
   <span style="display: none;" id="<?php echo $aff['id_trsain'].'id_navire_sain'; ?>">   <?php echo $aff['id_navire'] ?> </span>


  <td  style=" vertical-align: middle; color:black" class="colaffiches" id="<?php echo $aff['id_trsain'].'sac_sain'; ?>" ><?php echo $aff['sac_trsain'] ?></td>
  <td  style=" vertical-align: middle; color:black"  class="colaffiches" ><?php echo $aff['poids_trsain'] ?> </td>

 
  <td class="cacher_cellule"  style="vertical-align: middle; text-align: center; " >
  
   <div style="display: flex; justify-content: center;">

 <a class="fabtn"  data-roles='update_livraison_sain' data-id="<?php echo $aff['id_trsain'];  ?>" > <i class="fa fa-edit "  ></i></a>


<a  class="fabtn" target="blank" href="fichier_livraison_sain.php?id=<?php echo $aff['id_trsain']; ?>"   >
  <i class="fa fa-eye " ></i> 
</a>

<a    id="<?php echo $aff['id_trsain'] ?>" name="delete"   class="fabtn1 " onclick="delete_livraison_sain(<?php echo $aff['id_trsain'] ?>)" > <i class="fa fa-trash  " ></i> </a>
</div>
</td>






</tr>
<?php } ?> 

<?php  
if(!empty($aff['date_trsain']) and empty($aff['id_trsain'])){
    ?>

<tr style="background: black; color:black; text-align: center; vertical-align: middle; ">
  <td style="color: white;" class="sous_tatal_livraison" colspan="8"> TOTAL <?php echo $aff['date_trsain'] ?></td>
 
  <td style="color:black;" class="sous_tatal_livraison" ><?php echo $aff['sum(trs.sac_trsain)'] ?></td>
  <td style="color:black;" class="sous_tatal_livraison" ><?php echo $aff['sum(trs.poids_trsain)'] ?></td>
   <td style="color:black;" class="sous_tatal_livraison" ></td>
  

</tr>
<?php } ?> 



<?php } 

}

//FERMETURE FUNCTION
?>  

<?php  
 
  function affichage_transfert_avaries($bdd,$produit,$poids_sac,$navire,$destination,$statut){

 ?>
   <?php
        $affiche=afficher_transfert_avaries($bdd,$produit,$poids_sac,$navire,$destination,$statut);

   while ($aff=$affiche->fetch()){
 if(!empty($aff['dates']) and !empty($aff['id'])){
    ?>

<tr   style="vertical-align: middle;" >
  <td  style=" vertical-align: middle; color:black"  class="colaffiches" id="<?php echo $aff['id'].'date_sain'; ?>"    ><?php echo $aff['dates'] ?></td>
  <td  style=" vertical-align: middle; color:black" class="colaffiches" id="<?php echo $aff['id'].'heure_sain'; ?>"><?php echo $aff['heure'] ?></td>
    <td  style=" vertical-align: middle; color:black"  class="colaffiches" id="<?php echo $aff['id'].'dec_sain'; ?>" ><?php echo $aff['num_dec_transfert'] ?></td>
     <span style="display: none;"  id="<?php echo $aff['id'].'id_dec_sain'; ?>">   <?php echo $aff['dec_trsain'] ?> </span>
         
            
  <td>  </td>
  <td> </td>
  <td  ></td>
  <td  style=" vertical-align: middle; color:black"  class="colaffiches" id= ><?php echo $aff['num_camions'] ?></td>
  <td  style=" vertical-align: middle; color:black"  class="colaffiches" id="<?php echo $aff['id'].'chauffeur_sain'; ?>" ><?php echo $aff['nom_chauffeur'] ?></td>
  <span style="display: none;" id="<?php echo $aff['id'].'id_dis_sain'; ?>">   <?php echo $aff['id_dis_liv'] ?> </span>
   <span style="display: none;" id="<?php echo $aff['id'].'id_produit_sain'; ?>">   <?php echo $aff['id_produit'] ?> </span>
   <span style="display: none;" id="<?php echo $aff['id'].'poids_sac_sain'; ?>">   <?php echo $aff['poids_kg'] ?> </span>
   <span style="display: none;" id="<?php echo $aff['id'].'id_destination_sain'; ?>">   <?php echo $aff['id_mangasin'] ?> </span>
   <span style="display: none;" id="<?php echo $aff['id'].'id_navire_sain'; ?>">   <?php echo $aff['id_navire'] ?> </span>


  <td  style=" vertical-align: middle; color:black" class="colaffiches" id="<?php echo $aff['id'].'sac_sain'; ?>" ><?php echo $aff['sac'] ?></td>
  <td  style=" vertical-align: middle; color:black"  class="colaffiches" ><?php echo $aff['poids'] ?> </td>

 
  <td class="cacher_cellule"  style="vertical-align: middle; text-align: center; " >
  
   <div style="display: flex; justify-content: center;">

 <a class="fabtn"  data-roles='update_livraison_sain' data-id="<?php echo $aff['id'];  ?>" > <i class="fa fa-edit "  ></i></a>


<a  class="fabtn" target="blank" href="fichier_livraison_sain.php?id=<?php echo $aff['id']; ?>"   >
  <i class="fa fa-eye " ></i> 
</a>

<a    id="<?php echo $aff['id'] ?>" name="delete"   class="fabtn1 " onclick="delete_livraison_sain(<?php echo $aff['id'] ?>)" > <i class="fa fa-trash  " ></i> </a>
</div>
</td>






</tr>
<?php } ?> 

<?php  
if(!empty($aff['dates']) and empty($aff['id'])){
    ?>

<tr style="background: black; color:black; text-align: center; vertical-align: middle; ">
  <td style="color: white;" class="sous_tatal_livraison" colspan="8"> TOTAL <?php echo $aff['dates'] ?></td>
 
  <td style="color:black;" class="sous_tatal_livraison" ><?php echo $aff['sum(trav.sac)'] ?></td>
  <td style="color:black;" class="sous_tatal_livraison" ><?php echo $aff['sum(trav.poids)'] ?></td>
   <td style="color:black;" class="sous_tatal_livraison" ></td>
  

</tr>
<?php } ?> 



<?php } 

}

//FERMETURE FUNCTION
?>    