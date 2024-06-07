<?php 

function afficher_chauffeur($bdd){

$chauffeur=$bdd->query("select * from chauffeur ");
	return $chauffeur;
}

function calculLigne($bdd,$id){

	 $calculLigne=$bdd->prepare("select count(id_chauffeur) from chauffeur where id_chauffeur<=?");
      $calculLigne->bindParam(1,$id);
      $calculLigne->execute();
      return $calculLigne;
  }

  function affichage_chauffeur($bdd){
   $chauffeur=	afficher_chauffeur($bdd);
   while($chauffeurs=$chauffeur->fetch()){
   	$id=$chauffeurs['id_chauffeur'];

     $calculLigne=	calculLigne($bdd,$id);
     $calculLignes=$calculLigne->fetch(); ?>

                       <tr style="text-align:center;" border='5' id="<?php echo $chauffeurs['id_chauffeur'] ?>">
                            <td ><span style="color: red; margin-left: 0px; " > <?php echo  $calculLignes['count(id_chauffeur)']; ?></span> </td>
                                 <td id="<?php echo $chauffeurs['id_chauffeur'].'chauffeur' ?>" ><?php echo $chauffeurs['nom_chauffeur']; ?></td>
                               
                              <td id="<?php echo $chauffeurs['id_chauffeur'].'permis' ?>" ><?php echo$chauffeurs['n_permis']; ?> </td>
                            <td id="<?php echo $chauffeurs['id_chauffeur'].'tel_chauffeur' ?>" ><?php echo $chauffeurs['num_telephone']; ?> </td>
                          
                          <td  >
  <button id="<?php echo $chauffeurs['id_chauffeur'] ?>" name="deletechauf" type="submit"  class="fabtn1 " onclick="deleteChauffeur(<?php echo $chauffeurs['id_chauffeur'] ?>)" > <i class="fa fa-trash  " ></i> </button>
                            <a class="fabtn"  type="" name="modify" data-role="update_chauffeur"   data-id="<?php echo $chauffeurs['id_chauffeur']; ?>"       id="btnbtn" s> <i class="fa fa-edit " ></i></a></td>
                        </tr>
     <?php  

   }
  }

 ?>

