<?php 

function par_cale_vrac($bdd,$b){
  $requete_cale = $bdd->prepare("SELECT  c.*, dc.*, sum(dc.nombre_sac), sum(dc.poids),des.* from categories as c left join declaration_chargement as dc on c.id_categories=dc.categories_id 
    left join description_categories as des on des.id_descrip=dc.id_description where dc.id_navire=?
   group by dc.cales, c.id_categories, dc.id_dec  with rollup ");
            $requete_cale ->bindParam(1,$b);
            $requete_cale ->execute();
            return $requete_cale;
} 

function navire_type($bdd,$b){
    $nav=$bdd->prepare("SELECT type,navire from navire_deb where id=?");
    $nav->bindParam(1,$b);
    $nav->execute();
    return $nav;
}

 
  function affichage_par_cale_vrac($bdd,$b){
    //$navs2=navire_con($bdd,$b);
    //$types=$navs2->fetch(); ?>

                 

      <?php 

               $requete_cale=par_cale_vrac($bdd,$b);
             while($row2 = $requete_cale->fetch()){

               $politique_modif = $bdd->prepare("SELECT count(manif.bl)   FROM transfert_debarquement as manif 
             inner join declaration_chargement as dc  on dc.id_dec=manif.cale


                

                   WHERE manif.cale=? ");
                   $politique_modif->bindParam(1,$row2['id_dec']);
                   $politique_modif->execute();
                   $pol_modif=$politique_modif->fetch();
            ?>
      
              <?php 
              if(!empty($row2['id_categories']) and !empty($row2['id_dec']) and !empty($row2['cales']) ){ ?>
                <tr id="<?php echo $row2['id_dec'] ?>" style="text-align:center; background: white; font-size: 14px;" border='5'>
        
      <td class="colcel" id="<?php echo $row2['id_dec'].'cales'; ?>"  ><?php echo $row2['cales']; ?></td>
  
      <td class="colcel"  id="<?php echo $row2['id_dec'].'nom_chargeur'; ?>" ><?php echo $row2['nom_chargeur']; ?></td>
   <td class="colcel"   id="<?php echo $row2['id_dec'].'produit'; ?>"  >   <?php echo $row2['nom_categories']; ?> <?php echo $row2['nom_descrip']; ?></td><span style="display: none;" id="<?php echo $row2['id_dec'].'produit-id'; ?>" style="display: none;"><?php echo $row2['id_categories'] ?></span>
   <span style="display: none;" id="<?php echo $row2['id_dec'].'type'; ?>" style="display: none;" ><?php echo $types['type'] ?></span>

   <span style="display: none;" id="<?php echo $row2['id_dec'].'poids_is_vrac'; ?>"  ><?php echo $row2['sum(dc.poids)'] ?></span>
    <span style="display: none;" class="colcel" id="<?php echo $row2['id_dec'].'conditionnement'; ?>" ><?php echo $row2['conditionnement']; ?> KGS</span>
   <span style="display: none;" class="colcel" id="<?php echo $row2['id_dec'].'sac'; ?>" ><?php echo number_format($row2['sum(dc.nombre_sac)'], 0,',',' '); ?></span>
   
   <td class="colcel" id="<?php echo $row2['id_dec'].'poids'; ?>" ><?php echo number_format($row2['sum(dc.poids)'], 3,',',' '); ?></td>
   

     <td style="display: none;" class="colcel" id="<?php echo $row2['id_dec'].'navire'; ?>" ><?php echo $row2['id_navire'] ?></td>
   <td id="no-print" class="colcel"  >
<div  style="display: flex; justify-content: center; display: flex; vertical-align: middle;">
    <a class="fabtn1"  style="display: flex; justify-content: center; vertical-align: middle;"  id="<?php echo $row2['id_dec'].'aa' ?>" name="delete"    onclick="deleteDec(<?php echo $row2['id_dec'] ?>)" > <i class="fa fa-trash " ></i> </a>
     <a class="fabtn1" style="display: flex; justify-content: center; vertical-align: middle;"  name="modify"  data-role="update" data-id="<?php echo $row2['id_dec']; ?>" data-pol_modif_cale=<?php echo $pol_modif['count(manif.bl)']; ?> ><i class="fa fa-edit  "  ></i></a>
 </div>

   <!--  <a class="fabtn1" style="display: flex; justify-content: center; vertical-align: middle;"  name="modify" >  <i class="fa fa-ellipsis-v "  ></i>  </a> !-->
     
   </div>
    </td>
  
    </tr>
         <?php } ?>

                <?php 
              if(empty($row2['id_categories']) and empty($row2['id_dec']) and !empty($row2['cales'])){ ?>
          <tr  style="text-align:center;  " border='5'>
    <td  id="soustotal" >TOTAL <?php echo $row2['cales']; ?></td>
     <td   id="soustotal"   colspan="2"  >  </td>
    

    <td id="soustotal"  ><?php echo number_format($row2['sum(dc.poids)'], 3,',',' '); ?></td>
     <td class="no-print" id="soustotal"  > </td>
   </tr>
                 <?php } ?>

<?php 
              if(empty($row2['cales']) and empty($row2['id_categories']) and empty($row2['id_dec'])){

               ?>
               <tr>
               
             

<td id="total"   colspan="3"  >TOTAL </td>


<td id="total" ><?php echo number_format($row2['sum(dc.poids)'], 3,',',' '); ?></td>
<td class="no-print" id="total" ></td>
</tr>
<?php } ?>

    </tr>
               <?php } ?>
   
<?php   } //FERMETURE FUNC ?>


 ?>