<?php 

function afficher_entrepot($bdd){

	$entrepot=$bdd->query('SELECT mg.*,su.* from mangasin as mg left join simar_user as su on su.id_sim_user=mg.id_mangasinier order by mg.mangasin asc ');
	return $entrepot;
}

function calculLigne($bdd,$id){

	 $calculLigne=$bdd->prepare("select count(mangasin) from mangasin where id<=?");
      $calculLigne->bindParam(1,$id);
      $calculLigne->execute();
      return $calculLigne;
  }

  function affichage_entrepot($bdd){
   $entrepot=	afficher_entrepot($bdd);
   while($entrepots=$entrepot->fetch()){
   	$id=$entrepots['id'];

     $calculLigne=	calculLigne($bdd,$id);
     $calculLignes=$calculLigne->fetch(); ?>

                           <tr  style="text-align:center; vertical-align: middle; " border='5' id="<?php echo $entrepots['id'] ?>">
                            <td style="vertical-align: middle; font-size: 10px;" ><span style="color: red; margin-left: 0px; " >  <?php echo  $calculLignes['count(mangasin)']; ?></span> </td>
          <td id="<?php echo $entrepots['id'].'mangasin' ?>" style="vertical-align: middle; " > <?php echo $entrepots['mangasin']   ; ?> </td>
          <td id="<?php echo $entrepots['id'].'code_mangasin' ?>" style="vertical-align: middle;" > <?php echo $entrepots['code']   ; ?> </td>
                         <td id="<?php echo $entrepots['id'].'agrement' ?>" style="vertical-align: middle;" > <?php echo $entrepots['num_agrement']   ; ?> </td>
        <td id="<?php echo $entrepots['id'].'superficie' ?>" style="vertical-align: middle;" > <?php echo number_format($entrepots['superficie'], 0,',',' ').' m²'; ?> </td>
         <td id="<?php echo $entrepots['id'].'sac_mg' ?>" style="vertical-align: middle; white-space: nowrap;" > <?php echo number_format($entrepots['sac_stock'], 0,',',' '). ' sacs' ?> </td>
       <td id="<?php echo $entrepots['id'].'poids_mg' ?>" style="vertical-align: middle;  white-space: nowrap;" > <?php echo number_format($entrepots['poids_stock'], 3,',',' '). ' T' ?> </td>
       <td style="vertical-align: middle; white-space: nowrap;"> <?php //echo number_format($sac_stocker, 0,',',' '); ?></td> 
       <td style="vertical-align: middle; white-space: nowrap;"> <?php //echo number_format($calT['sum(rm.poids)'], 3,',',' '). ' T'; ?></td> 
                                 
       <td style="vertical-align: middle; white-space: nowrap;"> <?php //echo number_format($sac_restant, 0,',',' '); ?></td>
       <td  style="vertical-align: middle; white-space: nowrap;"> <?php //echo number_format($poids_restant, 3,',',' '); ?></td> 


    
  
                                 
                                 <td style="vertical-align: middle;"  >
              <div style="display: flex; justify-content: center;">                     
                            <a style="float:left;"  id="<?php echo $entrepots['id'] ?>" name="deleteMg"   class="fabtn1 " onclick="deleteMg(<?php echo $entrepots['id'] ?>)" > <i class="fa fa-trash  " ></i> </a>
                            <a  style="display: flex; justify-content: center;"  class="fabtn1" type=""   data-role="update_mangasin" data-id="<?php echo $entrepots['id']; ?>"       id="btnbtn" > <i class="fa fa-edit " ></i></a>
<a style="display: flex; justify-content: center;"  id="<?php echo $entrepots['id'] ?>" name="details" type="submit"  class="fabtn1 " data-bs-toggle="modal" data-bs-target="#vue_details_entrepots<?php echo $entrepots['id'] ?>" onclick="setModalContent(<?php echo $entrepots['id'] ?>)"> <i class="fas fa-info-circle   " ></i> </a>
<a  style="display: flex; justify-content: center;"  href="insertion_fichier_entrepot.php?id=<?php echo $entrepots['id'] ?>"   class="fabtn1 "  onclick="setModalContent(<?php echo $entrepots['id'] ?>)"> <i class="fas fa-folder  " ></i> </a>

</td>    
                              </tr>
     <?php  

   }
  }

 ?>

